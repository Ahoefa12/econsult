<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medecin;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class MedecinController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Medecin::with('speciality');

        // F1: Recherche par spécialité
        if ($request->has('speciality')) {
            $query->whereHas('speciality', function ($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->speciality . '%');
            });
        }

        // F2: Filtre par localisation (adresse_cabinet)
        if ($request->has('location')) {
            $query->where('adresse_cabinet', 'like', '%' . $request->location . '%');
        }

        // F2: Filtre par disponibilité (plus complexe, nécessiterait une logique d'agenda)
        if ($request->has('date')) {
            $date = Carbon::parse($request->date)->startOfDay();
            // Filtrer les médecins qui ont des créneaux libres ce jour-là
            $query->whereJsonContains('horaires_travail', $date->dayName); // Ex: 'Lundi'
            // Une logique plus fine impliquerait de vérifier les rendez-vous déjà pris
        }

        $medecins = $query->get();
        return response()->json($medecins);
    }

    // Afficher le profil d'un médecin (F3)
    public function show($id)
    {
        $medecin = Medecin::with('speciality')->find($id);
        if (!$medecin) {
            return response()->json(['message' => 'Médecin non trouvé'], 404);
        }
        return response()->json($medecin);
    }

    // Gestion de l'agenda par le médecin (F8, F9)
    // Nécessite une authentification du médecin (sanctum)
    public function getAgenda(Request $request, $medecinId)
    {
        if ($request->user()->id != $medecinId) {
            return response()->json(['message' => 'Accès non autorisé'], 403);
        }

        $medecin = Medecin::find($medecinId);
        $rendezvous = $medecin->rendezVous()->whereDate('date_heure', '>=', Carbon::now())->orderBy('date_heure')->get();

        return response()->json([
            'horaires_travail' => $medecin->horaires_travail,
            'rendezvous' => $rendezvous
        ]);
    }

    // Bloquer/débloquer des créneaux (F9)
    public function updateHoraires(Request $request, $medecinId)
    {
        if ($request->user()->id != $medecinId) {
            return response()->json(['message' => 'Accès non autorisé'], 403);
        }

        $request->validate([
            'horaires_travail' => 'required|array',
            'horaires_travail.*' => 'nullable', 
        ]);

        $medecin = Medecin::find($medecinId);
        $medecin->horaires_travail = $request->horaires_travail;
        $medecin->save();

        return response()->json(['message' => 'Horaires mis à jour', 'medecin' => $medecin]);
    }

    // Modifier le profil du médecin (F11)
    public function updateProfile(Request $request, $medecinId)
    {
        if ($request->user()->id != $medecinId) {
            return response()->json(['message' => 'Accès non autorisé'], 403);
        }

        $medecin = Medecin::find($medecinId);

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:medecins,email,' . $medecinId,
            'telephone' => 'nullable|string|max:20',
            'adresse_cabinet' => 'nullable|string|max:255',
            'speciality_id' => 'required|exists:specialities,id',
            'diplomes' => 'nullable|array',
            'photo' => 'nullable|image|max:2048', 
        ]);

        // Gérer le téléchargement de la photo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos_medecins', 'public');
            $medecin->photo = $path;
        }

        $medecin->update($request->except(['password', 'photo'])); // Ne pas mettre à jour le mot de passe ici
        return response()->json(['message' => 'Profil médecin mis à jour', 'medecin' => $medecin]);
    }

    // Obtenir les créneaux disponibles pour un médecin à une date donnée (F4)
    public function getAvailableSlots(Request $request, $medecinId)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
        ]);

        $medecin = Medecin::find($medecinId);
        if (!$medecin) {
            return response()->json(['message' => 'Médecin non trouvé'], 404);
        }

        $requestedDate = Carbon::parse($request->date);
        $dayOfWeek = $requestedDate->dayName; // 'Monday', 'Tuesday', etc.

        $medecinHoraires = collect($medecin->horaires_travail)->get($dayOfWeek, []); // Récupérer les horaires pour ce jour
        $dureeConsultation = $medecin->duree_consultation ?? 30; // Si le médecin a une durée de consultation spécifique

        $takenSlots = RendezVous::where('medecin_id', $medecinId)
            ->whereDate('date_heure', $requestedDate)
            ->whereIn('statut', ['confirmé', 'en_attente']) // Seulement les RDV confirmés ou en attente
            ->pluck('date_heure')
            ->map(fn($dt) => Carbon::parse($dt)->format('H:i')) // Formater en 'HH:MM'
            ->toArray();

        $availableSlots = [];
        foreach ($medecinHoraires as $period) {
            list($start, $end) = explode('-', $period);
            $currentSlot = Carbon::parse($requestedDate->format('Y-m-d') . ' ' . $start);
            $endPeriod = Carbon::parse($requestedDate->format('Y-m-d') . ' ' . $end);

            while ($currentSlot->addMinutes($dureeConsultation)->lessThanOrEqualTo($endPeriod)) {
                $slotTime = $currentSlot->subMinutes($dureeConsultation)->format('H:i');
                if (!in_array($slotTime, $takenSlots) && $currentSlot->greaterThan(Carbon::now())) { // Ne pas proposer les créneaux déjà passés
                    $availableSlots[] = $slotTime;
                }
                $currentSlot->addMinutes($dureeConsultation); // Passer au slot suivant
            }
        }

        return response()->json(['date' => $request->date, 'available_slots' => array_unique($availableSlots)]);
    }
}
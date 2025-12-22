<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentPending;
use App\Models\RendezVous;
use App\Models\Medecin;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; // Pour l'envoi d'emails
use Illuminate\Support\Facades\Log;


class RendezVousController extends Controller
{
    // Créer un rendez-vous (F5, F4)
    public function store(Request $request)
    {
        $patient = Auth::user(); // Le patient doit être authentifié
        dd($patient->email);

        $validator = Validator::make($request->all(), [
            'medecin_id' => 'required|exists:medecins,id',
            'date_heure' => 'required|date_format:Y-m-d H:i|after_or_equal:now',
            'duree_minutes' => 'nullable|integer|min:15',
            'motif_consultation' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $medecin = Medecin::find($request->medecin_id);
        $requestedDateTime = Carbon::parse($request->date_heure);
        $duree = $request->duree_minutes ?? 30; // Par défaut 30 minutes

        // Vérification de la disponibilité (F12)
        // 1. Le médecin travaille-t-il à cette heure? (Simplifié ici, basé sur horaires_travail JSON)
        $dayOfWeek = $requestedDateTime->dayName; // Ex: 'Monday'
        $doctorWorks = false;
        if (isset($medecin->horaires_travail[$dayOfWeek])) {
            foreach ($medecin->horaires_travail[$dayOfWeek] as $period) {
                list($start, $end) = explode('-', $period);
                $periodStart = Carbon::parse($requestedDateTime->format('Y-m-d') . ' ' . $start);
                $periodEnd = Carbon::parse($requestedDateTime->format('Y-m-d') . ' ' . $end);

                // Vérifier si le créneau demandé est à l'intérieur d'une période de travail
                if ($requestedDateTime->greaterThanOrEqualTo($periodStart) && $requestedDateTime->addMinutes($duree)->lessThanOrEqualTo($periodEnd)) {
                    $doctorWorks = true;
                    break;
                }
            }
        }

        if (!$doctorWorks) {
            return response()->json(['message' => 'Le médecin n\'est pas disponible à ce créneau selon ses horaires.'], 400);
        }

        // 2. Le créneau n'est-il pas déjà pris? (F12)
        $existingRdv = RendezVous::where('medecin_id', $request->medecin_id)
            ->where('date_heure', $requestedDateTime)
            ->whereIn('statut', ['confirme', 'en_attente'])
            ->first();

        if ($existingRdv) {
            return response()->json(['message' => 'Ce créneau est déjà réservé.'], 409);
        }

        $rendezvous = RendezVous::create([
            'user_id' => $patient->id,
            'medecin_id' => $request->medecin_id,
            'date_heure' => $requestedDateTime,
            'duree_minutes' => $duree,
            'motif_consultation' => $request->motif_consultation,
            'statut' => 'en_attente', // ou 'en_attente' si validation manuelle par le médecin
        ]);
        $userMail = $patient->email;
// dd($userMail);

// Mail::to($patient->email)->send(new AppointmentPending());

        

        

        return response()->json(['message' => 'Rendez-vous créé avec succès', 'rendezvous' => $rendezvous], 201);
    }

    // Consulter les détails d'un RDV (F10 - par le médecin)
    public function show(Request $request, $id)
    {        $rendezvous = RendezVous::with(['patient', 'medecin.speciality'])->find($id);

        if (!$rendezvous) {
            return response()->json(['message' => 'Rendez-vous non trouvé'], 404);
        }

        // Vérification d'autorisation (le médecin ne peut voir que ses RDV)
        if ($request->user() instanceof Medecin && $request->user()->id !== $rendezvous->medecin_id) {
            return response()->json(['message' => 'Accès non autorisé'], 403);
        }
        // Pour un patient, il peut voir ses propres RDV
        if ($request->user() instanceof User && $request->user()->id !== $rendezvous->patient_id) {
            return response()->json(['message' => 'Accès non autorisé'], 403);
        }


        return response()->json($rendezvous);
    }

    // Mise à jour du statut par le médecin (Ex: si statut 'en_attente')
    public function updateStatut(Request $request, $id)
    {
        $medecin = $request->user(); // Le médecin doit être authentifié
        if (!$medecin instanceof Medecin) { // S'assurer que c'est bien un médecin
            return response()->json(['message' => 'Accès non autorisé'], 403);
        }

        $rendezvous = RendezVous::where('id', $id)->where('medecin_id', $medecin->id)->first();
        if (!$rendezvous) {
            return response()->json(['message' => 'Rendez-vous non trouvé ou non autorisé'], 404);
        }

        $request->validate([
            'statut' => 'required|in:confirmé,annulé,terminé', // Ajoutez 'terminé' pour après la consultation
        ]);

        $rendezvous->statut = $request->statut;
        $rendezvous->save();

        // TODO: Envoyer une notification au patient si le statut change (F13)

        return response()->json(['message' => 'Statut du rendez-vous mis à jour', 'rendezvous' => $rendezvous]);
    }
}
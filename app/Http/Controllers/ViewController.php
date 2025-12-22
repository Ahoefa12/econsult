<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RendezVous;
use Illuminate\Support\Facades\Auth;
use App\Models\Medecin;
use App\Models\Specialite;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentPending;

class ViewController extends Controller
{
    public function accueil()
    {
        return view('Accueil');
    }

    public function specialite()
    {
        return view('specialite.index');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function commentCaMarche()
    {
        return view('comment-ca-marche');
    }
    public function contactezNous()
    {
        return view('contactez-nous');
    }

    public function rendezvous()
    {
        return view('rendez-vous');
    }

    public function choisirMedecin(Request $request)
    {
        $specialiteId = $request->query('specialite_id');

        // Fetch doctors based on specialty if provided, otherwise get all
        $medecins = $specialiteId
            ? Medecin::with('speciality')->where('specialite_id', $specialiteId)->get()
            : Medecin::with('speciality')->get();

        return view('medecin', compact('medecins'));
    }

    public function dateHeure()
    {
        return view('date-heure');
    }

    public function informations()
    {
        return view('informations');
    }

    public function confirmerRendezVous(Request $request)
    {
        // Validation des données
        $request->validate([
            'medecin_id' => 'required|exists:medecins,id',
            'date' => 'required|date',
            'heure' => 'required',
            'motif' => 'nullable|string|max:500',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'required|string',
        ]);

        // Combiner date et heure pour le stockage
        $dateHeure = Carbon::parse($request->date . ' ' . $request->heure);

        // Récupérer le médecin pour les détails
        $medecin = Medecin::with('speciality')->findOrFail($request->medecin_id);

        // Créer le rendez-vous
        $rendezVous = RendezVous::create([
            'user_id' => Auth::id(),
            'medecin_id' => $request->medecin_id,
            'date_heure' => $dateHeure,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'motif_consultation' => $request->motif,
            'statut' => 'en_attente',
            'duree_minutes' => 30, // Valeur par défaut
        ]);

        // Charger les relations pour l'email
        $rendezVous->load('medecin.speciality');

        // Envoyer l'email de confirmation
        try {
            Mail::to($request->email)->send(new AppointmentPending($rendezVous));
        } catch (\Exception $e) {
            // Log l'erreur mais ne bloque pas le processus
            \Log::error('Erreur envoi email: ' . $e->getMessage());
        }

        // Préparer les données pour la vue de confirmation
        $appointmentData = [
            'email' => $request->email,
            'specialite' => $medecin->speciality->nom,
            'medecin' => 'Dr. ' . $medecin->prenom . ' ' . $medecin->nom,
            'date' => $dateHeure->translatedFormat('l d F Y'), // Format français ex: samedi 20 décembre 2025
            'heure' => $dateHeure->format('H:i'),
        ];

        return view('confirmation', ['appointment' => $appointmentData]);
    }

}

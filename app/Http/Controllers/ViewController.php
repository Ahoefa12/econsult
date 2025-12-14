<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RendezVous;
use Illuminate\Support\Facades\Auth;
use App\Models\Medecin;
use App\Models\Specialite;
use Carbon\Carbon;

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

    public function choisirMedecin()
    {
        return view('medecin');
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
        // 1. Get Authenticated Patient
        $user = Auth::user();
        $patient = $user->patient;

        if (!$patient) {
            return back()->withErrors(['error' => 'Aucun dossier patient associé à ce compte.']);
        }

        // 2. Validate Data (Assuming mock data passed via form or we retrieve from request)
        // In a real flow, we'd pass IDs. For this demo, let's assume we have them or look them up.
        // The form currently sends: prenom, nom, email, telephone, motif (which are confirming info)
        // BUT we need: medecin_id, date, heure from previous steps.
        // Ideally, these should be passed as hidden fields in the form. But for now I'll check query/inputs.
        
        // Mocking ID retrieval if not in request (since we didn't add hidden fields yet to informations.blade.php)
        // We will assume the user has followed the flow and we might need to grab from session if we stored it there.
        // For simplicity now, let's try to get from request, or fallback to a dummy logic if missing (for demo), 
        // BUT strictly we should use hidden inputs. I will add hidden inputs validation next.
        
        // Let's assume we added hidden inputs (I will do that in the next step).
        
        $request->validate([
            'medecin_id' => 'required',
            'date' => 'required',
            'heure' => 'required',
            'motif' => 'nullable|string'
        ]);

        $medecinId = $request->medecin_id;
        $date = $request->date; // YYYY-MM-DD
        $heure = $request->heure; // HH:MM
        $motif = $request->motif;
        
        // Combine date and time
        $dateHeure = Carbon::parse("$date $heure");

        // 3. Save Appointment
        $rendezVous = RendezVous::create([
            'patient_id' => $patient->id,
            'medecin_id' => $medecinId,
            'date_heure' => $dateHeure,
            'duree_minutes' => 30, // Default
            'motif_consultation' => $motif,
            'statut' => 'en_attente',
            // Also saving contact info for snapshot (as per schema update)
            'nom' => $patient->nom,
            'prenom' => $patient->prenom,
            'telephone' => $patient->telephone,
            'email' => $patient->email,
        ]);

        // 4. Prepare Confirmation Data
        $medecin = Medecin::find($medecinId);
        $appointment = [
            'email' => $patient->email,
            'specialite' => $medecin->speciality->nom ?? 'Généraliste',
            'medecin' => 'Dr. ' . $medecin->prenom . ' ' . $medecin->nom,
            'date' => $dateHeure->translatedFormat('l d F Y'),
            'heure' => $dateHeure->format('H:i'),
        ];
        
        // Store in session for the redirect view
        return redirect()->route('rendez-vous.confirmation')->with('appointment', $appointment);
    }

    public function confirmation()
    {
        if (session('appointment')) {
            $appointment = session('appointment');
        } else {
             // Fallback mock data if accessed directly for testing
             $appointment = [
                'email' => 'diane@gmail.com',
                'specialite' => 'Dermatologie',
                'medecin' => 'Dr. Marie Lefebvre',
                'date' => 'samedi 20 décembre 2025',
                'heure' => '10:00'
            ];
        }
        
        return view('confirmation', compact('appointment'));
    }
}

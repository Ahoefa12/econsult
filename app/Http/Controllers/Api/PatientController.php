<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PatientController extends Controller
{
    // Modifier le profil du patient (après authentification)
    public function updateProfile(Request $request)
    {
        $patient = $request->user(); // Le patient est authentifié via Sanctum

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:patients,email,' . $patient->id,
            'telephone' => 'nullable|string|max:20',
        ]);

        $patient->update($request->except('password')); // Ne pas modifier le mot de passe ici
        return response()->json(['message' => 'Profil patient mis à jour', 'patient' => $patient]);
    }

    // Changer le mot de passe du patient
    public function changePassword(Request $request)
    {
        $patient = $request->user();

        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($patient) {
                if (!Hash::check($value, $patient->password)) {
                    $fail('Le mot de passe actuel est incorrect.');
                }
            }],
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $patient->password = Hash::make($request->new_password);
        $patient->save();

        return response()->json(['message' => 'Mot de passe mis à jour avec succès']);
    }

    // Gérer les RDV du patient (F6)
    public function getMyRendezVous(Request $request)
    {
        $patient = $request->user();
        $rendezvous = $patient->rendezVous()->with('medecin.speciality')->orderBy('date_heure', 'desc')->get();
        return response()->json($rendezvous);
    }

    // Annuler un RDV (F6)
    public function cancelRendezVous(Request $request, $id)
    {
        $patient = $request->user();
        $rendezvous = RendezVous::where('id', $id)->where('patient_id', $patient->id)->first();

        if (!$rendezvous) {
            return response()->json(['message' => 'Rendez-vous non trouvé ou non autorisé'], 404);
        }

        if ($rendezvous->date_heure < now()) {
            return response()->json(['message' => 'Impossible d\'annuler un rendez-vous passé'], 400);
        }

        $rendezvous->statut = 'annulé';
        $rendezvous->save();

        
        return response()->json(['message' => 'Rendez-vous annulé avec succès', 'rendezvous' => $rendezvous]);
    }

   
}
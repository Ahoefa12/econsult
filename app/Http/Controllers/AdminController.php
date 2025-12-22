<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RendezVous;
use App\Models\Medecin;
use App\Models\User;
use App\Models\Specialite;
use App\Models\DisponibiliteMedecin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmed;
use App\Mail\AppointmentCancelled;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'appointments_today' => RendezVous::whereDate('date_heure', Carbon::today())->count(),
            'total_doctors' => Medecin::count(),
            'total_patients' => User::count(),
            'pending_requests' => RendezVous::where('statut', 'en_attente')->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function appointments()
    {
        $appointments = RendezVous::with(['user', 'medecin'])->orderBy('date_heure', 'desc')->get();
        return view('admin.appointments', compact('appointments'));
    }

    public function doctors()
    {
        $doctors = Medecin::with('speciality')->get();
        return view('admin.doctors', compact('doctors'));
    }

    public function patients()
    {
        $patients = User::with('rendezVous')->get();
        return view('admin.patients', compact('patients'));
    }

    public function specialties()
    {
        $specialties = Specialite::withCount('medecins')->get();
        return view('admin.specialties', compact('specialties'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function createDoctor()
    {
        return view('admin.doctor-create');
    }

    public function storeDoctor(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:medecins,email',
            'password' => 'required|string|min:8',
            'telephone' => 'required|string|max:20',
            'specialite_id' => 'required|exists:specialites,id',
            'adresse_cabinet' => 'required|string',
            'diplomes' => 'nullable|string',
            'horaires_travail' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('doctors', 'public');
        }

        // Convert comma-separated strings to arrays for diplomes
        $diplomes = null;
        if ($request->diplomes) {
            $diplomes = array_map('trim', explode(',', $request->diplomes));
        }

        // Create the doctor
        Medecin::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'telephone' => $validated['telephone'],
            'specialite_id' => $validated['specialite_id'],
            'adresse_cabinet' => $validated['adresse_cabinet'],
            'diplomes' => $diplomes,
            'horaires_travail' => $request->horaires_travail,
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.doctors')->with('success', 'Médecin ajouté avec succès!');
    }

    public function editDoctor($id)
    {
        $doctor = Medecin::findOrFail($id);
        return view('admin.doctor-edit', compact('doctor'));
    }

    public function updateDoctor(Request $request, $id)
    {
        $doctor = Medecin::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:medecins,email,' . $doctor->id,
            'password' => 'nullable|string|min:8',
            'telephone' => 'required|string|max:20',
            'specialite_id' => 'required|exists:specialites,id',
            'adresse_cabinet' => 'required|string',
            'diplomes' => 'nullable|string',
            'horaires_travail' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('doctors', 'public');
        }

        // Convert comma-separated strings to arrays for diplomes
        $diplomes = null;
        if ($request->diplomes) {
            $diplomes = array_map('trim', explode(',', $request->diplomes));
        }

        // Update the doctor
        $doctor->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $doctor->password,
            'telephone' => $validated['telephone'],
            'specialite_id' => $validated['specialite_id'],
            'adresse_cabinet' => $validated['adresse_cabinet'],
            'diplomes' => $diplomes,
            'horaires_travail' => $request->horaires_travail,
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.doctors')->with('success', 'Médecin modifié avec succès!');
    }

    /**
     * Affiche l'agenda d'un médecin
     */
    public function doctorSchedule($id)
    {
        $doctor = Medecin::with([
            'disponibilites' => function ($query) {
                $query->future()->orderBy('date');
            }
        ])->findOrFail($id);

        $specialites = Specialite::all();

        return view('admin.doctor-schedule', compact('doctor', 'specialites'));
    }

    /**
     * Met à jour les horaires de travail d'un médecin
     */
    public function updateSchedule(Request $request, $id)
    {
        $doctor = Medecin::findOrFail($id);

        $validated = $request->validate([
            'horaires_travail' => 'required|json',
        ]);

        $horaires = json_decode($validated['horaires_travail'], true);

        $doctor->update([
            'horaires_travail' => $horaires,
        ]);

        return redirect()->route('admin.doctors.schedule', $id)
            ->with('success', 'Horaires mis à jour avec succès!');
    }

    /**
     * Ajoute une exception (congé, fermeture)
     */
    public function addException(Request $request, $id)
    {
        $doctor = Medecin::findOrFail($id);

        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'type' => 'required|in:conge,fermeture,disponible',
            'heure_debut' => 'nullable|date_format:H:i',
            'heure_fin' => 'nullable|date_format:H:i|after:heure_debut',
            'motif' => 'nullable|string|max:500',
        ]);

        DisponibiliteMedecin::create([
            'medecin_id' => $doctor->id,
            'date' => $validated['date'],
            'type' => $validated['type'],
            'heure_debut' => $validated['heure_debut'] ?? null,
            'heure_fin' => $validated['heure_fin'] ?? null,
            'motif' => $validated['motif'] ?? null,
        ]);

        return redirect()->route('admin.doctors.schedule', $id)
            ->with('success', 'Exception ajoutée avec succès!');
    }

    /**
     * Supprime une exception
     */
    public function removeException($id, $exceptionId)
    {
        $doctor = Medecin::findOrFail($id);
        $exception = DisponibiliteMedecin::where('medecin_id', $doctor->id)
            ->findOrFail($exceptionId);

        $exception->delete();

        return redirect()->route('admin.doctors.schedule', $id)
            ->with('success', 'Exception supprimée avec succès!');
    }

    /**
     * Confirme un rendez-vous et envoie un email
     */
    public function confirmAppointment($id)
    {
        $appointment = RendezVous::with('medecin.speciality')->findOrFail($id);

        $appointment->update(['statut' => 'confirme']);

        // Envoyer l'email de confirmation
        try {
            Mail::to($appointment->email)->send(new AppointmentConfirmed($appointment));
        } catch (\Exception $e) {
            \Log::error('Erreur envoi email confirmation: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Rendez-vous confirmé et email envoyé au patient!');
    }

    /**
     * Annule un rendez-vous et envoie un email
     */
    public function cancelAppointment($id)
    {
        $appointment = RendezVous::with('medecin.speciality')->findOrFail($id);

        $appointment->update(['statut' => 'annule']);

        // Envoyer l'email d'annulation
        try {
            Mail::to($appointment->email)->send(new AppointmentCancelled($appointment));
        } catch (\Exception $e) {
            \Log::error('Erreur envoi email annulation: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Rendez-vous annulé et email envoyé au patient!');
    }
}

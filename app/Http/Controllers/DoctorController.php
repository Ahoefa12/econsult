<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RendezVous;
use App\Models\Medecin;
use App\Models\DisponibiliteMedecin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmed;
use App\Mail\AppointmentCancelled;

class DoctorController extends Controller
{
    /**
     * Affiche le tableau de bord du médecin
     */
    public function dashboard()
    {
        $doctor = Auth::guard('doctor')->user();

        // Statistiques
        $stats = [
            'today' => RendezVous::where('medecin_id', $doctor->id)
                ->whereDate('date_heure', Carbon::today())
                ->count(),
            'this_week' => RendezVous::where('medecin_id', $doctor->id)
                ->whereBetween('date_heure', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->count(),
            'pending' => RendezVous::where('medecin_id', $doctor->id)
                ->where('statut', 'en_attente')
                ->count(),
            'total_patients' => RendezVous::where('medecin_id', $doctor->id)
                ->distinct('email')
                ->count('email'),
        ];

        // Prochains rendez-vous
        $upcomingAppointments = RendezVous::where('medecin_id', $doctor->id)
            ->where('date_heure', '>=', Carbon::now())
            ->where('statut', '!=', 'annule')
            ->orderBy('date_heure', 'asc')
            ->limit(5)
            ->get();

        // Rendez-vous aujourd'hui
        $todayAppointments = RendezVous::where('medecin_id', $doctor->id)
            ->whereDate('date_heure', Carbon::today())
            ->where('statut', '!=', 'annule')
            ->orderBy('date_heure', 'asc')
            ->get();

        return view('doctor.dashboard', compact('doctor', 'stats', 'upcomingAppointments', 'todayAppointments'));
    }

    /**
     * Affiche la liste des rendez-vous
     */
    public function appointments(Request $request)
    {
        $doctor = Auth::guard('doctor')->user();

        $query = RendezVous::where('medecin_id', $doctor->id);

        // Compteurs par statut
        $stats = [
            'total' => RendezVous::where('medecin_id', $doctor->id)->count(),
            'pending' => RendezVous::where('medecin_id', $doctor->id)->where('statut', 'en_attente')->count(),
            'confirmed' => RendezVous::where('medecin_id', $doctor->id)->where('statut', 'confirme')->count(),
            'cancelled' => RendezVous::where('medecin_id', $doctor->id)->where('statut', 'annule')->count(),
        ];

        // Filtres
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'today':
                    $query->whereDate('date_heure', Carbon::today());
                    break;
                case 'week':
                    $query->whereBetween('date_heure', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('date_heure', Carbon::now()->month);
                    break;
            }
        }

        if ($request->has('status') && $request->status != 'all') {
            $query->where('statut', $request->status);
        }

        $appointments = $query->orderBy('date_heure', 'desc')->paginate(20);

        return view('doctor.appointments', compact('doctor', 'appointments', 'stats'));
    }

    /**
     * Affiche la liste des patients
     */
    public function patients()
    {
        $doctor = Auth::guard('doctor')->user();

        // Récupérer les patients uniques ayant pris RDV avec ce médecin
        $patients = RendezVous::where('medecin_id', $doctor->id)
            ->select('email', 'nom', 'prenom', 'telephone')
            ->selectRaw('COUNT(*) as total_appointments')
            ->selectRaw('MAX(date_heure) as last_appointment')
            ->groupBy('email', 'nom', 'prenom', 'telephone')
            ->orderBy('last_appointment', 'desc')
            ->get();

        return view('doctor.patients', compact('doctor', 'patients'));
    }

    /**
     * Affiche les détails d'un patient
     */
    public function patientDetails($email)
    {
        $doctor = Auth::guard('doctor')->user();

        // Vérifier que ce patient a bien consulté ce médecin
        $appointments = RendezVous::where('medecin_id', $doctor->id)
            ->where('email', $email)
            ->orderBy('date_heure', 'desc')
            ->get();

        if ($appointments->isEmpty()) {
            abort(404, 'Patient non trouvé');
        }

        $patient = $appointments->first();

        return view('doctor.patient-details', compact('doctor', 'patient', 'appointments'));
    }

    /**
     * Affiche la page de gestion de l'agenda
     */
    public function schedule()
    {
        $doctor = Auth::guard('doctor')->user()->load([
            'disponibilites' => function ($query) {
                $query->where('date', '>=', Carbon::today())->orderBy('date');
            }
        ]);

        return view('doctor.schedule', compact('doctor'));
    }

    /**
     * Met à jour les horaires de travail
     */
    public function updateSchedule(Request $request)
    {
        $doctor = Auth::guard('doctor')->user();

        $request->validate([
            'horaires_travail' => 'required|json',
        ]);

        $horaires = json_decode($request->horaires_travail, true);

        $doctor->update([
            'horaires_travail' => $horaires,
        ]);

        return redirect()->route('doctor.schedule')
            ->with('success', 'Horaires mis à jour avec succès!');
    }

    /**
     * Ajoute une exception (congé, fermeture)
     */
    public function addException(Request $request)
    {
        $doctor = Auth::guard('doctor')->user();

        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'type' => 'required|in:conge,fermeture,disponible',
            'heure_debut' => 'nullable|date_format:H:i',
            'heure_fin' => 'nullable|date_format:H:i',
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

        return redirect()->route('doctor.schedule')
            ->with('success', 'Exception ajoutée avec succès!');
    }

    /**
     * Supprime une exception
     */
    public function removeException($exceptionId)
    {
        $doctor = Auth::guard('doctor')->user();

        $exception = DisponibiliteMedecin::where('medecin_id', $doctor->id)
            ->findOrFail($exceptionId);

        $exception->delete();

        return redirect()->route('doctor.schedule')
            ->with('success', 'Exception supprimée avec succès!');
    }

    /**
     * Confirme un rendez-vous
     */
    public function confirmAppointment($id)
    {
        $doctor = Auth::guard('doctor')->user();

        $appointment = RendezVous::where('medecin_id', $doctor->id)
            ->with('medecin.speciality')
            ->findOrFail($id);

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
     * Annule un rendez-vous
     */
    public function cancelAppointment($id)
    {
        $doctor = Auth::guard('doctor')->user();

        $appointment = RendezVous::where('medecin_id', $doctor->id)
            ->with('medecin.speciality')
            ->findOrFail($id);

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

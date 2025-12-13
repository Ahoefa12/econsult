<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RendezVous;
use App\Models\Medecin;
use App\Models\Patient;
use App\Models\Specialite;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'appointments_today' => RendezVous::whereDate('date_heure', Carbon::today())->count(),
            'total_doctors' => Medecin::count(),
            'total_patients' => Patient::count(),
            'pending_requests' => RendezVous::where('statut', 'en_attente')->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function appointments()
    {
        $appointments = RendezVous::with(['patient', 'medecin'])->orderBy('date_heure', 'desc')->get();
        return view('admin.appointments', compact('appointments'));
    }

    public function doctors()
    {
        $doctors = Medecin::with('speciality')->get();
        return view('admin.doctors', compact('doctors'));
    }

    public function patients()
    {
        $patients = Patient::with('rendezVous')->get();
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
}

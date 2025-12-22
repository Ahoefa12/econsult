<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Medecin;

class DoctorAuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion médecin
     */
    public function showLoginForm()
    {
        // Si déjà connecté, rediriger vers dashboard
        if (Auth::guard('doctor')->check()) {
            return redirect()->route('doctor.dashboard');
        }

        return view('doctor.auth.login');
    }

    /**
     * Authentifie le médecin
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Tentative de connexion avec le guard doctor
        if (Auth::guard('doctor')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('doctor.dashboard'))
                ->with('success', 'Bienvenue Dr. ' . Auth::guard('doctor')->user()->nom);
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    /**
     * Déconnecte le médecin
     */
    public function logout(Request $request)
    {
        Auth::guard('doctor')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('doctor.login')
            ->with('success', 'Vous avez été déconnecté avec succès.');
    }
}

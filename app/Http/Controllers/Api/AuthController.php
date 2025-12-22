<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Patient;
use App\Models\User;

// use App\Models\Medecin;

class AuthController extends Controller
{
    /**
     * Inscription patient
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom'       => 'required|string|max:255',
            'prenom'    => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:patients,email',
            'password'  => 'required|string|min:8|confirmed',
           'role'      => 'nullable|in:patient,medecin'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Patient enregistré avec succès.',
            'token'   => $token,
            'user' => $user
        ], 201);
    }

    /**
     * Connexion patient
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants fournis sont incorrects.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Connexion réussie.',
            'token'   => $token,
            'user' => $user
        ], 200);
    }

    /**
     * Déconnexion (Patient ou Médecin authentifié)
     */
    public function logout(Request $request)
    {
        // Vérification si l'utilisateur est authentifié
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Déconnexion réussie.'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Aucun utilisateur connecté.'
        ], 401);
    }
}

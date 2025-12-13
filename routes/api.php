<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SpecialiteController;
use App\Http\Controllers\Api\MedecinController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\RendezVousController;

/*
| ROUTES PUBLIQUES (sans authentification)
*/

// Auth patients & médecins
Route::post('register-patient', [AuthController::class, 'registerPatient']);
Route::post('login-patient', [AuthController::class, 'loginPatient']);

Route::post('register-medecin', [AuthController::class, 'registerMedecin']);
Route::post('login-medecin', [AuthController::class, 'loginMedecin']);

// Public
Route::get('specialites', [SpecialiteController::class, 'index']);
Route::apiResource('medecins', MedecinController::class)->only(['index', 'show']); 
// index = liste médecins, show = détail d’un médecin

/*
 ROUTES AUTHENTIFIÉES — PATIENT
*/

Route::middleware(['auth:sanctum', 'can:isPatient'])->prefix('patient')->group(function () {
    
    Route::post('logout', [AuthController::class, 'logout']);
    
    Route::get('me', function (Request $request) {
        return $request->user();
    });

    Route::put('profile', [PatientController::class, 'updateProfile']);
    Route::put('password', [PatientController::class, 'changePassword']);

    // Rendez-vous patient
    Route::get('rendezvous', [PatientController::class, 'getMyRendezVous']);
    Route::post('rendezvous', [RendezVousController::class, 'store']);
    Route::put('rendezvous/{id}/cancel', [PatientController::class, 'cancelRendezVous']);
});

/*
| ROUTES AUTHENTIFIÉES — MEDECIN
*/

Route::middleware(['auth:sanctum', 'can:isMedecin'])->prefix('medecin')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('me', fn(Request $request) => $request->user());

    Route::get('{id}/agenda', [MedecinController::class, 'getAgenda']);
    Route::put('{id}/horaires', [MedecinController::class, 'updateHoraires']);
    Route::put('{id}/profile', [MedecinController::class, 'updateProfile']);

    // Gestion RDV
    Route::get('rendezvous/{id}', [RendezVousController::class, 'show']);
    Route::put('rendezvous/{id}/statut', [RendezVousController::class, 'updateStatut']);
});

<?php

use App\Http\Controllers\Api\SpecialiteController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\ViewController::class, 'accueil'])->name('Accueil');
// Route::get('/specialites', [App\Http\Controllers\ViewController::class, 'specialite'])->name('specialites');
Route::get('/specialites/index', [App\Http\Controllers\ViewController::class, 'specialite'])->name('specialites.liste');
Route::get('/login', [App\Http\Controllers\ViewController::class, 'login'])->name('login');
Route::get('/registration', [App\Http\Controllers\ViewController::class, 'registration'])->name('registration');
Route::get('/comment-ca-marche', [App\Http\Controllers\ViewController::class, 'commentCaMarche'])->name('comment_ca_marche');
Route::get('/contactez-nous', [App\Http\Controllers\ViewController::class, 'contactezNous'])->name('contactez_nous');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::post('/registration', [App\Http\Controllers\AuthController::class, 'register'])->name('registration.post');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']); // Backup GET logout

// Protected Appointment Routes
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::get('/appointments', [App\Http\Controllers\AdminController::class, 'appointments'])->name('appointments');
    Route::get('/doctors', [App\Http\Controllers\AdminController::class, 'doctors'])->name('doctors');
    Route::get('/patients', [App\Http\Controllers\AdminController::class, 'patients'])->name('patients');
    Route::get('/specialties', [App\Http\Controllers\AdminController::class, 'specialties'])->name('specialties');
    Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('settings');
});
    Route::get('/rendez-vous', [App\Http\Controllers\ViewController::class, 'rendezvous'])->name('rendez-vous');
    Route::get('/rendez-vous/medecin', [App\Http\Controllers\ViewController::class, 'choisirMedecin'])->name('rendez-vous.medecin');
    Route::get('/rendez-vous/date-heure', [App\Http\Controllers\ViewController::class, 'dateHeure'])->name('rendez-vous.date_heure');
    Route::get('/rendez-vous/informations', [App\Http\Controllers\ViewController::class, 'informations'])->name('rendez-vous.informations');
    Route::post('/rendez-vous/confirmer', [App\Http\Controllers\ViewController::class, 'confirmerRendezVous'])->name('rendez-vous.confirmer');
    Route::get('/rendez-vous/confirmation', [App\Http\Controllers\ViewController::class, 'confirmation'])->name('rendez-vous.confirmation');
});

// Admin Routes

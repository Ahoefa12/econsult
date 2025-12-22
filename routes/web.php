<?php

use App\Http\Controllers\Api\SpecialiteController;
use App\Mail\AppointmentPending;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Mail;
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

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [App\Http\Controllers\AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [App\Http\Controllers\AdminAuthController::class, 'logout'])->name('logout');
});

// Protected Appointment Routes
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
        Route::get('/appointments', [App\Http\Controllers\AdminController::class, 'appointments'])->name('appointments');
        Route::get('/doctors', [App\Http\Controllers\AdminController::class, 'doctors'])->name('doctors');
        Route::get('/patients', [App\Http\Controllers\AdminController::class, 'patients'])->name('patients');
        Route::get('/specialties', [App\Http\Controllers\AdminController::class, 'specialties'])->name('specialties');
        Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('settings');
        Route::get('/doctors/create', [App\Http\Controllers\AdminController::class, 'createDoctor'])->name('doctors.create');
        Route::post('/doctors', [App\Http\Controllers\AdminController::class, 'storeDoctor'])->name('doctors.store');
        Route::get('/doctors/{id}/edit', [App\Http\Controllers\AdminController::class, 'editDoctor'])->name('doctors.edit');
        Route::put('/doctors/{id}', [App\Http\Controllers\AdminController::class, 'updateDoctor'])->name('doctors.update');
        Route::get('/doctors/{id}/schedule', [App\Http\Controllers\AdminController::class, 'doctorSchedule'])->name('doctors.schedule');
        Route::post('/doctors/{id}/schedule', [App\Http\Controllers\AdminController::class, 'updateSchedule'])->name('doctors.schedule.update');
        Route::post('/doctors/{id}/exceptions', [App\Http\Controllers\AdminController::class, 'addException'])->name('doctors.exceptions.add');
        Route::delete('/doctors/{id}/exceptions/{exceptionId}', [App\Http\Controllers\AdminController::class, 'removeException'])->name('doctors.exceptions.remove');

        // Appointment status routes
        Route::post('/appointments/{id}/confirm', [App\Http\Controllers\AdminController::class, 'confirmAppointment'])->name('appointments.confirm');
        Route::post('/appointments/{id}/cancel', [App\Http\Controllers\AdminController::class, 'cancelAppointment'])->name('appointments.cancel');
    });
    Route::get('/rendez-vous', [App\Http\Controllers\ViewController::class, 'rendezvous'])->name('rendez-vous');
    Route::get('/rendez-vous/medecin', [App\Http\Controllers\ViewController::class, 'choisirMedecin'])->name('rendez-vous.medecin');
    Route::get('/rendez-vous/date-heure', [App\Http\Controllers\ViewController::class, 'dateHeure'])->name('rendez-vous.date_heure');
    Route::get('/rendez-vous/informations', [App\Http\Controllers\ViewController::class, 'informations'])->name('rendez-vous.informations');
    Route::post('/rendez-vous/confirmer', [App\Http\Controllers\ViewController::class, 'confirmerRendezVous'])->name('rendez-vous.confirmer');
    Route::get('/rendez-vous/confirmation', [App\Http\Controllers\ViewController::class, 'confirmation'])->name('rendez-vous.confirmation');
});

// Doctor Authentication Routes (public)
Route::prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/login', [App\Http\Controllers\DoctorAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\DoctorAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [App\Http\Controllers\DoctorAuthController::class, 'logout'])->name('logout');
});

// Doctor Dashboard Routes (protected)
Route::prefix('doctor')->name('doctor.')->middleware(App\Http\Middleware\DoctorAuth::class)->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DoctorController::class, 'dashboard'])->name('dashboard');
    Route::get('/appointments', [App\Http\Controllers\DoctorController::class, 'appointments'])->name('appointments');
    Route::post('/appointments/{id}/confirm', [App\Http\Controllers\DoctorController::class, 'confirmAppointment'])->name('appointments.confirm');
    Route::post('/appointments/{id}/cancel', [App\Http\Controllers\DoctorController::class, 'cancelAppointment'])->name('appointments.cancel');
    Route::get('/patients', [App\Http\Controllers\DoctorController::class, 'patients'])->name('patients');
    Route::get('/patients/{email}', [App\Http\Controllers\DoctorController::class, 'patientDetails'])->name('patients.details');
    Route::get('/schedule', [App\Http\Controllers\DoctorController::class, 'schedule'])->name('schedule');
    Route::post('/schedule', [App\Http\Controllers\DoctorController::class, 'updateSchedule'])->name('schedule.update');
    Route::post('/schedule/exceptions', [App\Http\Controllers\DoctorController::class, 'addException'])->name('schedule.exceptions.add');
    Route::delete('/schedule/exceptions/{exceptionId}', [App\Http\Controllers\DoctorController::class, 'removeException'])->name('schedule.exceptions.remove');
});

Route::get('/test-mail', function () {
    Mail::to('demagnanestor@gmail.com')->send(new AppointmentPending());
    return 'mail envoyé';
});

// API Routes for Schedule
Route::prefix('api')->group(function () {
    Route::get('/schedule/available-slots', [App\Http\Controllers\ScheduleController::class, 'getAvailableSlots'])->name('api.schedule.slots');
    Route::post('/schedule/check-availability', [App\Http\Controllers\ScheduleController::class, 'checkAvailability'])->name('api.schedule.check');
    Route::get('/schedule/month/{medecinId}/{year}/{month}', [App\Http\Controllers\ScheduleController::class, 'getMonthAppointments'])->name('api.schedule.month');
    Route::get('/schedule/availability', [App\Http\Controllers\ScheduleController::class, 'getMonthAvailability'])->name('api.schedule.availability');
});

// Admin Routes


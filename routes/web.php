<?php

use App\Http\Controllers\Api\SpecialiteController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\ViewController::class, 'accueil'])->name('Accueil');
// Route::get('/specialites', [App\Http\Controllers\ViewController::class, 'specialite'])->name('specialites');
Route::get('/login', [App\Http\Controllers\ViewController::class, 'login'])->name('login');
Route::get('/registration', [App\Http\Controllers\ViewController::class, 'registration'])->name('registration');
Route::get('/comment-ca-marche', [App\Http\Controllers\ViewController::class, 'commentCaMarche'])->name('comment_ca_marche');
Route::get('/contactez-nous', [App\Http\Controllers\ViewController::class, 'contactezNous'])->name('contactez_nous');
Route::get('/rendez-vous', [App\Http\Controllers\ViewController::class, 'rendezvous'])->name('rendez-vous');

Route::get('/specialites/index', [SpecialiteController::class, 'index'])->name('specialites.liste');

// Route::resource('/specialites', SpecialiteController::class)->names([
//     'index'   => 'specialites.liste',
//     'create'  => 'specialites.creer',
//     'store'   => 'specialites.enregistrer',
//     'show'    => 'specialites.afficher',
//     'edit'    => 'specialites.editer',
//     'update'  => 'specialites.mettre_a_jour',
//     'destroy' => 'specialites.supprimer',
// ]);

Route::get('/rendez-vous/medecin', [App\Http\Controllers\ViewController::class, 'choisirMedecin'])->name('rendez-vous.medecin');
Route::get('/rendez-vous/date-heure', [App\Http\Controllers\ViewController::class, 'dateHeure'])->name('rendez-vous.date_heure');
Route::get('/rendez-vous/informations', [App\Http\Controllers\ViewController::class, 'informations'])->name('rendez-vous.informations');
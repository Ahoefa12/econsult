<?php

use App\Models\Specialite;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedecinsTable extends Migration
{
    /**

     * @return void
     */
    public function up()
    {
        Schema::create('medecins', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('specialite_id')->nullable();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('password'); // Mot de passe hashé
            $table->string('telephone')->nullable();
            $table->string('adresse_cabinet')->nullable();
            $table->string('photo')->nullable(); // Chemin vers l'image
            $table->json('diplomes')->nullable(); // Ex: ['PhD en Cardiologie', 'DU Imagerie']
            $table->json('horaires_travail')->nullable(); // Ex: ['Lundi': ['09:00-12:00', '14:00-18:00']]
            $table->foreignIdFor(Specialite::class)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medecins');
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rendez_vouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('medecin_id')->constrained('medecins')->onDelete('cascade');
            $table->dateTime('date_heure');
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone');
            $table->string('email');
            $table->integer('duree_minutes')->default(30); // Durée par défaut de la consultation
            $table->text('motif_consultation')->nullable();
            $table->enum('statut', ['confirme', 'annule', 'en_attente'])->default('en_attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendez_vouses');
    }
};

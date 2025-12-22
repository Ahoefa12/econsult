<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('disponibilites_medecins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medecin_id')->constrained('medecins')->onDelete('cascade');
            $table->date('date');
            $table->enum('type', ['conge', 'fermeture', 'disponible'])->default('conge');
            $table->time('heure_debut')->nullable();
            $table->time('heure_fin')->nullable();
            $table->text('motif')->nullable();
            $table->timestamps();

            // Index pour améliorer les performances de recherche
            $table->index(['medecin_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disponibilites_medecins');
    }
};

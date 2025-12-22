<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medecin;
use Illuminate\Support\Facades\Hash;

class DoctorTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mettre à jour tous les médecins existants avec un mot de passe
        $medecins = Medecin::all();

        foreach ($medecins as $medecin) {
            // Utiliser l'email comme base pour le mot de passe (pour les tests)
            // Mot de passe par défaut : "password123"
            $medecin->update([
                'password' => Hash::make('password123')
            ]);

            $this->command->info("Mot de passe défini pour Dr. {$medecin->nom} {$medecin->prenom} - Email: {$medecin->email}");
        }

        $this->command->info('');
        $this->command->info('✅ Tous les médecins peuvent maintenant se connecter avec le mot de passe: password123');
        $this->command->info('');
        $this->command->info('Exemples de connexion:');
        $this->command->info('URL: http://127.0.0.1:8000/doctor/login');

        $firstDoctor = Medecin::first();
        if ($firstDoctor) {
            $this->command->info("Email: {$firstDoctor->email}");
            $this->command->info('Mot de passe: password123');
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medecin;
use App\Models\DisponibiliteMedecin;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer tous les médecins
        $medecins = Medecin::all();

        foreach ($medecins as $medecin) {
            // Définir des horaires de travail standard
            $horaires = [
                'lundi' => [
                    ['debut' => '09:00', 'fin' => '12:00'],
                    ['debut' => '14:00', 'fin' => '18:00']
                ],
                'mardi' => [
                    ['debut' => '09:00', 'fin' => '12:00'],
                    ['debut' => '14:00', 'fin' => '18:00']
                ],
                'mercredi' => [
                    ['debut' => '09:00', 'fin' => '12:00']
                ],
                'jeudi' => [
                    ['debut' => '09:00', 'fin' => '12:00'],
                    ['debut' => '14:00', 'fin' => '18:00']
                ],
                'vendredi' => [
                    ['debut' => '09:00', 'fin' => '12:00'],
                    ['debut' => '14:00', 'fin' => '17:00']
                ],
                'samedi' => [
                    ['debut' => '09:00', 'fin' => '13:00']
                ],
                'dimanche' => []
            ];

            // Mettre à jour les horaires du médecin
            $medecin->update([
                'horaires_travail' => $horaires
            ]);

            // Ajouter quelques exceptions (congés) pour les 3 prochains mois
            $exceptions = [
                [
                    'date' => Carbon::now()->addDays(15),
                    'type' => 'conge',
                    'motif' => 'Congé personnel'
                ],
                [
                    'date' => Carbon::now()->addDays(30),
                    'type' => 'conge',
                    'motif' => 'Formation médicale'
                ],
                [
                    'date' => Carbon::now()->addDays(45),
                    'type' => 'fermeture',
                    'heure_debut' => '14:00',
                    'heure_fin' => '18:00',
                    'motif' => 'Réunion administrative'
                ]
            ];

            foreach ($exceptions as $exception) {
                DisponibiliteMedecin::create([
                    'medecin_id' => $medecin->id,
                    'date' => $exception['date'],
                    'type' => $exception['type'],
                    'heure_debut' => $exception['heure_debut'] ?? null,
                    'heure_fin' => $exception['heure_fin'] ?? null,
                    'motif' => $exception['motif']
                ]);
            }

            $this->command->info("Horaires et exceptions créés pour Dr. {$medecin->nom} {$medecin->prenom}");
        }

        $this->command->info('Seeding des horaires terminé avec succès!');
    }
}

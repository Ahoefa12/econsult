<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medecin;
use App\Models\User;
use App\Models\Specialite;
use Illuminate\Support\Facades\Hash;

class MedecinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Données des médecins avec leurs spécialités
        $medecins = [
            // Cardiologie (ID: 1)
            [
                'nom' => 'Dubois',
                'prenom' => 'Jean',
                'email' => 'jean.dubois@econsult.com',
                'telephone' => '0601020304',
                // 'adresse_cabinet' => '15 Avenue des Champs-Élysées, 75008 Paris',
                'specialite_id' => 1,
                'diplomes' => ['Doctorat en Médecine', 'Spécialisation en Cardiologie', 'DU Échocardiographie'],
            ],
            [
                'nom' => 'Martin',
                'prenom' => 'Sophie',
                'email' => 'sophie.martin@econsult.com',
                'telephone' => '70121213',
                // 'adresse_cabinet' => '28 Rue de la République, 69002 Lyon',
                'specialite_id' => 1,
                'diplomes' => ['Doctorat en Médecine', 'Spécialisation en Cardiologie'],
            ],

            // Dermatologie (ID: 2)
            [
                'nom' => 'Lefebvre',
                'prenom' => 'Marie',
                'email' => 'marie.lefebvre@econsult.com',
                'telephone' => '70707070',
                // 'adresse_cabinet' => '42 Boulevard Haussmann, 75009 Paris',
                'specialite_id' => 2,
                'diplomes' => ['Doctorat en Médecine', 'Spécialisation en Dermatologie', 'DU Dermatologie Esthétique'],
            ],
            [
                'nom' => 'Moreau',
                'prenom' => 'Pierre',
                'email' => 'pierre.moreau@econsult.com',
                'telephone' => '71717171',
                // 'adresse_cabinet' => '18 Rue Victor Hugo, 13001 Marseille',
                'specialite_id' => 2,
                'diplomes' => ['Doctorat en Médecine', 'Spécialisation en Dermatologie'],
            ],

            // Neurologie (ID: 3)
            [
                'nom' => 'Bernard',
                'prenom' => 'Claire',
                'email' => 'claire.bernard@econsult.com',
                'telephone' => '78451223',
                // 'adresse_cabinet' => '5 Place Bellecour, 69002 Lyon',
                'specialite_id' => 3,
                'diplomes' => ['Doctorat en Médecine', 'Spécialisation en Neurologie', 'DU Neuro-imagerie'],
            ],

            // Généraliste (ID: 4)
            [
                'nom' => 'Petit',
                'prenom' => 'Thomas',
                'email' => 'thomas.petit@econsult.com',
                'telephone' => '78451252',
                // 'adresse_cabinet' => '12 Rue de la Paix, 75002 Paris',
                'specialite_id' => 4,
                'diplomes' => ['Doctorat en Médecine Générale', 'DU Médecine d\'Urgence'],
            ],
            [
                'nom' => 'Robert',
                'prenom' => 'Isabelle',
                'email' => 'isabelle.robert@econsult.com',
                'telephone' => '92157548',
                // 'adresse_cabinet' => '7 Avenue Jean Jaurès, 31000 Toulouse',
                'specialite_id' => 4,
                'diplomes' => ['Doctorat en Médecine Générale'],
            ],
            [
                'nom' => 'Richard',
                'prenom' => 'Luc',
                'email' => 'luc.richard@econsult.com',
                'telephone' => '78455623',
                // 'adresse_cabinet' => '23 Rue Nationale, 59000 Lille',
                'specialite_id' => 4,
                'diplomes' => ['Doctorat en Médecine Générale', 'DU Gériatrie'],
            ],

            // Pédiatrie (ID: 5)
            [
                'nom' => 'Durand',
                'prenom' => 'Émilie',
                'email' => 'emilie.durand@econsult.com',
                'telephone' => '',
                // 'adresse_cabinet' => '34 Boulevard Saint-Germain, 75005 Paris',
                'specialite_id' => 5,
                'diplomes' => ['Doctorat en Médecine', 'Spécialisation en Pédiatrie', 'DU Néonatologie'],
            ],
            [
                'nom' => 'Roux',
                'prenom' => 'Antoine',
                'email' => 'antoine.roux@econsult.com',
                'telephone' => '0601020313',
                // 'adresse_cabinet' => '9 Rue Paradis, 13001 Marseille',
                'specialite_id' => 5,
                'diplomes' => ['Doctorat en Médecine', 'Spécialisation en Pédiatrie'],
            ],

            // Psychiatrie (ID: 6)
            [
                'nom' => 'Vincent',
                'prenom' => 'Nathalie',
                'email' => 'nathalie.vincent@econsult.com',
                'telephone' => '0601020314',
                // 'adresse_cabinet' => '16 Rue de Rivoli, 75004 Paris',
                'specialite_id' => 6,
                'diplomes' => ['Doctorat en Médecine', 'Spécialisation en Psychiatrie', 'DU Thérapies Cognitives'],
            ],

            // Gynécologie (ID: 7)
            [
                'nom' => 'Fournier',
                'prenom' => 'Céline',
                'email' => 'celine.fournier@econsult.com',
                'telephone' => '0601020315',
                // 'adresse_cabinet' => '21 Avenue Foch, 69006 Lyon',
                'specialite_id' => 7,
                'diplomes' => ['Doctorat en Médecine', 'Spécialisation en Gynécologie-Obstétrique'],
            ],

            // Orthopédie (ID: 8)
            [
                'nom' => 'Girard',
                'prenom' => 'Marc',
                'email' => 'marc.girard@econsult.com',
                'telephone' => '0601020316',
                // 'adresse_cabinet' => '8 Rue du Commerce, 75015 Paris',
                'specialite_id' => 8,
                'diplomes' => ['Doctorat en Médecine', 'Spécialisation en Chirurgie Orthopédique', 'DU Traumatologie du Sport'],
            ],

            // Ophtalmologie (ID: 10)
            [
                'nom' => 'Bonnet',
                'prenom' => 'Julien',
                'email' => 'julien.bonnet@econsult.com',
                'telephone' => '0601020317',
                // 'adresse_cabinet' => '45 Cours Vitton, 69006 Lyon',
                'specialite_id' => 10,
                'diplomes' => ['Doctorat en Médecine', 'Spécialisation en Ophtalmologie', 'DU Chirurgie Réfractive'],
            ],
        ];

        foreach ($medecins as $medecinData) {
            // Créer un utilisateur pour chaque médecin
            $user = User::create([
                'nom' => $medecinData['nom'],
                'prenom' => $medecinData['prenom'],
                'email' => $medecinData['email'],
                'password' => Hash::make('password123'), // Mot de passe par défaut
                'telephone' => $medecinData['telephone'],
                'adresse' => $medecinData['adresse_cabinet'],
                'date_naissance' => '1980-01-01', // Date par défaut
                'sexe' => 'M', // Sexe par défaut
                'role_id' => 2, // Assuming 2 is the role ID for doctors
            ]);

            // Créer le médecin
            Medecin::create([
                'user_id' => $user->id,
                'nom' => $medecinData['nom'],
                'prenom' => $medecinData['prenom'],
                'email' => $medecinData['email'],
                'password' => Hash::make('password123'),
                'telephone' => $medecinData['telephone'],
                'adresse_cabinet' => $medecinData['adresse_cabinet'],
                'specialite_id' => $medecinData['specialite_id'],
                'diplomes' => $medecinData['diplomes'],
                'horaires_travail' => [
                    'Lundi' => ['09:00-12:00', '14:00-18:00'],
                    'Mardi' => ['09:00-12:00', '14:00-18:00'],
                    'Mercredi' => ['09:00-12:00', '14:00-18:00'],
                    'Jeudi' => ['09:00-12:00', '14:00-18:00'],
                    'Vendredi' => ['09:00-12:00', '14:00-17:00'],
                ],
                'photo' => null, // Peut être ajouté plus tard
            ]);
        }
    }
}

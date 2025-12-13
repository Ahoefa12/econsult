<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialite; 

class SpecialiteSeeder extends Seeder
{
    public function run(): void
    {
        $specialities = [
            ['nom' => 'Cardiologie'],
            ['nom' => 'Dermatologie'],
            ['nom' => 'Neurologie'],
            ['nom' => 'Généraliste'],
            ['nom' => 'Pédiatrie'],
            ['nom' => 'Psychiatrie'],
            ['nom' => 'Gynécologie'],
            ['nom' => 'Orthopédie'],
            ['nom' => 'Oto-rhino-laryngologie'],
            ['nom' => 'Ophtalmologie'],
            ['nom' => 'Kinesithérapie'],
            ['nom' => 'Endocrinologie'],
            ['nom' => 'Gastro-entérologie'],
            ['nom' => 'Urologie'],
            ['nom' => 'Oncologie'],
            ['nom' => 'Rhumatologie'],
            ['nom' => 'Néphrologie'],
            ['nom' => 'Hématologie'],
            ['nom' => 'Infectiologie'],
            ['nom' => 'Pneumologie'],
        ];

        foreach ($specialities as $speciality) {
            Specialite::create($speciality);
        }
    }
}
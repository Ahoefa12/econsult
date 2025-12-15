<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            SpecialiteSeeder::class,
            MedecinSeeder::class,
        ]);

        User::factory()->create([
            "nom" => "Admin",
            "prenom" => "System",
            "email" => "admin@econsult.com",
            "password" => Hash::make('password'),
            "role_id" => 1,
            "adresse" => "Siege Social",
            "telephone" => "0000000000",
            "date_naissance" => "2000-01-01",
            "sexe" => "M",
        ]);
    }
}

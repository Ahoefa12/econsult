<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles =[
            [
                'typeRole' => 'Admin',
                'status' => 'Actif',
            ],
            [
                'typeRole' => 'Patient',
                'status' => 'Actif',
            ],
            [
                'typeRole' => 'Medecin',
                'status' => 'Actif',
            ],
        ];
        foreach ($roles as $role) {
         Role::create([
            'typeRole' => $role['typeRole'],
            'status' => $role['status'],
         ]);
        }
    }
}

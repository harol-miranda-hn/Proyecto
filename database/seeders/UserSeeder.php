<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear un estudiante
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'profesor',
        ]);

        // Crear un estudiante
        User::create([
            'name' => 'Katherine Cálix',
            'email' => 'katherinecalix@admin.com',
            'password' => bcrypt('password'),
            'role' => 'estudiante',
        ]);

        // Crear un profesor
        User::create([
            'name' => 'Msc. Jairo Martinez',
            'email' => 'profesor1@example.com',
            'password' => bcrypt('password'),
            'role' => 'profesor',
        ]);
    }
}

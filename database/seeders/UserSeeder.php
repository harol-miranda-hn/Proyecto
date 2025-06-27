<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'administrador',
        ]);

        User::create([
            'name' => 'Super Administrador',
            'email' => 'superadmin@supeadmin.com',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
        ]);

        User::create([
            'name' => 'Katherine Cálix',
            'email' => 'katherinecalix@admin.com',
            'password' => bcrypt('password'),
            'role' => 'administrador',
        ]);

        User::create([
            'name' => 'Lic. Harol Miranda',
            'email' => 'harolenocmiranda@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
        ]);
    }
}

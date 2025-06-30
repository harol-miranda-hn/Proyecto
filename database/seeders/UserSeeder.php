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
            'email' => 'admin@darknethn.com',
            'password' => bcrypt('password'),
            'role' => 'administrador',
        ]);

        User::create([
            'name' => 'Super Administrador',
            'email' => 'superadmin@darknethn.com',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
        ]);

        User::create([
            'name' => 'Lic. Katherine Cálix',
            'email' => 'katherinecalix@darknethn.com',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
        ]);

        User::create([
            'name' => 'Lic. Harol Miranda',
            'email' => 'harolenocmiranda@darknethn.com',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
        ]);
    }
}

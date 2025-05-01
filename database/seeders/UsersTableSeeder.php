<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Usuarios existentes
        User::create([
            'uuid' => 'a61f3b62-9d25-4b8f-bb84-63284e9b56f2',
            'name' => 'Juan Pérez',
            'email' => 'juan.perez@gmail.com',
            'password' => Hash::make('hashed_password_juan'),
            'apartment_number' => 'A101'
        ]);

        User::create([
            'uuid' => 'f4b8c1fc-1d96-40a1-93f1-c4658f689784',
            'name' => 'Laura Gómez',
            'email' => 'laura.gomez@outlook.com',
            'password' => Hash::make('hashed_password_laura'),
            'apartment_number' => 'B202'
        ]);

        User::create([
            'uuid' => 'b31e7c8f-82d3-4d36-bfa7-21f3fdcba2ab',
            'name' => 'Carlos Méndez',
            'email' => 'carlos.mendez@gmail.com',
            'password' => Hash::make('hashed_password_carlos'),
            'apartment_number' => 'C303'
        ]);

        User::create([
            'uuid' => 'd426b86b-7f59-4b4a-b6ba-df423c8be097',
            'name' => 'Ana Torres',
            'email' => 'ana.torres@correo.com',
            'password' => Hash::make('hashed_password_ana'),
            'apartment_number' => 'D404'
        ]);

        User::create([
            'uuid' => '8bcf16d3-bcb4-46ea-bb5e-98e0c56f9ab6',
            'name' => 'Javier Sánchez',
            'email' => 'javier.sanchez@correo.com',
            'password' => Hash::make('hashed_password_javier'),
            'apartment_number' => 'E505'
        ]);

        User::create([
            'uuid' => 'c1f616fb-8efb-441f-b960-6e91773d4f74',
            'name' => 'María López',
            'email' => 'maria.lopez@correo.com',
            'password' => Hash::make('hashed_password_maria'),
            'apartment_number' => 'F606'
        ]);

        User::create([
            'uuid' => 'e5b8a923-52f1-4d7f-b2cf-774b0db551f7',
            'name' => 'Jose Trespalacios',
            'email' => 'josetrespalaciso@gmail.com',
            'password' => Hash::make('D3v3l0p3r**'),
            'apartment_number' => 'G707'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            ['uuid' => 'a61f3b62-9d25-4b8f-bb84-63284e9b56f2', 'name' => 'Juan Pérez', 'email' => 'juan.perez@gmail.com', 'password' => bcrypt('hashed_password_juan'), 'apartment_number' => 'A101'],
            ['uuid' => 'f4b8c1fc-1d96-40a1-93f1-c4658f689784', 'name' => 'Laura Gómez', 'email' => 'laura.gomez@outlook.com', 'password' => bcrypt('hashed_password_laura'), 'apartment_number' => 'B202'],
            ['uuid' => 'b31e7c8f-82d3-4d36-bfa7-21f3fdcba2ab', 'name' => 'Carlos Méndez', 'email' => 'carlos.mendez@gmail.com', 'password' => bcrypt('hashed_password_carlos'), 'apartment_number' => 'C303'],
            ['uuid' => 'fdb8d7b8-c6d9-4b79-a45f-0a7889f9ed85', 'name' => 'Ana Torres', 'email' => 'ana.torres@outlook.com', 'password' => bcrypt('hashed_password_ana'), 'apartment_number' => 'D404'],
            ['uuid' => 'c79a07f6-b029-41f7-b222-7e7fe27bfc60', 'name' => 'Javier Sánchez', 'email' => 'javier.sanchez@gmail.com', 'password' => bcrypt('hashed_password_javier'), 'apartment_number' => 'E505'],
            ['uuid' => 'b3f2616c-27cc-4180-b9b3-2830a222d08e', 'name' => 'María López', 'email' => 'maria.lopez@outlook.com', 'password' => bcrypt('hashed_password_maria'), 'apartment_number' => 'F606'],
            ['uuid' => 'f0837c71-c4c1-41e1-9d53-d0f38d0f7f70', 'name' => 'Luis Fernández', 'email' => 'luis.fernandez@gmail.com', 'password' => bcrypt('hashed_password_luis'), 'apartment_number' => 'G707'],
            ['uuid' => 'efb88c9f-ec2c-44f5-bcf5-9cc2320a30cb', 'name' => 'Sofía Martín', 'email' => 'sofia.martin@outlook.com', 'password' => bcrypt('hashed_password_sofia'), 'apartment_number' => 'H808'],
        ]);
    }
}

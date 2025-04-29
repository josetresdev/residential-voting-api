<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'admin', 'description' => 'Administrador del sistema'],
            ['name' => 'resident', 'description' => 'Residente del condominio'],
            ['name' => 'guest', 'description' => 'Invitado temporal al condominio'],
            ['name' => 'security', 'description' => 'Personal de seguridad del condominio'],
            ['name' => 'maintenance', 'description' => 'Personal encargado de mantenimiento del condominio'],
            ['name' => 'manager', 'description' => 'Encargado de la gestión del condominio'],
            ['name' => 'staff', 'description' => 'Personal de soporte'],
        ]);
    }
}

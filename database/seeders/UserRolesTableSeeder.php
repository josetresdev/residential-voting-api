<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesTableSeeder extends Seeder
{
    public function run()
    {
        // Obtener los IDs de los usuarios y roles
        $users = DB::table('users')->pluck('id')->toArray();
        $roles = DB::table('roles')->pluck('id')->toArray();

        // Datos de roles que se asignarán a los usuarios
        $rolesData = [
            ['user_id' => 1, 'role_id' => 1], // Juan Pérez es admin
            ['user_id' => 2, 'role_id' => 2], // Laura Gómez es votante
            ['user_id' => 3, 'role_id' => 2], // Carlos Méndez es votante
            ['user_id' => 4, 'role_id' => 3], // Ana Torres es moderador
            ['user_id' => 5, 'role_id' => 4], // Javier Sánchez es usuario
            ['user_id' => 6, 'role_id' => 2], // María López es votante
            ['user_id' => 7, 'role_id' => 1], // Jose Trespalacios es administrador
        ];

        // Insertar los datos solo si los IDs existen en las tablas users y roles
        foreach ($rolesData as $role) {
            if (in_array($role['user_id'], $users) && in_array($role['role_id'], $roles)) {
                DB::table('role_user')->insertOrIgnore($role);
            }
        }
    }
}

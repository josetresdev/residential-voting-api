<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        Permission::create(['name' => 'create_voting', 'description' => 'Crear votaciones']);
        Permission::create(['name' => 'view_voting', 'description' => 'Ver votaciones']);
        Permission::create(['name' => 'create_user', 'description' => 'Crear usuarios']);
        Permission::create(['name' => 'view_user', 'description' => 'Ver usuarios']);
        Permission::create(['name' => 'create_question', 'description' => 'Crear preguntas']);
        Permission::create(['name' => 'view_question', 'description' => 'Ver preguntas']);
        Permission::create(['name' => 'create_option', 'description' => 'Crear opciones']);
        Permission::create(['name' => 'view_option', 'description' => 'Ver opciones']);
    }
}

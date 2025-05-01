<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Obtener roles existentes
        $adminRole = Role::where('name', 'admin')->first();
        $voterRole = Role::where('name', 'voter')->first();
        $moderatorRole = Role::where('name', 'moderator')->first();
        $userRole = Role::where('name', 'user')->first();

        // Asignar permisos al rol de admin
        $adminRole->permissions()->attach([
            Permission::where('name', 'create_voting')->first()->id,
            Permission::where('name', 'view_voting')->first()->id,
            Permission::where('name', 'create_user')->first()->id,
            Permission::where('name', 'view_user')->first()->id,
            Permission::where('name', 'create_question')->first()->id,
            Permission::where('name', 'view_question')->first()->id,
            Permission::where('name', 'create_option')->first()->id,
            Permission::where('name', 'view_option')->first()->id,
        ]);

        // Asignar permisos al rol de votante
        $voterRole->permissions()->attach([
            Permission::where('name', 'view_voting')->first()->id,
            Permission::where('name', 'view_question')->first()->id,
            Permission::where('name', 'view_option')->first()->id,
        ]);

        // Asignar permisos al rol de moderador
        $moderatorRole->permissions()->attach([
            Permission::where('name', 'view_voting')->first()->id,
            Permission::where('name', 'view_question')->first()->id,
            Permission::where('name', 'view_option')->first()->id,
        ]);

        // Asignar permisos al rol de usuario
        $userRole->permissions()->attach([
            Permission::where('name', 'view_voting')->first()->id,
            Permission::where('name', 'view_question')->first()->id,
            Permission::where('name', 'view_option')->first()->id,
        ]);
    }
}

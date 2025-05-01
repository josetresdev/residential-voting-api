<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'voter']);
        Role::create(['name' => 'moderator']);
        Role::create(['name' => 'user']);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class VotingSessionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('voting_sessions')->insert([
            ['id' => 1, 'uuid' => Str::uuid(), 'title' => 'Presidencia del condominio', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'uuid' => Str::uuid(), 'title' => 'Proyecto de mantenimiento', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'uuid' => Str::uuid(), 'title' => 'Modificación del reglamento interno', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'uuid' => Str::uuid(), 'title' => 'Junta administrativa del condominio', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

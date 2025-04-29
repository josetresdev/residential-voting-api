<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityLogsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('activity_logs')->insert([
            [
                'user_id' => 1,
                'action' => 'create',
                'target_table' => 'voting_sessions',
                'target_id' => 1,
                'description' => 'Creó la sesión de votación para presidente',
                'ip_address' => '192.168.0.10',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => now(),
            ],
            [
                'user_id' => 2,
                'action' => 'vote',
                'target_table' => 'questions',
                'target_id' => 1,
                'description' => 'Votó por opción 2 (Ana Torres)',
                'ip_address' => '192.168.0.5',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => now(),
            ],
            [
                'user_id' => 5,
                'action' => 'create',
                'target_table' => 'voting_sessions',
                'target_id' => 2,
                'description' => 'Creó la sesión de votación para proyectos de mantenimiento',
                'ip_address' => '192.168.0.20',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => now(),
            ],
            [
                'user_id' => 7,
                'action' => 'create',
                'target_table' => 'questions',
                'target_id' => 2,
                'description' => 'Creó la pregunta sobre proyectos de mantenimiento',
                'ip_address' => '192.168.0.30',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => now(),
            ],
        ]);
    }
}

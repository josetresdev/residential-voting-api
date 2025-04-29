<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jobs')->insert([
            [
                'queue' => 'default',
                'payload' => json_encode(['task' => 'send_email', 'to' => 'juan.perez@gmail.com', 'subject' => 'Bienvenido']),
                'attempts' => 0,
                'reserved_at' => null,
                'available_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'queue' => 'maintenance',
                'payload' => json_encode(['task' => 'notify_maintenance_team', 'project' => 'Proyecto A - Piscina']),
                'attempts' => 0,
                'reserved_at' => null,
                'available_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'queue' => 'default',
                'payload' => json_encode(['task' => 'send_email', 'to' => 'laura.gomez@outlook.com', 'subject' => 'Recordatorio de votación']),
                'attempts' => 0,
                'reserved_at' => null,
                'available_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'queue' => 'maintenance',
                'payload' => json_encode(['task' => 'notify_maintenance_team', 'project' => 'Proyecto B - Jardines']),
                'attempts' => 0,
                'reserved_at' => null,
                'available_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

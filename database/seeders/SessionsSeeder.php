<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sessions')->insert([
            [
                'id' => 'a0b23d0b-69bb-4724-8ba6-3e59cc12b84c',
                'user_id' => 2,
                'ip_address' => '192.168.0.5',
                'user_agent' => 'Mozilla/5.0',
                'payload' => '{"auth":true}',
                'created_at' => now(),
                'updated_at' => now(),
                'last_activity' => now(),
            ],
            [
                'id' => 'c1e9baf4-93da-4631-b3e5-e53b5dbfaed8',
                'user_id' => 3,
                'ip_address' => '192.168.0.6',
                'user_agent' => 'Mozilla/5.0',
                'payload' => '{"auth":true}',
                'created_at' => now(),
                'updated_at' => now(),
                'last_activity' => now(),
            ],
            [
                'id' => 'a0c23f5e-07a3-4b6e-9e57-9c792b69da93',
                'user_id' => 6,
                'ip_address' => '192.168.0.7',
                'user_agent' => 'Mozilla/5.0',
                'payload' => '{"auth":true}',
                'created_at' => now(),
                'updated_at' => now(),
                'last_activity' => now(),
            ],
            [
                'id' => 'c2d9a4fb-d960-4649-8759-d1f1c3bdb9e0',
                'user_id' => 8,
                'ip_address' => '192.168.0.8',
                'user_agent' => 'Mozilla/5.0',
                'payload' => '{"auth":true}',
                'created_at' => now(),
                'updated_at' => now(),
                'last_activity' => now(),
            ],
        ]);
    }
}

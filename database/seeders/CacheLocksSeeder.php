<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CacheLocksSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cache_locks')->insert([
            [
                'key' => 'user_data_123',
                'owner' => 'admin_user',
                'expiration' => 600,
            ],
            [
                'key' => 'session_data_987',
                'owner' => 'maintenance_team',
                'expiration' => 600,
            ],
        ]);
    }
}

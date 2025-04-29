<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CacheSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cache')->insert([
            [
                'key' => 'user_data_123',
                'value' => '{"name": "Juan Pérez", "email": "juan.perez@gmail.com"}',
                'expiration' => 3600,
            ],
            [
                'key' => 'session_data_987',
                'value' => '{"session_id": "a0b23d0b-69bb-4724-8ba6-3e59cc12b84c", "status": "active"}',
                'expiration' => 3600,
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasswordResetsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('password_resets')->insert([
            [
                'email' => 'laura.gomez@outlook.com',
                'token' => 'reset_token_hash_1',
                'created_at' => now(),
            ],
            [
                'email' => 'carlos.mendez@gmail.com',
                'token' => 'reset_token_hash_2',
                'created_at' => now(),
            ],
            [
                'email' => 'javier.sanchez@gmail.com',
                'token' => 'reset_token_hash_3',
                'created_at' => now(),
            ],
            [
                'email' => 'maria.lopez@outlook.com',
                'token' => 'reset_token_hash_4',
                'created_at' => now(),
            ],
        ]);
    }
}

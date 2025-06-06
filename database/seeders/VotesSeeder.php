<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VotesSeeder extends Seeder
{
    public function run(): void
    {
        // Insertando votos con referencias correctas a las opciones
        DB::table('votes')->insert([
            [
                'uuid' => '8dbab15e-87bb-4e5d-84cf-cb4f8be612e0',
                'user_id' => 1,
                'voting_session_id' => 1,
                'option_id' => 1,
            ],
            [
                'uuid' => 'd1fc9d1f-2fdb-4640-8b61-90a758f1d393',
                'user_id' => 2,
                'voting_session_id' => 1,
                'option_id' => 2,
            ],
            [
                'uuid' => 'ec9b67ab-7f88-40d7-800b-54c2c24d6872',
                'user_id' => 3,
                'voting_session_id' => 2,
                'option_id' => 3,
            ],
            [
                'uuid' => 'b69e4b3e-b8fe-497b-90ae-fb0f22d6c8ea',
                'user_id' => 4,
                'voting_session_id' => 3,
                'option_id' => 5,
            ],
            [
                'uuid' => '1abfb08f-bc22-462e-b6fe-f632eaad3813',
                'user_id' => 5,
                'voting_session_id' => 4,
                'option_id' => 6,
            ],
            [
                'uuid' => 'aceac6d4-7270-4e0f-a2c3-b4e8e6256db1',
                'user_id' => 6,
                'voting_session_id' => 2,
                'option_id' => 4,
            ],
        ]);
    }
}

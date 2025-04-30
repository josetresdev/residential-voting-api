<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VotesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('votes')->insert([
            [
                'uuid' => '8dbab15e-87bb-4e5d-84cf-cb4f8be612e0',
                'user_id' => 2,
                'question_id' => 1,
                'option_id' => 2,
            ],
            [
                'uuid' => 'd1fc9d1f-2fdb-4640-8b61-90a758f1d393',
                'user_id' => 3,
                'question_id' => 1,
                'option_id' => 1,
            ],
            [
                'uuid' => 'ec9b67ab-7f88-40d7-800b-54c2c24d6872',
                'user_id' => 4,
                'question_id' => 2,
                'option_id' => 3,
            ],
            [
                'uuid' => 'b69e4b3e-b8fe-497b-90ae-fb0f22d6c8ea',
                'user_id' => 5,
                'question_id' => 3,
                'option_id' => 6,
            ],
            [
                'uuid' => '1abfb08f-bc22-462e-b6fe-f632eaad3813',
                'user_id' => 6,
                'question_id' => 4,
                'option_id' => 7,
            ],
            [
                'uuid' => 'aceac6d4-7270-4e0f-a2c3-b4e8e6256db1',
                'user_id' => 7,
                'question_id' => 2,
                'option_id' => 4,
            ],
        ]);
    }
}

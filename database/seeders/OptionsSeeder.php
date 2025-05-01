<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class OptionsSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('options')->insert([
            [
                'id' => 1,
                'question_id' => 1,
                'text' => 'Carlos Méndez',
                'votes_cache' => 0,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'question_id' => 1,
                'text' => 'Ana Torres',
                'votes_cache' => 0,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'question_id' => 2,
                'text' => 'Proyecto A - Piscina',
                'votes_cache' => 0,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'question_id' => 2,
                'text' => 'Proyecto B - Jardines',
                'votes_cache' => 0,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'question_id' => 3,
                'text' => 'Sí',
                'votes_cache' => 0,
                'created_by' => 3,
                'updated_by' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'question_id' => 3,
                'text' => 'No',
                'votes_cache' => 0,
                'created_by' => 3,
                'updated_by' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'question_id' => 4,
                'text' => 'Juan Pérez',
                'votes_cache' => 0,
                'created_by' => 4,
                'updated_by' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 8,
                'question_id' => 4,
                'text' => 'Sofía Martín',
                'votes_cache' => 0,
                'created_by' => 4,
                'updated_by' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}

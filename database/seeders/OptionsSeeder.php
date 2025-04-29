<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('options')->insert([
            [
                'id' => 1,
                'question_id' => 1,
                'text' => 'Carlos Méndez',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => 2,
                'question_id' => 1,
                'text' => 'Ana Torres',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => 3,
                'question_id' => 2,
                'text' => 'Proyecto A - Piscina',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => 4,
                'question_id' => 2,
                'text' => 'Proyecto B - Jardines',
                'created_by' => 2,
                'updated_by' => 2,
            ],
            [
                'id' => 5,
                'question_id' => 3,
                'text' => 'Sí',
                'created_by' => 3,
                'updated_by' => 3,
            ],
            [
                'id' => 6,
                'question_id' => 3,
                'text' => 'No',
                'created_by' => 3,
                'updated_by' => 3,
            ],
            [
                'id' => 7,
                'question_id' => 4,
                'text' => 'Juan Pérez',
                'created_by' => 4,
                'updated_by' => 4,
            ],
            [
                'id' => 8,
                'question_id' => 4,
                'text' => 'Sofía Martín',
                'created_by' => 4,
                'updated_by' => 4,
            ],
        ]);
    }
}

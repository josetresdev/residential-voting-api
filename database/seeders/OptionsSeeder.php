<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Option;
use Illuminate\Support\Facades\DB;

class OptionsSeeder extends Seeder
{
    public function run()
    {
        // Insertando opciones para la pregunta 1
        $option1 = Option::create([
            'question_id' => 1,
            'text' => 'Carlos Méndez',
            'created_by' => 1,
            'updated_by' => 1,
            'votes_cache' => 0,
        ]);
        
        $option2 = Option::create([
            'question_id' => 1,
            'text' => 'Ana Torres',
            'created_by' => 1,
            'updated_by' => 1,
            'votes_cache' => 0,
        ]);

        // Insertando opciones para la pregunta 2
        $option3 = Option::create([
            'question_id' => 2,
            'text' => 'Proyecto A - Piscina',
            'created_by' => 1,
            'updated_by' => 1,
            'votes_cache' => 0,
        ]);

        $option4 = Option::create([
            'question_id' => 2,
            'text' => 'Proyecto B - Jardines',
            'created_by' => 2,
            'updated_by' => 2,
            'votes_cache' => 0,
        ]);

        // Insertando opciones para la pregunta 3
        $option5 = Option::create([
            'question_id' => 3,
            'text' => 'Sí',
            'created_by' => 3,
            'updated_by' => 3,
            'votes_cache' => 0,
        ]);

        $option6 = Option::create([
            'question_id' => 3,
            'text' => 'No',
            'created_by' => 3,
            'updated_by' => 3,
            'votes_cache' => 0,
        ]);
    }
}

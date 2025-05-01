<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('questions')->insert([
            'uuid' => Str::uuid()->toString(),
            'title' => '¿Qué proyecto prefieres?',
            'text' => '¿Qué proyecto prefieres?',
            'description' => 'Descripción de la pregunta sobre proyectos',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('questions')->insert([
            'uuid' => Str::uuid()->toString(),
            'title' => '¿Qué proyecto te gustaría más?',
            'text' => '¿Qué proyecto te gustaría más?',
            'description' => 'Pregunta sobre cuál proyecto es preferido por los votantes',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('questions')->insert([
            'uuid' => Str::uuid()->toString(),
            'title' => '¿Estás a favor de la propuesta?',
            'text' => '¿Estás a favor de la propuesta?',
            'description' => 'Pregunta sobre la aceptación de una propuesta',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

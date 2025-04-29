<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('questions')->insert([
            ['uuid' => 'f0fa73da-b9b7-4724-9b0b-cdf8e580a392', 'title' => '¿Quién debe ser el próximo presidente?', 'description' => 'Votación para elegir el próximo presidente de condominio. Los candidatos son Carlos Méndez y Ana Torres.', 'voting_session_id' => 1, 'closes_at' => '2025-05-10 23:59:59', 'created_by' => 1, 'updated_by' => 1],
            ['uuid' => 'c39edbd0-e8fa-4567-a343-18c9de19fe6a', 'title' => '¿Qué proyecto debe aprobarse primero?', 'description' => 'Votación para seleccionar el primer proyecto de mantenimiento. Las opciones son Proyecto A - Piscina o Proyecto B - Jardines.', 'voting_session_id' => 2, 'closes_at' => '2025-05-15 23:59:59', 'created_by' => 2, 'updated_by' => 2],
            ['uuid' => 'e756d4c8-4c1d-4171-bebd-f21c7c865105', 'title' => '¿Debe modificarse el reglamento interno?', 'description' => 'Votación para aprobar las modificaciones al reglamento interno del condominio.', 'voting_session_id' => 3, 'closes_at' => '2025-05-20 23:59:59', 'created_by' => 3, 'updated_by' => 3],
            ['uuid' => '4baf53cd-4aef-4c8c-897e-e6187e40d34d', 'title' => '¿Quién debe ser el nuevo representante en la junta?', 'description' => 'Votación para elegir al nuevo representante en la junta administrativa del condominio.', 'voting_session_id' => 4, 'closes_at' => '2025-05-25 23:59:59', 'created_by' => 4, 'updated_by' => 4],
        ]);
    }
}

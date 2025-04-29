<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VotingSessionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('voting_sessions')->insert([
            ['uuid' => '4bc03526-07da-47b8-928b-3d2f8194d7ac', 'title' => 'Elección de presidente de condominio', 'description' => 'Votación anual para elegir presidente del condominio. Todos los residentes pueden votar.', 'status' => 'active'],
            ['uuid' => '5c897c43-7d76-4f95-8f1d-56c77c50497e', 'title' => 'Votación sobre proyectos de mantenimiento', 'description' => 'Votación para aprobar proyectos de mantenimiento para el condominio', 'status' => 'active'],
            ['uuid' => '7f5a6cd9-e332-41e8-b0f5-8ffda88d2952', 'title' => 'Votación para cambiar las normas de convivencia', 'description' => 'Votación para modificar las normas de convivencia del condominio.', 'status' => 'closed'],
            ['uuid' => 'e70f7b3f-83b1-4961-8d4a-df7f35e5c4e4', 'title' => 'Elección de representantes para la junta', 'description' => 'Votación para elegir representantes del condominio para la junta administrativa.', 'status' => 'active'],
        ]);
    }
}

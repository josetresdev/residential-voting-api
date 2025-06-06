<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            UserRolesTableSeeder::class,
            RolePermissionsTableSeeder::class,
            VotingSessionsTableSeeder::class,
            QuestionsTableSeeder::class,
            OptionsSeeder::class,
            VotesSeeder::class,
        ]);
    }
}

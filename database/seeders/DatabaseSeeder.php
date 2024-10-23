<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Team;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            ProductSeeder::class
            // Outros seeders que você possa ter
        ]);

        User::factory(10)->withPublicTeam()->create();

        $publicTeam = Team::where('name', 'Public')->first();

        User::factory()->withPersonalTeam()->withPublicTeam()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'current_team_id' => $publicTeam->id
        ]);

        User::factory()->withPublicTeam()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'current_team_id' => $publicTeam->id
        ]);
    }
}

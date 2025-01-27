<?php

namespace Database\Seeders;

use App\Models\User;
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

        User::factory()->withPublicTeam()->withPersonalTeam()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->withPublicTeam()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
        ]);
    }
}

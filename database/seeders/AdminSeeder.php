<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $admin = User::factory()->create([
                'name' => 'Admin User',
                'email' => env('ADMIN_EMAIL'),
                'password' => Hash::make(env('ADMIN_PASSWORD')),
            ]);

            // Criar o time de admin
            $adminTeam = $admin->ownedTeams()->create([
                'name' => 'Admin Team',
                'personal_team' => true,
            ]);

            // Criar o time público
            $publicTeam = $admin->ownedTeams()->create([
                'name' => 'Public',
                'personal_team' => true,
            ]);

            $admin->teams()->attach($adminTeam->id, ['role' => 'admin']);
            $admin->teams()->attach($publicTeam->id, ['role' => 'admin']);
            $admin->current_team_id = $adminTeam->id;
            $admin->save();
        });
    }
}

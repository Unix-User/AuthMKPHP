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
            $admin = User::create([
                'name' => 'Admin User',
                'email' => env('ADMIN_EMAIL'),
                'password' => Hash::make(env('ADMIN_PASSWORD')),
            ]);

            // Criar o time de admin
            $admin->ownedTeams()->create([
                'name' => 'Admin Team',
                'personal_team' => true,
            ]);

            // Criar o time público
            $admin->ownedTeams()->create([
                'name' => 'Public',
                'personal_team' => true,
            ]);
        });
    }
}

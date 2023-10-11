<?php

namespace Database\Seeders;

use App\Enums\UserRoleName;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * * Create Administrator
         */
        User::factory()->create([
            'full_name' => 'Administrator',
            'email' => 'administrator@ditdaya.kemdikbud.go.id',
            'role' => UserRoleName::ADMINISTRATOR,
        ]);

        /**
         * * Create Guest
         */
        User::factory()->count(5)->create();
    }
}

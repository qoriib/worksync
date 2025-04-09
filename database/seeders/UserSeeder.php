<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin HR 1',
            'email' => 'admin1@worksync.com',
            'role' => 'admin',
            'password' => Hash::make('worksync'),
        ]);

        User::create([
            'name' => 'Admin HR 2',
            'email' => 'admin2@worksync.com',
            'role' => 'admin',
            'password' => Hash::make('worksync'),
        ]);

        User::factory()->count(10)->create([
            'role' => 'user',
        ]);
    }
}

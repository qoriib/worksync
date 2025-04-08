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
        // Admin HR
        $admin = User::create([
            'name' => 'Admin HR',
            'email' => 'admin@worksync.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $admin->karyawan()->create([
            'jabatan' => 'HR Manager',
            'no_telp' => '081234567891',
            'alamat' => 'Jl. HRD No. 1',
        ]);

        // Karyawan 1
        $user1 = User::create([
            'name' => 'Karyawan Satu',
            'email' => 'user1@worksync.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $user1->karyawan()->create([
            'jabatan' => 'Staff IT',
            'no_telp' => '081234567892',
            'alamat' => 'Jl. Mawar No. 2',
        ]);

        // Karyawan 2
        $user2 = User::create([
            'name' => 'Karyawan Dua',
            'email' => 'user2@worksync.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $user2->karyawan()->create([
            'jabatan' => 'Staff Finance',
            'no_telp' => '081234567893',
            'alamat' => 'Jl. Melati No. 3',
        ]);
    }
}

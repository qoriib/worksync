<?php

namespace Database\Seeders;

use App\Models\Presensi;
use Illuminate\Database\Seeder;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Presensi::factory()->count(5)->create();
    }
}

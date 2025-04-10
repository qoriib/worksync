<?php

namespace Database\Seeders;

use App\Models\PengajuanPresensi;
use Illuminate\Database\Seeder;

class PengajuanPresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PengajuanPresensi::factory()->count(30)->create();
    }
}

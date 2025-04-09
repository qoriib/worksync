<?php

namespace Database\Seeders;

use App\Models\Cuti;
use Illuminate\Database\Seeder;

class CutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cuti::factory()->count(15)->create();
    }
}

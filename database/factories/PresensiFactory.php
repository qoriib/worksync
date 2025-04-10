<?php

namespace Database\Factories;

use App\Models\Presensi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presensi>
 */
class PresensiFactory extends Factory
{
    protected $model = Presensi::class;

    public function definition(): array
    {
        return [
            'jenis' => $this->faker->randomElement(['absensi', 'terlambat', 'keluar']),
            'waktu' => $this->faker->dateTimeBetween('-5 hours', 'now'),
            'keterangan' => $this->faker->optional()->sentence(),
        ];
    }
}

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
        $waktuMulai = $this->faker->dateTimeBetween('-1 week', '+1 week');
        $waktuSelesai = (clone $waktuMulai)->modify('+8 hours');

        return [
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => $waktuSelesai,
            'keterangan' => $this->faker->optional()->sentence(),
        ];
    }
}

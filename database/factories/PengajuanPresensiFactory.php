<?php

namespace Database\Factories;

use App\Models\PengajuanPresensi;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengajuanPresensi>
 */
class PengajuanPresensiFactory extends Factory
{
    protected $model = PengajuanPresensi::class;

    public function definition(): array
    {
        return [
            'presensi_id' => Presensi::inRandomOrder()->first()->id,
            'user_id' => User::where('role', 'user')->inRandomOrder()->first()->id,
            'alasan' => $this->faker->sentence(),
            'bukti' => null,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}

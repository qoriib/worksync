<?php

namespace Database\Factories;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
    protected $model = Karyawan::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // buat user otomatis jika belum disediakan
            'jabatan' => $this->faker->randomElement(['Staf', 'Supervisor', 'Manager']),
            'no_telp' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
        ];
    }
}

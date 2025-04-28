<?php

namespace Database\Factories;

use App\Models\Karyawan;
use App\Models\Pendidikan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pendidikan>
 */
class PendidikanFactory extends Factory
{
    protected $model = Pendidikan::class;

    public function definition(): array
    {
        return [
            'karyawan_id' => Karyawan::factory(),
            'tingkat_sekolah' => $this->faker->randomElement(['Dasar', 'Lanjutan Pertama', 'Lanjutan Atas', 'Universitas', 'Kursus', 'Lainnya']),
            'nama_sekolah' => $this->faker->company() . ' School',
            'tahun_ijazah' => $this->faker->year(),
            'jurusan' => $this->faker->randomElement(['Teknik Informatika', 'Akuntansi', 'Manajemen', 'Sastra Inggris', 'Hukum', null]),
        ];
    }
}

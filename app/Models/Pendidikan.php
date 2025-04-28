<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'tingkat_sekolah',
        'nama_sekolah',
        'tahun_ijazah',
        'jurusan',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}

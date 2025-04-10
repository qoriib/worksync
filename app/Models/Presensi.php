<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis',
        'waktu',
        'keterangan',
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];

    public function pengajuans()
    {
        return $this->hasMany(PengajuanPresensi::class);
    }

    public function getKeterlambatanMenitAttribute()
    {
        $jamMasuk = now()->setTime(8, 0); // default jam masuk
        return max(0, $this->waktu->diffInMinutes($jamMasuk));
    }
}

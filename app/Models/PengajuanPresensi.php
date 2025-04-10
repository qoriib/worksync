<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPresensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'presensi_id',
        'alasan',
        'bukti',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function presensi()
    {
        return $this->belongsTo(Presensi::class);
    }
}

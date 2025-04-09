<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
        'presensi_id',
        'user_id',
        'status',
        'bukti',
    ];

    public function presensi()
    {
        return $this->belongsTo(Presensi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

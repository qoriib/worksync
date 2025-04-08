<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}

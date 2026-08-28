<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chromebook extends Model
{
    protected $fillable = [
        'pendaftaran',
        'usernanme',
        'password',
        'serial_number',
        'status',
        'hari',
        'tanggal',
        'jam',
        'keterangan'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}

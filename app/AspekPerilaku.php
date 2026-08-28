<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AspekPerilaku extends Model
{
    protected $fillable = [
        'aspek',
        'observasi',
        'keterangan'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}

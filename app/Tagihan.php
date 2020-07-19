<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $fillable = [
        'gel_id', 'keterangan', 'biaya'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

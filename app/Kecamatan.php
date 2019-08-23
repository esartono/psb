<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $fillable = [
        'kota_id', 'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $fillable = [
        'prov_id', 'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

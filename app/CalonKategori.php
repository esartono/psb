<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalonKategori extends Model
{
    protected $fillable = [
        'name', 'status'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

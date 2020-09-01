<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JDoku extends Model
{
    protected $fillable = [
        'code', 'name', 'unit'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

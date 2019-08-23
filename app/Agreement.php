<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    protected $fillable = [
        'agreement'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

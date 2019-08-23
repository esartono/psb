<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $fillable = [
        'camat_id', 'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

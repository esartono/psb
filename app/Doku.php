<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doku extends Model
{
    protected $fillable = [
        'calon_id', 'user_id', 'jdoku', 'file'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inggris extends Model
{
    protected $fillable = [
        'pendaftaran', 'usernanme', 'password', 'access_code'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

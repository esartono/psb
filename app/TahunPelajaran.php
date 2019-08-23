<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunPelajaran extends Model
{
    protected $fillable = [
        'name', 'status'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

}

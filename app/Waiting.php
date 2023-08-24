<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Waiting extends Model
{
    protected $fillable = [
        'nama', 'asal_sekolah', 'unit', 'ta', 'wa', 'email', 'status'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

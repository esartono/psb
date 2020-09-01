<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rapot extends Model
{
    protected $fillable = [
        'calon_id', 'tp', 'sms', 'pelajaran', 'nilai'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

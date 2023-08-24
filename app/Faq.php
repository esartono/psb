<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Faq extends Model
{
    protected $fillable = [
        'tanya', 'jawab', 'status'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

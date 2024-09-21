<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InstrumenWawancara extends Model
{
    protected $fillable = [
        'unit_id',
        'instrumen',
        'singkatan'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'unit_id' => 'array',
    ];
}

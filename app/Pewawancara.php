<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pewawancara extends Model
{
    protected $fillable = [
        'tp',
        'unit_id',
        'nip',
        'nama'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function unitnya()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}

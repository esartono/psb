<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    protected $fillable = [
        'tp', 'unit_id', 'spp'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function unitnya()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function tpnya()
    {
        return $this->belongsTo(TahunPelajaran::class, 'tp');
    }
}

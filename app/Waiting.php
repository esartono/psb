<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Waiting extends Model
{
    protected $fillable = [
        'nama',
        'asal_sekolah',
        'unit',
        'ta',
        'wa',
        'email',
        'status'
    ];

    protected $hidden = [
        'updated_at'
    ];

    protected $appends = [
        'tpname',
    ];

    public function getTpNameAttribute()
    {
        return $this->ta . '/' . $this->ta + 1;
    }
}

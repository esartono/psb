<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $fillable = [
        'tp_id', 'nama', 'jenis', 'diskon', 'berlaku_sampai'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

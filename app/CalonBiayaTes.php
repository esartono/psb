<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalonBiayaTes extends Model
{
    protected $fillable = [
        'calon_id', 'biaya_id', 'lunas', 'expired'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function calonnya()
    {
        return $this->hasOne(Calon::class, 'calon_id');
    }

    public function biayanya()
    {
        return $this->belongsTo(BiayaTes::class, 'biaya_id');
    }
}

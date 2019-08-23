<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiayaTes extends Model
{
    protected $table = 'biaya_tes';

    protected $fillable = [
        'gel_id', 'ck_id', 'biaya'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function gelnya()
    {
        return $this->belongsTo(Gelombang::class, 'gel_id');
    }

    public function cknya()
    {
        return $this->belongsTo(CalonKategori::class, 'ck_id');
    }

}

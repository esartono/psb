<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'gel_id', 'internal', 'seleksi', 'kuota', 'ikut', 'keterangan'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function gelnya()
    {
        return $this->belongsTo(Gelombang::class, 'gel_id');
    }
}

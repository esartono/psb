<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalonJadwal extends Model
{
    protected $fillable = [
        'calon_id', 'jadwal_id', 'kesehatan', 'wawancara_ortu', 'wawancara_siswa', 'wawancara_inggris'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function calonnya()
    {
        return $this->hasOne(Calon::class, 'calon_id');
    }

    public function jadwalnya()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaNF extends Model
{
    protected $fillable = [
        'nis', 'name', 'jk', 'unit', 'tp', 'kelas'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $appends = [
        'kelamin'
    ];

    public function getKelaminAttribute()
    {
        if($this->attributes['jk'] === 1) {
            return 'Laki-Laki';
        }

        if($this->attributes['jk'] === 2) {
            return 'Perempuan';
        }
    }

    public function unitnya()
    {
        return $this->belongsTo(Unit::class, 'unit');
    }

    public function tpnya()
    {
        return $this->belongsTo(TahunPelajaran::class, 'tp');
    }

    public function kelasnya()
    {
        return $this->belongsTo(Kelasnya::class, 'kelas');
    }
}

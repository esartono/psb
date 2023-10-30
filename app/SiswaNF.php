<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaNF extends Model
{
    protected $fillable = [
        'nis', 'nisn', 'name', 'jk', 'unit', 'tp', 'kelas'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $appends = [
        'kelamin', 'unitnya'
    ];

    public function getKelaminAttribute()
    {
        if ($this->attributes['jk'] === 1) {
            return 'Laki-Laki';
        }

        if ($this->attributes['jk'] === 2) {
            return 'Perempuan';
        }
    }

    public function getUnitnyaAttribute()
    {
        $unit = Unit::where('id', $this->attributes['unit'])->first();
        if ($unit) {
            return $unit;
        }

        if ($this->attributes['unit'] == 0) {
            return [
                'id' => 0,
                'cat_id' => 1,
                'name' => 'CCEC Nurul Fikri'
            ];
        }

        if ($this->attributes['unit'] == 6) {
            return [
                'id' => 6,
                'cat_id' => 3,
                'name' => 'NFBS Bogor'
            ];
        }

        return [
            'id' => 1000,
            'cat_id' => 1,
            'name' => '-'
        ];
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

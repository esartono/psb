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
        'kelamin', 'unitnya'
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

    public function getUnitnyaAttribute()
    {
        $unit = Unit::where('id', $this->attributes['unit'])->first();
        if($unit){
            return $unit;
        } else {
            return [
                'id' => 5,
                'cat_id' => 3,
                'name' => 'NFBS Bogor'
            ];
        }
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

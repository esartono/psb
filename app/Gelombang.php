<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    protected $fillable = [
        'name', 'tp', 'unit_id', 'minimum_age', 'kuota', 'kuota_inklusi', 'kode_va', 'start', 'end'
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

    protected $appends = [
        'jlhrekap'
    ];

    public function getJlhRekapAttribute()
    {
        $lbaru = Calon::where('gel_id', $this->attributes['id'])->where('jk', 1)->where('status', 0)->get()->count();
        $pbaru = Calon::where('gel_id', $this->attributes['id'])->where('jk', 2)->where('status', 0)->get()->count();
        $laktif = Calon::where('gel_id', $this->attributes['id'])->where('jk', 1)->where('status', 1)->get()->count();
        $paktif = Calon::where('gel_id', $this->attributes['id'])->where('jk', 2)->where('status', 1)->get()->count();
        return compact('lbaru', 'pbaru', 'laktif', 'paktif');
    }

}

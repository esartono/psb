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
        $lbaru = Calon::where('gel_id', $this->attributes['id'])->where('jk', 1)->where('aktif', true)->where('status', 0)->get()->count();
        $pbaru = Calon::where('gel_id', $this->attributes['id'])->where('jk', 2)->where('aktif', true)->where('status', 0)->get()->count();
        $laktif = Calon::where('gel_id', $this->attributes['id'])->where('jk', 1)->where('aktif', true)->where('status', 1)->get()->count();
        $paktif = Calon::where('gel_id', $this->attributes['id'])->where('jk', 2)->where('aktif', true)->where('status', 1)->get()->count();
        $umumbaru = Calon::where('gel_id', $this->attributes['id'])->where('ck_id', 1)->where('aktif', true)->where('status', 0)->get()->count();
        $nfbaru = Calon::where('gel_id', $this->attributes['id'])->where('ck_id', 2)->where('aktif', true)->where('status', 0)->get()->count();
        $pegbaru = Calon::where('gel_id', $this->attributes['id'])->where('ck_id', 3)->where('aktif', true)->where('status', 0)->get()->count();
        $umumaktif = Calon::where('gel_id', $this->attributes['id'])->where('ck_id', 1)->where('aktif', true)->where('status', 1)->get()->count();
        $nfaktif = Calon::where('gel_id', $this->attributes['id'])->where('ck_id', 2)->where('aktif', true)->where('status', 1)->get()->count();
        $pegaktif = Calon::where('gel_id', $this->attributes['id'])->where('ck_id', 3)->where('aktif', true)->where('status', 1)->get()->count();

        $terima = CalonTagihan::where('lunas', 1)->where('pendaftaran', 'like',  $this->attributes['kode_va'] .'%')->get()->pluck('calonid');
        $umumdaul = Calon::whereIn('id', $terima)->where('ck_id', 1)->get()->count();
        $nfdaul = Calon::whereIn('id', $terima)->where('ck_id', 2)->get()->count();
        $pegdaul = Calon::whereIn('id', $terima)->where('ck_id', 3)->get()->count();
        return compact('lbaru', 'pbaru', 'laktif', 'paktif', 'umumbaru', 'nfbaru', 'pegbaru', 'umumaktif', 'nfaktif', 'pegaktif', 'umumdaul', 'nfdaul', 'pegdaul');
    }

    public static function unit($id)
    {
        $unit = static::whereId($id)->first()->unit_id;
        return Unit::where('id',$unit)->first()->name;
    }
}

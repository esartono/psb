<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CalonTagihan extends Model
{
    protected $fillable = [
        'pendaftaran', 'pengembangan', 'pendidikan', 'spp', 'komite', 'seragam', 'diskon', 'infaq', 'lunas', 'pewawancara'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $appends = [
        'calonnya', 'calonid', 'unitnya', 'total', 'va'
    ];

    public function getVaAttribute()
    {
        $va = CalonHasil::where('pendaftaran', $this->attributes['pendaftaran'])->first();
        if($va) {
            return $va->va;
        } else {
            return 'kosong';
        }
    }

    public function getCalonnyaAttribute()
    {
        $gel = Gelombang::where('kode_va', substr($this->attributes['pendaftaran'],0,6))->first()->id;
        $urut = intval(substr($this->attributes['pendaftaran'],6));
        return DB::table('calons')
                ->select('calons.id as idc', 'calons.name', 'jk', 'tempat_lahir', 'tgl_lahir', 'ayah_nama', 'ayah_hp', 'ibu_nama', 'ibu_hp', 'asal_sekolah', 'calon_kategoris.name as ck')
                ->leftJoin('calon_kategoris', 'calons.ck_id', '=', 'calon_kategoris.id')
                ->where('urut', $urut)
                ->where('gel_id', $gel)
                ->first();
    }

    public function getCalonidAttribute()
    {
        $gel = Gelombang::where('kode_va', substr($this->attributes['pendaftaran'],0,6))->first()->id;
        $urut = intval(substr($this->attributes['pendaftaran'],6));
        return DB::table('calons')
                ->select('calons.id as idc')
                ->where('urut', $urut)
                ->where('gel_id', $gel)
                ->first()->idc;
    }

    public function getUnitnyaAttribute()
    {
        return DB::table('gelombangs')
                ->select('units.name')
                ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                ->where('kode_va', substr($this->attributes['pendaftaran'],0,6))
                ->first();
    }

    public function getTotalAttribute()
    {
        return $this->attributes['pengembangan']+$this->attributes['pendidikan']
            +$this->attributes['spp']+$this->attributes['komite']+$this->attributes['seragam']
            +$this->attributes['infaq']-$this->attributes['diskon'];
    }

}

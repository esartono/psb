<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AmbilSeragam extends Model
{
    protected $table = 'calon_ambil_seragam';

    public $timestamps = false;

    protected $fillable = [
        'pendaftaran', 'siap', 'hari', 'lunas_daul', 'tanggal', 'jam'
    ];

    protected $appends = [
        'calonnya', 'unitnya'
    ];

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

    public function getUnitnyaAttribute()
    {
        return DB::table('gelombangs')
                ->select('units.name')
                ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                ->where('kode_va', substr($this->attributes['pendaftaran'],0,6))
                ->first();
    }
}

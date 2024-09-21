<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CalonHasil extends Model
{
    protected $fillable = [
        'pendaftaran', 'lulus', 'catatan', 'va'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $appends = [
        'calonnya', 'unitnya'
    ];

    public function getCalonnyaAttribute()
    {
        $gel = Gelombang::where('kode_va', substr($this->attributes['pendaftaran'], 0, 6))->first()->id;
        $urut = intval(substr($this->attributes['pendaftaran'], 6));
        return DB::table('calons')
            ->select('calons.name', 'jk', 'tempat_lahir', 'tgl_lahir', 'ayah_nama', 'ayah_hp', 'ibu_nama', 'ibu_hp', 'asal_sekolah', 'calon_kategoris.name as ck')
            ->leftJoin('calon_kategoris', 'calons.ck_id', '=', 'calon_kategoris.id')
            ->where('urut', $urut)
            ->where('gel_id', $gel)
            ->first();
    }

    public function getUnitnyaAttribute()
    {
        return DB::table('gelombangs')
            ->select('units.name', 'school_categories.name as school_type')
            ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
            ->leftJoin('school_categories', 'units.cat_id', '=', 'school_categories.id')
            ->where('kode_va', substr($this->attributes['pendaftaran'], 0, 6))
            ->first();
    }
}

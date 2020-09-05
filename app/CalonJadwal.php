<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CalonJadwal extends Model
{
    protected $fillable = [
        'calon_id', 'jadwal_id', 'kesehatan', 'wawancara_siswa', 'wawancara_inggris', 'wawancara', 'waktu'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $appends = [
        'calonnya'
    ];

    // public function calonnya()
    // {
    //     return $this->belongsTo(Calon::class, 'calon_id');
    // }

    public function jadwalnya()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function getCalonnyaAttribute()
    {
        return DB::table('calons')
                ->select('calons.name', 'gel_id', 'jk', 'tempat_lahir', 'tgl_lahir', 'ayah_nama', 'ayah_hp',
                    'ibu_nama', 'ibu_hp', 'asal_sekolah', 'calon_kategoris.name as ck', 'units.name as unitnya',
                    DB::raw('concat(gelombangs.kode_va, LPAD(calons.urut, 3, "0")) as uruts'))
                ->leftJoin('calon_kategoris', 'calons.ck_id', '=', 'calon_kategoris.id')
                ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                ->where('calons.id', $this->attributes['calon_id'])
                ->first();
    }
}

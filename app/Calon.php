<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    protected $fillable = [
        'gel_id',
        'ck_id',
        'tgl_daftar',
        'urut',
        'nisn',
        'nik',
        'name',
        'panggilan',
        'jk',
        'kelas_tujuan',
        'photo',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'alamat',
        'rt',
        'rw',
        'kodepos',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'phone',
        'ayah_nama',
        'ayah_pendidikan',
        'ayah_pekerjaan',
        'ayah_penghasilan',
        'ayah_hp',
        'ayah_email',
        'ibu_nama',
        'ibu_pendidikan',
        'ibu_pekerjaan',
        'ibu_penghasilan',
        'ibu_hp',
        'ibu_email',
        'asal_nf',
        'pindahan',
        'asal_sekolah',
        'asal_alamat_sekolah',
        'asal_propinsi_sekolah',
        'asal_kota_sekolah',
        'asal_kecamatan_sekolah',
        'asal_kelurahan_sekolah',
        'info',
        'status',
        'setuju',
        'user_id'
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

    public function gelnya()
    {
        return $this->belongsTo(Gelombang::class, 'gel_id');
    }

    public function cknya()
    {
        return $this->belongsTo(CalonKategori::class, 'ck_id');
    }

}

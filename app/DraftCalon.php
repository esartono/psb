<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DraftCalon extends Model
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
        'jurusan',
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
        'ayah_nik',
        'ayah_pendidikan',
        'ayah_pekerjaan',
        'ayah_penghasilan',
        'ayah_hp',
        'ayah_email',
        'ibu_nama',
        'ibu_nik',
        'ibu_pendidikan',
        'ibu_pekerjaan',
        'ibu_penghasilan',
        'ibu_hp',
        'ibu_email',
        'asal_nf',
        'pindahan',
        'tahun_sekarang',
        'asal_sekolah',
        'asal_alamat_sekolah',
        'asal_propinsi_sekolah',
        'asal_kota_sekolah',
        'asal_kecamatan_sekolah',
        'asal_kelurahan_sekolah',
        'info',
        'rencana_masuk',
        'setuju',
        'step',
        'user_id'
    ];

    protected $dates = [
        'tgl_lahir', 'tgl_daftar'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

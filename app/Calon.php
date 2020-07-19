<?php

namespace App;

use Carbon\Carbon;
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
        'kelamin', 'usia', 'lahir', 'uruts', 'jadwal', 'hasil'
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

    public function getUsiaAttribute()
    {
        $age = Carbon::create($this->attributes['tgl_lahir']);
        $patok = Carbon::create('2020', '7', '1');
        return $age->diff($patok)->format('%y Tahun, %m Bulan dan %d Hari');
    }

    public function getLahirAttribute()
    {
        $age = Carbon::create($this->attributes['tgl_lahir']);
        return $this->attributes['tempat_lahir'].', '.\Carbon\Carbon::parse($age)->formatLocalized('%d %B %Y');
    }

    public function getUrutsAttribute()
    {
        $gel = Gelombang::where('id', $this->attributes['gel_id'])->first();
        return $gel->kode_va . sprintf("%03d", $this->attributes['urut']);
    }

    public function getJadwalAttribute()
    {
        $jadwal = CalonJadwal::with('jadwalnya')->where('calon_id', $this->attributes['id'])->first();
        if($jadwal) {
            return $jadwal->jadwalnya;
        } else {
            return $jadwal=['seleksi'=> "Belum Ada"];
        }
    }

    public function getHasilAttribute()
    {
        $gel = Gelombang::where('id', $this->attributes['gel_id'])->first();
        $daftar = $gel->kode_va . sprintf("%03d", $this->attributes['urut']);

        $hasil = CalonHasil::where('pendaftaran', $daftar)->where('lulus', '>', 0)->first();
        $tagihan = CalonTagihan::where('pendaftaran', $daftar)->first();
        if(!$hasil) {
            $hasil = 'Kosong';
            $tagihan = 'Kosong';
            return compact('hasil', 'tagihan');
        }

        return compact('hasil', 'tagihan');
    }

    public function gelnya()
    {
        return $this->belongsTo(Gelombang::class, 'gel_id');
    }

    public function cknya()
    {
        return $this->belongsTo(CalonKategori::class, 'ck_id');
    }

    public function kelasnya()
    {
        return $this->belongsTo(Kelasnya::class, 'kelas_tujuan');
    }

    public function biayates()
    {
        return $this->hasOne(CalonBiayaTes::class);
    }

    public function usernya()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

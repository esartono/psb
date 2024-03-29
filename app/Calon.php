<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Do_;

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
        'status',
        'setuju',
        'aktif',
        'user_id'
    ];

    protected $dates = [
        'tgl_lahir', 'tgl_daftar'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $appends = [
        'kelamin', 'usia', 'lahir', 'uruts', 'jadwal', 'wawancara', 'hasil', 'bayarppdb', 'biayappdb', 'bt', 'seragam', 'tahap', 'registrasi', 'dokumen'
    ];

    public function getTahapAttribute()
    {
        $tahap = 1;

        if ($this->attributes['status'] === 1) {
            $tahap = 2;
        }

        $cekLengkapDokumen = Doku::where('calon_id', $this->attributes['id'])->count();
        $itungdataygharus = JDoku::where('unit', 'like', '%TK%')->count();

        if ($cekLengkapDokumen >= $itungdataygharus) {
            $tahap = 3;
        }
        $cek_wawancara_keu = CalonTagihanPSB::where('calon_id', $this->attributes['id'])->first();
        if ($cek_wawancara_keu) {
            $tahap = 4;
        }

        $gel = Gelombang::where('id', $this->attributes['gel_id'])->first();
        $daftar = $gel->kode_va . sprintf("%03d", $this->attributes['urut']);

        $hasil = CalonHasil::where('pendaftaran', $daftar)->where('lulus', '>', 0)->first();
        if ($hasil) {
            $tahap = 5;

            $daul = BayarTagihan::where('calon_id', $this->attributes['id'])->first();
            if ($daul) {
                $tahap = 6;
                if ($cek_wawancara_keu->lunas == 1) {
                    $tahap = 7;
                    $ambilSeragam = AmbilSeragam::where('pendaftaran', $daftar)->where('siap', 'SIAP')->first();
                    if ($ambilSeragam) {
                        $tahap = 8;
                        $ambilBuku = AmbilBuku::where('pendaftaran', $daftar)->where('siap', 'SIAP')->first();
                        if ($ambilBuku) {
                            $tahap = 8.5;
                        }
                    }
                }
            }
        }

        return $tahap;
    }

    public function getKelaminAttribute()
    {
        if ($this->attributes['jk'] === 1) {
            return 'Laki-Laki';
        }

        if ($this->attributes['jk'] === 2) {
            return 'Perempuan';
        }
    }

    public function getUsiaAttribute()
    {
        $age = Carbon::create($this->attributes['tgl_lahir']);
        $patok = Carbon::create('2021', '7', '1');
        return $age->diff($patok)->format('%y Tahun, %m Bulan dan %d Hari');
    }

    public function getLahirAttribute()
    {
        $age = Carbon::create($this->attributes['tgl_lahir']);
        return $this->attributes['tempat_lahir'] . ', ' . \Carbon\Carbon::parse($age)->locale('id')->formatLocalized('%d %B %Y');
    }

    public function getUrutsAttribute()
    {
        $gel = Gelombang::where('id', $this->attributes['gel_id'])->first();
        return $gel->kode_va . sprintf("%03d", $this->attributes['urut']);
    }

    public function getRegistrasiAttribute()
    {
        $gel = Gelombang::where('id', $this->attributes['gel_id'])->first();
        return $gel->kode_va . sprintf("%03d", $this->attributes['urut']) . ' - ' . $this->attributes['name'];
    }

    public function getJadwalAttribute()
    {
        $jadwal = CalonJadwal::with('jadwalnya')->where('calon_id', $this->attributes['id'])->first();
        // $jadwal = CalonJadwal::with('jadwalnya')->where('calon_id', 863)->first();
        if ($jadwal) {
            if ($jadwal->jadwal_id > 0) {
                return $jadwal->jadwalnya;
            }
        }
        // return $cek;
        $jadwal = new Collection();
        $jadwal->seleksi = '-';
        $jadwal->seleksi_online = '-';
        return $jadwal;
    }

    public function getWawancaraAttribute()
    {
        $jadwal = CalonJadwal::where('calon_id', $this->attributes['id'])->first();
        if ($jadwal) {
            return $jadwal = ['wawancara' => $jadwal->wawancara, 'waktu' => $jadwal->waktu];
        } else {
            return $jadwal = ['wawancara' => "Belum Ada", 'waktu' => "-"];
        }
    }

    public function getHasilAttribute()
    {
        $gel = Gelombang::where('id', $this->attributes['gel_id'])->first();
        $daftar = $gel->kode_va . sprintf("%03d", $this->attributes['urut']);

        $hasil = CalonHasil::where('pendaftaran', $daftar)->where('lulus', '>', 0)->first();
        $tagihan = CalonTagihan::where('pendaftaran', $daftar)->first();
        if (!$hasil) {
            $hasil = 'Kosong';
            $tagihan = 'Kosong';
        }

        return compact('hasil', 'tagihan');
    }

    public function getBiayappdbAttribute()
    {
        $bayarppdb = BayarTagihan::where('calon_id', $this->attributes['id']);
        if (!$bayarppdb) {
            $bayarppdb = 'Kosong';
        }

        return compact('bayarppdb');
    }

    public function getBayarppdbAttribute()
    {
        $bayarppdb = BayarTagihan::where('calon_id', $this->attributes['id'])->get();
        if (!$bayarppdb) {
            $bayarppdb = 'Kosong';
        }
        $cpsb = CalonTagihanPSB::where('calon_id', $this->attributes['id'])->first();

        return compact('bayarppdb', 'cpsb');
    }

    public function getSeragamAttribute()
    {
        $sudah = FALSE;
        $atas = '-';
        $bawah = '-';

        $seragam = CalonSeragam::where('calon_id', $this->attributes['id'])->first();
        if ($seragam) {
            $sudah = TRUE;
            $atas = $seragam->atas;
            $bawah = $seragam->bawah;
        }

        return compact('sudah', 'atas', 'bawah');
    }

    public function getBtAttribute()
    {
        $bt = CalonBiayaTes::where('calon_id', $this->attributes['id'])->first();
        if ($bt) {
            $biayates = $bt;
            $bn = BiayaTes::where('id', $biayates->biaya_id)->first();
        } else {
            $biayates = "-";
            $bn = "-";
        }

        if ($bn !== "-") {
            $biayanya = $bn;
        } else {
            $biayanya = "-";
        }

        return compact('biayates', 'biayanya');
    }

    public function getDokumenAttribute()
    {
        $cekLengkapDokumen = Doku::where('calon_id', $this->attributes['id'])->count();
        $itungdataygharus = JDoku::where('unit', 'like', '%TK%')->count();

        return array($cekLengkapDokumen, $itungdataygharus);
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

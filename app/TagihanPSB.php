<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagihanPSB extends Model
{
    protected $fillable = [
        'gel_id', 'kelas', 'kelamin', 'biaya1', 'biaya2', 'biaya3'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $casts = [
        'biaya1' => 'array',
        'biaya2' => 'array',
        'biaya3' => 'array',
    ];

    public function gelnya()
    {
        return $this->belongsTo(Gelombang::class, 'gel_id');
    }

    public function kelasnya()
    {
        return $this->belongsTo(Kelasnya::class, 'kelas');
    }

    protected $appends = [
        'total', 'spp'
    ];

    public function getTotalAttribute()
    {
        $total = [];
        $total[1] = 0;
        $total[2] = 0;
        $total[3] = 0;
        $sppnya = 0;

        $tp = TahunPelajaran::where('status', 1)->first();
        $unit = Gelombang::whereId($this->attributes['gel_id'])->first()->unit_id;
        if ($tp) {
            $spp = Spp::where('tp', $tp->id)->where('unit_id', $unit)->first();
            if ($spp) {
                $sppnya = $spp->spp;
            }
        }

        if ($this->attributes['biaya1']) {
            $biaya = json_decode($this->attributes['biaya1']);
            foreach ($biaya as $k => $v) {
                $total[1] = $total[1] + $v;
            }

            // khusus di atas 2024
            $cekTp = intval(substr($tp->name, 0, 4));
            if ($cekTp < 2024) {
                $total[1] = $total[1] + $sppnya;
            }

            if ($cekTp >= 2024) {
                $total[1] = $total[1];
            }
        }

        if ($this->attributes['biaya2']) {
            $biaya = json_decode($this->attributes['biaya2']);
            foreach ($biaya as $k => $v) {
                $total[2] = $total[2] + $v;
            }
            $total[2] = $total[2] + $sppnya;
        }

        if ($this->attributes['biaya3']) {
            $biaya = json_decode($this->attributes['biaya3']);
            foreach ($biaya as $k => $v) {
                $total[3] = $total[3] + $v;
            }
            $total[3] = $total[3] + $sppnya;
        }

        return $total;
    }

    public function getTotalpindahanAttribute()
    {
        $total = [];
        $total[1] = 0;
        $total[2] = 0;
        $total[3] = 0;
        $sppnya = 0;

        $tp_now = TahunPelajaran::where('status', 1)->first()->name;
        $tp_cek = explode("/", $tp_now);
        $tp_awal = intval($tp_cek[0]);
        $tp_pindahan = $tp_awal - 1 . '/' . $tp_awal;

        $tp = TahunPelajaran::where('name', $tp_pindahan)->first()->id;
        $unit = Gelombang::whereId($this->attributes['gel_id'])->first()->unit_id;
        if ($tp) {
            $spp = Spp::where('tp', $tp)->where('unit_id', $unit)->first();
            if ($spp) {
                $sppnya = $spp->spp;
            }
        }

        if ($this->attributes['biaya1']) {
            $biaya = json_decode($this->attributes['biaya1']);
            foreach ($biaya as $k => $v) {
                $total[1] = $total[1] + $v;
            }
            $total[1] = $total[1] + $sppnya;
        }

        if ($this->attributes['biaya2']) {
            $biaya = json_decode($this->attributes['biaya2']);
            foreach ($biaya as $k => $v) {
                $total[2] = $total[2] + $v;
            }
            $total[2] = $total[2] + $sppnya;
        }

        if ($this->attributes['biaya3']) {
            $biaya = json_decode($this->attributes['biaya3']);
            foreach ($biaya as $k => $v) {
                $total[3] = $total[3] + $v;
            }
            $total[3] = $total[3] + $sppnya;
        }

        return $total;
    }

    public static function biayanya($id)
    {
        $calon = Calon::where('id', $id)->first();
        $biayas = TagihanPSB::where('gel_id', $calon->gel_id)
            ->where('kelas', $calon->kelas_tujuan)
            ->where('kelamin', $calon->jk)
            ->first();

        $biaya = $biayas->biaya1;
        $total = 0;
        foreach ($biaya as $k => $v) {
            $total = $total + $v;
        }

        $reguler = 1;
        $totalnya = $total;
        $biayanya = $biaya;

        return array_merge($biayanya, ['reguler' => $reguler, 'tagihan' => $totalnya]);
    }

    public function getSppAttribute()
    {
        $tp = TahunPelajaran::where('status', 1)->first();
        $unit = Gelombang::whereId($this->attributes['gel_id'])->first()->unit_id;
        if ($tp) {
            $spp = Spp::where('tp', $tp->id)->where('unit_id', $unit)->first();
            if ($spp) {
                return $spp->spp;
            }
        }
        return 0;
    }

    public function getSpppindahanAttribute()
    {
        $tp_now = TahunPelajaran::where('status', 1)->first()->name;
        $tp_cek = explode("/", $tp_now);
        $tp_awal = intval($tp_cek[0]);
        $tp_pindahan = $tp_awal - 1 . '/' . $tp_awal;

        $tp = TahunPelajaran::where('name', $tp_pindahan)->first()->id;
        $unit = Gelombang::whereId($this->attributes['gel_id'])->first()->unit_id;
        if ($tp) {
            $spp = Spp::where('tp', $tp)->where('unit_id', $unit)->first();
            if ($spp) {
                return $spp->spp;
            }
        }
        return 0;
    }

    public static function sppnya($id)
    {
        $calon = Calon::where('id', $id)->first();
        $tp = TahunPelajaran::where('status', 1)->first();
        $unit = Gelombang::whereId($calon->gel_id)->first()->unit_id;
        if ($tp) {
            $spp = Spp::where('tp', $tp->id)->where('unit_id', $unit)->first();
            if ($spp) {
                return $spp->spp;
            }
        }
        return 0;
    }
}

<?php

namespace App\Exports;

use App\Gelombang;
use App\Calon;
use App\CalonTagihan;
use App\Pekerjaan;
use App\Pendidikan;
use App\Penghasilan;
use App\Kelurahan;
use App\Kecamatan;
use App\Kota;
use App\Provinsi;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class Terima implements FromView
{

    public function view() : view
    {
        $terimaTK = array();
        $terimaSD = array();
        $terimaSMP = array();
        $terimaSMA = array();

        $gelTK = Gelombang::where('unit_id', 1)->get()->pluck('kode_va');
        $terimaTK = CalonTagihan::where('lunas', 1)
                ->Where(function ($query) use($gelTK) {
                    for ($i = 0; $i < count($gelTK); $i++){
                        $query->orwhere('pendaftaran', 'like',  $gelTK[$i] .'%');
                    }
                })->get()->pluck('calonid');

        $gelSD = Gelombang::where('unit_id', 2)->get()->pluck('kode_va');
        $terimaSD = CalonTagihan::where('lunas', 1)
                ->Where(function ($query) use($gelSD) {
                    for ($i = 0; $i < count($gelSD); $i++){
                        $query->orwhere('pendaftaran', 'like',  $gelSD[$i] .'%');
                    }
                })->get()->pluck('calonid');

        $gelSMP = Gelombang::where('unit_id', 3)->get()->pluck('kode_va');
        $terimaSMP = CalonTagihan::where('lunas', 1)
                ->Where(function ($query) use($gelSMP) {
                    for ($i = 0; $i < count($gelSMP); $i++){
                        $query->orwhere('pendaftaran', 'like',  $gelSMP[$i] .'%');
                    }
                })->get()->pluck('calonid');

        $gelSMA = Gelombang::where('unit_id', 4)->get()->pluck('kode_va');
        $terimaSMA = CalonTagihan::where('lunas', 1)
                ->Where(function ($query) use($gelSMA) {
                    for ($i = 0; $i < count($gelSMA); $i++){
                        $query->orwhere('pendaftaran', 'like',  $gelSMA[$i] .'%');
                    }
                })->get()->pluck('calonid');

        $pekerjaans = Pekerjaan::get();

        $pekerjaan = array();
        $no = 0;
        foreach ($pekerjaans as $p)
        {
            $no = $no + 1;
            $pekerjaan['no'][$no] = $no;
            $pekerjaan['nama'][$no] = $p->name;
            $pekerjaan['ayahTK'][$no] = Calon::whereIn('id', $terimaTK)->where('ayah_pekerjaan', $p->id)->get()->count();
            $pekerjaan['ibuTK'][$no] = Calon::whereIn('id', $terimaTK)->where('ibu_pekerjaan', $p->id)->get()->count();
            $pekerjaan['ayahSD'][$no] = Calon::whereIn('id', $terimaSD)->where('ayah_pekerjaan', $p->id)->get()->count();
            $pekerjaan['ibuSD'][$no] = Calon::whereIn('id', $terimaSD)->where('ibu_pekerjaan', $p->id)->get()->count();
            $pekerjaan['ayahSMP'][$no] = Calon::whereIn('id', $terimaSMP)->where('ayah_pekerjaan', $p->id)->get()->count();
            $pekerjaan['ibuSMP'][$no] = Calon::whereIn('id', $terimaSMP)->where('ibu_pekerjaan', $p->id)->get()->count();
            $pekerjaan['ayahSMA'][$no] = Calon::whereIn('id', $terimaSMA)->where('ayah_pekerjaan', $p->id)->get()->count();
            $pekerjaan['ibuSMA'][$no] = Calon::whereIn('id', $terimaSMA)->where('ibu_pekerjaan', $p->id)->get()->count();
        }

        $pendidikans = Pendidikan::get();
        $pendidikan = array();
        $no = 0;
        foreach ($pendidikans as $p)
        {
            $no = $no + 1;
            $pendidikan['no'][$no] = $no;
            $pendidikan['nama'][$no] = $p->name;
            $pendidikan['ayahTK'][$no] = Calon::whereIn('id', $terimaTK)->where('ayah_pendidikan', $p->id)->get()->count();
            $pendidikan['ibuTK'][$no] = Calon::whereIn('id', $terimaTK)->where('ibu_pendidikan', $p->id)->get()->count();
            $pendidikan['ayahSD'][$no] = Calon::whereIn('id', $terimaSD)->where('ayah_pendidikan', $p->id)->get()->count();
            $pendidikan['ibuSD'][$no] = Calon::whereIn('id', $terimaSD)->where('ibu_pendidikan', $p->id)->get()->count();
            $pendidikan['ayahSMP'][$no] = Calon::whereIn('id', $terimaSMP)->where('ayah_pendidikan', $p->id)->get()->count();
            $pendidikan['ibuSMP'][$no] = Calon::whereIn('id', $terimaSMP)->where('ibu_pendidikan', $p->id)->get()->count();
            $pendidikan['ayahSMA'][$no] = Calon::whereIn('id', $terimaSMA)->where('ayah_pendidikan', $p->id)->get()->count();
            $pendidikan['ibuSMA'][$no] = Calon::whereIn('id', $terimaSMA)->where('ibu_pendidikan', $p->id)->get()->count();
        }

        $penghasilans = Penghasilan::get();
        $penghasilan = array();
        $no = 0;
        foreach ($penghasilans as $p)
        {
            $no = $no + 1;
            $penghasilan['no'][$no] = $no;
            $penghasilan['nama'][$no] = $p->name;
            $penghasilan['ayahTK'][$no] = Calon::whereIn('id', $terimaTK)->where('ayah_penghasilan', $p->id)->get()->count();
            $penghasilan['ibuTK'][$no] = Calon::whereIn('id', $terimaTK)->where('ibu_penghasilan', $p->id)->get()->count();
            $penghasilan['ayahSD'][$no] = Calon::whereIn('id', $terimaSD)->where('ayah_penghasilan', $p->id)->get()->count();
            $penghasilan['ibuSD'][$no] = Calon::whereIn('id', $terimaSD)->where('ibu_penghasilan', $p->id)->get()->count();
            $penghasilan['ayahSMP'][$no] = Calon::whereIn('id', $terimaSMP)->where('ayah_penghasilan', $p->id)->get()->count();
            $penghasilan['ibuSMP'][$no] = Calon::whereIn('id', $terimaSMP)->where('ibu_penghasilan', $p->id)->get()->count();
            $penghasilan['ayahSMA'][$no] = Calon::whereIn('id', $terimaSMA)->where('ayah_penghasilan', $p->id)->get()->count();
            $penghasilan['ibuSMA'][$no] = Calon::whereIn('id', $terimaSMA)->where('ibu_penghasilan', $p->id)->get()->count();
        }

        $asal = array();
        $asal['nfTK'] = Calon::whereIn('id', $terimaTK)->where('asal_nf', 1)->get()->count();
        $asal['non_nfTK'] = Calon::whereIn('id', $terimaTK)->where('asal_nf', 0)->get()->count();
        $asal['nfSD'] = Calon::whereIn('id', $terimaSD)->where('asal_nf', 1)->get()->count();
        $asal['non_nfSD'] = Calon::whereIn('id', $terimaSD)->where('asal_nf', 0)->get()->count();
        $asal['nfSMP'] = Calon::whereIn('id', $terimaSMP)->where('asal_nf', 1)->get()->count();
        $asal['non_nfSMP'] = Calon::whereIn('id', $terimaSMP)->where('asal_nf', 0)->get()->count();
        $asal['nfSMA'] = Calon::whereIn('id', $terimaSMA)->where('asal_nf', 1)->get()->count();
        $asal['non_nfSMA'] = Calon::whereIn('id', $terimaSMA)->where('asal_nf', 0)->get()->count();

        $kelurahan = array();
        $no = 0;
        $kelurahans = DB::table('calons')
            ->select('kelurahan')
            ->groupBy('kelurahan')
            ->get();
        foreach ($kelurahans as $k)
        {
            $no = $no + 1;
            $kelurahan['no'][$no] = $no;
            $kelurahan['nama'][$no] = Kelurahan::where('id', $k->kelurahan)->first()->name;
            $kelurahan['TK'][$no] = Calon::whereIn('id', $terimaTK)->where('kelurahan', $k->kelurahan)->get()->count();
            $kelurahan['SD'][$no] = Calon::whereIn('id', $terimaSD)->where('kelurahan', $k->kelurahan)->get()->count();
            $kelurahan['SMP'][$no] = Calon::whereIn('id', $terimaSMP)->where('kelurahan', $k->kelurahan)->get()->count();
            $kelurahan['SMA'][$no] = Calon::whereIn('id', $terimaSMA)->where('kelurahan', $k->kelurahan)->get()->count();
        }

        $kecamatan = array();
        $no = 0;
        $kecamatans = DB::table('calons')
            ->select('kecamatan')
            ->groupBy('kecamatan')
            ->get();
        foreach ($kecamatans as $k)
        {
            $no = $no + 1;
            $kecamatan['no'][$no] = $no;
            $kecamatan['nama'][$no] = Kecamatan::where('id', $k->kecamatan)->first()->name;
            $kecamatan['TK'][$no] = Calon::whereIn('id', $terimaTK)->where('kecamatan', $k->kecamatan)->get()->count();
            $kecamatan['SD'][$no] = Calon::whereIn('id', $terimaSD)->where('kecamatan', $k->kecamatan)->get()->count();
            $kecamatan['SMP'][$no] = Calon::whereIn('id', $terimaSMP)->where('kecamatan', $k->kecamatan)->get()->count();
            $kecamatan['SMA'][$no] = Calon::whereIn('id', $terimaSMA)->where('kecamatan', $k->kecamatan)->get()->count();
        }

        $kota = array();
        $no = 0;
        $kotas = DB::table('calons')
            ->select('kota')
            ->groupBy('kota')
            ->get();
        foreach ($kotas as $k)
        {
            $no = $no + 1;
            $kota['no'][$no] = $no;
            $kota['nama'][$no] = Kota::where('id', $k->kota)->first()->name;
            $kota['TK'][$no] = Calon::whereIn('id', $terimaTK)->where('kota', $k->kota)->get()->count();
            $kota['SD'][$no] = Calon::whereIn('id', $terimaSD)->where('kota', $k->kota)->get()->count();
            $kota['SMP'][$no] = Calon::whereIn('id', $terimaSMP)->where('kota', $k->kota)->get()->count();
            $kota['SMA'][$no] = Calon::whereIn('id', $terimaSMA)->where('kota', $k->kota)->get()->count();
        }

        $provinsi = array();
        $no = 0;
        $provinsis = DB::table('calons')
            ->select('provinsi')
            ->groupBy('provinsi')
            ->get();
        foreach ($provinsis as $k)
        {
            $no = $no + 1;
            $provinsi['no'][$no] = $no;
            $provinsi['nama'][$no] = Provinsi::where('id', $k->provinsi)->first()->name;
            $provinsi['TK'][$no] = Calon::whereIn('id', $terimaTK)->where('provinsi', $k->provinsi)->get()->count();
            $provinsi['SD'][$no] = Calon::whereIn('id', $terimaSD)->where('provinsi', $k->provinsi)->get()->count();
            $provinsi['SMP'][$no] = Calon::whereIn('id', $terimaSMP)->where('provinsi', $k->provinsi)->get()->count();
            $provinsi['SMA'][$no] = Calon::whereIn('id', $terimaSMA)->where('provinsi', $k->provinsi)->get()->count();
        }

        $provinsi = array();
        $no = 0;
        $provinsis = DB::table('calons')
            ->select('provinsi')
            ->groupBy('provinsi')
            ->get();
        foreach ($provinsis as $k)
        {
            $no = $no + 1;
            $provinsi['no'][$no] = $no;
            $provinsi['nama'][$no] = Provinsi::where('id', $k->provinsi)->first()->name;
            $provinsi['TK'][$no] = Calon::whereIn('id', $terimaTK)->where('provinsi', $k->provinsi)->get()->count();
            $provinsi['SD'][$no] = Calon::whereIn('id', $terimaSD)->where('provinsi', $k->provinsi)->get()->count();
            $provinsi['SMP'][$no] = Calon::whereIn('id', $terimaSMP)->where('provinsi', $k->provinsi)->get()->count();
            $provinsi['SMA'][$no] = Calon::whereIn('id', $terimaSMA)->where('provinsi', $k->provinsi)->get()->count();
        }

        return view('exports.statistik', compact('pekerjaan', 'pendidikan', 'penghasilan', 'asal', 'kelurahan', 'kecamatan', 'kota', 'provinsi'));
    }
}

<?php

namespace App\Exports;

use App\Calon;
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

class Statistik implements FromView
{
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function view() : view
    {
        $status = array();
        $status[0] = 1;
        if ($this->id == 'all') {
            $status[1] = 0;
        }
        $pekerjaans = Pekerjaan::get();

        $pekerjaan = array();
        $no = 0;
        foreach ($pekerjaans as $p)
        {
            $no = $no + 1;
            $pekerjaan['no'][$no] = $no;
            $pekerjaan['nama'][$no] = $p->name;
            $pekerjaan['ayahTK'][$no] = Calon::whereIn('status', $status)->where('ayah_pekerjaan', $p->id)->where('gel_id', 1)->get()->count();
            $pekerjaan['ibuTK'][$no] = Calon::whereIn('status', $status)->where('ibu_pekerjaan', $p->id)->where('gel_id', 1)->get()->count();
            $pekerjaan['ayahSD'][$no] = Calon::whereIn('status', $status)->where('ayah_pekerjaan', $p->id)->where('gel_id', 2)->get()->count();
            $pekerjaan['ibuSD'][$no] = Calon::whereIn('status', $status)->where('ibu_pekerjaan', $p->id)->where('gel_id', 2)->get()->count();
            $pekerjaan['ayahSMP'][$no] = Calon::whereIn('status', $status)->where('ayah_pekerjaan', $p->id)->where('gel_id', 3)->get()->count();
            $pekerjaan['ibuSMP'][$no] = Calon::whereIn('status', $status)->where('ibu_pekerjaan', $p->id)->where('gel_id', 3)->get()->count();
            $pekerjaan['ayahSMA'][$no] = Calon::whereIn('status', $status)->where('ayah_pekerjaan', $p->id)->where('gel_id', 4)->get()->count();
            $pekerjaan['ibuSMA'][$no] = Calon::whereIn('status', $status)->where('ibu_pekerjaan', $p->id)->where('gel_id', 4)->get()->count();
        }

        $pendidikans = Pendidikan::get();
        $pendidikan = array();
        $no = 0;
        foreach ($pendidikans as $p)
        {
            $no = $no + 1;
            $pendidikan['no'][$no] = $no;
            $pendidikan['nama'][$no] = $p->name;
            $pendidikan['ayahTK'][$no] = Calon::whereIn('status', $status)->where('ayah_pendidikan', $p->id)->where('gel_id', 1)->get()->count();
            $pendidikan['ibuTK'][$no] = Calon::whereIn('status', $status)->where('ibu_pendidikan', $p->id)->where('gel_id', 1)->get()->count();
            $pendidikan['ayahSD'][$no] = Calon::whereIn('status', $status)->where('ayah_pendidikan', $p->id)->where('gel_id', 2)->get()->count();
            $pendidikan['ibuSD'][$no] = Calon::whereIn('status', $status)->where('ibu_pendidikan', $p->id)->where('gel_id', 2)->get()->count();
            $pendidikan['ayahSMP'][$no] = Calon::whereIn('status', $status)->where('ayah_pendidikan', $p->id)->where('gel_id', 3)->get()->count();
            $pendidikan['ibuSMP'][$no] = Calon::whereIn('status', $status)->where('ibu_pendidikan', $p->id)->where('gel_id', 3)->get()->count();
            $pendidikan['ayahSMA'][$no] = Calon::whereIn('status', $status)->where('ayah_pendidikan', $p->id)->where('gel_id', 4)->get()->count();
            $pendidikan['ibuSMA'][$no] = Calon::whereIn('status', $status)->where('ibu_pendidikan', $p->id)->where('gel_id', 4)->get()->count();
        }

        $penghasilans = Penghasilan::get();
        $penghasilan = array();
        $no = 0;
        foreach ($penghasilans as $p)
        {
            $no = $no + 1;
            $penghasilan['no'][$no] = $no;
            $penghasilan['nama'][$no] = $p->name;
            $penghasilan['ayahTK'][$no] = Calon::whereIn('status', $status)->where('ayah_penghasilan', $p->id)->where('gel_id', 1)->get()->count();
            $penghasilan['ibuTK'][$no] = Calon::whereIn('status', $status)->where('ibu_penghasilan', $p->id)->where('gel_id', 1)->get()->count();
            $penghasilan['ayahSD'][$no] = Calon::whereIn('status', $status)->where('ayah_penghasilan', $p->id)->where('gel_id', 2)->get()->count();
            $penghasilan['ibuSD'][$no] = Calon::whereIn('status', $status)->where('ibu_penghasilan', $p->id)->where('gel_id', 2)->get()->count();
            $penghasilan['ayahSMP'][$no] = Calon::whereIn('status', $status)->where('ayah_penghasilan', $p->id)->where('gel_id', 3)->get()->count();
            $penghasilan['ibuSMP'][$no] = Calon::whereIn('status', $status)->where('ibu_penghasilan', $p->id)->where('gel_id', 3)->get()->count();
            $penghasilan['ayahSMA'][$no] = Calon::whereIn('status', $status)->where('ayah_penghasilan', $p->id)->where('gel_id', 4)->get()->count();
            $penghasilan['ibuSMA'][$no] = Calon::whereIn('status', $status)->where('ibu_penghasilan', $p->id)->where('gel_id', 4)->get()->count();
        }

        $asal = array();
        $asal['nfTK'] = Calon::whereIn('status', $status)->where('asal_nf', 1)->where('gel_id', 1)->get()->count();
        $asal['non_nfTK'] = Calon::whereIn('status', $status)->where('asal_nf', 0)->where('gel_id', 1)->get()->count();
        $asal['nfSD'] = Calon::whereIn('status', $status)->where('asal_nf', 1)->where('gel_id', 2)->get()->count();
        $asal['non_nfSD'] = Calon::whereIn('status', $status)->where('asal_nf', 0)->where('gel_id', 2)->get()->count();
        $asal['nfSMP'] = Calon::whereIn('status', $status)->where('asal_nf', 1)->where('gel_id', 3)->get()->count();
        $asal['non_nfSMP'] = Calon::whereIn('status', $status)->where('asal_nf', 0)->where('gel_id', 3)->get()->count();
        $asal['nfSMA'] = Calon::whereIn('status', $status)->where('asal_nf', 1)->where('gel_id', 4)->get()->count();
        $asal['non_nfSMA'] = Calon::whereIn('status', $status)->where('asal_nf', 0)->where('gel_id', 4)->get()->count();

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
            $kelurahan['TK'][$no] = Calon::whereIn('status', $status)->where('kelurahan', $k->kelurahan)->where('gel_id', 1)->get()->count();
            $kelurahan['SD'][$no] = Calon::whereIn('status', $status)->where('kelurahan', $k->kelurahan)->where('gel_id', 2)->get()->count();
            $kelurahan['SMP'][$no] = Calon::whereIn('status', $status)->where('kelurahan', $k->kelurahan)->where('gel_id', 3)->get()->count();
            $kelurahan['SMA'][$no] = Calon::whereIn('status', $status)->where('kelurahan', $k->kelurahan)->where('gel_id', 4)->get()->count();
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
            $kecamatan['TK'][$no] = Calon::whereIn('status', $status)->where('kecamatan', $k->kecamatan)->where('gel_id', 1)->get()->count();
            $kecamatan['SD'][$no] = Calon::whereIn('status', $status)->where('kecamatan', $k->kecamatan)->where('gel_id', 2)->get()->count();
            $kecamatan['SMP'][$no] = Calon::whereIn('status', $status)->where('kecamatan', $k->kecamatan)->where('gel_id', 3)->get()->count();
            $kecamatan['SMA'][$no] = Calon::whereIn('status', $status)->where('kecamatan', $k->kecamatan)->where('gel_id', 4)->get()->count();
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
            $kota['TK'][$no] = Calon::whereIn('status', $status)->where('kota', $k->kota)->where('gel_id', 1)->get()->count();
            $kota['SD'][$no] = Calon::whereIn('status', $status)->where('kota', $k->kota)->where('gel_id', 2)->get()->count();
            $kota['SMP'][$no] = Calon::whereIn('status', $status)->where('kota', $k->kota)->where('gel_id', 3)->get()->count();
            $kota['SMA'][$no] = Calon::whereIn('status', $status)->where('kota', $k->kota)->where('gel_id', 4)->get()->count();
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
            $provinsi['TK'][$no] = Calon::whereIn('status', $status)->where('provinsi', $k->provinsi)->where('gel_id', 1)->get()->count();
            $provinsi['SD'][$no] = Calon::whereIn('status', $status)->where('provinsi', $k->provinsi)->where('gel_id', 2)->get()->count();
            $provinsi['SMP'][$no] = Calon::whereIn('status', $status)->where('provinsi', $k->provinsi)->where('gel_id', 3)->get()->count();
            $provinsi['SMA'][$no] = Calon::whereIn('status', $status)->where('provinsi', $k->provinsi)->where('gel_id', 4)->get()->count();
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
            $provinsi['TK'][$no] = Calon::whereIn('status', $status)->where('provinsi', $k->provinsi)->where('gel_id', 1)->get()->count();
            $provinsi['SD'][$no] = Calon::whereIn('status', $status)->where('provinsi', $k->provinsi)->where('gel_id', 2)->get()->count();
            $provinsi['SMP'][$no] = Calon::whereIn('status', $status)->where('provinsi', $k->provinsi)->where('gel_id', 3)->get()->count();
            $provinsi['SMA'][$no] = Calon::whereIn('status', $status)->where('provinsi', $k->provinsi)->where('gel_id', 4)->get()->count();
        }

        return view('exports.statistik', compact('pekerjaan', 'pendidikan', 'penghasilan', 'asal', 'kelurahan', 'kecamatan', 'kota', 'provinsi'));
    }
}

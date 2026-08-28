<?php

namespace App\Exports;

use App\Calon;
use App\Gelombang;
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

    function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): view
    {
        if (auth()->user()->isAdmin()) {
            $gelombangTK = Gelombang::where('tp', auth()->user()->tpid)->where('unit_id', 1)->get()->pluck('id');
            $gelombangSD = Gelombang::where('tp', auth()->user()->tpid)->where('unit_id', 2)->get()->pluck('id');
            $gelombangSMP = Gelombang::where('tp', auth()->user()->tpid)->where('unit_id', 3)->get()->pluck('id');
            $gelombangSMA = Gelombang::where('tp', auth()->user()->tpid)->where('unit_id', 4)->get()->pluck('id');

            $status = array();
            $status[0] = 1;
            if ($this->id == 'all') {
                $status[1] = 0;
            }

            $calonsTK = Calon::whereIn('gel_id', $gelombangTK)->whereIn('status', $status)->pluck('id');
            $calonsSD = Calon::whereIn('gel_id', $gelombangSD)->whereIn('status', $status)->pluck('id');
            $calonsSMP = Calon::whereIn('gel_id', $gelombangSMP)->whereIn('status', $status)->pluck('id');
            $calonsSMA = Calon::whereIn('gel_id', $gelombangSMA)->whereIn('status', $status)->pluck('id');

            $pekerjaans = Pekerjaan::get();

            $pekerjaan = array();
            $no = 0;
            foreach ($pekerjaans as $p) {
                $no = $no + 1;
                $pekerjaan['no'][$no] = $no;
                $pekerjaan['nama'][$no] = $p->name;
                $pekerjaan['ayahTK'][$no] = Calon::whereIn('id', $calonsTK)->where('ayah_pekerjaan', $p->id)->get()->count();
                $pekerjaan['ibuTK'][$no] = Calon::whereIn('id', $calonsTK)->where('ibu_pekerjaan', $p->id)->get()->count();
                $pekerjaan['ayahSD'][$no] = Calon::whereIn('id', $calonsSD)->where('ayah_pekerjaan', $p->id)->get()->count();
                $pekerjaan['ibuSD'][$no] = Calon::whereIn('id', $calonsSD)->where('ibu_pekerjaan', $p->id)->get()->count();
                $pekerjaan['ayahSMP'][$no] = Calon::whereIn('id', $calonsSMP)->where('ayah_pekerjaan', $p->id)->get()->count();
                $pekerjaan['ibuSMP'][$no] = Calon::whereIn('id', $calonsSMP)->where('ibu_pekerjaan', $p->id)->get()->count();
                $pekerjaan['ayahSMA'][$no] = Calon::whereIn('id', $calonsSMA)->where('ayah_pekerjaan', $p->id)->get()->count();
                $pekerjaan['ibuSMA'][$no] = Calon::whereIn('id', $calonsSMA)->where('ibu_pekerjaan', $p->id)->get()->count();
            }

            $pendidikans = Pendidikan::get();
            $pendidikan = array();
            $no = 0;
            foreach ($pendidikans as $p) {
                $no = $no + 1;
                $pendidikan['no'][$no] = $no;
                $pendidikan['nama'][$no] = $p->name;
                $pendidikan['ayahTK'][$no] = Calon::whereIn('id', $calonsTK)->where('ayah_pendidikan', $p->id)->get()->count();
                $pendidikan['ibuTK'][$no] = Calon::whereIn('id', $calonsTK)->where('ibu_pendidikan', $p->id)->get()->count();
                $pendidikan['ayahSD'][$no] = Calon::whereIn('id', $calonsSD)->where('ayah_pendidikan', $p->id)->get()->count();
                $pendidikan['ibuSD'][$no] = Calon::whereIn('id', $calonsSD)->where('ibu_pendidikan', $p->id)->get()->count();
                $pendidikan['ayahSMP'][$no] = Calon::whereIn('id', $calonsSMP)->where('ayah_pendidikan', $p->id)->get()->count();
                $pendidikan['ibuSMP'][$no] = Calon::whereIn('id', $calonsSMP)->where('ibu_pendidikan', $p->id)->get()->count();
                $pendidikan['ayahSMA'][$no] = Calon::whereIn('id', $calonsSMA)->where('ayah_pendidikan', $p->id)->get()->count();
                $pendidikan['ibuSMA'][$no] = Calon::whereIn('id', $calonsSMA)->where('ibu_pendidikan', $p->id)->get()->count();
            }

            $penghasilans = Penghasilan::get();
            $penghasilan = array();
            $no = 0;
            foreach ($penghasilans as $p) {
                $no = $no + 1;
                $penghasilan['no'][$no] = $no;
                $penghasilan['nama'][$no] = $p->name;
                $penghasilan['ayahTK'][$no] = Calon::whereIn('id', $calonsTK)->where('ayah_penghasilan', $p->id)->get()->count();
                $penghasilan['ibuTK'][$no] = Calon::whereIn('id', $calonsTK)->where('ibu_penghasilan', $p->id)->get()->count();
                $penghasilan['ayahSD'][$no] = Calon::whereIn('id', $calonsSD)->where('ayah_penghasilan', $p->id)->get()->count();
                $penghasilan['ibuSD'][$no] = Calon::whereIn('id', $calonsSD)->where('ibu_penghasilan', $p->id)->get()->count();
                $penghasilan['ayahSMP'][$no] = Calon::whereIn('id', $calonsSMP)->where('ayah_penghasilan', $p->id)->get()->count();
                $penghasilan['ibuSMP'][$no] = Calon::whereIn('id', $calonsSMP)->where('ibu_penghasilan', $p->id)->get()->count();
                $penghasilan['ayahSMA'][$no] = Calon::whereIn('id', $calonsSMA)->where('ayah_penghasilan', $p->id)->get()->count();
                $penghasilan['ibuSMA'][$no] = Calon::whereIn('id', $calonsSMA)->where('ibu_penghasilan', $p->id)->get()->count();
            }

            $asal = array();
            $asal['nfTK'] = Calon::whereIn('id', $calonsTK)->where('asal_nf', 1)->get()->count();
            $asal['non_nfTK'] = Calon::whereIn('id', $calonsTK)->where('asal_nf', 0)->get()->count();
            $asal['nfSD'] = Calon::whereIn('id', $calonsSD)->where('asal_nf', 1)->get()->count();
            $asal['non_nfSD'] = Calon::whereIn('id', $calonsSD)->where('asal_nf', 0)->get()->count();
            $asal['nfSMP'] = Calon::whereIn('id', $calonsSMP)->where('asal_nf', 1)->get()->count();
            $asal['non_nfSMP'] = Calon::whereIn('id', $calonsSMP)->where('asal_nf', 0)->get()->count();
            $asal['nfSMA'] = Calon::whereIn('id', $calonsSMA)->where('asal_nf', 1)->get()->count();
            $asal['non_nfSMA'] = Calon::whereIn('id', $calonsSMA)->where('asal_nf', 0)->get()->count();

            $kelurahan = array();
            $no = 0;
            $kelurahans = DB::table('calons')
                ->select('kelurahan')
                ->groupBy('kelurahan')
                ->get();
            foreach ($kelurahans as $k) {
                $no = $no + 1;
                $kelurahan['no'][$no] = $no;
                $kelurahan['nama'][$no] = Kelurahan::where('id', $k->kelurahan)->first()->name ?? '-';
                $kelurahan['TK'][$no] = Calon::whereIn('id', $calonsTK)->where('kelurahan', $k->kelurahan)->get()->count();
                $kelurahan['SD'][$no] = Calon::whereIn('id', $calonsSD)->where('kelurahan', $k->kelurahan)->get()->count();
                $kelurahan['SMP'][$no] = Calon::whereIn('id', $calonsSMP)->where('kelurahan', $k->kelurahan)->get()->count();
                $kelurahan['SMA'][$no] = Calon::whereIn('id', $calonsSMA)->where('kelurahan', $k->kelurahan)->get()->count();
            }

            $kecamatan = array();
            $no = 0;
            $kecamatans = DB::table('calons')
                ->select('kecamatan')
                ->groupBy('kecamatan')
                ->get();
            foreach ($kecamatans as $k) {
                $no = $no + 1;
                $kecamatan['no'][$no] = $no;
                $kecamatan['nama'][$no] = Kecamatan::where('id', $k->kecamatan)->first()->name ?? '-';
                $kecamatan['TK'][$no] = Calon::whereIn('id', $calonsTK)->where('kecamatan', $k->kecamatan)->get()->count();
                $kecamatan['SD'][$no] = Calon::whereIn('id', $calonsSD)->where('kecamatan', $k->kecamatan)->get()->count();
                $kecamatan['SMP'][$no] = Calon::whereIn('id', $calonsSMP)->where('kecamatan', $k->kecamatan)->get()->count();
                $kecamatan['SMA'][$no] = Calon::whereIn('id', $calonsSMA)->where('kecamatan', $k->kecamatan)->get()->count();
            }

            $kota = array();
            $no = 0;
            $kotas = DB::table('calons')
                ->select('kota')
                ->groupBy('kota')
                ->get();
            foreach ($kotas as $k) {
                $no = $no + 1;
                $kota['no'][$no] = $no;
                $kota['nama'][$no] = Kota::where('id', $k->kota)->first()->name ?? '-';
                $kota['TK'][$no] = Calon::whereIn('id', $calonsTK)->where('kota', $k->kota)->get()->count();
                $kota['SD'][$no] = Calon::whereIn('id', $calonsSD)->where('kota', $k->kota)->get()->count();
                $kota['SMP'][$no] = Calon::whereIn('id', $calonsSMP)->where('kota', $k->kota)->get()->count();
                $kota['SMA'][$no] = Calon::whereIn('id', $calonsSMA)->where('kota', $k->kota)->get()->count();
            }

            $provinsi = array();
            $no = 0;
            $provinsis = DB::table('calons')
                ->select('provinsi')
                ->groupBy('provinsi')
                ->get();
            foreach ($provinsis as $k) {
                $no = $no + 1;
                $provinsi['no'][$no] = $no;
                $provinsi['nama'][$no] = Provinsi::where('id', $k->provinsi)->first()->name ?? '-';
                $provinsi['TK'][$no] = Calon::whereIn('id', $calonsTK)->where('provinsi', $k->provinsi)->get()->count();
                $provinsi['SD'][$no] = Calon::whereIn('id', $calonsSD)->where('provinsi', $k->provinsi)->get()->count();
                $provinsi['SMP'][$no] = Calon::whereIn('id', $calonsSMP)->where('provinsi', $k->provinsi)->get()->count();
                $provinsi['SMA'][$no] = Calon::whereIn('id', $calonsSMA)->where('provinsi', $k->provinsi)->get()->count();
            }

            return view('exports.statistik', compact('pekerjaan', 'pendidikan', 'penghasilan', 'asal', 'kelurahan', 'kecamatan', 'kota', 'provinsi'));
        }
        return '-';
    }
}

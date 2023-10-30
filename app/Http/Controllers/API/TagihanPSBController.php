<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Spp;
use App\Calon;
use App\Simmsit;
use App\Kelasnya;
use App\JTagihan;
use App\Gelombang;
use App\TagihanPSB;
use App\TahunPelajaran;

class TagihanPSBController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'jtagihan');
    }

    public function index()
    {
        return TagihanPSB::with('gelnya.unitnya', 'gelnya.tpnya', 'kelasnya')
            ->whereHas('gelnya', function ($query) {
                $query->where('tp', auth('api')->user()->tpid);
            })
            ->orderBy('kelas', 'asc')
            ->orderBy('kelamin', 'asc')
            ->get()
            ->toArray();
    }

    public function store(Request $request)
    {
        $gel = DB::table('gelombangs')
            ->select('gelombangs.id', 'school_categories.name as nama', 'units.id as unit')
            ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
            ->leftJoin('school_categories', 'units.cat_id', '=', 'school_categories.id')
            ->where('gelombangs.id', $request->gel_id)
            ->first();
        $kelas = Kelasnya::whereId($request['kelas'])->first()->name;

        if ($gel->nama !== 'TK') {
            if ($kelas === '1' || $kelas === '7' || $kelas === '10') {
                $kls = Kelasnya::where('unit_id', $gel->unit)->get();
                $dp1 = $request['biaya1'];
                if ($request['biaya2']) {
                    $dp2 = $request['biaya2'];
                } else {
                    $dp2['Dana Pengembangan'] = '0';
                }
                if ($request['biaya3']) {
                    $dp3 = $request['biaya3'];
                } else {
                    $dp3['Dana Pengembangan'] = '0';
                }

                $d1 = intval($dp1['Dana Pengembangan']);
                $d2 = intval($dp2['Dana Pengembangan']);
                $d3 = intval($dp3['Dana Pengembangan']);

                foreach ($kls as $k) {
                    $t = intval($k->name);
                    if ($kelas === '1') {
                        $selisih = 7 - $t;
                        $bagi = 6;
                    }

                    if ($kelas === '7') {
                        $selisih = 10 - $t;
                        $bagi = 3;
                    }

                    if ($kelas === '10') {
                        $selisih = 13 - $t;
                        $bagi = 3;
                    }

                    $dp1['Dana Pengembangan'] = floor(($selisih / $bagi) * $d1 / 1000) * 1000;
                    $dp2['Dana Pengembangan'] = floor(($selisih / $bagi) * $d2 / 1000) * 1000;
                    $dp3['Dana Pengembangan'] = floor(($selisih / $bagi) * $d3 / 1000) * 1000;

                    TagihanPSB::updateOrCreate([
                        'gel_id' => $request['gel_id'],
                        'kelas' => $k->id,
                        'kelamin' => $request['kelamin']
                    ], [
                        'biaya1' => $dp1,
                        'biaya2' => $dp2,
                        'biaya3' => $dp3,
                    ]);
                }
            }
        }

        if ($gel->nama === 'TK') {
            TagihanPSB::updateOrCreate([
                'gel_id' => $request['gel_id'],
                'kelas' => $request['kelas'],
                'kelamin' => $request['kelamin']
            ], [
                'biaya1' => $request['biaya1'],
                'biaya2' => $request['biaya2'],
                'biaya3' => $request['biaya3'],
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $biaya = TagihanPSB::findOrFail($id);
        $biaya->update($request->all());
    }

    public function show($tgh)
    {
        $tp_now = TahunPelajaran::where('status', 1)->first()->name;
        $cekTp = intval(substr($tp_now, 0, 4));
        if ($cekTp < 2024) {
            $tp = explode("/", $tp_now);
            $tp_awal = intval($tp[0]);
            $tp_akhir = intval($tp[1]);

            $tagihan = explode(':', $tgh);
            $id = $tagihan[0];
            $tgh_id = $tagihan[1];
            $calon = Calon::findOrFail($id);
            $asalNF = $calon->asal_nf;

            if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                $tp_cek = $tp_awal - 1 . '/' . $tp_awal;
                $tp_pindahan = TahunPelajaran::where('name', $tp_cek)->first()->id;
                $unit_cek = Gelombang::where('id', $calon->gel_id)->first()->unit_id;
                $gel_pindahan = Gelombang::where('unit_id', $unit_cek)->where('tp', $tp_pindahan)->first()->id;
                $biayas = TagihanPSB::where('gel_id', $gel_pindahan)
                    ->where('kelas', $calon->kelas_tujuan)
                    ->where('kelamin', $calon->jk)
                    ->first();

                $biaya = $biayas->biaya1 + ['SPP bulan Juli' => $biayas->spppindahan];
                $total = $biayas->totalpindahan[1];
            } else {
                $biayas = TagihanPSB::where('gel_id', $calon->gel_id)
                    ->where('kelas', $calon->kelas_tujuan)
                    ->where('kelamin', $calon->jk)
                    ->first();

                $biaya = $biayas->biaya1 + ['SPP bulan Juli' => $biayas->spp];
                $total = $biayas->total[1];
            }

            if (is_null($biayas)) {
                $data = "KOSONG";
                return compact('data');
            }

            $kls = Kelasnya::where('id', $calon->kelas_tujuan)->first();
            $kelass = Kelasnya::where('unit_id', $kls->unit_id)->where('id', '>=', $kls->id)->get();

            $kelas = [];
            $totalTahunan = 0;
            $no = 1;
            $dauls = 0;
            // $spp_naik = [0, 0, 0, 0, 50000, 150000, 250000];
            $spp_naik = 100000;
            $daul = [
                'TK A' => 2000000,
                'TK B' => 2000000,
                '2' => 3750000,
                '3' => 4100000,
                '4' => 4500000,
                '5' => 4700000,
                '6' => 4900000,
                '8' => 4250000,
                '9' => 5000000,
                '11' => 5000000,
                '12' => 6000000,
            ];

            if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                $daul = [
                    'TK A' => 2000000,
                    'TK B' => 2000000,
                    '2' => 3500000,
                    '3' => 3750000,
                    '4' => 4100000,
                    '5' => 4500000,
                    '6' => 4900000,
                    '8' => 4000000,
                    '9' => 4250000,
                    '11' => 4500000,
                    '12' => 5000000,
                ];
            }
            $bln = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $bulanmasuk = 'SPP bulan ' . $bln[$calon->rencana_masuk];

            if ($calon->pindahan === 0) {
                $bulan = 'SPP ' . $bln[($calon->rencana_masuk) + 1] . ' ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                $hitungbln = 11;
            }
            if ($calon->pindahan === 1) {
                if ($calon->rencana_masuk >= 7) {
                    $bulan = 'SPP ' . $bln[($calon->rencana_masuk) + 1] . ' ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                    $hitungbln = 12 - $calon->rencana_masuk + 6;
                }

                if ($calon->rencana_masuk <= 6) {
                    $bulan = 'SPP ' . $bln[($calon->rencana_masuk) + 1] . ' ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                    $hitungbln = 6 - $calon->rencana_masuk;
                }
            }

            foreach ($kelass as $k) {
                if ($no === 1) {
                    $sppnya = $biayas->spp;
                    $kelas[$no]['ket'] = $bulan;
                    $kelas[$no]['total'] = 'Rp. ' . number_format($sppnya * $hitungbln);
                    $totalTahunan = $biayas->spp * $hitungbln;
                }
                if ($no > 1) {
                    $sppnya = $biayas->spp + ($spp_naik * ($no - 1));
                    if ($k->name == 'TK A' || $k->name == 'TK B' || $k->name == 'PG') {
                        $sppnya = $biayas->spp + 100000;
                    }
                    $dauls = (isset($daul[$k->name]) ? $daul[$k->name] : 0);
                    $kelas[$no]['ket'] = 'SPP Juli ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                    $kelas[$no]['total'] = 'Rp. ' . number_format(($sppnya * 12) + $dauls);
                    $totalTahunan = $totalTahunan + ($sppnya * 12) + $dauls;
                    $kelas[$no]['daul'] = (isset($daul[$k->name]) ? 'Dana Tahunan : Rp. ' . number_format($daul[$k->name]) : 0);
                }
                // if ($no === 2 && $tgh_id < 3) {
                //     $sppnya = $biaya2['Iuran SPP Bulan Juli'] + $spp_naik[$no];
                //     $kelas[$no]['ket'] = 'SPP Juli '.($tp_awal+$no-1).' s/d SPP Juni '.($tp_akhir+$no-1);
                //     $kelas[$no]['total'] = 'Rp. '.number_format(($sppnya*12) + $dauls);
                //     $totalTahunan = $totalTahunan + $dauls + $biaya2['Iuran SPP Bulan Juli']*12;
                // }
                // if ($no === 2 && $tgh_id >= 3) {
                //     $sppnya = $biaya3['Iuran SPP Bulan Juli'] + $spp_naik[$no];
                //     $kelas[$no]['ket'] = 'SPP Juli '.($tp_awal+$no-1).' s/d SPP Juni '.($tp_akhir+$no-1);
                //     $kelas[$no]['total'] = 'Rp. '.number_format(($sppnya*12) + $dauls);
                //     $totalTahunan = $totalTahunan + $dauls + $biaya3['Iuran SPP Bulan Juli']*12;
                // }
                // if ($no > 2) {
                //     $sppnya = $biaya3['Iuran SPP Bulan Juli'] + $spp_naik[$no];
                //     $kelas[$no]['ket'] = 'SPP Juli '.($tp_awal+$no-1).' s/d SPP Juni '.($tp_akhir+$no-1);
                //     $kelas[$no]['total'] = 'Rp. '.number_format(($sppnya*12) + $dauls);
                //     $totalTahunan = $totalTahunan + $dauls + $biaya3['Iuran SPP Bulan Juli']*12;
                // }
                // $totalTahunan = $totalTahunan +;
                $kelas[$no]['spp'] = ' @ Rp. ' . number_format($sppnya);
                $kelas[$no]['kelas'] = $k->name;
                $no = $no + 1;
            }
            return compact('biaya', 'total', 'kelas', 'totalTahunan', 'sppnya', 'asalNF', 'bulanmasuk');
        }
        if ($cekTp >= 2024) {
            $tp = explode("/", $tp_now);
            $tp_awal = intval($tp[0]);
            $tp_akhir = intval($tp[1]);

            $tagihan = explode(':', $tgh);
            $id = $tagihan[0];
            $tgh_id = $tagihan[1];
            $calon = Calon::findOrFail($id);
            $asalNF = $calon->asal_nf;

            if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                $tp_cek = $tp_awal - 1 . '/' . $tp_awal;
                $tp_pindahan = TahunPelajaran::where('name', $tp_cek)->first()->id;
                $unit_cek = Gelombang::where('id', $calon->gel_id)->first()->unit_id;
                $gel_pindahan = Gelombang::where('unit_id', $unit_cek)->where('tp', $tp_pindahan)->first()->id;
                $biayas = TagihanPSB::where('gel_id', $gel_pindahan)
                    ->where('kelas', $calon->kelas_tujuan)
                    ->where('kelamin', $calon->jk)
                    ->first();

                $biaya = $biayas->biaya1;
                $total = $biayas->totalpindahan[1];
            } else {
                $biayas = TagihanPSB::where('gel_id', $calon->gel_id)
                    ->where('kelas', $calon->kelas_tujuan)
                    ->where('kelamin', $calon->jk)
                    ->first();

                $biaya = $biayas->biaya1;
                $total = $biayas->total[1];
            }

            if (is_null($biayas)) {
                $data = "KOSONG";
                return compact('data');
            }

            $kls = Kelasnya::where('id', $calon->kelas_tujuan)->first();
            $kelass = Kelasnya::where('unit_id', $kls->unit_id)->where('id', '>=', $kls->id)->get();

            $kelas = [];
            $totalTahunan = 0;
            $no = 1;
            $dauls = 0;
            $spp_naik = [0, 0, 200000, 100000, 100000, 100000, 100000, 100000];
            $daul = [
                'TK A' => 2000000,
                'TK B' => 2000000,
                '2' => 3750000,
                '3' => 4100000,
                '4' => 4500000,
                '5' => 4700000,
                '6' => 4900000,
                '8' => 4250000,
                '9' => 5000000,
                '11' => 5000000,
                '12' => 6000000,
            ];

            if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                $daul = [
                    'TK A' => 2000000,
                    'TK B' => 2000000,
                    '2' => 3500000,
                    '3' => 3750000,
                    '4' => 4100000,
                    '5' => 4500000,
                    '6' => 4900000,
                    '8' => 4000000,
                    '9' => 4250000,
                    '11' => 4500000,
                    '12' => 5000000,
                ];
            }
            $bln = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $bulanmasuk = 'SPP bulan ' . $bln[$calon->rencana_masuk];

            if ($calon->pindahan === 0) {
                $bulan = 'SPP ' . $bln[($calon->rencana_masuk) + 1] . ' ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                $hitungbln = 11;
            }
            if ($calon->pindahan === 1) {
                if ($calon->rencana_masuk >= 7) {
                    $bulan = 'SPP ' . $bln[($calon->rencana_masuk) + 1] . ' ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                    $hitungbln = 12 - $calon->rencana_masuk + 6;
                }

                if ($calon->rencana_masuk <= 6) {
                    $bulan = 'SPP ' . $bln[($calon->rencana_masuk) + 1] . ' ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                    $hitungbln = 6 - $calon->rencana_masuk;
                }
            }

            foreach ($kelass as $k) {
                // if ($no === 1) {
                if ($no === 1) {
                    $sppnya = $biayas->spp;
                }
                if ($no > 1) {
                    $sppnya = $sppnya + $spp_naik[$no];
                    $kelas[$no]['daul'] = (isset($daul[$k->name]) ? 'Dana Tahunan : Rp. ' . number_format($daul[$k->name]) : 0);
                }
                $dauls = (isset($daul[$k->name]) ? $daul[$k->name] : 0);
                $kelas[$no]['ket'] = 'SPP Juli ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                $kelas[$no]['total'] = 'Rp. ' . number_format(($sppnya * 12) + $dauls);
                $totalTahunan = $totalTahunan + ($sppnya * 12) + $dauls;
                $kelas[$no]['spp'] = ' @ Rp. ' . number_format($sppnya);
                $kelas[$no]['kelas'] = $k->name;
                $no = $no + 1;
            }
            return compact('biaya', 'total', 'kelas', 'totalTahunan', 'sppnya', 'asalNF', 'bulanmasuk');
        }
    }

    public function simmsit()
    {
        $tp = substr(auth('api')->user()->tpname, 0, 4) - 1;
        return Simmsit::orderBy('nama', 'asc')->where('tahun_ajaran', $tp)->pluck('nama');
    }

    public function jtagihan()
    {
        return Jtagihan::orderBy('id', 'asc')->get()->toArray();
    }

    public function jtagihaninvoce()
    {
        $jt = Jtagihan::orderBy('id', 'asc')->get()->toArray();
        array_push($jt, ['id' => 5, 'alias' => 'spp', 'name' => 'SPP bulan Juli']);
        return $jt;
    }

    public function destroy($id)
    {
        $biaya = TagihanPSB::findOrFail($id);
        $biaya->delete();
    }
}

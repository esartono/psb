<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Calon;
use App\Kelasnya;
use App\Gelombang;
use App\TagihanPSB;
use App\TahunPelajaran;

class TagihanPSBController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    public function index()
    {
        return TagihanPSB::with('gelnya.unitnya', 'gelnya.tpnya', 'kelasnya')
                ->whereHas('gelnya', function ($query) {
                    $query->where('tp', auth('api')->user()->tpid);
                })
                ->orderBy('id', 'asc')
                ->get()
                ->toArray();
    }

    public function store(Request $request)
    {
        $gel = DB::table('gelombangs')
                ->select('gelombangs.id', 'school_categories.name as nama' , 'units.id as unit')
                ->leftJoin('units','gelombangs.unit_id','=','units.id')
                ->leftJoin('school_categories','units.cat_id','=','school_categories.id')
                ->where('gelombangs.id', $request->gel_id)
                ->first();
        $kelas = Kelasnya::whereId($request['kelas'])->first()->name;

        if($gel->nama !== 'TK') {
            if($kelas === '1' || $kelas === '7' || $kelas === '10') {
                $kls = Kelasnya::where('unit_id', $gel->unit)->get();
                $dp1 = $request['biaya1'];
                $dp2 = $request['biaya2'];
                $dp3 = $request['biaya3'];

                $d1 = intval($dp1['Dana Pengembangan']);
                $d2 = intval($dp2['Dana Pengembangan']);
                $d3 = intval($dp3['Dana Pengembangan']);

                foreach ($kls as $k) {
                    $t = intval($k->name);
                    if($kelas === '1'){
                        $selisih = 7 - $t;
                    }

                    if($kelas === '7'){
                        $selisih = 10 - $t;
                    }

                    if($kelas === '10'){
                        $selisih = 13 - $t;
                    }

                    $dp1['Dana Pengembangan'] = ($selisih / 6) * $d1;
                    $dp2['Dana Pengembangan'] = ($selisih / 3) * $d2;
                    $dp3['Dana Pengembangan'] = ($selisih / 3) * $d3;

                    TagihanPSB::updateOrCreate([
                        'gel_id' => $request['gel_id'],
                        'kelas' => $k->id,
                        'kelamin' => $request['kelamin']
                    ],[
                        'biaya1' => $dp1,
                        'biaya2' => $dp2,
                        'biaya3' => $dp3,
                    ]);
                }
            }
        }

        if($gel->nama === 'TK') {
            TagihanPSB::updateOrCreate([
                'gel_id' => $request['gel_id'],
                'kelas' => $request['kelas'],
                'kelamin' => $request['kelamin']
            ],[
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
        $tp = explode("/", $tp_now);
        $tp_awal = intval($tp[0]);
        $tp_akhir = intval($tp[1]);

        $tagihan = explode(':', $tgh);
        $id = $tagihan[0];
        $tgh_id = $tagihan[1];
        $calon = Calon::findOrFail($id);
        $biayas = TagihanPSB::where('gel_id', $calon->gel_id)
                ->where('kelas', $calon->kelas_tujuan)
                ->where('kelamin', $calon->jk)
                ->first();

        $biaya3 = $biayas->biaya3;
        $biaya2 = $biayas->biaya2;

        if($tgh_id == 1){$biaya = $biayas->biaya1; $total = $biayas->total[1];}
        if($tgh_id == 2){$biaya = $biayas->biaya2; $total = $biayas->total[2];}
        if($tgh_id == 3){$biaya = $biayas->biaya3; $total = $biayas->total[3];}

        $kls = Kelasnya::where('id', $calon->kelas_tujuan)->first();
        $kelass = Kelasnya::where('unit_id', $kls->unit_id)->where('id', '>=', $kls->id)->get();

        $kelas = [];
        $totalTahunan = 0;
        $no = 1;
        $dauls = 0;
        $spp_naik = [0, 0, 0, 0, 50000, 150000, 250000];
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
        foreach($kelass as $k) {
            if ($no === 1){
                $sppnya = $biaya['Iuran SPP Bulan Juli'] + $spp_naik[$no];
                $kelas[$no]['ket'] = 'SPP Agustus '.($tp_awal+$no-1).' s/d SPP Juni '.($tp_akhir+$no-1);
                $kelas[$no]['total'] = 'Rp. '.number_format($sppnya*11);
                $totalTahunan = $totalTahunan + $biaya['Iuran SPP Bulan Juli']*11;
            }
            if ($no > 1){
                $dauls = (isset($daul[$k->name]) ? $daul[$k->name] : 0);
                $kelas[$no]['daul'] = (isset($daul[$k->name]) ? 'Dana Tahunan : Rp. '.number_format($daul[$k->name]) : 0);
            }
            if ($no === 2 && $tgh_id < 3) {
                $sppnya = $biaya2['Iuran SPP Bulan Juli'] + $spp_naik[$no];
                $kelas[$no]['ket'] = 'SPP Juli '.($tp_awal+$no-1).' s/d SPP Juni '.($tp_akhir+$no-1);
                $kelas[$no]['total'] = 'Rp. '.number_format(($sppnya*12) + $dauls);
                $totalTahunan = $totalTahunan + $dauls + $biaya2['Iuran SPP Bulan Juli']*12;
            }
            if ($no === 2 && $tgh_id >= 3) {
                $sppnya = $biaya3['Iuran SPP Bulan Juli'] + $spp_naik[$no];
                $kelas[$no]['ket'] = 'SPP Juli '.($tp_awal+$no-1).' s/d SPP Juni '.($tp_akhir+$no-1);
                $kelas[$no]['total'] = 'Rp. '.number_format(($sppnya*12) + $dauls);
                $totalTahunan = $totalTahunan + $dauls + $biaya3['Iuran SPP Bulan Juli']*12;
            }
            if ($no > 2) {
                $sppnya = $biaya3['Iuran SPP Bulan Juli'] + $spp_naik[$no];
                $kelas[$no]['ket'] = 'SPP Juli '.($tp_awal+$no-1).' s/d SPP Juni '.($tp_akhir+$no-1);
                $kelas[$no]['total'] = 'Rp. '.number_format(($sppnya*12) + $dauls);
                $totalTahunan = $totalTahunan + $dauls + $biaya3['Iuran SPP Bulan Juli']*12;
            }
            // $totalTahunan = $totalTahunan +;
            $kelas[$no]['spp'] = ' @ Rp. '.number_format($sppnya);
            $kelas[$no]['kelas'] = $k->name;
            $no = $no + 1;
        }
        return compact('biaya', 'total', 'kelas', 'totalTahunan');
    }

    public function destroy($id)
    {
        $biaya = TagihanPSB::findOrFail($id);
        $biaya->delete();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use App\Gelombang;
use App\Calon;
use App\TagihanPSB;
use App\TahunPelajaran;
use App\CalonTagihanPSB;
use App\Kelasnya;
use App\Jadwal;
use App\CalonJadwal;

class WawancaraController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function wawancaraKeuangan()
    {
        return view('wawancara.keuangan');
    }

    public function PDFKeuangan($id)
    {
        $ctg = CalonTagihanPSB::where('calon_id', $id)->first();

        $tp_now = TahunPelajaran::where('status', 1)->first()->name;
        $tp = explode("/", $tp_now);
        $tp_awal = intval($tp[0]);
        $tp_akhir = intval($tp[1]);

        $biayanya = ['Dana Pengembangan', 'Dana Pendidikan', 'SPP bulan Juli', 'Iuran Komite Sekolah / tahun', 'Seragam'];

        $security = $ctg->created_at;

        $id = $ctg->calon_id;
        // $tgh_id = $ctg->tagihanpsb_id;
        //Kalo ini ada yg di edit, maka di TagihanPSBController.show juga mulai dari baris ini
        $calon = Calon::findOrFail($id);
        $khusus = 0;
        $biayas = TagihanPSB::where('gel_id', $calon->gel_id)
                ->where('kelas', $calon->kelas_tujuan)
                ->where('kelamin', $calon->jk)
                ->first();

        if (TagihanPSB::where('gel_id', $calon->uruts)->exists()) {
            $biayas = TagihanPSB::where('gel_id', $calon->uruts)->first();
            $khusus = 1;
        }

        $biaya1 = $biayas->biaya1 + ['SPP bulan Juli' => $biayas->spp];
        // $biaya2 = $biayas->biaya2;
        // $biaya3 = $biayas->biaya3;

        $total1 = $biayas->total[1];
        // $total2 = $biayas->total[2];
        // $total3 = $biayas->total[3];

        $kls = Kelasnya::where('id', $calon->kelas_tujuan)->first();
        $kelass = Kelasnya::where('unit_id', $kls->unit_id)->where('id', '>=', $kls->id)->get();

        $spp_naik = 100000;
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

        $totalAll = [];
        $kelas = [];
        $no = 1;
        $dauls = 0;
        $totalth = 0;
        $tgh_id = 1;
        foreach($kelass as $k) {
            if ($no === 1){
                $sppnya = $biayas->spp;
                if ($ctg->khusus == 0) {
                    $kelas[$k->name]['ket'][0] = 'SPP Agustus '.($tp_awal+$no-1).' s/d SPP Juni '.($tp_akhir+$no-1);
                    $kelas[$k->name]['total'][0] = $sppnya*11;
                    $totalth = $totalth + $sppnya*11;
                }
                if ($ctg->khusus == 1) {
                    $kelas[$k->name]['ket'][0] = 'SPP Februari s/d SPP Juni '.($tp_akhir+$no-1-$khusus);
                    $kelas[$k->name]['total'][0] = $sppnya*5;
                    $totalth = $totalth + $sppnya*5;
                }
            }
            if ($no > 1) {
                $sppnya = $biayas->spp + ($spp_naik*($no-1));
                $kelas[$k->name]['ket'][$no-1] = 'SPP Juli '.($tp_awal+$no-1-$khusus).' s/d SPP Juni '.($tp_akhir+$no-1-$khusus);
                $kelas[$k->name]['total'][$no-1] = $sppnya*12;
                $kelas[$k->name]['daul'][$no-1] = $daul[$k->name];
                $totalth = $totalth + $sppnya*12 + $daul[$k->name];
            }
            $kelas[$k->name]['spp'][$no-1] = $sppnya;
            $totalAll[$tgh_id] = $totalth;
            $kelas[$k->name]['kelas'] = $k->name;
            $no = $no + 1;
        }

        $tglbatas = "31 Mei 2021";
        $batasannya = new \DateTime('2021-05-31');

        $reg1 = new \DateTime('2021-02-1');
        $reg2 = new \DateTime('2021-03-1');
        $reg3 = new \DateTime('2021-04-1');

        if($reg3 > $ctg->created_at) {
            $tglbatas = "31 April 2021";
        }

        if($reg2 > $ctg->created_at) {
            $tglbatas = "31 Maret 2021";
        }

        if($reg1 > $ctg->created_at) {
            $tglbatas = "31 Januari 2021";
        }

        if($batasannya < $ctg->created_at) {
            $cjadwal = CalonJadwal::where('calon_id', $ctg->calon_id)->first()->jadwal_id;
            $jadwal = explode('-', Jadwal::whereId($cjadwal)->first()->keterangan);
            $tglbatas = $jadwal[1];
        }

        if ($ctg->khusus == 0) {
            $pdf = PDF::loadView('pdf.tagihanPSB', compact('biayanya', 'ctg', 'tglbatas', 'security', 'calon', 'biaya1', 'total1', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir'));
        }

        if ($ctg->khusus == 1) {
            $pdf = PDF::loadView('pdf.tagihanPSBKhusus', compact('biayanya', 'ctg', 'security', 'calon', 'biaya1', 'biaya2', 'biaya3', 'total1', 'total2', 'total3', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir'));
        }

        return $pdf->stream('');
    }

    public function getCalon($id)
    {
        $calon = Calon::with('gelnya.unitnya.catnya', 'kelasnya')
                ->whereId($id)->first();

        $now = new \DateTime();
        $tglbatas = "31 Mei 2021";
        $reg1 = new \DateTime('2021-02-1');
        $reg2 = new \DateTime('2021-03-1');
        $reg3 = new \DateTime('2021-04-1');

        if($reg3 > $now) {
            $tglbatas = "31 April 2021";
        }

        if($reg2 > $now) {
            $tglbatas = "31 Maret 2021";
        }

        if($reg1 > $now) {
            $tglbatas = "31 Januari 2021";
        }

        return view('wawancara.invoice', compact('calon', 'tglbatas'));

        // $id = $request->id;
        // $va = substr($id, 0, 6);
        // $urt = intval(substr($id, 6));
        // if(auth()->user()->isAdmin() || auth()->user()->isAdminKeu()) {
        //     $gelombang = Gelombang::where('kode_va', $va)->get()->pluck('id');
        //     if(count($gelombang) > 0){
        //         $calon = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'usernya')
        //                 ->where('gel_id',$gelombang)
        //                 ->where('urut',$urt)
        //                 ->where('status',1)->first();
        //         $tagihans = TagihanPSB::where('kelas', $calon->kelas_tujuan)->get();
        //         $no = 1;
        //         return view('wawancara.invoice', compact('calon', 'tagihans', 'no'));
        //     }
        //     return redirect()->back()->with('error', 'Maaf, No. Pendaftaran : '. $id .' tidak ditemukan');
        // }
    }
}

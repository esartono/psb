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
        $biayanya = ['Dana Pengembangan', 'Dana Pendidikan', 'Iuran SPP Bulan Juli', 'Iuran Komite Sekolah / tahun', 'Seragam'];

        $security = $ctg->created_at;

        $tp_now = TahunPelajaran::where('status', 1)->first()->name;
        $tp = explode("/", $tp_now);
        $tp_awal = intval($tp[0]);
        $tp_akhir = intval($tp[1]);

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

        $biaya1 = $biayas->biaya1;
        $biaya2 = $biayas->biaya2;
        $biaya3 = $biayas->biaya3;

        $total1 = $biayas->total[1];
        $total2 = $biayas->total[2];
        $total3 = $biayas->total[3];

        $kls = Kelasnya::where('id', $calon->kelas_tujuan)->first();
        $kelass = Kelasnya::where('unit_id', $kls->unit_id)->where('id', '>=', $kls->id)->get();

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

        $totalAll = [];
        $kelas = [];
        for($tgh_id = 1; $tgh_id<=3; $tgh_id++){
            $no = 1;
            $dauls = 0;
            $totalth = 0;
            foreach($kelass as $k) {
                if ($no === 1){
                    if($tgh_id == 1){
                        $sppnya = $biaya1['Iuran SPP Bulan Juli'] + $spp_naik[$no];
                    }
                    if($tgh_id == 2){
                        $sppnya = $biaya2['Iuran SPP Bulan Juli'] + $spp_naik[$no];
                    }
                    if($tgh_id == 3){
                        $sppnya = $biaya3['Iuran SPP Bulan Juli'] + $spp_naik[$no];
                    }
                    if ($ctg->khusus == 0) {
                        $kelas[$k->name]['ket'.$tgh_id] = 'SPP Agustus '.($tp_awal+$no-1).' s/d SPP Juni '.($tp_akhir+$no-1);
                        $kelas[$k->name]['total'.$tgh_id] = $sppnya*11;
                        $totalth = $totalth + $sppnya*11;
                    }

                    if ($ctg->khusus == 1) {
                        $kelas[$k->name]['ket'.$tgh_id] = 'SPP Februari s/d SPP Juni '.($tp_akhir+$no-1-$khusus);
                        $kelas[$k->name]['total'.$tgh_id] = $sppnya*5;
                        $totalth = $totalth + $sppnya*5;
                    }
                }
                if ($no > 1){
                    $dauls = (isset($daul[$k->name]) ? $daul[$k->name] : 0);
                    $kelas[$k->name]['daul'.$tgh_id] = (isset($daul[$k->name]) ? $daul[$k->name] : 0);
                    $totalth = $totalth + $dauls;
                }
                if ($no === 2 && $tgh_id < 3) {
                    $sppnya = $biaya2['Iuran SPP Bulan Juli'] + $spp_naik[$no];
                    $kelas[$k->name]['ket'.$tgh_id] = 'SPP Juli '.($tp_awal+$no-1-$khusus).' s/d SPP Juni '.($tp_akhir+$no-1-$khusus);
                    $kelas[$k->name]['total'.$tgh_id] = $sppnya*12;
                    $totalth = $totalth + $sppnya*12;
                }
                if ($no === 2 && $tgh_id >= 3) {
                    $sppnya = $biaya3['Iuran SPP Bulan Juli'] + $spp_naik[$no];
                    $kelas[$k->name]['ket'.$tgh_id] = 'SPP Juli '.($tp_awal+$no-1-$khusus).' s/d SPP Juni '.($tp_akhir+$no-1-$khusus);
                    $kelas[$k->name]['total'.$tgh_id] = $sppnya*12;
                    $totalth = $totalth + $sppnya*12;
                }
                if ($no > 2) {
                    $sppnya = $biaya3['Iuran SPP Bulan Juli'] + $spp_naik[$no];
                    $kelas[$k->name]['ket'.$tgh_id] = 'SPP Juli '.($tp_awal+$no-1-$khusus).' s/d SPP Juni '.($tp_akhir+$no-1-$khusus);
                    $kelas[$k->name]['total'.$tgh_id] = $sppnya*12;
                    $totalth = $totalth + $sppnya*12;
                }
                $totalAll[$tgh_id] = $totalth;
                $kelas[$k->name]['spp'.$tgh_id] = $sppnya;
                $kelas[$k->name]['kelas'] = $k->name;
                $no = $no + 1;
            }
        }

        $tglbatas = "31 Mei 2021";
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

        if ($ctg->khusus == 0) {
            $pdf = PDF::loadView('pdf.tagihanPSB', compact('biayanya', 'ctg', 'tglbatas', 'security', 'calon', 'biaya1', 'biaya2', 'biaya3', 'total1', 'total2', 'total3', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir'));
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

use Telegram;
use PDF;

use App\CalonBiayaTes;
use App\Jadwal;
use App\Calon;
use App\BiayaTes;
use App\Gelombang;
use App\CalonJadwal;
use App\TahunPelajaran;
use App\TagihanPSB;
use App\Kelasnya;
use App\CalonTagihanPSB;
use App\BayarTagihan;

use App\Edupay\Facades\Edupay;

class UjicobaController extends Controller
{
    public function cek()
    {
        $lihat = Calon::get();

        foreach($lihat as $l){
            $bayar = Edupay::view($l->uruts);
            if(isset($bayar['status_bayar'])){
                if($bayar['status_bayar'] == '1'){
                    $cek = CalonBiayaTes::where('calon_id', $l->id)->first();
                    $cek->update(['lunas' => 1]);
                    //$cek->lunas($l->id);

                    $l->update(['status' => 1]);

                    Telegram::sendMessage([
                        'chat_id' => '643982879',
                        //'chat_id' => '-1001398300408',
                        'text' => 'Id Tagihan : '.$bayar['inquiry_response_nama'].' - '.$bayar['id_tagihan'].' Sudah Lunas',
                    ]);
                }
            } else {
                Telegram::sendMessage([
                    'chat_id' => '643982879',
                    //'chat_id' => '-1001398300408',
                    'text' => 'Id Tagihan : '.$l->uruts.' - '.$bayar['message']
                ]);

            }
        }
    }

    public function cek1()
    {

        $calonbiayates = CalonBiayaTes::where('lunas', 1)->get();
        foreach($calonbiayates as $c) {
            $calon = Calon::with('gelnya')->whereId($c->calon_id)->first();
            $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->addDays(3)->timezone('Asia/Jakarta')->toDateString())
                        ->where('gel_id', $calon->gel_id)
                        ->where('internal', 0)->first();
            // dd($jadwal->id);
            if($jadwal){
                $jd = $jadwal->id;
            } else {
                $jd = 0;
                dd($calon->uruts);
            }

            $cj = CalonJadwal::where('calon_id', $calon->id)->first();
            if(!$cj){
                CalonJadwal::updateOrCreate(
                    ['calon_id' => $calon->id],
                    ['jadwal_id' => $jd]
                );
            } else {
                if($cj->jadwal_id == 0){
                    CalonJadwal::updateOrCreate(
                        ['calon_id' => $calon->id],
                        ['jadwal_id' => $jd]
                    );
                }
            }
        }

    }

    public function cek2()
    {
        $tp = TahunPelajaran::where('status', 1)->first();

        $gelombang = Gelombang::with('unitnya.catnya')->where('tp', $tp->id)
                ->orderBy('unit_id', 'asc')->get()->toArray();

        $cek = 'Update Pendaftaran PPDB SIT NF'.PHP_EOL.'Tanggal: '.date('d M Y').' ('.date('H:i').')'.PHP_EOL;
        // foreach ($gelombang as $gel) {
        //     $cek = $cek.PHP_EOL.$gel['unitnya']['catnya']['name'] . ' : ' . ($gel['jlhrekap']['laktif']+$gel['jlhrekap']['paktif']);
        // }
        foreach ($gelombang as $gel) {
            $cek = $cek.PHP_EOL.$gel['unitnya']['name'] . ' : '.PHP_EOL.
                '  Umum : '.$gel['jlhrekap']['umumaktif'].PHP_EOL.
                '  Internal : '.$gel['jlhrekap']['nfaktif'].PHP_EOL.
                '  Pegawai : '.$gel['jlhrekap']['pegaktif'].PHP_EOL.
                '  TOTAL : '.($gel['jlhrekap']['umumaktif']+$gel['jlhrekap']['nfaktif']+$gel['jlhrekap']['pegaktif']).PHP_EOL;
        }

        Telegram::sendMessage(
            [
                'chat_id' => '902836220',
                'text' => $cek
            ]);

        Telegram::sendMessage(
            [
                'chat_id' => '11095399',
                'text' => $cek
            ]);

        Telegram::sendMessage(
            [
                'chat_id' => '330501661',
                'text' => $cek
            ]);

        Telegram::sendMessage(
            [
                'chat_id' => '643982879',
                'text' => $cek
            ]);
    }

    public function cek31()
    {
        $jadwal = Jadwal::get();
        foreach($jadwal as $j) {
            $c = CalonJadwal::where('jadwal_id', $j->id)->get()->count();
            $n[$j->id] = $c;
            $j->update(['ikut' => $c]);
        }
        dd($n);
    }

    public function cek3()
    {
        // return CalonTagihanPSB::with('calonnya')->whereId(10)->get()->toArray();
        // return Carbon::today()->addDays(3)->timezone('Asia/Jakarta')->toDateString();
        ini_set('max_execution_time', 1200);
        $ctgs = CalonTagihanPSB::offset(567)->limit(100)->get();
        // $ctgs = CalonTagihanPSB::where('calon_id', 535)->get();

        $hitung_urut = 0;
        foreach($ctgs as $ctg){
            echo $hitung_urut++;
            $security = '80191007';

            $biayanya = ['Dana Pengembangan', 'Dana Pendidikan', 'Iuran SPP Bulan Juli', 'Iuran Komite Sekolah / tahun', 'Seragam'];

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
                            $kelas[$k->name]['ket'.$tgh_id] = 'SPP Agustus '.($tp_awal+$no-1-$khusus).' s/d SPP Juni '.($tp_akhir+$no-1-$khusus);
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

            $pdf = PDF::loadView('pdf.tagihanPSB', compact('biayanya', 'ctg', 'security', 'tglbatas', 'calon', 'biaya1', 'biaya2', 'biaya3', 'total1', 'total2', 'total3', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir'));
            // return $pdf->stream('');
            $path = Storage::disk('my_upload')->put('/'.$calon->uruts.'/tagihanPSB-'.$calon->uruts.'.pdf', $pdf->output());

            $calonsnya = Calon::with('gelnya.unitnya', 'usernya')->where('id',$calon->id)->first();
            Mail::send('emails.tagihanPSB', compact('calonsnya'), function ($m) use ($calonsnya)
                {
                    $m->to($calonsnya->usernya->email, $calonsnya->name)
                        ->from('psb@nurulfikri.sch.id', 'Panitia PSB SIT Nurul Fikri')
                        ->attach(storage_path('dokumen').'/'.$calonsnya->uruts.'/tagihanPSB-'.$calonsnya->uruts.'.pdf', [
                            'mime' => 'application/pdf',
                        ])
                        ->subject('Form Pembiayaan PPDB - SIT Nurul Fikri');
                }
            );
        }
    }

    public function cek4()
    {
        $cj = CalonTagihanPSB::get();
        foreach($cj as $j) {
            CalonTagihanPSB::where('id', $j->id)->update(['va1' => '860001']);
        }

    }

    public function cek5()
    {
        $sd = ['212232004','212232005','212232008','212232009','212232015','212232017','212232019','212232020','212232021','212232023','212232024','212232025','212232026','212232030','212232031','212232032','212232033','212232034','212232035','212232039','212232040'];
        $smp = ['212233001','212233003','212233004','212233005','212233006','212233009','212233011','212233012','212233015','212233016','212233018','212233019','212233021','212233022','212233023','212233029','212233038','212233042','212233043','212233044','212233046','212233051','212233052','212233053','212233055','212233057','212233059','212233063','212233064','212233065','212233070','212233071','212233073','212233075','212233076','212233077','212233079','212233080','212233082','212233084','212233086','212233090','212233092','212233093','212233095','212233097','212233098','212233101','212233105','212233109','212233110','212233116'];
        $sma = ['212234004','212234006','212234010','212234011','212234013','212234014','212234017','212234018','212234019','212234020','212234023','212234024','212234025','212234026','212234030','212234032','212234033','212234034','212234035','212234037','212234038','212234039','212234040','212234041','212234043','212234045','212234046','212234047','212234049','212234056','212234057','212234059','212234060','212234061','212234063','212234064','212234065','212234069','212234073','212234075','212234078','212234079','212234080','212234087','212234094','212234108','212234110','212234111','212234112','212234113','212234114','212234115','212234117','212234118','212234119','212234126','212234130','212234132','212234134','212234136','212234147','212234148','212234158','212234161'];

        foreach ($sd as $s) {
            $gel = Gelombang::where('kode_va', substr($s,0,6))->first()->id;
            $urut = intval(substr($s,6));
            $calon = Calon::where('gel_id', $gel)->where('urut', $urut)->first()->id;
            echo $calon.'<br>';
        }
    }

    public function cek33()
    {
        // return CalonTagihanPSB::with('calonnya')->whereId(10)->get()->toArray();
        // return Carbon::today()->addDays(3)->timezone('Asia/Jakarta')->toDateString();
        ini_set('max_execution_time', 1000);
        $ctgs = CalonTagihanPSB::offset(168)->limit(70)->get();

        foreach($ctgs as $ctg){

        $id = $ctg->calon_id;

        $calonsnya = Calon::with('gelnya.unitnya', 'usernya')->where('id',$id)->first();
        Mail::send('emails.jadwalDokumen', compact('id'), function ($m) use ($calonsnya)
            {
                $m->to($calonsnya->usernya->email, $calonsnya->name)
                    ->from('psb@nurulfikri.sch.id', 'Panitia PSB SIT Nurul Fikri')
                    ->subject('Jadwal Penyerahan Dokumen');
            }
        );
        }
    }

    public function cek6()
    {
        $calons = CalonTagihanPSB::with('calonnya')->get();
        return view('exports.tagihanPSB', [
            'calons' => $calons,
            'no' => 1,
            'judul' => 'Eksport Tagihan',
        ]);
    }

    public function asalNF($gel)
    {
        $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->addDays(3)->timezone('Asia/Jakarta')->toDateString())
                ->where('gel_id', $gel)
                ->where('internal', 1)->first();
        if($jadwal){
            return $jadwal->id;
        } else {
            return "SALAH";
        }
    }

    public function pilihjadwal($gel)
    {
        $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->addDays(3)->timezone('Asia/Jakarta')->toDateString())
                ->where('gel_id', $gel)
                ->where('internal', 0)->first();
        if($jadwal){
            return $jadwal->id;
        } else {
            return 0;
        }
    }

}

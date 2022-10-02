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
use App\JTagihan;
use App\SiswaNF;


use App\Facades\Edupay;
use App\Notifications\Wa;

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
        $tes = Wa::kirim(auth()->user()->phone, 'Tes kirim dari PPDB NF');
        dd($tes);
        // $lihat = Calon::with('usernya')->where('status', 0)->where('aktif', 1)->get();
        // $eko = "";

        // foreach($lihat as $l){
        //     $bayar = Edupay::view($l->uruts);
        //     if(isset($bayar['status_bayar'])){
        //         if($bayar['status_bayar'] == '1'){
        //             Telegram::sendMessage([
        //                 'chat_id' => '643982879',
        //                 //'chat_id' => '-1001398300408',
        //                 'text' => 'Id Tagihan : '.$bayar['inquiry_response_nama'].' - '.$bayar['id_tagihan'].' Sudah Lunas',
        //             ]);
        //             Wa::kirim(
        //                 $l->usernya->phone,
        //                 'Terima kasih Bapak/Ibu '.$l->usernya->name.', Pembayaran Biaya Pendaftaran atas nama '.$bayar['inquiry_response_nama'].' telah kami terima');
        //             $cek = CalonBiayaTes::where('calon_id', $l->id)->first();
        //             $cek->update(['lunas' => 1]);
        //             $cek->lunas($l->id);
        //         }
        //     } else {
        //         // $eko = $eko.'Id Tagihan : '.$l->uruts.' - '.$bayar['message'].PHP_EOL;
        //     }
        // }
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
        ini_set('max_execution_time', 1200);

        $calons = Calon::whereIn('gel_id', [6,7,8,9])->where('status', 1)->get();

        foreach($calons as $c){
            $cek = CalonJadwal::where('calon_id', $c->id)->first();

            if(is_null($cek)) {
                $jadwal = Jadwal::where('gel_id', $c->gel_id)->where('internal', $c->asal_nf)->first();
                CalonJadwal::updateOrCreate([
                    'calon_id' => $c->id
                ], [
                    'jadwal_id' => $jadwal->id,
                ]);
            }
        }

        // if($asal == 1) {
        //     $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->addDays(3)->timezone('Asia/Jakarta')->toDateString())
        //             ->where('gel_id', $gel)
        //             ->where('internal', 1)
        //             ->whereColumn('kuota', '>=', 'ikut')
        //             ->first();
        //     if($jadwal) {
        //         return $jadwal->id;
        //     }
        // }

        // $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->addDays(3)->timezone('Asia/Jakarta')->toDateString())
        //         ->where('gel_id', $gel)
        //         ->where('internal', 0)
        //         ->whereColumn('kuota', '>=', 'ikut')
        //         ->first();

        // if($jadwal) {
        //     return $jadwal->id;
        // }
        // return 0;
        
        dd('Berhasil Gan');
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

    public function pilihjadwal($gel, $asal)
    {
        if($asal == 1) {
            $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->addDays(3)->timezone('Asia/Jakarta')->toDateString())
                    ->where('gel_id', $gel)
                    ->where('internal', 1)
                    ->whereColumn('kuota', '>=', 'ikut')
                    ->first();
            if($jadwal) {
                return $jadwal->id;
            }
        }

        $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->addDays(3)->timezone('Asia/Jakarta')->toDateString())
                ->where('gel_id', $gel)
                ->where('internal', 0)
                ->whereColumn('kuota', '>=', 'ikut')
                ->first();

        if($jadwal) {
            return $jadwal->id;
        }
        return 0;
    }

}

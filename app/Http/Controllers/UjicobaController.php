<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Telegram;

use App\CalonBiayaTes;
use App\Jadwal;
use App\Calon;
use App\Gelombang;
use App\CalonJadwal;
use App\TahunPelajaran;

use App\Edupay\Facades\Edupay;

class UjicobaController extends Controller
{
    public function cek()
    {
        $lihat = Calon::where('status', 0)->get();

        foreach($lihat as $l){
            $bayar = Edupay::view($l->uruts);
            if(isset($bayar['status_bayar'])){
                if($bayar['status_bayar'] == '1'){
                    $cek = CalonBiayaTes::where('calon_id', $l->id)->first();
                    $cek->update(['lunas' => 1]);
                    $cek->lunas($l->id);

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

            if ($calon->asal_nf){
                $cek = $this->asalNF($calon->gelnya->id);
                if($cek !== "SALAH"){
                    $jd = $cek;
                } else {
                    $jd = $this->pilihjadwal($calon->gelnya->id);
                }
            } else {
                $jd = $this->pilihjadwal($calon->gelnya->id);
            }

            CalonJadwal::updateOrCreate(
                ['calon_id' => $calon->id],
                ['jadwal_id' => $jd]
            );
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
            ['chat_id' => '643982879',
            'text' => $cek],
            ['chat_id' => '902836220',
            'text' => $cek]
        );

    }

    public function cek3()
    {
        $jadwal = CalonJadwal::get();
        foreach($jadwal as $j) {
            CalonJadwal::find($j->id)->update(['waktu' => null]);
        }

    }

    public function asalNF($gel)
    {
        $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->timezone('Asia/Jakarta')->toDateString())
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
        $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->timezone('Asia/Jakarta')->toDateString())
                ->where('gel_id', $gel)
                ->where('internal', 0)->first();
        if($jadwal){
            return $jadwal->id;
        } else {
            return 0;
        }
    }

}

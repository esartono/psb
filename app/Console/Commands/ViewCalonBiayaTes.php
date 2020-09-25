<?php

namespace App\Console\Commands;

use App\Edupay\Facades\Edupay;
use Illuminate\Console\Command;

use Carbon\Carbon;

use Telegram;
use App\CalonBiayaTes;
use App\Calon;
use App\CalonJadwal;
use App\Jadwal;


class ViewCalonBiayaTes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'view:calon_biaya_tes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'View Edupay from Calon Biaya Tes ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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

        //Auto Jadwal

        $calonbiayates = CalonBiayaTes::where('lunas', 1)->get();
        foreach($calonbiayates as $c) {
            $calon = Calon::with('gelnya')->whereId($c->calon_id)->first();

            // if ($calon->asal_nf){
            //     $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->timezone('Asia/Jakarta')->toDateString())
            //             ->where('gel_id', $calon->gelnya->id)
            //             ->where('internal', 1)->first();
            //     if($jadwal){
            //         $cek = $jadwal->id;
            //     } else {
            //         $cek = "SALAH";
            //     }
            //     if($cek !== "SALAH"){
            //         $jd = $cek;
            //     } else {
            //         $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->timezone('Asia/Jakarta')->toDateString())
            //                 ->where('gel_id', $calon->gelnya->id)
            //                 ->where('internal', 0)->first();
            //         if($jadwal){
            //             $jd = $jadwal->id;
            //         } else {
            //             $jd = 0;
            //         }
            //     }
            // } else {
                $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->timezone('Asia/Jakarta')->toDateString())
                        ->where('gel_id', $calon->gelnya->id)
                        ->where('internal', 0)->first();
                if($jadwal){
                    $jd = $jadwal->id;
                } else {
                    $jd = 0;
                }
            // }

            $cek = CalonJadwal::where('calon_id', $calon->id)->get()->count();
            if ($cek == 0){
                CalonJadwal::updateOrCreate(
                    ['calon_id' => $calon->id],
                    ['jadwal_id' => $jd]
                );
            }

            $jadwal = Jadwal::get();
            foreach($jadwal as $j) {
                $c = CalonJadwal::where('jadwal_id', $j->id)->get()->count();
                $j->update(['ikut' => $c]);
            }
        }

        // $lihat = CalonBiayaTes::with('calonnya')->where('lunas', 0)
        //     ->whereDate('expired','<=', Carbon::today()->timezone('Asia/Jakarta')->toDateString())->get();
        // foreach($lihat as $l){
        //     $bayar = Edupay::view($l->calonnya->uruts);
        //     if($bayar['status_bayar'] == 1){
        //         $cek = CalonBiayaTes::where('calon_id', $l->calon_id)->first();
        //         $cek->update(['lunas' => 1]);
        //         $cek->lunas($l->calon_id);

        //         Telegram::sendMessage([
        //             'chat_id' => '643982879',
		//             //'chat_id' => '-1001398300408',
        //             'text' => 'Id Tagihan : '.$bayar['inquiry_response_nama'].' - '.$bayar['id_tagihan'].' Sudah Lunas',
        //         ]);
        //     }
        // }
    }
}

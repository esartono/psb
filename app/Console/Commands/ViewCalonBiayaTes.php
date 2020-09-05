<?php

namespace App\Console\Commands;

use App\Edupay\Facades\Edupay;
use Illuminate\Console\Command;

use Carbon\Carbon;

use Telegram;
use App\CalonBiayaTes;

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
        $lihat = CalonBiayaTes::with('calonnya')->where('lunas', 0)
            ->whereDate('expired','>=', Carbon::today()->timezone('Asia/Jakarta')->toDateString())->get();
        foreach($lihat as $l){
            $bayar = Edupay::view($l->calonnya->uruts);
            if($bayar['status_bayar'] == 1){
                $cek = CalonBiayaTes::where('calon_id', $l->calon_id)->first();
                $cek->update(['lunas' => 1]);
                $cek->lunas($l->calon_id);

                Telegram::sendMessage([
                    'chat_id' => '643982879',
		            //'chat_id' => '-1001398300408',
                    'text' => 'Id Tagihan : '.$bayar['inquiry_response_nama'].' - '.$bayar['id_tagihan'].' Sudah Lunas',
                ]);
            }
        }
    }
}

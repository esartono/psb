<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Telegram;

use App\CalonBiayaTes;
use App\Edupay\Facades\Edupay;

class UjicobaController extends Controller
{
    public function cek()
    {
        $lihat = CalonBiayaTes::with('calonnya')->where('lunas', 0)->whereDate('expired', '>=', date('Y-m-d'))->get();
        foreach($lihat as $l){
            $bayar = Edupay::view($l->calonnya->uruts);
            if(isset($bayar['status_bayar'])){
                if($bayar['status_bayar'] == 1){
                    $cek = CalonBiayaTes::where('calon_id', $l->calon_id)->first();
                    $cek->update(['lunas' => 1]);
                    $cek->lunas();

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
                    'text' => 'Id Tagihan : '.$l->calonnya->uruts.' -- '.$bayar['message'],
                ]);
            }

        }
    }

}

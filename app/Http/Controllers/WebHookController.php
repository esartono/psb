<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Gelombang;
use App\Calon;
use App\CalonBiayaTes;

class WebHookController extends Controller
{
    public function webhookHandler(Request $request)
    {
        sleep(5);
        $pendaftaran = $request->va;
        $sukses = $request->message;

        $gel = Gelombang::where('kode_va', substr($pendaftaran, 0, 6))->first()->id;
        $urut = intval(substr($pendaftaran, 6));
        $calon = Calon::where('urut', $urut)->where('gel_id', $gel)->first();
        $cek = CalonBiayaTes::where('calon_id', $calon->id)->first();

        if ($cek) {
            if ($sukses === "Payment Sukses") {
                $cek->update(['lunas' => 1]);
                $cek->lunas($calon->id);
                return response()->json(['message' => 'Calon sudah berhasil di aktifkan'], 200);
            }
        }

        return response()->json(['message' => 'Not Found!'], 404);
    }
}

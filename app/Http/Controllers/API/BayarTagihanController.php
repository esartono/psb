<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

use App\Calon;
use App\Gelombang;
use App\BayarTagihan;

use Excel;
use App\Exports\ExportBayar;

class BayarTagihanController extends Controller
{
    public function index()
    {
        return BayarTagihan::distinct()
                ->select('calon_id')
                ->with('calonnya', 'adminnya')
                ->get()->toArray();
    }

    public function store(Request $request)
    {
        $gels = Gelombang::where('kode_va', substr($request->pendaftaran,0,6))->first();
        $urut = intval(substr($request->pendaftaran,6));

        if($request->keterangan) {
            $ket = $request->keterangan;
        } else {
            $ket = "-";
        }

        if($gels) {
            $gel = $gels->id;
            $calon = Calon::with('gelnya.unitnya', 'kelasnya', 'usernya')
                    ->where('urut', $urut)->where('gel_id', $gel)->first();

            if($calon) {
                BayarTagihan::create([
                    'calon_id' => $calon->id,
                    'tgl_bayar' => $request->tgl_bayar,
                    'bayar' => $request->bayar,
                    'keterangan' => $ket,
                    'admin' => auth('api')->user()->id
                ]);

                $bayar = BayarTagihan::where('calon_id', $calon->id)->get();
                $tagihan = $bayar->last();

                Mail::send('emails.bayarpsb', compact('calon', 'bayar', 'tagihan'), function ($m) use ($calon)
                    {
                        $m->to($calon->usernya->email, $calon->name)->from('psb@nurulfikri.sch.id', 'Panitia PSB SIT Nurul Fikri')->subject('Pembayaran Daftar Ulang SIT Nurul Fikri');
                    }
                );
            }
        }
    }

    public function show($id)
    {
        return BayarTagihan::with('calonnya')
                ->where('calon_id', $id)
                ->get()->toArray();
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function export()
    {
        return Excel::download(new ExportBayar, 'Data Pembayaran Tagihan PSB.xlsx');
    }

}

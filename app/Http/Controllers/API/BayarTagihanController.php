<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

use App\Calon;
use App\Gelombang;
use App\BayarTagihan;
use App\CalonTagihanPSB;

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
        $registrasi = explode(' - ',$request->name);
        $pendaftaran = $registrasi[0];
        $gels = Gelombang::where('kode_va', substr($pendaftaran,0,6))->first();
        $urut = intval(substr($pendaftaran,6));

        $ket = "-";

        if($request->keterangan) {
            $ket = $request->keterangan;
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
                    'tambah_infaq' => $request->infaq,
                    'diskon' => $request->diskon,
                    'keterangan' => $ket,
                    'admin' => auth('api')->user()->id
                ]);

                $cpsb = CalonTagihanPSB::where('calon_id', $calon->id)->first();
                $cpsb->update(['daul' => 1 , 'lunas' => $request->lunas]);
                $bayar = BayarTagihan::where('calon_id', $calon->id)->get();
                // $tagihan = $bayar->last();

                Mail::send('emails.bayarpsb', compact('calon', 'bayar', 'cpsb'), function ($m) use ($calon)
                    {
                        $m->to($calon->usernya->email, $calon->name)->from('psb@nurulfikri.sch.id', 'Panitia PPDB SIT Nurul Fikri')->subject('Pembayaran Daftar Ulang SIT Nurul Fikri');
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
        return Excel::download(new ExportBayar, 'Data Pembayaran Tagihan PPDB.xlsx');
    }

}

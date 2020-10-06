<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Calon;
use App\Gelombang;
use App\BayarTagihan;

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
        $gel = Gelombang::where('kode_va', substr($request->pendaftaran,0,6))->first()->id;
        $urut = intval(substr($request->pendaftaran,6));

        $calon = Calon::with('gelnya.unitnya', 'kelasnya', 'usernya')
                    ->where('urut', $urut)->where('gel_id', $gel)->first();

        BayarTagihan::create([
            'calon_id' => $calon->id,
            'tgl_bayar' => $request->tgl_bayar,
            'bayar' => $request->bayar,
            'keterangan' => $request->keterangan,
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
}

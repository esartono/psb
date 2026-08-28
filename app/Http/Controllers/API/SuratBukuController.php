<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use App\Gelombang;
use App\AmbilBuku;

class SuratBukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('id');
        return DB::table('calons')
            ->select(
                'calons.id',
                'calons.name',
                'calons.jk',
                'units.name as unit',
                DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts'),
                'bayar_spps.tanggal_bayar as tgl_bayar',
                'bayar_spps.jumlahbayar as bayar',
                'bayar_spps.lunas as lunas',
            )
            ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
            ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
            ->leftJoin('bayar_spps', 'calons.id', '=', 'bayar_spps.calon_id')
            ->whereIn('gel_id', $gelombang)
            ->where('calons.status', 1)
            ->where('calons.aktif', true)
            ->where('bayar_spps.verifikasi', 1)
            ->orderBy('bayar_spps.id', 'desc')
            ->get()
            ->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seragam = AmbilBuku::where('pendaftaran', $request->pendaftaran)->first();

        if (!$seragam) {
            AmbilBuku::create([
                'pendaftaran' => $request->pendaftaran,
                'lunas_daul' => $request->lunas_daul,
                'siap' => $request->siap,
                'hari' => $request->hari,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
            ]);
        } else {
            return 'ERROR';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $seragam = AmbilBuku::where('id', $id)->first();
        $seragam->update([
            'lunas_daul' => $request->lunas_daul,
            'siap' => $request->siap,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

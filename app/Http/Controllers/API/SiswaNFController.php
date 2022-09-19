<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SiswaNF;
use App\DraftCalon;

class SiswaNFController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SiswaNF::with('tpnya', 'kelasnya')->orderBy('name', 'asc')->get()->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SiswaNF::create([
            'nis' => $request['nis'],
            'jk' => $request['jk'],
            'tp' => $request['tp'],
            'unit' => $request['unit'],
            'name' => $request['name'],
            'kelas' => $request['kelas']

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswas = SiswaNF::where('nis', $id)->orderBy('tp', 'desc')->get();
        $cek = $siswas->count();
        // return compact('siswa', 'cek');
        if($cek > 0){
            $siswa = $siswas->first();
            if($siswa->unit === 1 || $siswa->unit === 2 || $siswa->unit === 3) {
                $alamat = 'Jl. Tugu Raya No. 61 Kelapa Dua';
                $propinsi = 32;
                $kota = 3276;
                $kecamatan = 3276040;
                $kelurahan = 3276040012;
                if($siswa->unit === 1) {
                    $sekolah = 'TKIT Nurul Fikri';
                    $alamat = 'Jalan Haji Rijin No. 100';
                }
                if($siswa->unit === 2) {
                    $sekolah = 'SDIT Nurul Fikri';
                }
                if($siswa->unit === 3) {
                    $sekolah = 'SMPIT Nurul Fikri';
                }
            }
            if($siswa->unit === 6) {
                $sekolah = 'NFBS Bogor';
                $alamat = 'Jl. Jami RT002/008';
                $propinsi = 32;
                $kota = 3201;
                $kecamatan = 3201071;
                $kelurahan = 3201071002;
            }
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $cek = 2;
            if($calon->ck_id === 3){
                $cek = 3;
            }
            $calon->update([
                'ck_id' => $cek,
                'step' => 4,
                'asal_nf' => 1,
                'name' => $siswa->name,
                'jk' => $siswa->jk,
                'asal_sekolah' => $sekolah,
                'asal_alamat_sekolah' => $alamat,
                'asal_propinsi_sekolah' => $propinsi,
                'asal_kota_sekolah' => $kota,
                'asal_kecamatan_sekolah' => $kecamatan,
                'asal_kelurahan_sekolah' => $kelurahan,
            ]);
        }
        return compact('cek');
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
        $siswa = SiswaNF::findOrFail($id);
        $siswa->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = SiswaNF::findOrFail($id);
        $siswa->delete();
    }
}

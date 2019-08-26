<?php

namespace App\Http\Controllers\API;

use App\BiayaTes;
use App\Calon;
use App\CalonBiayaTes;
use App\Gelombang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCalonRequest;

class CalonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('id');

        $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya');

        if(auth('api')->user()->isAdmin()) {
            return $calons->whereIn('gel_id', $gelombang)->get()->toArray();
        }

        if (auth('api')->user()->isUser()){
            return $calons->where('user_id', auth('api')->user()->id)
                    ->whereIn('gel_id', $gelombang)->get()->toArray();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCalonRequest $request)
    {
        $urut = Calon::where('gel_id', $request['gel_id'])->get()->count();

        $calon = Calon::create([
            'gel_id' => $request['gel_id'],
            'ck_id' => $request['ck_id'],
            'tgl_daftar' => date('Y-m-d'),
            'urut' => $urut+1,
            'nisn' => $request['nisn'],
            'nik' => $request['nik'],
            'name' => $request['name'],
            'panggilan' => $request['panggilan'],
            'jk' => $request['jk'],
            'kelas_tujuan' => $request['kelas_tujuan'],
            'photo' => 'Belum Ada',
            'tempat_lahir' => $request['tempat_lahir'],
            'tgl_lahir' => $request['tgl_lahir'],
            'agama' => $request['agama'],
            'info' => $request['info'],
            'status' => false,
            'setuju' => $request['setuju'],
            'user_id' => auth('api')->user()->id,
            'alamat' => $request['alamat'],
            'rt' => $request['rt'],
            'rw' => $request['rw'],
            'kodepos' => '13791',
            'provinsi' => $request['provinsi'],
            'kota' => $request['kota'],
            'kecamatan' => $request['kecamatan'],
            'kelurahan' => $request['kelurahan'],
            'phone' => $request['phone'],
            'ayah_nama' => $request['ayah_nama'],
            'ayah_pendidikan' => $request['ayah_pendidikan'],
            'ayah_pekerjaan' => $request['ayah_pekerjaan'],
            'ayah_penghasilan' => $request['ayah_penghasilan'],
            'ayah_hp' => $request['ayah_hp'],
            'ayah_email' => $request['ayah_email'],
            'ibu_nama' => $request['ibu_nama'],
            'ibu_pendidikan' => $request['ibu_pendidikan'],
            'ibu_pekerjaan' => $request['ibu_pekerjaan'],
            'ibu_penghasilan' => $request['ibu_penghasilan'],
            'ibu_hp' => $request['ibu_hp'],
            'ibu_email' => $request['ibu_email'],
            'asal_nf' => $request['asal_nf'],
            'pindahan' => 0,
            'asal_sekolah' => $request['asal_sekolah'],
            'asal_alamat_sekolah' => $request['asal_alamat_sekolah'],
            'asal_propinsi_sekolah' => $request['asal_propinsi_sekolah'],
            'asal_kota_sekolah' => $request['asal_kota_sekolah'],
            'asal_kecamatan_sekolah' => $request['asal_kecamatan_sekolah'],
            'asal_kelurahan_sekolah' => $request['asal_kelurahan_sekolah'],
        ]);

        $biaya = BiayaTes::where('gel_id', $request['gel_id'])
                    ->where('ck_id', $request['ck_id'])
                    ->get()->first();

        CalonBiayaTes::create([
            'calon_id' => $calon->id,
            'biaya_id' => $biaya->id,
            'expired' => date("Y-m-d", strtotime("+1 week"))
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
        $calon = Calon::with('gelnya.unitnya.catnya')
            ->where('id', $id)
            ->where('user_id', auth('api')->user()->id)
            ->first();

        if($calon) {
            return $calon;
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
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
        $calon = Calon::findOrFail($id);
        $calon->update($request->all());
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

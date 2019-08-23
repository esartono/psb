<?php

namespace App\Http\Controllers\API;

use App\Calon;
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
        $this->authorize('viewAny');
        return Calon::orderBy('id', 'asc')->get()->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCalonRequest $request)
    {
        if ($request['kelas_tujuan'] === '1' || $request['kelas_tujuan'] === '7' || $request['kelas_tujuan'] === '10') {
            $pindahan = 0;
        } else {
            $pindahan = 1;
        }

        Calon::create([
            'gel_id' => $request['gel_id'],
            'ck_id' => $request['ck_id'],
            'tgl_daftar' => date('Y-m-d'),
            'nisn' => $request['nisn'],
            'nik' => $request['nik'],
            'name' => $request['name'],
            'panggilan' => $request['panggilan'],
            'jk' => $request['jk'],
            'kelas_tujuan' => $request['kelas_tujuan'],
            'photo' => 'Belum Ada',
            'tempat_lahir' => $request['tempat_lahir'],
            'tgl_lahir' => date('tgl_lahir'),
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
            'pindahan' => $pindahan,
            'asal_sekolah' => $request['asal_sekolah'],
            'asal_alamat_sekolah' => $request['asal_alamat_sekolah'],
            'asal_propinsi_sekolah' => $request['asal_propinsi_sekolah'],
            'asal_kota_sekolah' => $request['asal_kota_sekolah'],
            'asal_kecamatan_sekolah' => $request['asal_kecamatan_sekolah'],
            'asal_kelurahan_sekolah' => $request['asal_kelurahan_sekolah'],
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
        $this->authorize('view', $id);
        return Calon::orderBy('id', 'asc')->get()->toArray();
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
        //
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

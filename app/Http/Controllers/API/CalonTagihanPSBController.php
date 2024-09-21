<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Gelombang;
use App\CalonTagihanPSB;
use App\Calon;
use App\CalonHasil;

class CalonTagihanPSBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth('api')->user()->isHaveAccess([1, 4])) {
            $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('id');
        }

        if (auth('api')->user()->isAdminUnit()) {
            $unit = auth('api')->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth('api')->user()->tpid)->get()->pluck('id');
        }

        if (auth('api')->user()->isHaveAccess([1, 4]) || auth('api')->user()->isAdminUnit()) {
            $calons = Calon::whereIn('gel_id', $gelombang)->pluck('id');
            return CalonTagihanPSB::with('calonnya')->whereIn('calon_id', $calons)->get()->toArray();
            // return DB::table('calons')
            //     ->select(
            //         'calons.id',
            //         'calons.name',
            //         'jk',
            //         'gelombangs.kode_va',
            //         'users.name as ygwawancara',
            //         'calon_tagihan_p_s_b_s.infaq',
            //         'calon_tagihan_p_s_b_s.infaqnfpeduli',
            //         'calon_tagihan_p_s_b_s.potongan',
            //         'calon_tagihan_p_s_b_s.va1',
            //         'calon_tagihan_p_s_b_s.saudara',
            //         'urut',
            //         DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
            //     )
            //     ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
            //     ->leftJoin('calon_tagihan_p_s_b_s', 'calons.id', '=', 'calon_tagihan_p_s_b_s.calon_id')
            //     ->leftJoin('users', 'calon_tagihan_p_s_b_s.pewawancara', '=', 'users.id')
            //     ->whereIn('gel_id', $gelombang)
            //     ->where('calons.status', 1)
            //     ->where('calons.aktif', true)
            //     ->orderBy('ygwawancara', 'asc')
            //     ->orderBy('calons.name', 'asc')
            //     ->get()
            //     ->toArray();
        }
    }

    public function impruf()
    {
        if (auth('api')->user()->isHaveAccess([1, 4])) {
            $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('id');
        }

        if (auth('api')->user()->isAdminUnit()) {
            $unit = auth('api')->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth('api')->user()->tpid)->get()->pluck('id');
        }

        if (auth('api')->user()->isHaveAccess([1, 4]) || auth('api')->user()->isAdminUnit()) {
            $calons = Calon::whereIn('gel_id', $gelombang)->pluck('id');
            return CalonTagihanPSB::with('calonnya')->whereIn('calon_id', $calons)->get();
            // $calonnya = DB::table('calon_tagihan_p_s_b_s')
            //     ->select(
            //         'calons.id',
            //         'calons.name',
            //         'calons.jk',
            //         'gelombangs.kode_va',
            //         'calon_tagihan_p_s_b_s.lain',
            //         'calons.urut',
            //         DB::raw('CONCAT(gelombangs.kode_va, LPAD(calons.urut, 3, 0)) as uruts'),
            //     )
            //     ->leftJoin('calons', 'calon_tagihan_p_s_b_s.calon_id', '=', 'calons.id')
            //     ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
            //     ->whereIn('calons.id', $calons)
            //     ->where('calons.status', 1)
            //     ->where('calons.aktif', true)
            //     ->orderBy('calons.name', 'asc')
            //     ->get();
        }
    }

    public function store(Request $request)
    {
        $pots = [
            [
                'potongan' => 0,
                'keterangan' => 'Tidak ada potongan',
                'notif' => 0
            ],
            [
                'potongan' => 10,
                'keterangan' => 'Asal dari NF (Depok/Bogor)',
                'notif' => 0
            ],
            [
                'potongan' => 5,
                'keterangan' => 'Memiliki Saudara kandung PERTAMA di NF',
                'notif' => 1
            ],
            [
                'potongan' => 10,
                'keterangan' => 'Memiliki Saudara kandung KEDUA di NF',
                'notif' => 1
            ],
            [
                'potongan' => 10,
                'keterangan' => 'Diskon Mendaftarkan lebih dari 1',
                'notif' => 1
            ],
            [
                'potongan' => 25,
                'keterangan' => 'Diskon Undangan Khusus asal NF (Depok/Bogor)',
                'notif' => 0
            ],
            [
                'potongan' => 50,
                'keterangan' => 'Diskon anak PEGAWAI TETAP',
                'notif' => 1
            ],
            [
                'potongan' => 50,
                'keterangan' => 'Diskon anak PEGAWAI KONTRAK',
                'notif' => 1
            ],
            [
                'potongan' => 50,
                'keterangan' => 'Diskon Pemenang Lomba tingkat Nasional (Bertingkat)',
                'notif' => 0
            ],
            [
                'potongan' => 25,
                'keterangan' => 'Diskon Hafal minimal 15 Juz',
                'notif' => 0
            ]
        ];
        $potongan = 0;
        $keterangan = $pots[0]['keterangan'];
        if ($request->potongan) {
            $potongan = $pots[$request->potongan]['potongan'];
            $keterangan = $pots[$request->potongan]['keterangan'];
        }
        $saudara = implode(', ', $request['saudara']);
        CalonTagihanPSB::updateOrCreate(
            [
                'calon_id' => $request['calon_id'],
                'pewawancara' => auth('api')->user()->id
            ],
            [
                'va1' => '860001',
                'va2' => '',
                'infaq' => $request['infaq'],
                'infaqnfpeduli' => $request['infaqnfpeduli'],
                'potongan' => $potongan,
                'keterangan' => $keterangan,
                'saudara' => $saudara,
                'daul' => 0,
                'lunas' => false,
                'lain' => $request['lain']
            ]
        );

        $calon = Calon::whereId($request['calon_id'])->first();
        CalonHasil::updateOrCreate(
            [
                'pendaftaran' => $calon->uruts
            ],
            [
                'lulus' => 0,
                'catatan' => '',
                'va' => ''
            ]
        );
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

    public function registrasi()
    {
        $regis = array();
        $cta = CalonTagihanPSB::get()->pluck('calon_id');
        $calon = Calon::whereIn('id', $cta)->orderBy('name')->get()->pluck('registrasi');

        return $calon;
    }
}

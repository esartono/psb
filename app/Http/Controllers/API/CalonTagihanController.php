<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use App\Gelombang;
use App\AmbilSeragam;
use App\AmbilBuku;
use App\Chromebook;
use App\CalonTagihan;
use App\CalonTagihanPSB;
use App\CalonHasil;
use App\CalonDaul;
use App\Calon;

class CalonTagihanController extends Controller
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
        if (auth('api')->user()->isAdmin()) {
            $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('kode_va');
        }

        if (auth('api')->user()->isAdminUnit()) {
            $unit = auth('api')->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth('api')->user()->tpid)->get()->pluck('kode_va');
        }

        if (auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
            return CalonTagihan::Where(function ($query) use ($gelombang) {
                for ($i = 0; $i < count($gelombang); $i++) {
                    $query->orwhere('pendaftaran', 'like',  $gelombang[$i] . '%');
                }
            })->orderBy('pendaftaran', 'asc')->get()->toArray();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (auth('api')->user()->isAdmin()) {
            $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('id');
        }

        if (auth('api')->user()->isAdminUnit()) {
            $unit = auth('api')->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth('api')->user()->tpid)->get()->pluck('id');
        }

        $getCalon = Calon::whereIn('gel_id', $gelombang)->get()->pluck('id');
        $lunas = CalonTagihanPSB::whereIn('calon_id', $getCalon)->where('daul', 1)->get()->pluck('calon_id');

        if (auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
            // return Calon::with('gelnya.unitnya.catnya', 'cknya')->whereIn('id', $lunas)->get()->toArray();
            return DB::table('calons')
                ->select(
                    'calons.id',
                    'calons.name',
                    'calons.tempat_lahir',
                    'calons.tgl_lahir',
                    'calons.jk',
                    'calons.pindahan',
                    'units.name as unit',
                    'kelasnyas.name as kelas',
                    'calon_kategoris.name as ck',
                    'gelombangs.kode_va',
                    'urut',
                    DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts'),
                    'calon_tagihan_p_s_b_s.lunas as lunas'
                )
                ->leftJoin('calon_kategoris', 'calons.ck_id', '=', 'calon_kategoris.id')
                ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                ->leftJoin('calon_tagihan_p_s_b_s', 'calons.id', '=', 'calon_tagihan_p_s_b_s.calon_id')
                ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
                ->whereIn('calons.id', $lunas)
                ->orderBy('calon_tagihan_p_s_b_s.updated_at', 'desc')
                ->get()
                ->toArray();
        }
    }

    public function cekambil($id)
    {
        $data = array();
        if (auth('api')->user()->isAdmin() || auth('api')->user()->isPengadaan()) {
            //Cek Seragam
            $data['pendaftaran'] = $id;
            $seragam = AmbilSeragam::where('pendaftaran', $id)->first();
            $data['seragam'] = isset($seragam->sudah) ? $seragam->sudah : 0;
            $data['ket_seragam'] = isset($seragam->keterangan) ? $seragam->keterangan : '';

            //Cek Chromebook
            $cb = Chromebook::where('pendaftaran', $id)->first();
            $data['chromebook'] = isset($cb->status) ? $cb->status : 0;
            $data['ket_chromebook'] = isset($cb->keterangan) ? $cb->keterangan : '';
            $data['sn_chromebook'] = isset($cb->serial_number) ? $cb->serial_number : '';

            //Cek Buku
            $buku = AmbilBuku::where('pendaftaran', $id)->first();
            $data['buku'] = isset($buku->sudah) ? $buku->sudah : 0;
            $data['ket_buku'] = isset($buku->keterangan) ? $buku->keterangan : '';
        }
        return response()->json(['data' => $data], 200);
    }

    public function inputambil(Request $request)
    {
        if (auth('api')->user()->isAdmin() || auth('api')->user()->isPengadaan()) {
            //Cek Seragam
            // $seragam = AmbilSeragam::where('pendaftaran', $request->pendaftaran)->first();
            AmbilSeragam::updateOrCreate([
                'pendaftaran' => $request->pendaftaran,
            ], [
                'sudah' => $request->seragam,
                'keterangan' => $request->ket_seragam,
            ]);

            //Cek Chromebook
            Chromebook::updateOrCreate([
                'pendaftaran' => $request->pendaftaran,
            ], [
                'status' => $request->chromebook,
                'serial_number' => $request->sn_chromebook,
                'keterangan' => $request->ket_chromebook,
            ]);

            // //Cek Buku
            AmbilBuku::updateOrCreate([
                'pendaftaran' => $request->pendaftaran,
            ], [
                'sudah' => $request->buku,
                'keterangan' => $request->ket_buku,
            ]);
        }
    }

    public function ambil()
    {

        if (auth('api')->user()->isAdmin() || auth('api')->user()->isPengadaan()) {
            $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('id');
            $getCalon = Calon::whereIn('gel_id', $gelombang)->get()->pluck('id');
            $lunas = CalonTagihanPSB::whereIn('calon_id', $getCalon)->where('daul', 1)->get()->pluck('calon_id');

            $datas = DB::table('calons')
                ->select(
                    'calons.id',
                    'calons.name',
                    'calons.tempat_lahir',
                    'calons.tgl_lahir',
                    'calons.jk',
                    'calons.pindahan',
                    'units.name as unit',
                    'kelasnyas.name as kelas',
                    'calon_kategoris.name as ck',
                    'gelombangs.kode_va',
                    'urut',
                    DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts'),
                    'calon_tagihan_p_s_b_s.lunas as lunas'
                )
                ->leftJoin('calon_kategoris', 'calons.ck_id', '=', 'calon_kategoris.id')
                ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                ->leftJoin('calon_tagihan_p_s_b_s', 'calons.id', '=', 'calon_tagihan_p_s_b_s.calon_id')
                ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
                ->whereIn('calons.id', $lunas)
                ->orderBy('calons.gel_id', 'asc')
                ->orderBy('calons.urut', 'asc')
                ->get();
            // ->toArray();

            $data = array();
            foreach ($datas as $k => $d) {
                $data[$k]['name'] = $d->name;
                $data[$k]['unit'] = $d->unit;
                $data[$k]['jk'] = $d->jk;
                $data[$k]['uruts'] = $d->uruts;
                $data[$k]['ck'] = $d->ck;

                //Cek Seragam
                $seragam = AmbilSeragam::where('pendaftaran', $d->uruts)->first();
                $data[$k]['seragam'] = isset($seragam->sudah) ? $seragam->sudah : 0;
                $data[$k]['ket_seragam'] = isset($seragam->keterangan) ? $seragam->keterangan : '';

                //Cek Chromebook
                $cb = Chromebook::where('pendaftaran', $d->uruts)->first();
                $data[$k]['chromebook'] = isset($cb->status) ? $cb->status : 0;
                $data[$k]['ket_chromebook'] = isset($cb->keterangan) ? $cb->keterangan : '';
                $data[$k]['sn_chromebook'] = isset($cb->serial_number) ? $cb->serial_number : '';

                //Cek Buku
                $buku = AmbilBuku::where('pendaftaran', $d->uruts)->first();
                $data[$k]['buku'] = isset($buku->sudah) ? $buku->sudah : 0;
                $data[$k]['ket_buku'] = isset($buku->keterangan) ? $buku->keterangan : '';
            }
            return $data;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $lunas = CalonTagihan::findOrFail($id);
        $lunas->update([
            'lunas' => 1
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

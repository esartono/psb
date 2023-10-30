<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use App\Gelombang;
use App\AmbilSeragam;
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

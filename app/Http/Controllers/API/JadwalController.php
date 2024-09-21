<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Jadwal;
use App\Gelombang;


class JadwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'jadwalnya');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jadwalnya()
    {
        return Jadwal::with('gelnya.unitnya.catnya', 'gelnya.tpnya')
            ->whereHas('gelnya', function ($query) {
                $query->where('tp', auth('api')->user()->tpid);
            })->orderBy('seleksi', 'asc')->get()->toArray();
    }

    public function index()
    {
        $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('id');

        return DB::table('jadwals')
            ->select(
                'jadwals.*',
                'gelombangs.name as gel_name',
                'tahun_pelajarans.name as tp_name',
                'units.name as unit_name',
                'school_categories.name as cat_name',
            )
            ->leftJoin('gelombangs', 'jadwals.gel_id', '=', 'gelombangs.id')
            ->leftJoin('tahun_pelajarans', 'gelombangs.tp', '=', 'tahun_pelajarans.id')
            ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
            ->leftJoin('school_categories', 'units.cat_id', '=', 'school_categories.id')
            ->whereIn('jadwals.gel_id', $gelombang)
            ->orderBy('jadwals.seleksi', 'asc')
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
        Jadwal::create([
            'gel_id' => $request['gel_id'],
            'seleksi' => $request['seleksi'],
            'seleksi_online' => $request['seleksi_online'],
            'pengumuman' => $request['pengumuman'],
            'kuota' => $request['kuota'],
            'keterangan' => $request['keterangan'],
            'akademik_link' => $request['akademik_link']
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
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
    }
}

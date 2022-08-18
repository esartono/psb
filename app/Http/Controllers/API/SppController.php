<?php

namespace App\Http\Controllers\API;

use App\Spp;
use App\TahunPelajaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SppController extends Controller
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
        // Cek tahun Ajaran Aktif
        $tps = array();
        $tp = TahunPelajaran::where('status', 1)->first();
        $tps[1] = $tp->id;

        $tp = TahunPelajaran::where('name', 'LIKE', '%/'.substr($tp->name, 0, 4))->first();
        $tps[0] = $tp->id;

        return Spp::with('tpnya', 'unitnya')->whereIn('tp', $tps)->orderBy('unit_id', 'asc')->get()->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Spp::create([
            'tp' => $request['tp'],
            'unit_id' => $request['unit_id'],
            'spp' => $request['spp']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function show(Spp $spp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $spp = Spp::findOrFail($id);
        $spp->update($request->all());
    }

    public function destroy($id)
    {
        $spp = Spp::findOrFail($id);
        $spp->delete();
    }
}

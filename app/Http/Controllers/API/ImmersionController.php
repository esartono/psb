<?php

namespace App\Http\Controllers\API;

use App\Immersion;
use App\TahunPelajaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImmersionController extends Controller
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
        $tp = TahunPelajaran::where('status', 1)->first();
        return Immersion::with('tpnya', 'unitnya')->where('tp', $tp)->orderBy('unit_id', 'asc')->get()->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Immersion::create([
            'tp' => $request['tp'],
            'unit_id' => $request['unit_id'],
            'langsung' => $request['langsung'],
            'tahunan' => $request['tahunan'],
            'bulanan' => $request['bulanan']
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
        $immersion = Immersion::findOrFail($id);
        $immersion->update($request->all());
    }

    public function destroy($id)
    {
        $immersion = Immersion::findOrFail($id);
        $immersion->delete();
    }
}

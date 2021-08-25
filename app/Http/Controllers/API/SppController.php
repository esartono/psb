<?php

namespace App\Http\Controllers\API;

use App\Spp;
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
        return Spp::with('tpnya', 'unitnya')->orderBy('id', 'asc')->get()->toArray();
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

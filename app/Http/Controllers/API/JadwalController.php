<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jadwal;

class JadwalController extends Controller
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
        return Jadwal::with('gelnya.unitnya.catnya', 'gelnya.tpnya')
            ->whereHas('gelnya', function ($query) {
                $query->where('tp', auth('api')->user()->tpid);
            })->orderBy('seleksi', 'asc')->get()->toArray();
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

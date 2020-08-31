<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SiswaNF;

class SiswaNFController extends Controller
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
        return SiswaNF::with('tpnya', 'kelasnya')->orderBy('name', 'asc')->get()->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SiswaNF::create([
            'nis' => $request['nis'],
            'jk' => $request['jk'],
            'tp' => $request['tp'],
            'unit' => $request['unit'],
            'name' => $request['name'],
            'kelas' => $request['kelas']

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
        $siswa = SiswaNF::with('tpnya', 'kelasnya')->where('nis', $id)->get();
        $cek = $siswa->count();
        return compact('siswa', 'cek');
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
        $siswa = SiswaNF::findOrFail($id);
        $siswa->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = SiswaNF::findOrFail($id);
        $siswa->delete();
    }
}

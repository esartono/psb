<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Seragam;

class SeragamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Seragam::with('catnya')->orderBy('id', 'asc')->get()->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Seragam::create([
            'cat_id' => $request['cat_id'],
            'jk' => $request['jk'],
            'jenis' => $request['jenis'],
            'ukuran' => $request['ukuran'],
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
        $seragam = Seragam::findOrFail($id);
        $seragam->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seragam = Seragam::findOrFail($id);
        $seragam->delete();

    }

    public function dataSeragam($pr)
    {
        $pr = explode(':',$pr);

        $baju = Seragam::where('cat_id', $pr[1])->where('jk', $pr[0])->where('jenis', 'Baju Atasan')->get();
        $celana = Seragam::where('cat_id', $pr[1])->where('jk', $pr[0])->where('jenis', 'Celana/Rok')->get();

        return compact('baju', 'celana');
    }
}

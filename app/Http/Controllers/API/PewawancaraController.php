<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Pewawancara;

class PewawancaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pewawancara::with('unitnya')->orderBy('id', 'desc')->get()->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nipNama = explode(" - ", $request['nip']);
        Pewawancara::updateOrCreate([
            'tp' => taId(),
            'nip' => $nipNama[0],
            'unit_id' => $request['unit_id'],
        ], [
            'nama' => $nipNama[1]
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
        $data = Pewawancara::findOrFail($id);
        $nipNama = explode(" - ", $request['nip']);
        Pewawancara::update([
            'unit_id' => $request['unit_id'],
            'nip' => $nipNama[0],
            'nama' => $nipNama[1]
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
        $data = Pewawancara::findOrFail($id);
        $data->delete();
    }
}

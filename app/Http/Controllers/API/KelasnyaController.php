<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Excel;

//use App\Exports\KelasExport;

use App\Kelasnya;

class KelasnyaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    public function index()
    {
        return Kelasnya::with('unitnya')->orderBy('id', 'asc')->get()->toArray();
    }

    public function store(Request $request)
    {
        Kelasnya::create([
            'name' => $request['name'],
            'unit_id' => $request['unit_id'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelasnya::findOrFail($id);
        $kelas->update($request->all());
    }

    public function destroy($id)
    {
        $kelas = Kelasnya::findOrFail($id);
        $kelas->delete();
    }

    public function dataKelas($unit)
    {
        return Kelasnya::where('unit_id',$unit)->orderBy('id', 'asc')->get()->toArray();
    }

}

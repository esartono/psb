<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Excel;

//use App\Exports\KelasExport;

use App\Kelasnya;
use App\Gelombang;

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
        $status = $request['status'];
        $ta = $request['tahun_ajaran'];

        if($status == 0 || $ta == 3){
            $status = false;
            $ta = 3;
        }

        Kelasnya::create([
            'name' => $request['name'],
            'unit_id' => $request['unit_id'],
            'status' => $status,
            'kelamin' => $request['kelamin'],
            'jurusan' => $request['jurusan'],
            'tahun_ajaran' => $ta,
        ]);
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelasnya::findOrFail($id);

        $status = $request['status'];
        $ta = $request['tahun_ajaran'];

        if($status == 0 || $ta == 3){
            $status = false;
            $ta = 3;
        }

        $kelas->update([
            'name' => $request['name'],
            'unit_id' => $request['unit_id'],
            'status' => $status,
            'kelamin' => $request['kelamin'],
            'jurusan' => $request['jurusan'],
            'tahun_ajaran' => $ta
        ]);
    }

    public function destroy($id)
    {
        $kelas = Kelasnya::findOrFail($id);
        $kelas->delete();
    }

    public function dataKelas($unit)
    {
        // return Kelasnya::where('unit_id',$unit)->where('status',true)->orderBy('id', 'asc')->get()->toArray();
        return Kelasnya::where('unit_id',$unit)->orderBy('id', 'asc')->get()->toArray();
    }

    public function dataKelGel($gel)
    {
        $unit = Gelombang::whereId($gel)->first()->unit_id;
        return Kelasnya::where('unit_id',$unit)->orderBy('id', 'asc')->get()->toArray();
    }
}

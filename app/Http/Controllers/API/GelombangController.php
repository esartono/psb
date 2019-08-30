<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Excel;

use App\Gelombang;
use App\TahunPelajaran;

class GelombangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    public function index()
    {
        return Gelombang::with('unitnya.catnya', 'tpnya')
                ->where('tp', auth('api')->user()->tpid)
                ->orderBy('unit_id', 'asc')->get()->toArray();
    }

    public function show($id)
    {
        $tgl_sekarang = today()->format('Y-m-d');

        $gelombang = Gelombang::with('unitnya.catnya', 'tpnya')
                ->where('unit_id', $id)
                ->where('end', '>', $tgl_sekarang)
                ->where('tp', auth('api')->user()->tpid)
                ->first();

        if ($gelombang !== null) {
            return $gelombang->toArray();
        }
    }

    public function store(Request $request)
    {
        Gelombang::create([
            'name' => $request['name'],
            'tp' => $request['tp'],
            'unit_id' => $request['unit_id'],
            'minimum_age' => $request['minimum_age'],
            'kuota' => $request['kuota'],
            'kuota_inklusi' => $request['kuota_inklusi'],
            'kode_va' => $request['kode_va'],
            'start' => $request['start'],
            'end' => $request['end'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $gelombang = Gelombang::findOrFail($id);
        $gelombang->update($request->all());
    }

    public function destroy($id)
    {
        $gelombang = Gelombang::findOrFail($id);
        $gelombang->delete();
    }
}

<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Excel;

//use App\Exports\KelasExport;

use App\BiayaTes;
use App\TahunPelajaran;

class BiayaTesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    public function index()
    {
        $tp = TahunPelajaran::where('status',1)->first();

        return BiayaTes::with('gelnya.unitnya', 'gelnya.tpnya','cknya')
                ->whereHas('gelnya', function ($query) use($tp) {
                    $query->where('tp', $tp->id);
                })
                ->orderBy('id', 'asc')
                ->get()
                ->toArray();
    }

    public function store(Request $request)
    {
        $cek = BiayaTes::where('gel_id', $request['gel_id'])->where('ck_id', $request['ck_id'])->get()->count();

        if($cek === 0){
            BiayaTes::create([
                'gel_id' => $request['gel_id'],
                'ck_id' => $request['ck_id'],
                'biaya' => $request['biaya'],
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $biaya = BiayaTes::findOrFail($id);
        $biaya->update($request->all());
    }

    public function destroy($id)
    {
        $biaya = BiayaTes::findOrFail($id);
        $biaya->delete();
    }
}

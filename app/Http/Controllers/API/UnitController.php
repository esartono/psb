<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Excel;

use App\Exports\UnitExport;

use App\Unit;
use App\Calon;
use App\Gelombang;
use App\TesWawancara;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('dataUnit', 'index');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::with('catnya')->orderBy('id', 'asc')->get()->toArray();
        return $units;
    }

    public function unitnya()
    {
        return Unit::orderBy('name', 'asc')->paginate(100);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Unit::create([
            'name' => $request['name'],
            'cat_id' => $request['cat_id'],
            'logo' => 'belum ada',
            'address' => $request['address'],
            'email' => $request['email'],
            'phone' => $request['phone'],
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

        $unit = Unit::findOrFail($id);
        $unit->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $unit = Unit::findOrFail($id);
        $unit->delete();
    }

    public function export()
    {
        return Excel::download(new UnitExport, 'units.xlsx');
    }

    public function unitWawancara()
    {
        $units = Unit::orderBy('id', 'asc')->get();
        $no = 0;
        foreach ($units as $u) {
            // $tesWawancara = TesWawancara::where('unit_id', $u->id)->count();
            $gelombang = Gelombang::where('unit_id', $u->id)->where('tp', auth()->user()->tpid)->get()->pluck('id');
            $getCalon = Calon::whereIn('gel_id', $gelombang)->get()->pluck('id');
            $totalData = TesWawancara::whereIn('calon_id', $getCalon)->get()->pluck('calon_id')->count();

            $split = 150;
            if ($totalData > 0) {
                if ($totalData <= $split) {
                    $data[$no] = [
                        'id'   => $u->id . '::0::' . $totalData,
                        'name' => $u->name . ' - 0 s/d ' . $totalData,
                    ];
                    $no++;
                } else {
                    $totalKelompok = ceil($totalData / $split);
                    for ($i = 1; $i <= $totalKelompok; $i++) {
                        if ($i == 1) {
                            $awal  = 0;
                            $akhir = $split;
                        } else {
                            $awal  = (($i - 1) * $split) + 1;
                            $akhir = ($i == $totalKelompok) ? $totalData : ($i * $split);
                        }
                        $data[$no] = [
                            'id'   => $u->id . '::' . $awal . '::' . $akhir,
                            'name' => $u->name . ' - ' . $awal . ' s/d ' . $akhir,
                        ];
                        $no++;
                    }
                }
            }
        }
        return $data;
    }
}

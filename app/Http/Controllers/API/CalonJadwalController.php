<?php

namespace App\Http\Controllers\API;

use App\CalonJadwal;
use App\Gelombang;
use App\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

use Excel;
use App\Exports\CpdTesExport;
use App\Exports\CpdPsikoTesExport;

class CalonJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api')->except('exportTes', 'exportPsikoTes');
    }

    public function index()
    {
        if(auth('api')->user()->isAdmin()) {
            $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('id');
            $jadwal = Jadwal::whereIn('gel_id',$gelombang)->get()->pluck('id');
        }

        if(auth('api')->user()->isAdminUnit()) {
            $unit = auth('api')->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth('api')->user()->tpid)->get()->pluck('id');
            $jadwal = Jadwal::whereIn('gel_id',$gelombang)->get()->pluck('id');
        }
        $calons = CalonJadwal::with('jadwalnya')->whereIn('jadwal_id', $jadwal)->orderBy('jadwal_id', 'asc')->get();
        return compact('calons');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth('api')->user()->isAdmin()) {
            return CalonJadwal::with('calonnya', 'jadwalnya.gelnya.unitnya.catnya')->where('jadwal_id',$id)->get()->toArray();
        }
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
        $calon = CalonJadwal::findOrFail($id);
        $calon->update([
            'jadwal_id' => $request->jadwal_id
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
        //
    }

    public function exportTes($id)
    {
        return Excel::download(new CpdTesExport($id), 'cpdTes.xlsx');
    }

    public function exportPsikoTes($id)
    {
        return Excel::download(new CpdPsikoTesExport($id), 'cpdPsikotes.xlsx');
    }

}

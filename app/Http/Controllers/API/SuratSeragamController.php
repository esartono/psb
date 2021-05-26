<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Gelombang;
use App\AmbilSeragam;

class SuratSeragamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth('api')->user()->isAdmin()) {
            $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('kode_va');
        }

        if(auth('api')->user()->isAdminUnit()) {
            $unit = auth('api')->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth('api')->user()->tpid)->get()->pluck('kode_va');
        }

        if(auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
            return AmbilSeragam::Where(function ($query) use($gelombang) {
                for ($i = 0; $i < count($gelombang); $i++){
                    $query->orwhere('pendaftaran', 'like',  $gelombang[$i] .'%');
                }
            })->orderBy('pendaftaran', 'asc')->get()->toArray();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seragam = AmbilSeragam::where('pendaftaran', $request->pendaftaran)->first();

        if (!$seragam) {
            AmbilSeragam::create([
                'pendaftaran' => $request->pendaftaran,
                'lunas_daul' => $request->lunas_daul,
                'siap' => $request->siap,
                'hari' => $request->hari,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
            ]);
        } else {
            return 'ERROR';
        }
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
        $seragam = AmbilSeragam::where('id', $id)->first();
        $seragam->update([
            'lunas_daul' => $request->lunas_daul,
            'siap' => $request->siap,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
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
}

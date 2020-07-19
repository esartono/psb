<?php

namespace App\Http\Controllers\API;

use App\Calon;
use App\CalonHasil;
use App\CalonTagihan;
use App\Gelombang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalonHasilController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('kode_va');
        }

        if(auth('api')->user()->isAdminUnit()) {
            $unit = auth('api')->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth('api')->user()->tpid)->get()->pluck('kode_va');
        }

        if(auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
            return CalonHasil::where('lulus', $id)
                ->Where(function ($query) use($gelombang) {
                for ($i = 0; $i < count($gelombang); $i++){
                    $query->orwhere('pendaftaran', 'like',  $gelombang[$i] .'%');
                }
            })->get()->toArray();
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
        $ids = explode(":", $id);
        $hasils = CalonHasil::where('id', $ids[0])->first();
        $hasils->update([
                'lulus' => $ids[1],
                'catatan' => $ids[2]
            ]
        );
    }

    public function mundur(Request $request)
    {
        $hasils = CalonHasil::where('pendaftaran', $request->idpeserta)->first();
        $hasils->update([
                'lulus' => 4,
                'catatan' => $request->alasan
            ]
        );
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

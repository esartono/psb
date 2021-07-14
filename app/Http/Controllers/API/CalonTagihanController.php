<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Gelombang;
use App\AmbilSeragam;
use App\CalonTagihan;
use App\CalonHasil;
use App\CalonDaul;

class CalonTagihanController extends Controller
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
            return CalonTagihan::Where(function ($query) use($gelombang) {
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
        $undur = CalonHasil::where('lulus', 4)->get()->pluck('pendaftaran');
        if(auth('api')->user()->isAdmin()) {
            $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('kode_va');
        }

        if(auth('api')->user()->isAdminUnit()) {
            $unit = auth('api')->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth('api')->user()->tpid)->get()->pluck('kode_va');
        }

        // if(auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
            // return CalonTagihan::whereNotIn('pendaftaran', $undur)->where('lunas', 1)
                // ->Where(function ($query) use($gelombang) {
                // for ($i = 0; $i < count($gelombang); $i++){
                    // $query->orwhere('pendaftaran', 'like',  $gelombang[$i] .'%');
                // }
            // })->get()->toArray();
        // }
        // if(auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
        //     return AmbilSeragam::whereNotIn('pendaftaran', $undur)->where('lunas_daul', 'Lunas')
        //         ->Where(function ($query) use($gelombang) {
        //         for ($i = 0; $i < count($gelombang); $i++){
        //             $query->orwhere('pendaftaran', 'like',  $gelombang[$i] .'%');
        //         }
        //     })->get()->toArray();
        // }
        if(auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
            return CalonDaul::whereNotIn('pendaftaran', $undur)
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
    public function update($id)
    {
        $lunas = CalonTagihan::findOrFail($id);
        $lunas->update([
            'lunas' => 1
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

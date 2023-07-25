<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Gelombang;
use App\AmbilSeragam;
use App\CalonTagihan;
use App\CalonTagihanPSB;
use App\CalonHasil;
use App\CalonDaul;
use App\Calon;

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
        if (auth('api')->user()->isAdmin()) {
            $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('kode_va');
        }

        if (auth('api')->user()->isAdminUnit()) {
            $unit = auth('api')->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth('api')->user()->tpid)->get()->pluck('kode_va');
        }

        if (auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
            return CalonTagihan::Where(function ($query) use ($gelombang) {
                for ($i = 0; $i < count($gelombang); $i++) {
                    $query->orwhere('pendaftaran', 'like',  $gelombang[$i] . '%');
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
        if (auth('api')->user()->isAdmin()) {
            $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('kode_va');
        }

        if (auth('api')->user()->isAdminUnit()) {
            $unit = auth('api')->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth('api')->user()->tpid)->get()->pluck('kode_va');
        }

        // $lulus = CalonHasil::where('lulus', 1)
        //     ->Where(function ($query) use ($gelombang) {
        //         for ($i = 0; $i < count($gelombang); $i++) {
        //             $query->orwhere('pendaftaran', 'like',  $gelombang[$i] . '%');
        //         }
        //     })->get();
        // return $lulus;
        $lunas = CalonTagihanPSB::where('lunas', 1)->get()->pluck('calon_id');

        // if (auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
        //     $lunas = CalonTagihanPSB::whereIn('calon_id', $lulus)->where('lunas', 1)
        //         ->Where(function ($query) use ($gelombang) {
        //             for ($i = 0; $i < count($gelombang); $i++) {
        //                 $query->orwhere('pendaftaran', 'like',  $gelombang[$i] . '%');
        //             }
        //         })->get()->toArray();
        // }
        // if(auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
        //     $lunas = CalonTagihan::whereNotIn('pendaftaran', $undur)->where('lunas', 1)
        //         ->Where(function ($query) use($gelombang) {
        //         for ($i = 0; $i < count($gelombang); $i++){
        //             $query->orwhere('pendaftaran', 'like',  $gelombang[$i] .'%');
        //         }
        //     })->get()->toArray();
        // }
        // if(auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
        //     return AmbilSeragam::whereNotIn('pendaftaran', $undur)->where('lunas_daul', 'Lunas')
        //         ->Where(function ($query) use($gelombang) {
        //         for ($i = 0; $i < count($gelombang); $i++){
        //             $query->orwhere('pendaftaran', 'like',  $gelombang[$i] .'%');
        //         }
        //     })->get()->toArray();
        // }
        if (auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
            return Calon::with('gelnya.unitnya.catnya', 'cknya')->whereIn('id', $lunas)->get()->toArray();
            // return CalonTagihanPSB::whereNotIn('pendaftaran', $undur)->where('lunas', 1)
            //     ->Where(function ($query) use($gelombang) {
            //     for ($i = 0; $i < count($gelombang); $i++){
            //         $query->orwhere('pendaftaran', 'like',  $gelombang[$i] .'%');
            //     }
            // })->get()->toArray();
            // return CalonDaul::whereNotIn('pendaftaran', $undur)
            //     ->Where(function ($query) use($gelombang) {
            //     for ($i = 0; $i < count($gelombang); $i++){
            //         $query->orwhere('pendaftaran', 'like',  $gelombang[$i] .'%');
            //     }
            // })->get()->toArray();
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

<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Gelombang;
use App\CalonTagihanPSB;
use App\Calon;
use App\CalonHasil;

class CalonTagihanPSBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth('api')->user()->isHaveAccess([1,4])) {
            $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('id');
        }

        if(auth('api')->user()->isAdminUnit()) {
            $unit = auth('api')->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth('api')->user()->tpid)->get()->pluck('id');
        }

        if(auth('api')->user()->isHaveAccess([1,4]) || auth('api')->user()->isAdminUnit()) {
            return CalonTagihanPSB::with('calonnya')->get()->toArray();
        }
    }

    public function store(Request $request)
    {
        CalonTagihanPSB::updateOrCreate(
            [
                'calon_id' => $request['calon_id'],
                'pewawancara' => auth('api')->user()->id
            ],[
                'va1' => '860001',
                'va2' => '',
                'infaq' => $request['infaq'],
                'infaqnfpeduli' => $request['infaqnfpeduli'],
                'potongan' => 0,
                'daul' => 0,
                'lunas' => false,
            ]
        );

        $calon = Calon::whereId($request['calon_id'])->first();
        CalonHasil::updateOrCreate(
            [
                'pendaftaran' => $calon->uruts
            ],[
                'lulus' => 0,
                'catatan' => '',
                'va' => ''
            ]
        );
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
        //
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

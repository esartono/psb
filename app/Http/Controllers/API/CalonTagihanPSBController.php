<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CalonTagihanPSB;

class CalonTagihanPSBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        CalonTagihanPSB::create([
            'calon_id' => $request['calon_id'],
            'tagihanpsb_id' => $request['tagihan_id'],
            'infaq' => $request['infaq'],
            'infaqnfpeduli' => $request['infaqnfpeduli'],
            'potongan' => 0,
            'daul' => 0,
            'lunas' => false,
            'pewawancara' => auth('api')->user()->id
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

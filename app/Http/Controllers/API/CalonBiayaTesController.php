<?php

namespace App\Http\Controllers\API;

use App\CalonBiayaTes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Edupay\Facades\Edupay;

class CalonBiayaTesController extends Controller
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
        $biayates = CalonBiayaTes::with('calonnya', 'biayanya')->where('calon_id', $id)->first();
        $biayates->update([
                //'expired' => date("Y-m-d", strtotime("+3 days"))
                'expired' => date("Y-m-d")
            ]
        );

        $idtagihan = $biayates->calonnya->uruts;
        $total = $biayates->biayanya->biaya;
        $nama = $biayates->calonnya->name;
        //$end = date("Y-m-d", strtotime("+3 days"));
        $end = date("Y-m-d");

        return Edupay::edit($idtagihan, $total, $nama, $end);
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

<?php

namespace App\Http\Controllers\API;

use App\Calon;
use App\CalonBiayaTes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        dd('EKO Sartono');
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
        $start = date("Y-m-d");
        $end = date("Y-m-d", strtotime("+3 days"));

        $biayates = CalonBiayaTes::with('calonnya', 'biayanya')->where('calon_id', $id)->first();
        $biayates->update([
                'expired' => $end,
                // 'expired' => date("Y-m-d")
            ]
        );

        $idtagihan = $biayates->calonnya->uruts;
        $total = $biayates->biayanya->biaya;
        $nama = $biayates->calonnya->name;

        $bayar = Edupay::view($biayates->calonnya->uruts);
        if(isset($bayar['status_bayar'])){
            Edupay::edit($idtagihan, $total, $nama, $end);
        } else {
            Edupay::create($idtagihan, $total, $nama, $start, $end);
        }
        $calonsnya = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya','usernya')->where('id',$id)->first();
        Mail::send('emails.biayates', compact('calonsnya'), function ($m) use ($calonsnya)
            {
                $m->to($calonsnya->usernya->email, $calonsnya->name)->from('psb@nurulfikri.sch.id', 'Panitia PPDB SIT Nurul Fikri')->subject('Biaya Tes SIT Nurul Fikri');
            }
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

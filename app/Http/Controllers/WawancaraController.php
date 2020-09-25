<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Gelombang;
use App\Calon;
use App\TagihanPSB;


class WawancaraController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function wawancaraKeuangan()
    {
        return view('wawancara.keuangan');
    }

    public function wawancaraKeuanganPrint()
    {
        return view('wawancara.invoiceprint');
    }

    public function getCalon($id)
    {
        $calon = Calon::with('gelnya.unitnya.catnya', 'kelasnya')
                ->whereId($id)->first();

        return view('wawancara.invoice', compact('calon'));

        // $id = $request->id;
        // $va = substr($id, 0, 6);
        // $urt = intval(substr($id, 6));
        // if(auth()->user()->isAdmin() || auth()->user()->isAdminKeu()) {
        //     $gelombang = Gelombang::where('kode_va', $va)->get()->pluck('id');
        //     if(count($gelombang) > 0){
        //         $calon = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'usernya')
        //                 ->where('gel_id',$gelombang)
        //                 ->where('urut',$urt)
        //                 ->where('status',1)->first();
        //         $tagihans = TagihanPSB::where('kelas', $calon->kelas_tujuan)->get();
        //         $no = 1;
        //         return view('wawancara.invoice', compact('calon', 'tagihans', 'no'));
        //     }
        //     return redirect()->back()->with('error', 'Maaf, No. Pendaftaran : '. $id .' tidak ditemukan');
        // }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Calon;
use App\Gelombang;
use App\Unit;
use App\SchoolCategory;
use App\CalonSeragam;

class UniformController extends Controller
{
    public function uniform($id){
        // $calon = Calon::where('id',$id)->where('user_id',auth()->user()->id)->first();
        // if($calon) {
        //     $doku = Doku::where('calon_id',$id)->where('user_id',auth()->user()->id)->pluck('file', 'jdoku');
        //     return view('doku.index', compact('calon', 'doku'));
        // }
    }

    public function create($calon, $code)
    {
        // $jd = JDoku::where('code', $code)->first();
        // return view('doku.create', compact('calon', 'jd'));
    }

    public function show($id)
    {
        $calon = Calon::where('id',$id)->where('user_id',auth()->user()->id)->first();
        $unit_id = Gelombang::where('id', $calon->gel_id)->first();
        $unit = Unit::where('id', $unit_id->unit_id)->first();
        $tingkat = SchoolCategory::where('id', $unit->cat_id)->first()->name;
        return view('uniform.create', compact('tingkat', 'calon')); 
    }

    public function update(Request $request, $id)
    {
        // dd($request->atas);
        CalonSeragam::updateOrCreate(
            ['calon_id' => $id],
            [
                'atas' => $request->atas,
                'bawah' => $request->bawah,
                'lain' => "-"
            ]
        );
        // $calon = Calon::where('id', $request->calon)->first();
        return redirect()->route('home');
    }
}

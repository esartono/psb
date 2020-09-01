<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Doku;
use App\Calon;
use App\User;

class DokuController extends Controller
{
    public function calon($id){
        $calon = Calon::where('id',$id)->where('user_id',auth()->user()->id)->first();
        if($calon) {
            $doku = Doku::where('calon_id',$id)->where('user_id',auth()->user()->id)->pluck('file', 'jdoku');
            return view('doku.index', compact('calon', 'doku'));
        }
    }

    public function show($calon)
    {
        return view('doku.create', compact('calon'));
    }
}

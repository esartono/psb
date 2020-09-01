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
            return view('doku.index', compact('calon'));
        }
    }
}

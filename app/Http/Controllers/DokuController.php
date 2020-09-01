<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Doku;
use App\JDoku;
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

    public function upload($calon, $code)
    {
        $jd = JDoku::where('code', $code)->first();
        return view('doku.create', compact('calon', 'jd'));
    }

    public function show($calon)
    {
        return view('doku.create', compact('calon'));
    }

    public function update(Request $request)
    {
        $calon = $request->calon;
        $file = $request->file('file');

        $extension = $file->getClientOriginalExtension();
        $namefile = $file->getClientOriginalName();

        Storage::disk('my_upload')->put('/'.$calon.'/'.$namefile, File::get($file));
        Doku::create([
            'calon_id' => $calon,
            'user_id' => auth()->user()->id,
            'jdoku' => $request->jdoku,
            'file' => $namefile
        ]);

        return redirect()->route('dokumen', compact('calon'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Doku;
use App\JDoku;
use App\Calon;
use App\User;
use App\Jadwal;
use App\CalonJadwal;

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
        $calon = Calon::where('id', $request->calon)->first();
        $file = $request->file('file');

        $extension = $file->getClientOriginalExtension();
        $namefile = $file->getClientOriginalName();

        Storage::disk('my_upload')->put('/'.$calon->uruts.'/'.$namefile, File::get($file));
        Doku::create([
            'calon_id' => $calon->id,
            'user_id' => auth()->user()->id,
            'jdoku' => $request->jdoku,
            'file' => $namefile
        ]);

        return redirect()->route('dokumen', compact('calon'));
    }

    public function pilihJadwal($id)
    {
        $calon = Calon::where('id',$id)->where('user_id',auth()->user()->id)->first()->id;
        if($calon) {
            $cj = CalonJadwal::where('calon_id', $id)->first()->jadwal_id;
            $seleksi = strtotime(Jadwal::where('id', $cj)->first()->seleksi);
            $jadwal = array();
            for ($i = 0; $i < 7; $i++) {
                $seleksi = strtotime('-1 day', $seleksi);
                $cek = strftime('%w', $seleksi);
                if( $cek != 0 && $cek != 6) {
                    $jadwal[date("yy-m-d", $seleksi)] = strftime('%A, %d %B %Y', $seleksi);
                }
            }
            return view('user.pilihjadwal', compact('calon', 'jadwal'));
        }

        return redirect()->route('home');
    }

    public function updatejadwal(Request $request)
    {
        $calon = Calon::where('id',$request->calon)->where('user_id',auth()->user()->id)->first();
        if($calon) {
            CalonJadwal::updateOrCreate(['calon_id' => $request->calon],['jadwal_id' => $request->jadwal_id]);
        }

        return redirect()->route('home');
    }
}

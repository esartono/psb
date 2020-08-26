<?php

namespace App\Exports;

use App\Calon;
use App\Pekerjaan;
use App\Pendidikan;
use App\Penghasilan;
use App\Kelurahan;
use App\Kecamatan;
use App\Kota;
use App\Provinsi;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class Raw implements FromView
{
    public function view() : view
    {
        if(auth()->user()->isAdmin()) {
            $no = 1;
            $calons = Calon::with('gelnya', 'cknya', 'kelasnya')->where('status', 1)->get();
            return view('exports.unit', compact('calons', 'no'));
        }

        if(auth()->user()->isAdminUnit()) {
            $unit = auth()->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth()->user()->tpid)->get()->pluck('id');

            $no = 1;
            $calons = Calon::with('gelnya', 'cknya', 'kelasnya')->where('status', 1)->where('gel_id', $gelombang)->get();
            return view('exports.unit', compact('calons', 'no'));
        }

    }
}

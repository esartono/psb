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
        $no = 1;
        $calons = Calon::with('gelnya', 'cknya', 'kelasnya')->where('status', 1)->get();
        return view('exports.raw', compact('calons', 'no'));
    }
}

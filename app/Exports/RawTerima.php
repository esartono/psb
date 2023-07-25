<?php

namespace App\Exports;

use App\Calon;
use App\CalonTagihanPSB;
use App\Pekerjaan;
use App\Pendidikan;
use App\Penghasilan;
use App\Kelurahan;
use App\Kecamatan;
use App\Kota;
use App\Provinsi;
use App\Gelombang;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class RawTerima implements FromView
{
    public function view(): view
    {
        if (auth()->user()->isAdminUnit()) {
            $unit = auth()->user()->unit_id;
            $gel = Gelombang::where('tp', auth()->user()->tpid)->where('unit_id', $unit)->get()->pluck('id');
        }

        if (auth()->user()->isAdmin()) {
            $gel = Gelombang::where('tp', auth()->user()->tpid)->get()->pluck('id');
        }

        $terima = CalonTagihanPSB::where('daul', 1)->get()->pluck('calon_id');

        $no = 1;
        $calons = Calon::with('gelnya', 'cknya', 'kelasnya')
            ->whereIn('id', $terima)
            ->whereIn('gel_id', $gel)
            ->get();
        return view('exports.unit', compact('calons', 'no'));
    }
}

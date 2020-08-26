<?php

namespace App\Exports;

use App\Calon;
use App\CalonTagihan;
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

class RawTerima implements FromView
{
    public function view() : view
    {
        if(auth()->user()->isAdmin()) {
            $terima = CalonTagihan::where('lunas', 1)->get()->pluck('calonid');
        }

        if(auth()->user()->isAdminUnit()) {
            $unit = auth()->user()->unit_id;
            $gel = Gelombang::where('unit_id', $unit)->get()->pluck('kode_va');
            $terima = CalonTagihan::where('lunas', 1)
                    ->Where(function ($query) use($gel) {
                        for ($i = 0; $i < count($gel); $i++){
                            $query->orwhere('pendaftaran', 'like',  $gel[$i] .'%');
                        }
                    })->get()->pluck('calonid');
        }

        $no = 1;
        $calons = Calon::with('gelnya', 'cknya', 'kelasnya')->whereIn('id', $terima)->get();
        return view('exports.unit', compact('calons', 'no'));
    }
}

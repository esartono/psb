<?php

namespace App\Exports;

use App\Calon;
use App\Gelombang;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CpdAktifExport implements FromView
{
    public function view() : view
    {
        if(auth()->user()->isAdmin()) {
            $gelombang = Gelombang::where('tp', auth()->user()->tpid)->get()->pluck('id');
            $calons = Calon::with('gelnya.unitnya', 'cknya', 'kelasnya')
                    ->whereIn('gel_id', $gelombang)
                    ->where('status',1)
                    ->get();
        }

        if(auth()->user()->isAdminUnit()) {
            $unit = auth()->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth()->user()->tpid)->get()->pluck('id');

            $calons = Calon::with('gelnya.unitnya', 'cknya', 'kelasnya')
                    ->where('gel_id', $gelombang)
                    ->where('status',1)
                    ->get();
        }

        return view('exports.cpd', [
            'calons' => $calons,
            'no' => 1,
        ]);
    }
}

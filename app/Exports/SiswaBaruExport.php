<?php

namespace App\Exports;

use App\Calon;
use App\Gelombang;
use App\CalonHasil;
use App\CalonTagihan;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SiswaBaruExport implements FromView
{
    public function view() : view
    {
        $undur = CalonHasil::where('lulus', 4)->get()->pluck('pendaftaran');

        if(auth()->user()->isAdmin()) {

            $gel = Gelombang::get()->pluck('kode_va');
            $daul = CalonTagihan::whereNotIn('pendaftaran', $undur)->where('lunas', 1)
                    ->Where(function ($query) use($gel) {
                        for ($i = 0; $i < count($gel); $i++){
                            $query->orwhere('pendaftaran', 'like',  $gel[$i] .'%');
                        }
                    })->get()->pluck('calonid');
            $calons = Calon::with('gelnya.unitnya', 'cknya', 'kelasnya')
                    ->whereIn('id', $daul)
                    ->get();
        }

        if(auth()->user()->isAdminUnit()) {
            $unit = auth()->user()->unit_id;

            $gel = Gelombang::where('unit_id', $unit)->where('tp', auth()->user()->tpid)->get()->pluck('kode_va');
            $daul = CalonTagihan::whereNotIn('pendaftaran', $undur)->where('lunas', 1)
                    ->Where(function ($query) use($gel) {
                        for ($i = 0; $i < count($gel); $i++){
                            $query->orwhere('pendaftaran', 'like',  $gel[$i] .'%');
                        }
                    })->get()->pluck('calonid');

            $calons = Calon::with('gelnya.unitnya', 'cknya', 'kelasnya')
                    ->whereIn('id', $daul)
                    ->get();
        }

        return view('exports.siswabaru', [
            'calons' => $calons,
            'no' => 1,
        ]);
    }
}

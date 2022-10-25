<?php

namespace App\Exports;

use App\CalonTagihanPSB;
use App\Gelombang;
use App\Calon;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CpdExportBank implements FromView
{
    public $data;

    public function __construct($data = "")
    {
        $this->data = $data;
    }

    public function view(): view
    {
        $gelombang = Gelombang::where('tp', auth()->user()->tpid)->get()->pluck('id');
        $calons = Calon::whereIn('gel_id', $gelombang)->pluck('id');

        if (auth()->user()->isHaveAccess([1, 4])) {
            if ($this->data == 1) {
                $calons = CalonTagihanPSB::with('calonnya')->whereIn('calon_id', $calons)->get();
                return view('exports.muamalat', [
                    'calons' => $calons,
                    'no' => 1,
                ]);
            }

            if ($this->data == 2) {
                $calons = CalonTagihanPSB::with('calonnya.kelasnya')->whereIn('calon_id', $calons)->whereNull('va2')->get();
                return view('exports.bjbs', [
                    'calons' => $calons,
                    'no' => 1,
                ]);
            }

            if ($this->data == 3) {
                $calons = CalonTagihanPSB::with('calonnya')->whereIn('calon_id', $calons)->get();
                $now = new \DateTime();
                $reg1 = new \DateTime('2020-11-4');
                $reg2 = new \DateTime('2020-12-1');
                $reg3 = new \DateTime('2021-02-1');
                // $reg4 = new \DateTime('2021-07-30');

                // if($reg4 > $now) {
                $judul = 3;
                // }

                if ($reg3 > $now) {
                    $judul = 3;
                }

                if ($reg2 > $now) {
                    $judul = 2;
                }

                if ($reg1 > $now) {
                    $judul = 1;
                }

                return view('exports.tagihanPSB', [
                    'calons' => $calons,
                    'no' => 1,
                    'judul' => $judul,
                ]);
            }
        }
    }
}

<?php

namespace App\Exports;

use App\CalonJadwal;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CpdTesExport implements FromView
{
    public $data;

    public function __construct($data = "")
    {
        $this->data = $data;
    }

    public function view() : view
    {
        if(auth()->user()->isAdmin() || auth()->user()->isAdminUnit()) {
            $calons = CalonJadwal::with('calonnya', 'jadwalnya')->where('jadwal_id', $this->data)->get();
        }

        // if(auth()->user()->isAdmin()) {
        //     $calons = CalonJadwal::with('calonnya', 'jadwalnya')->get();
        // }

        return view('exports.tes', [
            'calons' => $calons,
            'no' => 1,
        ]);
    }
}

<?php

namespace App\Exports;

use App\BayarTagihan;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportBayar implements FromView
{
    public $data;

    public function __construct($data = "")
    {
        $this->data = $data;
    }

    public function view(): view
    {
        if (auth()->user()->isHaveAccess([1, 4])) {
            $calons = BayarTagihan::with('calonnya')->get();
            return view('exports.bayartagihanPSB', [
                'calons' => $calons,
                'no' => 1,
            ]);
        }
    }
}

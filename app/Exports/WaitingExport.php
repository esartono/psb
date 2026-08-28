<?php

namespace App\Exports;

use App\Waiting;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\FromView;

class WaitingExport implements FromView
{
    public $data;

    public function __construct($data = "")
    {
        $this->data = $data;
    }

    public function view(): view
    {
        $filters = explode('_', $this->data);
        $name = ($filters[0] == '-') ? '' : $filters[0];
        $unit = ($filters[1] == '-') ? '' : $filters[1];
        $tp = ($filters[2] == '-') ? '' : $filters[2];

        if (auth()->user()->isAdmin()) {
            $datas = Waiting::where('status', 1)
                ->where('nama', 'like', '%' . $name . '%')
                ->where('unit', 'like', '%' . $unit . '%')
                ->where('ta', $tp)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // if (auth()->user()->isAdminUnit()) {
        //     $adminUnit = auth()->user()->unit_id;
        //     $unit = Unit::whereId($adminUnit)->first();
        //     $unitnya = strtolower(substr($unit->name, 0, 3));

        //     if ($unitnya === 'sdi' || $unitnya === 'tki') {
        //         $unitnya = substr($unitnya, 0, 2);
        //     }

        //     return $data = Waiting::where('status', 1)
        //         ->where('unit', $unitnya)
        //         ->orderBy('created_at', 'desc')
        //         ->get()->toArray();
        // }

        return view('exports.waitinglist', [
            'datas' => $datas,
            'no' => 1,
        ]);
    }
}

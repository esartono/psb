<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CpdExportSeragam implements FromView
{
    public $data;

    public function __construct($data = "")
    {
        $this->data = $data;
    }

    public function view(): view
    {
        if (auth()->user()->isAdmin() || auth()->user()->isPengadaan()) {
            $gelombang = DB::table('gelombangs')->where('tp', auth()->user()->tpid)->get()->pluck('id');
            $calons = DB::table('calon_seragams')
                ->select(
                    'calons.id',
                    'calons.name',
                    'calons.jk',
                    'units.name as unit',
                    'calon_seragams.atas as atas',
                    'calon_seragams.bawah as bawah',
                    DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts'),
                    DB::raw('IF(calons.jk=1, "L", "P") as kelamin')
                )
                ->leftJoin('calons', 'calon_seragams.calon_id', '=', 'calons.id')
                ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                ->whereIn('calons.gel_id', $gelombang)
                ->orderBy('calons.name', 'asc')
                ->get();
        }

        return view('exports.seragam', [
            'calons' => $calons,
            'no' => 1,
        ]);
    }
}

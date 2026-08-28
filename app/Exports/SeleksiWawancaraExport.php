<?php

namespace App\Exports;

use App\Calon;
use App\Gelombang;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SeleksiWawancaraExport implements FromView
{
    public $data;

    public function __construct($data = "")
    {
        $this->data = $data;
    }

    public function view(): view
    {
        if (auth()->user()->isAdmin()) {
            $gelombang = Gelombang::where('unit_id', $this->data)->where('tp', auth()->user()->tpid)->get()->pluck('id');

            if ($this->data == 'All') {
                $gelombang = Gelombang::where('tp', auth()->user()->tpid)->get()->pluck('id');
            }
        }

        $calons = Calon::whereIn('gel_id', $gelombang)->pluck('id');

        $datas = DB::table('tes_wawancaras')
            ->select(
                'tes_wawancaras.id AS id',
                'calon_id',
                'calons.name AS name',
                'calons.jk AS jk',
                'units.name as unit',
                'kelasnyas.name as kelas',
                'instrumen_wawancaras.instrumen AS instrumen',
                'users.name AS pewawancara',
                'tes_wawancaras.skor',
                'tes_wawancaras.status',
                'tes_wawancaras.rubrik',
                DB::raw('FLOOR((tes_wawancaras.skor / (4*tes_wawancaras.rubrik)) * 100) AS total'),
                DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
            )
            ->leftJoin('instrumen_wawancaras', 'tes_wawancaras.instrumen_id', '=', 'instrumen_wawancaras.id')
            ->leftJoin('users', 'tes_wawancaras.pewawancara_id', '=', 'users.id')
            ->leftJoin('calons', 'tes_wawancaras.calon_id', '=', 'calons.id')
            ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
            ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
            ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
            ->whereIn('calon_id', $calons)
            ->orderBy('status', 'asc')
            ->orderBy('calons.name', 'asc')
            ->orderBy('instrumen', 'asc')
            ->get()
            ->toArray();

        return view('exports.seleksiwawancara', [
            'datas' => $datas,
            'no' => 1,
        ]);
    }
}

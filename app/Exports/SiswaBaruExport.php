<?php

namespace App\Exports;

use App\Calon;
use App\Gelombang;
use App\CalonHasil;
use App\CalonTagihanPSB;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\FromView;

class SiswaBaruExport implements FromView
{
    public function view(): view
    {
        // $undur = CalonHasil::where('lulus', 4)->get()->pluck('pendaftaran');

        if (auth()->user()->isAdmin()) {
            $gelombang = Gelombang::where('tp', auth()->user()->tpid)->get()->pluck('id');
        }

        if (auth()->user()->isAdminUnit()) {
            $unit = auth()->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth()->user()->tpid)->get()->pluck('id');
        }

        $getCalon = Calon::whereIn('gel_id', $gelombang)->get()->pluck('id');
        $lunas = CalonTagihanPSB::whereIn('calon_id', $getCalon)->where('daul', 1)->get()->pluck('calon_id');

        if (auth()->user()->isAdmin() || auth()->user()->isAdminUnit()) {
            $calons = DB::table('calons')
                ->select(
                    'calons.id',
                    'calons.name',
                    'calons.tempat_lahir',
                    'calons.tgl_lahir',
                    'calons.jk',
                    'calons.ayah_nama',
                    'calons.ayah_hp',
                    'calons.ibu_nama',
                    'calons.ibu_hp',
                    'units.name as unit',
                    'kelasnyas.name as kelas',
                    'calon_kategoris.name as ck',
                    'gelombangs.kode_va',
                    'urut',
                    DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts'),
                    'calon_tagihan_p_s_b_s.lunas as lunas',
                    'calons.alamat'
                )
                ->leftJoin('calon_kategoris', 'calons.ck_id', '=', 'calon_kategoris.id')
                ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                ->leftJoin('calon_tagihan_p_s_b_s', 'calons.id', '=', 'calon_tagihan_p_s_b_s.calon_id')
                ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
                ->whereIn('calons.id', $lunas)
                ->orderBy('calon_tagihan_p_s_b_s.updated_at', 'desc')
                ->get();
        }

        return view('exports.siswabaru', [
            'calons' => $calons,
            'no' => 1,
        ]);
    }
}

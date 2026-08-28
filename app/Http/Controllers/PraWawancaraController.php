<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

use PDF;
use App\Calon;
use App\Gelombang;
use App\Pewawancara;
use App\PraWawancara;
use Illuminate\Support\Arr;

class PraWawancaraController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin() || auth()->user()->isPewawancara()) {
            return view('tes_wawancara.index');
        }
    }

    public function item($id)
    {
        if (auth()->user()->isUser()) {
            $calon = Calon::where('id', $id)->where('user_id', auth()->user()->id)->first();
            if ($calon) {
                return view('pra_wawancara.index', compact('calon'));
            }
        }
    }

    public function list()
    {
        if (auth()->user()->isAdmin() || auth()->user()->isPewawancara()) {
            //list Calon

            $gelombang = Gelombang::where('tp', auth()->user()->tpid)->get()->pluck('id');
            $listCalon = DB::table('calons')
                ->select('id')
                ->whereIn('gel_id', $gelombang)
                ->where('calons.status', 1)
                ->where('aktif', true)
                ->pluck('id');

            //list yg udah isi wawancara
            $listpra = Prawawancara::whereIn('calon_id', $listCalon)->groupBy('calon_id')->pluck('calon_id');
            $lists = DB::table('calons')
                ->select(
                    'calons.id',
                    'calons.name',
                    'jk',
                    'units.name as unit',
                    'kelasnyas.name as kelas',
                    'ayah_nama',
                    'ibu_nama',
                    'calon_kategoris.name as ck',
                    'gelombangs.kode_va',
                    'urut',
                    'pindahan',
                    DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
                )
                ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                ->leftJoin('calon_kategoris', 'calons.ck_id', '=', 'calon_kategoris.id')
                ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
                ->whereIn('calons.id', $listpra)
                ->where('calons.status', 1)
                ->where('aktif', true)
                ->get();
            if ($lists) {
                return view('tes_wawancara.prawawancara', compact('lists'));
            }
        }
    }

    public function create(Request $request)
    {
        $jawaban = array();
        $catatan = array();
        $selesai = false;
        // $calon = Calon::where('id', $request->calon)->where('user_id', auth()->user()->id)->first();
        $calon = DB::table('calons')
            ->select(
                'calons.id',
                'calons.name',
                'jk',
                'units.name as unit',
                'kelasnyas.name as kelas',
                'gelombangs.kode_va',
                'urut',
                'pindahan',
                DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
            )
            ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
            ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
            ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
            ->where('calons.id', $request->calon)
            ->where('calons.status', 1)
            ->where('aktif', true)
            ->where('user_id', auth()->user()->id)
            ->first();
        if ($calon) {
            //cek udah diisi atau blm
            $cekudah = PraWawancara::where('calon_id', $request->calon)->get();
            if ($cekudah) {
                //Proses data
                foreach ($cekudah as $d) {
                    $jawaban[$d->no] = $d->jawaban;
                    $catatan[$d->no] = $d->catatan;
                }
                //Hitung datany    
                if (count($cekudah) >= 23) {
                    $selesai = true;
                }
                if ($calon->unit == "SDIT Nurul Fikri") {
                    if (count($cekudah) >= 22) {
                        $selesai = true;
                    }
                }
            }
            if ($calon->unit == "SDIT Nurul Fikri") {
                return view('pra_wawancara.formSD', compact('calon', 'jawaban', 'catatan', 'selesai'));
            }
            return view('pra_wawancara.form', compact('calon', 'jawaban', 'catatan', 'selesai'));
        }
    }

    public function show($id)
    {
        $data = PraWawancara::where('calon_id', $id)->get();
        $calon = DB::table('calons')
            ->select(
                'calons.id',
                'calons.name',
                'jk',
                'units.name as unit',
                'kelasnyas.name as kelas',
                'ayah_nama',
                'ibu_nama',
                'gelombangs.kode_va',
                'urut',
                'pindahan',
                DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
            )
            ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
            ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
            ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
            ->where('calons.id', $id)
            ->where('calons.status', 1)
            ->where('aktif', true)
            ->first();
        return view('pra_wawancara.detail', compact('data', 'calon'));
    }

    // public function PDFWawancara($id)
    // {
    //     $calon = DB::table('calons')
    //         ->select(
    //             'calons.id',
    //             'calons.name',
    //             'jk',
    //             'units.name AS unit',
    //             'pindahan',
    //             'kelasnyas.name as kelas',
    //             'gelombangs.kode_va',
    //             'urut',
    //             DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
    //         )
    //         ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
    //         ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
    //         ->leftJoin('calon_tagihan_p_s_b_s', 'calons.id', '=', 'calon_tagihan_p_s_b_s.calon_id')
    //         ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
    //         ->where('calons.status', 1)
    //         ->where('calons.aktif', true)
    //         ->orderBy('calons.name', 'asc')
    //         ->where('calons.id', $id)
    //         ->first();

    //     // dd($calon);
    //     $pdf = PDF::loadView('pdf.seleksiWawancara', compact('calon'));
    //     return $pdf->stream('');
    // }

    public function store(Request $request)
    {
        $balikin = array();
        $catatan = array();

        if (auth()->user()->isUser()) {
            foreach ($request->no as $no) {
                PraWawancara::updateOrCreate([
                    'calon_id' => $request->calon_id,
                    'kategori' => $request->kategori,
                    'no' => $no
                ], [
                    'no_soal' => $request->no_soal[$no],
                    'pertanyaan' => $request->pertanyaan[$no],
                    'jawaban' => $request->jawaban[$no],
                    'catatan' => $request->catatan[$no],
                    'status' => 1
                ]);
            }
        }
        $calon = Calon::where('id', $request->calon_id)->where('user_id', auth()->user()->id)->first();
        return view('pra_wawancara.index', compact('calon'));
    }

    // public function update(Request $request, Faq $faq)
    // {
    //     $faq->update($request->all());
    // }

    public function destroy($id)
    {
        $data = TesWawancara::whereId($id)->first();

        if ($data) {
            $data->update(['status' => 0]);
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }
}

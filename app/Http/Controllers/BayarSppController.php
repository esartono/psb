<?php

namespace App\Http\Controllers;

use PDF;
// use Auth;

use App\Calon;
use App\Gelombang;
use App\BayarSpp;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BayarSppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tp = TahunPelajaran::where('status', 1)->first();
        return BayarSpp::where('lunas', 0)
            ->where('tp', $tp)
            ->orderBy('verifikasi', 'asc')
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();
    }

    public function show($id)
    {
        ini_set('max_execution_time', 1200);
        // $gelombang = Gelombang::where('tp', auth()->user()->tpid)->get()->pluck('id');
        if (auth()->user()->isUser()) {
            // $calon = Calon::where('id', $id)->where()->first();
            $calon = DB::table('calons')
                ->select(
                    'calons.id',
                    'calons.name',
                    'calons.jk',
                    'kelasnyas.name as kelas',
                    'units.name as unit',
                    DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts'),
                    'bayar_spps.tanggal_bayar as tgl_bayar',
                    'bayar_spps.jumlahbayar as bayar',
                    'bayar_spps.lunas as lunas',
                )
                ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
                ->leftJoin('bayar_spps', 'calons.id', '=', 'bayar_spps.calon_id')
                ->where('calons.id', $id)
                ->where('calons.user_id', auth()->user()->id)
                ->where('calons.status', 1)
                ->where('calons.aktif', true)
                ->where('bayar_spps.verifikasi', 1)
                ->orderBy('bayar_spps.id', 'desc')
                ->first();
            if ($calon) {
                // $calon = $calons->first();
                $pdf = PDF::loadView('pdf.spp', compact('calon'));
                return $pdf->stream('');
            } else {
                return redirect('home');
            }
        }

        if (auth()->user()->isAdmin() || auth()->user()->isAdminkeu()) {

            // if (auth()->user()->isUser()) {
            //     $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
            //         ->where('id', $id)->where('status', 1)->where('user_id', auth()->user()->id);
            //     if ($calons->first()) {
            //         $pend = $calons->first()->uruts;

            //         $pd = CalonDaul::where('pendaftaran', $pend)->first();
            //         if (!$pd) {
            //             return redirect('ppdb');
            //         }
            //         if ($pd->lunas == 0) {
            //             return redirect('ppdb');
            //         }
            //     }

            //     if ($calons->get()->count() > 0) {
            //         $calonsnya = $calons->first();
            //         $pdf = PDF::loadView('pdf.daul', compact('calonsnya'));
            //         return $pdf->stream('');
            //     } else {
            //         return redirect('ppdb');
            //     }
            // }

            // if (auth()->user()->isAdmin() || auth()->user()->isAdminUnit()) {
            // $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
            // ->where('id', $id)->where('status', 1);
            $calon = DB::table('calons')
                ->select(
                    'calons.id',
                    'calons.name',
                    'calons.jk',
                    'kelasnyas.name as kelas',
                    'units.name as unit',
                    DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts'),
                    'bayar_spps.tanggal_bayar as tgl_bayar',
                    'bayar_spps.jumlahbayar as bayar',
                    'bayar_spps.lunas as lunas',
                )
                ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
                ->leftJoin('bayar_spps', 'calons.id', '=', 'bayar_spps.calon_id')
                ->where('calons.id', $id)
                ->where('calons.status', 1)
                ->where('calons.aktif', true)
                ->where('bayar_spps.verifikasi', 1)
                ->orderBy('bayar_spps.id', 'desc')
                ->first();
            if ($calon) {
                // $calon = $calons->first();
                $pdf = PDF::loadView('pdf.spp', compact('calon'));
                return $pdf->stream('');
            } else {
                return redirect('home');
            }
            // }
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->isAdmin() || auth('api')->user()->isAdminKeu()) {
            $cekdata = BayarSpp::whereId($request->id)->first();
            if ($cekdata) {
                if ($cekdata->verifikasi == 0) {
                    $ver = 1;
                }
                if ($cekdata->verifikasi == 1) {
                    $ver = 0;
                }
                $cekdata->update([
                    'verifikasi' => $ver,
                    'verificator' => auth()->user()->id,
                ]);

                return $cekdata;
            }

            return response()->json(['message' => 'Not Found!'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->isUser()) {
            $calon = Calon::where('id', $request->calon_id)->first();
            $file = $request->file('file');

            $extension = $file->getClientOriginalExtension();
            // $namefile = $file->getClientOriginalName();
            $namefile = 'Bayar SPP Juli - ' . $calon->uruts . '.' . $extension;

            Storage::disk('my_upload')->put('/' . $calon->uruts . '/' . $namefile, File::get($file));

            // $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            // $pecah_tgl = explode(' ', $request->tanggal_bayar);
            // $m = (array_search($pecah_tgl[1], $bulan)) + 1;

            BayarSpp::updateOrCreate(
                [
                    'calon_id' => $id,
                    'tp' => $request->tp
                ],
                [
                    'tanggal_bayar' => $request->tanggal_bayar,
                    // 'tanggal_bayar' => $pecah_tgl[2] . '-' . $m . '-' . $pecah_tgl[0],
                    'jumlahbayar' => $request->jumlahbayar,
                    'file' => $namefile,
                    'keterangan' => $request->keterangan
                ]
            );
            // $calon = Calon::where('id', $request->calon)->first();
            return redirect()->route('home');
        }
    }
}

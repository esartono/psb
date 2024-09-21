<?php

namespace App\Http\Controllers;

use App\Calon;
use App\BayarSpp;

use Illuminate\Http\Request;
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
        if (auth()->user()->isUser()) {
            $calon = Calon::where('id', $id)->where('user_id', auth()->user()->id)->first();
            return view('bayarSpp.index', compact('calon'));
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

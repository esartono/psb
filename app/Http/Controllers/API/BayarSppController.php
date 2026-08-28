<?php

namespace App\Http\Controllers\API;

use App\Calon;
use App\Gelombang;
use App\BayarSpp;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

class BayarSppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('id');
        return DB::table('calons')
            ->select(
                'calons.id',
                'calons.name',
                'calons.jk',
                'units.name as unit',
                DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts'),
                'bayar_spps.tanggal_bayar as tgl_bayar',
                'bayar_spps.jumlahbayar as bayar',
                'bayar_spps.lunas as lunas',
            )
            ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
            ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
            ->leftJoin('bayar_spps', 'calons.id', '=', 'bayar_spps.calon_id')
            ->whereIn('gel_id', $gelombang)
            ->where('calons.status', 1)
            ->where('calons.aktif', true)
            ->where('bayar_spps.verifikasi', 1)
            ->orderBy('bayar_spps.id', 'desc')
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
            $idPendaftaran = substr($request->name, 0, 9);
            $gel = substr($idPendaftaran, 0, 6);
            $gelID = Gelombang::where('kode_va', $gel)->first()->id;
            $urut = intval(substr($idPendaftaran, -3));
            $cekdata = Calon::where('gel_id', $gelID)->where('urut', $urut)->first();
            if ($cekdata) {
                BayarSpp::updateOrCreate([
                    'calon_id' => $cekdata->id
                ], [
                    'tp' => auth('api')->user()->tpid,
                    'tanggal_bayar' => $request->tgl_bayar,
                    'jumlahbayar' => $request->bayar,
                    'file' => 'nophoto.png',
                    'keterangan' => 'Input admin manual',
                    'lunas' => $request->lunas,
                    'status' => 1,
                    'verifikasi' => 1,
                    'verificator' => auth('api')->user()->id,
                ]);

                return response()->json(['message' => 'Berhasil di upload!'], 200);
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

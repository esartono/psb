<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Calon;
use App\Gelombang;
use App\BayarTagihan;
use App\TahunPelajaran;
use App\CalonTagihanPSB;

use Excel;
use App\Exports\ExportBayar;

class BayarTagihanController extends Controller
{
    protected $tp_berjalan;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->tp_berjalan = TahunPelajaran::where('status', 1)->first()->name;
    }

    public function index()
    {
        $tp = TahunPelajaran::where('name', $this->tp_berjalan)->first()->id;
        $gelombang = Gelombang::where('tp', $tp)->get()->pluck('id');
        $calon = Calon::whereIn('gel_id', $gelombang)->pluck('id');
        // return BayarTagihan::distinct()
        //     ->select('calon_id')
        //     // ->with('calonnya')
        //     ->whereIn('calon_id', $calon)
        //     ->get()->toArray();
        return BayarTagihan::distinct()
            // return DB::table('bayar_tagihans')
            ->select(
                'calon_id',
                'calons.name',
                'jk',
                'gelombangs.kode_va',
                'urut',
                DB::raw('MAX(bayar_tagihans.created_at) as urutbayar'),
                DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
            )
            ->leftJoin('calons', 'bayar_tagihans.calon_id', '=', 'calons.id')
            ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
            ->whereIn('calon_id', $calon)
            ->groupBy('bayar_tagihans.calon_id')
            ->orderBy('urutbayar', 'desc')
            ->get()
            ->toArray();
    }

    public function store(Request $request)
    {
        $registrasi = explode(' - ', $request->name);
        $pendaftaran = $registrasi[0];
        $gels = Gelombang::where('kode_va', substr($pendaftaran, 0, 6))->first();
        $urut = intval(substr($pendaftaran, 6));

        $ket = "-";

        if ($request->keterangan) {
            $ket = $request->keterangan;
        }

        if ($gels) {
            $gel = $gels->id;
            $calon = Calon::with('gelnya.unitnya', 'kelasnya', 'usernya')
                ->where('urut', $urut)->where('gel_id', $gel)->first();

            if ($calon) {
                BayarTagihan::create([
                    'calon_id' => $calon->id,
                    'tgl_bayar' => $request->tgl_bayar,
                    'bayar' => $request->bayar,
                    'tambah_infaq' => $request->tambah_infaq,
                    'diskon' => $request->diskon,
                    'keterangan' => $ket,
                    'admin' => auth('api')->user()->id
                ]);

                $cpsb = CalonTagihanPSB::where('calon_id', $calon->id)->first();
                $cpsb->update(['daul' => 1, 'lunas' => $request->lunas]);
                $bayar = BayarTagihan::where('calon_id', $calon->id)->get();
                // $tagihan = $bayar->last();

                // Mail::send('emails.bayarpsb', compact('calon', 'bayar', 'cpsb'), function ($m) use ($calon)
                //     {
                //         $m->to($calon->usernya->email, $calon->name)->from('psb@nurulfikri.sch.id', 'Panitia PPDB SIT Nurul Fikri')->subject('Pembayaran Daftar Ulang SIT Nurul Fikri');
                //     }
                // );
            }
        }
    }

    public function show($id)
    {
        return BayarTagihan::with('calonnya')
            ->where('calon_id', $id)
            ->get()->toArray();
    }

    public function update(Request $request, $id)
    {
        $ket = "-";

        if ($request->keterangan) {
            $ket = $request->keterangan;
        }

        $bayar = BayarTagihan::findOrFail($id);
        $bayar->update([
            'tgl_bayar' => $request->tgl_bayar,
            'bayar' => $request->bayar,
            'tambah_infaq' => $request->tambah_infaq,
            'diskon' => $request->diskon,
            'keterangan' => $ket,
            'admin' => auth('api')->user()->id
        ]);
        $cpsb = CalonTagihanPSB::where('calon_id', $bayar->calon_id)->first();
        $cpsb->update(['daul' => 1, 'lunas' => $request->lunas]);
    }

    public function destroy($id)
    {
        $bayar = BayarTagihan::findOrFail($id);

        $cekdata = BayarTagihan::where('calon_id', $bayar->calon_id)->pluck('calon_id', 'lunas');

        $cpsb = CalonTagihanPSB::where('calon_id', $bayar->calon_id)->first();
        $cpsb->update(['daul' => 1, 'lunas' => $request->lunas]);

        $bayar->delete();
    }

    public function export()
    {
        return Excel::download(new ExportBayar, 'Data Pembayaran Tagihan PPDB.xlsx');
    }
}

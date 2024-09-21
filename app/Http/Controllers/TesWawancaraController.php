<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Calon;
use App\Gelombang;
use App\Rubrik;
use App\InstrumenWawancara;
use App\TesWawancara;
use Illuminate\Support\Arr;

class TesWawancaraController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            return view('tes_wawancara.index');
        }
    }

    public function wawancara(Request $request)
    {
        if (auth()->user()->isAdmin() || auth()->user()->isPewawancara()) {
            $pilihanWawancara = $request->wawancara;
            $wawancara = array();
            $wawancaranya = TesWawancara::with('calonnya')->where('pewawancara_id', auth()->user()->id)->get();
            if ($wawancaranya) {
                $no = 1;
                foreach ($wawancaranya as $w) {
                    $wawancara[$no] = [
                        'no' => $no,
                        'nama' => $w->calonnya->name,
                        'no_pendaftaran' => $w->calonnya->uruts,
                    ];
                }
            }
            $unitnya = [
                1 => 'TK',
                2 => 'SD',
                3 => 'SMP',
                4 => 'SMA'
            ];
            if ($pilihanWawancara) {
                $modelWawancara = $pilihanWawancara;
                if ($request->id_pendaftaran) {
                    $pendaftaran = $request->id_pendaftaran;
                    $unit = substr($pendaftaran, 5, -3);
                    $gel = Gelombang::where('kode_va', substr($pendaftaran, 0, 6))->where('tp', taId())->first();
                    $urut = intval(substr($pendaftaran, 6));

                    if ($gel) {
                        $cari = 'TK dan SD';
                        if ($unit > 2) {
                            if ($modelWawancara == 'ortu') {
                                $cari = 'Orang Tua ' . $unitnya[$unit];
                            }
                            if ($modelWawancara == 'siswa') {
                                $cari = 'Siswa ' . $unitnya[$unit];
                            }
                        }

                        $calon = Calon::where('urut', $urut)->where('gel_id', $gel->id)->where('status', 1)->first();
                        $instrumen = InstrumenWawancara::where('singkatan', $modelWawancara)->where('instrumen', 'like', '%' . $cari . '%')->first()->id;
                        $rubrik = Rubrik::where('id_instrumen', $instrumen)->orderBy('id', 'asc')->get();
                        $rubriknya = $rubrik->pluck('id');

                        if ($calon) {
                            //cek Jawaban
                            $mulai = $start = $finish = $itung = 0;
                            $j = TesWawancara::where('calon_id', $calon->id)
                                ->where('instrumen_id', $instrumen)
                                ->first();
                            if ($j) {
                                $jawabannya = [
                                    0 => $j->jawaban,
                                    1 => $j->catatan
                                ];
                                foreach ($rubriknya as $r) {
                                    $itung++;
                                    if ($start == 0) {
                                        $start = $r;
                                    }
                                    if (empty($j->jawaban[$r]) || $j->jawaban[$r] == 0) {
                                        $finish = $r;
                                        break;
                                    }
                                }
                                $mulai = $finish > $start ? $finish : $start;
                                if ($itung == count($jawabannya[0])) {
                                    return view('tes_wawancara.proses', compact('j'));
                                }
                            }
                            return view('tes_wawancara.index', compact('modelWawancara', 'calon', 'rubrik', 'instrumen', 'jawabannya', 'mulai'));
                        } else {
                            return view('tes_wawancara.index', compact('modelWawancara'))->with('message', 'No. Pendaftaran : ' . $pendaftaran . ' tidak ditemukan.');
                        }
                    } else {
                        return view('tes_wawancara.index', compact('modelWawancara'))->with('message', 'No. Pendaftaran : ' . $pendaftaran . ' bukan di tahun ajaran ini.');
                    }
                }
                return view('tes_wawancara.index', compact('modelWawancara'));
            }
            return view('tes_wawancara.index', compact('wawancara'));
        }
    }

    public function store(Request $request)
    {
        $balikin = array();
        $catatan = array();
        if (auth()->user()->isAdmin() || auth()->user()->isPewawancara()) {
            foreach ($request['catatan'] as $k => $c) {
                $catatan[$k] = $c;
            }
            $data = TesWawancara::updateOrCreate([
                'calon_id' => $request['calon_id'],
                'instrumen_id' => $request['instrumen_id']
            ], [
                'pewawancara_id' => auth()->user()->id,
                'jawaban' => $request['jawaban'],
                'catatan' => $catatan,
                'skor' => 0,
                'rekomendasi' => "-"
            ]);

            $pilihanWawancara = InstrumenWawancara::whereId($data->instrumen_id)->first()->singkatan;
            $calon = Calon::whereId($data->calon_id)->first();
            $balikin = [
                'wawancara' => $pilihanWawancara,
                'id_pendaftaran' => $calon->uruts,
            ];
        }

        return redirect()->route('tesWawancara', $balikin);
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

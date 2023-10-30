<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

use Carbon\Carbon;

use App\Doku;
use App\JDoku;
use App\Calon;
use App\User;
use App\Unit;
use App\Jadwal;
use App\Gelombang;
use App\CalonJadwal;
use App\CalonKategori;

class DokuController extends Controller
{
    public function calon($id)
    {
        $calon = Calon::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if ($calon) {
            $doku = Doku::where('calon_id', $id)->where('user_id', auth()->user()->id)->pluck('file', 'jdoku');
            return view('doku.index', compact('calon', 'doku'));
        }
    }

    public function detail($id)
    {
        if (auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
            $calon = Calon::where('id', $id)->first();
            $gelombang = Gelombang::where('id', $calon->gel_id)->first()->unit_id;
            $unitnya = Unit::where('id', $gelombang)->first()->name;
            $unit = trim(str_replace('IT Nurul Fikri', '', $unitnya));

            $jd = JDoku::where('unit', 'like', '%' . $unit . '%')->get();
            $oke = array();
            $idsnya = -1;

            foreach ($jd as $j) {
                $doku = Doku::where('calon_id', $id)->where('jdoku', $j->code)->first();
                if ($doku) {
                    $ids = $doku->id;
                    $file = $doku->file;
                } else {
                    $ids = $idsnya--;
                    $file = 'kosong';
                }
                $oke[] = [
                    'id' => $ids,
                    'name' => $j->name,
                    'file' => $file,
                    'ck' => $ck
                ];
            }

            return $oke;

            // return DB::table('j_dokus')
            //     ->select('j_dokus.code', 'j_dokus.name', 'dokus.id', 'dokus.file')
            //     ->leftJoin('dokus', 'j_dokus.code', '=', 'dokus.jdoku')
            //     ->where('dokus.calon_id', $id)
            //     ->where('j_dokus.unit', 'like', '%'.$unit.'%')
            //     ->orderBy('j_dokus.name', 'asc')
            //     ->get()->toArray();
        }

        return 'EKO';
    }

    public function upload($calon, $code)
    {
        $jd = JDoku::where('code', $code)->first();
        return view('doku.create', compact('calon', 'jd'));
    }

    public function download($id)
    {
        $doku = Doku::whereId($id)->first();
        $calon = Calon::whereId($doku->calon_id)->first()->uruts;
        if (auth()->user()->isAdmin() || auth()->user()->isAdminUnit()) {
            $path = storage_path('dokumen/' . $calon . '/' . $doku->file);
        }

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function show($calon)
    {
        return view('doku.create', compact('calon'));
    }

    public function update(Request $request)
    {
        $calon = Calon::where('id', $request->calon)->first();
        $file = $request->file('file');

        $extension = $file->getClientOriginalExtension();
        $namefile = $file->getClientOriginalName();

        Storage::disk('my_upload')->put('/' . $calon->uruts . '/' . $namefile, File::get($file));
        Doku::create([
            'calon_id' => $calon->id,
            'user_id' => auth()->user()->id,
            'jdoku' => $request->jdoku,
            'file' => $namefile
        ]);

        return redirect()->route('dokumen', $calon->id);
    }

    public function pilihJadwal($calon)
    {
        return redirect()->route('home');
        //Gak JADI .....
        $calons = Calon::where('id', $calon)->where('user_id', auth()->user()->id)->first()->gel_id;
        if ($calons) {
            $cj = CalonJadwal::where('calon_id', $calon)->first()->jadwal_id;
            $seleksi = strtotime(Jadwal::where('id', $cj)->first()->seleksi);
            $jadwal = array();
            for ($i = 0; $i < 7; $i++) {
                $seleksi = strtotime('-1 day', $seleksi);
                $cek = strftime('%w', $seleksi);
                if ($cek != 0 && $cek != 6) {
                    $cekJadwal = CalonJadwal::whereDate('wawancara', date("yy-m-d", $seleksi))->get()->count();
                    if ($cek == 5) {
                        if ($calons <= 2 && $cekJadwal <= 9) {
                            $jadwal[date("yy-m-d", $seleksi)] = strftime('%A, %d %B %Y', $seleksi);
                        }
                        if ($calons > 2 && $cekJadwal <= 15) {
                            $jadwal[date("yy-m-d", $seleksi)] = strftime('%A, %d %B %Y', $seleksi);
                        }
                    } else {
                        if ($calons <= 2 && $cekJadwal <= 15) {
                            $jadwal[date("yy-m-d", $seleksi)] = strftime('%A, %d %B %Y', $seleksi);
                        }
                        if ($calons > 2 && $cekJadwal <= 25) {
                            $jadwal[date("yy-m-d", $seleksi)] = strftime('%A, %d %B %Y', $seleksi);
                        }
                    }
                }
            }
            return view('user.pilihjadwal', compact('calon', 'jadwal'));
        }

        return redirect()->route('home');
    }

    public function updatejadwal(Request $request)
    {
        $calon = Calon::where('id', $request->calon)->where('user_id', auth()->user()->id)->first();
        if ($calon) {
            CalonJadwal::updateOrCreate(
                ['calon_id' => $request->calon],
                ['wawancara' => $request->wawancara, 'waktu' => $request->waktu]
            );
        }

        return redirect()->route('home');
    }

    public function getWaktu(Request $request)
    {
        $seleksi = strtotime($request->jadwal);
        $calon = Calon::whereId($request->calon)->first()->gel_id;

        $j = ['09.00 - 10.00', '10.00 - 11.00', '11.00 - 12.00', '13.00 - 14.00', '14.00 - 15.00'];

        $cek = strftime('%w', $seleksi);
        if ($cek == 5) {
            $j = array_diff($j, ['11.00 - 12.00', '13.00 - 14.00']);
        }

        foreach ($j as $cekcok) {
            $cekJadwal = CalonJadwal::whereDate('wawancara', date("yy-m-d", $seleksi))
                ->where('waktu', $cekcok)->get()->count();
            if ($calon > 2 && $cekJadwal >= 5) {
                $j = array_diff($j, [$cekcok]);
            }
            if ($calon <= 2 && $cekJadwal >= 3) {
                $j = array_diff($j, [$cekcok]);
            }
        }


        return response()->json($j);
    }
}

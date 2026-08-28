<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

use Auth;
use PDF;
use Excel;

use App\Calon;
use App\Gelombang;
use App\Rubrik;
use App\InstrumenWawancara;
use App\TesWawancara;
use App\Pewawancara;
use App\PraWawancara;
use App\User;
use App\Unit;
use App\AspekPerilaku;
use App\CalonObservasi;

use App\Exports\SeleksiWawancaraExport;
use App\Exports\WaitingExport;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class TesWawancaraController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin() || auth()->user()->isPewawancara()) {
            return view('tes_wawancara.index');
        }
    }

    public function login(Request $request)
    {
        $url = 'http://sdmsmart.nurulfikri.sch.id/api/api.php/AbsensiPegawaiNF/?id=' . $request->nip . '&sandi=' . $request->password;
        $obj = json_decode(file_get_contents($url), true);
        if ($obj['message'] == 'Data show success') {
            //cek data pewawancara
            $cek = Pewawancara::where('nip', $request->nip)->first();
            if ($cek) {
                //cek udah ada apa blm di USER
                $cekUser = User::where('email', $request->nip . '@nf.local')->first();
                if (!$cekUser) {
                    $newPass = rand(1000000, 9999999);
                    $cekUser = User::create([
                        'name' => $cek->nama,
                        'email' => $request->nip . '@nf.local',
                        'phone' => '54321',
                        'email_verified_at' => '2025-09-01 07:07:07',
                        'password' => Hash::make($newPass),
                        'level' => 7,
                    ]);
                }
                Auth::loginUsingId($cekUser->id);
                return redirect()->route('home');
            }
        }
        return redirect()->route('depan');
    }

    public function wawancara(Request $request)
    {
        if (auth()->user()->isAdmin() || auth()->user()->isPewawancara()) {
            $pilihanWawancara = $request->wawancara;
            $wawancara = array();

            // cek Calon pada tahun berjalan
            $gelombang = Gelombang::where('tp', auth()->user()->tpid)->get()->pluck('id');
            $calons = Calon::whereIn('gel_id', $gelombang)->pluck('id');

            $wawancaras = DB::table('tes_wawancaras')
                ->select(
                    'calon_id',
                    DB::raw(
                        'CONCAT(
                            GROUP_CONCAT(instrumen_wawancaras.singkatan SEPARATOR "::"),
                            "::",
                            GROUP_CONCAT(IF(tes_wawancaras.skor > 0 OR tes_wawancaras.rubrik > 0, FLOOR((tes_wawancaras.skor / (4*tes_wawancaras.rubrik)) * 100), 0) SEPARATOR "::"),
                            "::",
                            GROUP_CONCAT(tes_wawancaras.created_at SEPARATOR "::"),
                            "::",
                            GROUP_CONCAT(tes_wawancaras.updated_at SEPARATOR "::")) AS skornya'
                    )
                )
                ->leftJoin('instrumen_wawancaras', 'tes_wawancaras.instrumen_id', '=', 'instrumen_wawancaras.id')
                ->groupBy('calon_id')
                ->whereIn('calon_id', $calons)
                // ->whereIn('calon_id', [6311])
                ->where('pewawancara_id', auth()->user()->id)
                ->get();
            $skornya = $wawancaras->pluck('skornya', 'calon_id');
            $listWawancara = $wawancaras->pluck('calon_id');
            $observasi = CalonObservasi::whereIn('calon_id', $listWawancara)->pluck('created_at', 'calon_id');
            $wawancaranya = Calon::whereIn('id', $listWawancara)
                ->orderBy('name', 'asc')
                ->get();

            if ($wawancaranya) {
                $no = 1;
                foreach ($wawancaranya as $w) {
                    $skor_ortu = $skor_siswa = '-';
                    $tgl_create_ortu = $tgl_create_siswa = "-";
                    $tgl_update_ortu = $tgl_update_siswa = "-";
                    $ins = explode("::", $skornya[$w->id]);
                    // dd($ins);
                    if (count($ins) == 8) {
                        if ($ins[0] == 'ortu') {
                            $skor_ortu = $ins[2];
                            $skor_siswa = $ins[3];
                            $tgl_create_ortu = formatIndo($ins[4]);
                            $tgl_create_siswa = formatIndo($ins[5]);
                            $tgl_update_ortu = formatIndo($ins[6]);
                            $tgl_update_siswa = formatIndo($ins[7]);
                        }
                        if ($ins[0] == 'siswa') {
                            $skor_ortu = $ins[3];
                            $skor_siswa = $ins[2];
                            $tgl_create_ortu = formatIndo($ins[5]);
                            $tgl_create_siswa = formatIndo($ins[4]);
                            $tgl_update_ortu = formatIndo($ins[7]);
                            $tgl_update_siswa = formatIndo($ins[6]);
                        }
                    }
                    if (count($ins) == 4) {
                        if (in_array('ortu', $ins)) {
                            $skor_ortu = $ins[1];
                            $tgl_create_ortu = formatIndo($ins[2]);
                            $tgl_update_ortu = formatIndo($ins[3]);
                        }
                        if (in_array('siswa', $ins)) {
                            $skor_siswa = $ins[1];
                            $tgl_create_siswa = formatIndo($ins[2]);
                            $tgl_update_siswa = formatIndo($ins[3]);
                        }
                    }
                    $tgl_observasi = isset($observasi[$w->id]) ? formatIndo($observasi[$w->id]) : '-';
                    $wawancara[$no] = [
                        'id' => $w->id,
                        'no' => $no,
                        'nama' => $w->name,
                        'no_pendaftaran' => $w->uruts,
                        'skor_ortu' => $skor_ortu,
                        'skor_siswa' => $skor_siswa,
                        'tgl_ortu' => $tgl_create_ortu,
                        'tgl_siswa' => $tgl_create_siswa,
                        'tgl_observasi' => $tgl_observasi
                    ];

                    $no++;
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

                        // cek kelengkapan seleksi
                        $adaseleksi = 0;
                        if ($calon) {
                            $kelengkapanseleksi = PraWawancara::where('calon_id', $calon->id)->get();
                            $adaseleksi = $kelengkapanseleksi->count();
                        }
                        // cek Wawancara Ortu
                        $adawawancaraortu = 0;
                        // $tesWawancaraortu = TesWawancara::where('calon_id', $calon->id)->first();
                        // $jawabanTes = $tesWawancaraortu->jawaban;
                        // $catatanTes = $tesWawancaraortu->catatan;
                        // $jawaban = array();
                        // $catatan = array();
                        // foreach ($jawabanTes as $k => $t) {
                        //     $jawaban[$k] = $t;
                        // }
                        // foreach ($catatanTes as $k => $t) {
                        //     $catatan[$k] = $t;
                        // }

                        //Cek Intrumen ortu
                        // $instrumenortu = InstrumenWawancara::whereId($tesWawancaraortu->instrumen_id)->orderBy('singkatan', 'asc')->get();

                        //cek Rubrik
                        // $rubrikortu = Rubrik::where('id_instrumen', $tesWawancaraortu->instrumen_id)->orderBy('id', 'asc')->get();
                        // $pg = $rubrikortu->pluck('rubrik', 'id')->toArray();

                        // AKHIR CEK WAWANCARA


                        //cek instrumennya bener gak
                        $instrumen = InstrumenWawancara::where('singkatan', $modelWawancara)->where('instrumen', 'like', '%' . $cari . '%')->first()->id;
                        $rubrik = Rubrik::where('id_instrumen', $instrumen)->orderBy('id', 'asc')->get();
                        $lengkap = 0;
                        $rubriknya = $rubrik->pluck('id');
                        $jawabannya = array();

                        // cek apakah pewawancaranya atau bukan
                        // $cekPewawancara = TesWawancara::where('calon_id', $calon->id)->first();
                        // if ($cekPewawancara) {
                        //     if (auth()->user()->id !== $cekPewawancara->pewawancara_id) {
                        //         return view('tes_wawancara.index', compact('modelWawancara', 'wawancara'))->with('message', 'No. Pendaftaran : ' . $calon->uruts . ' sudah di wawancarai oleh pewawancara yang lain.');
                        //     }
                        // }

                        if ($calon) {
                            //cek Jawaban
                            $mulai = $start = $finish = $itung = 0;
                            $waktu = 1800; //30 menit
                            $j = TesWawancara::where('calon_id', $calon->id)
                                ->where('instrumen_id', $instrumen)
                                ->first();

                            // dd($j);
                            if ($j) {
                                // cek apakah pewawancaranya atau bukan
                                if (auth()->user()->id !== $j->pewawancara_id) {
                                    return view('tes_wawancara.index', compact('modelWawancara', 'wawancara'))->with('message', 'No. Pendaftaran : ' . $calon->uruts . ' sudah di wawancarai oleh pewawancara yang lain.');
                                }

                                $jawabannya = [
                                    0 => $j->jawaban,
                                    1 => $j->catatan
                                ];
                                $itung = count($rubriknya);
                                foreach ($rubriknya as $r) {
                                    if ($start == 0) {
                                        $start = $r;
                                    }
                                    if (empty($j->jawaban[$r]) || $j->jawaban[$r] == 0) {
                                        $finish = $r;
                                        break;
                                    }
                                }
                                //hitung berapa lama lagi waktunya
                                // $diff = Carbon::createFromTimestamp($j->created_at->timestamp)->diffInSeconds(createFromTimestamp($j->updated_at->timestamp));
                                $diff = $j->updated_at->diffInSeconds($j->created_at);
                                $waktu = $waktu - $diff;
                                $mulai = $finish > $start ? $finish : $start;
                                // $mulai = count($jawabannya[0]);
                                if ($itung == count($jawabannya[0])) {
                                    $data = TesWawancara::updateOrCreate([
                                        'calon_id' => $calon->id,
                                        'instrumen_id' => $instrumen
                                    ], [
                                        'rubrik' => $itung,
                                        'status' => 1
                                    ]);
                                    $lengkap = 1;
                                    // return redirect('tesWawancara');
                                    // return view('tes_wawancara.index', compact('modelWawancara', 'wawancara'));
                                }
                            }
                            // dd($jawabannya);
                            return view('tes_wawancara.index', compact('modelWawancara', 'calon', 'rubrik', 'instrumen', 'jawabannya', 'mulai', 'waktu', 'kelengkapanseleksi', 'adaseleksi', 'adawawancaraortu', 'lengkap'));
                        } else {
                            return view('tes_wawancara.index', compact('modelWawancara'))->with('message', 'No. Pendaftaran : ' . $pendaftaran . ' tidak ditemukan.');
                        }
                    } else {
                        return view('tes_wawancara.index', compact('modelWawancara', 'wawancara'))->with('message', 'No. Pendaftaran : ' . $pendaftaran . ' bukan di tahun ajaran ini.');
                    }
                }
                return view('tes_wawancara.index', compact('modelWawancara', 'wawancara'));
            }
            return view('tes_wawancara.index', compact('wawancara'));
        }
    }

    public function PDFWawancara($id)
    {
        // Cek jawaban dan catatanya
        $tesWawancara = TesWawancara::with('usernya')->whereId($id)->first();
        $jawabanTes = $tesWawancara->jawaban;
        $catatanTes = $tesWawancara->catatan;
        $jawaban = array();
        $catatan = array();
        foreach ($jawabanTes as $k => $t) {
            $jawaban[$k] = $t;
        }
        foreach ($catatanTes as $k => $t) {
            $catatan[$k] = $t;
        }

        // dd($jawaban);
        $pewawancara = $tesWawancara->usernya->name;
        $tanggalWawancara = formatIndo($tesWawancara->created_at);

        //Cek Intrumen
        $instrumen = InstrumenWawancara::whereId($tesWawancara->instrumen_id)->orderBy('singkatan', 'asc')->get();

        //cek Rubrik
        $rubrik = Rubrik::where('id_instrumen', $tesWawancara->instrumen_id)->orderBy('id', 'asc')->get();
        $pg = $rubrik->pluck('rubrik', 'id')->toArray();

        //cek lengkap atau tidak
        if (count($jawaban) !== $rubrik->count() || count($catatan) !== $rubrik->count()) {
            dd("BELUM LENGKAP");
        }

        $calon = DB::table('calons')
            ->select(
                'calons.id',
                'calons.name',
                'jk',
                'units.name AS unit',
                'pindahan',
                'kelasnyas.name as kelas',
                'gelombangs.kode_va',
                'urut',
                DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
            )
            ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
            ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
            ->leftJoin('calon_tagihan_p_s_b_s', 'calons.id', '=', 'calon_tagihan_p_s_b_s.calon_id')
            ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
            ->where('calons.status', 1)
            ->where('calons.aktif', true)
            ->where('calons.id', $tesWawancara->calon_id)
            ->first();

        $pdf = PDF::loadView('pdf.seleksiWawancara', compact('calon', 'rubrik', 'tesWawancara', 'pewawancara', 'tanggalWawancara', 'instrumen', 'jawaban', 'catatan', 'pg'));
        return $pdf->stream('');
    }

    public function store(Request $request)
    {
        $balikin = array();
        $catatan = array();

        if ($request->selesai === 'selesai') {
            if (auth()->user()->isAdmin() || auth()->user()->isPewawancara()) {
                if ($request->modelWawancara === 'siswa') {
                    return redirect()->route('observasiPPDB', ['id' => $request->calon_id]);
                    dd('Goto Pengamatan');
                }
            }
            return redirect()->route('tesWawancara');
        }

        if (auth()->user()->isAdmin() || auth()->user()->isPewawancara()) {
            $rubrik = 0;
            $skor = 0;
            $rubrik = Rubrik::where('id_instrumen', $request['instrumen_id'])->orderBy('id', 'asc')->get()->count();

            // if ($request->selesai) {
            foreach ($request->jawaban as $r) {
                $skor = $skor + intval($r);
            }
            // }

            $data = TesWawancara::updateOrCreate([
                'calon_id' => $request['calon_id'],
                'instrumen_id' => $request['instrumen_id']
            ], [
                'pewawancara_id' => auth()->user()->id,
                'jawaban' => $request->jawaban,
                'catatan' => $request->catatan,
                'skor' => $skor,
                'rubrik' => $rubrik,
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


    public function editObservasi($id)
    {
        // dd($id);

    }

    public function observasi(Request $request)
    {
        //cek edit bukan??
        if ($request->editdulu === 'eko') {
            $calon = DB::table('calons')
                ->select(
                    'calons.id',
                    'calons.name',
                    'jk',
                    'units.name AS unit',
                    'pindahan',
                    'kelasnyas.name as kelas',
                    'gelombangs.kode_va',
                    'urut',
                    DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
                )
                ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                ->leftJoin('calon_tagihan_p_s_b_s', 'calons.id', '=', 'calon_tagihan_p_s_b_s.calon_id')
                ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
                ->where('calons.status', 1)
                ->where('calons.aktif', true)
                ->where('calons.id', $request->id)
                ->first();
            // dd($calon);
            $pewawancara = auth()->user()->name;
            $observasi = AspekPerilaku::orderBy('id', 'asc')->get();
            $cekObservasi = CalonObservasi::where('calon_id', $request->id)->first();

            if (auth()->user()->isAdmin() || auth()->user()->isPewawancara()) {
                if ($cekObservasi->observer_id === auth()->user()->id) {
                    return view('tes_wawancara.observasi', compact('calon', 'pewawancara', 'observasi', 'cekObservasi'));
                }
            }
        }

        //cek teswawancara
        $data = TesWawancara::where('calon_id', $request->id)->get();
        $cek = 0;
        if ($data->count() > 0) {
            foreach ($data as $d) {
                $pilihanWawancara = InstrumenWawancara::whereId($d->instrumen_id)->where('singkatan', 'siswa')->first() ?? 'kosong';
                if ($pilihanWawancara <> 'kosong') {
                    $cek = 1;
                }
            }
        }
        if ($cek == 0) {
            return redirect()->route('tesWawancara');
        }
        if ($cek == 1) {
            // $calon = Calon::whereId($request->id)->where('status', 1)->first();
            $calon = DB::table('calons')
                ->select(
                    'calons.id',
                    'calons.name',
                    'jk',
                    'units.name AS unit',
                    'pindahan',
                    'kelasnyas.name as kelas',
                    'gelombangs.kode_va',
                    'urut',
                    DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
                )
                ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                ->leftJoin('calon_tagihan_p_s_b_s', 'calons.id', '=', 'calon_tagihan_p_s_b_s.calon_id')
                ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
                ->where('calons.status', 1)
                ->where('calons.aktif', true)
                ->where('calons.id', $request->id)
                ->first();
            // dd($calon);
            $pewawancara = auth()->user()->name;
            $observasi = AspekPerilaku::orderBy('id', 'asc')->get();

            if (auth()->user()->isAdmin() || auth()->user()->isPewawancara()) {
                return view('tes_wawancara.observasi', compact('calon', 'pewawancara', 'observasi'));
            }
        }
    }

    public function simpanObservasi(Request $request)
    {
        $data = CalonObservasi::updateOrCreate([
            'calon_id' => $request->calon_id,
            'observer_id' => auth()->user()->id,
            'poin' => $request->yatidak,
            'catatan' => $request->uraian,
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('tesWawancara');
    }

    // public function update(Request $request, Faq $faq)
    // {
    //     $faq->update($request->all());
    // }

    public function export()
    {
        if (auth()->user()->isAdmin()) {
            return Excel::download(new SeleksiWawancaraExport, 'Seleksi_Wawancara.xlsx');
        }
    }

    public function exportWaiting(Request $request)
    {
        if (auth()->user()->isAdmin()) {
            $name = $request->name ?? '-';
            $unit = $request->unit ?? '-';
            $tp = $request->ta ?? '-';

            return Excel::download(new WaitingExport($name . '_' . $unit . '_' . $tp), 'Waiting_List.xlsx');
        }
    }

    public function exportData($export, $unitnya)
    {
        set_time_limit(0);
        ini_set('memory_limit', '512M');

        if (auth()->user()->isAdmin()) {
            if ($export == 'excel') {
                return Excel::download(new SeleksiWawancaraExport($unit), 'Seleksi_Wawancara.xlsx');
            }

            if ($export == 'pdf') {
                // Get Unit name
                $units = explode('::', $unitnya);
                $unit = $units[0];
                $awal = $units[1];
                $akhir = $units[2];
                $unitnyadonk = Unit::whereId($unit)->first();

                // Cek Intrumen dari Unit yg akan di print
                $instrumen = InstrumenWawancara::where('unit_id', 'like', '%' . $unit . '%')->orderBy('singkatan', 'asc')->get()->pluck('id');

                $jawaban = array();
                $catatan = array();

                foreach ($instrumen as $i) {
                    // Buat Array untuk rubrik-rubrik berdasarkan instrumen_id
                    $rubrik[$i] = Rubrik::where('id_instrumen', $i)->orderBy('id', 'asc')->get();
                    $pg[$i] = $rubrik[$i]->pluck('rubrik', 'id')->toArray();
                }
                $tesWawancara = TesWawancara::with('usernya', 'instrumennya', 'calonnya')
                    ->whereIn('instrumen_id', $instrumen)
                    ->orderBy('calon_id', 'asc')
                    ->orderBy('instrumen_id', 'asc')
                    ->skip($awal)->take($akhir)
                    ->get();

                foreach ($tesWawancara as $tw) {
                    $jawabanTes = array();
                    $catatanTes = array();

                    $jawabanTes = $tw->jawaban;
                    $catatanTes = $tw->catatan;
                    foreach ($jawabanTes as $k => $t) {
                        $jawaban[$tw->calon_id][$k] = $t;
                    }
                    foreach ($catatanTes as $k => $t) {
                        $catatan[$tw->calon_id][$k] = $t;
                    }
                }

                $pdf = PDF::loadView('pdf.seleksiWawancaraAll', compact('rubrik', 'pg', 'tesWawancara', 'jawaban', 'catatan', 'instrumen'));
                return $pdf->download('Seleksi Wawancara ' . $unitnyadonk->name . ' - ' . $awal + 1 . ' sd ' . $akhir + 1 . '.pdf');
                // return $pdf->stream('');
            }
        }
    }

    public function harapan()
    {
        $rubriks = Rubrik::where('butir', 'like', '%Apa alasan Kamu memilih%')->get();
        $jawabans = TesWawancara::with('usernya', 'instrumennya', 'calonnya')->get();

        $data = array();
        $no = 0;

        foreach ($jawabans as $js) {
            $jawaban = $js->jawaban;
            foreach ($rubriks as $r) {
                if (array_key_exists(strval($r->id), $jawaban)) {
                    $nojawabannya = $jawaban[strval($r->id)];
                    $rubriknya = $r->rubrik;
                    $jawabannya = $rubriknya[$nojawabannya];
                    $catatannya = $js->catatan;

                    $data[$no] = [
                        'pendaftaran' => $js->calonnya->uruts,
                        'nama' => $js->calonnya->name,
                        'pertanyaan' => $r->butir,
                        'jawaban' => $jawabannya,
                        'catatan' => $catatannya[strval($r->id)],
                    ];
                }
            }
            $no++;
        }

        return view('harapan', compact('data'));
        // return Excel::download(new HarapanExport($unit), 'Seleksi_Wawancara.xlsx');
    }


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

<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Kota;
use App\Calon;
use App\Agama;
use App\BiayaTes;
use App\Kelasnya;
use App\Provinsi;
use App\Kecamatan;
use App\Kelurahan;
use App\Pekerjaan;
use App\Gelombang;
use App\Agreement;
use App\Pendidikan;
use App\DraftCalon;
use App\SumberInfo;
use App\Penghasilan;
use App\CalonBiayaTes;
use App\CalonKategori;
use App\SchoolCategory;
use App\TahunPelajaran;

use App\Facades\Edupay;
use App\Facades\Maja;
use App\Notifications\Wa;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\FileController;

class DraftCalonController extends Controller
{
    protected $FileController;
    public function __construct(FileController $FileController)
    {
        $this->FileController = $FileController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($l = null)
    {
        $tp = TahunPelajaran::where('status', 1)->first();
        $gelombang = Gelombang::where('tp', $tp->id)->whereDate('start', '<=', date('Y-m-d'))->orderBy('start', 'asc')->first();

        $ages = $min_age = date('Y-m-d');
        $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $age = date('d', strtotime($ages)) . ' ' . $bulan[(date('m', strtotime($ages)) - 1)] . ' ' . date('Y', strtotime($ages));

        $pilihan = [
            ['name' => 'Pilih Unit/Kelas', 'icon' => 'fas fa-school'],
            ['name' => 'Orang Tua', 'icon' => 'fas fa-users'],
            ['name' => 'Data Pribadi', 'icon' => 'fas fa-user'],
            ['name' => 'Form Persetujuan', 'icon' => 'fas fa-handshake'],
        ];

        // Cek apakah sudah mulai belum pendaftarannya
        if (!$gelombang) {
            $start = date('M d, Y H:i:s', strtotime(date('Y') . '-09-01'));
            $step = 0;
            return view('user.create', compact('step', 'pilihan', 'age', 'min_age', 'start'));
        }

        if (is_null($l)) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            if ($calon) {
                $step = $calon->step;
            } else {
                $step = 1;
            }
        } else {
            $step = 1;
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            if ($calon) {
                $step = $calon->step;
            }
            if ($l <= $step && $step > 3) {
                if ($l < 4) {
                    $step = 4;
                } else {
                    $step = $l;
                }
            }
        }

        if ($step == 1) {
            return view('user.create', compact('step', 'pilihan', 'age', 'min_age'));
        }

        if ($step == 2) {
            $ok = $calon->pindahan;
            $csma = '';
            if ($ok === 1) {
                $cekkelas = Kelasnya::where('status', 1)
                    ->whereIn('tahun_ajaran', [0, 2])
                    ->get()
                    ->groupBy('unit_id')->keys()->toArray();
            } else {
                $cekkelas = Kelasnya::where('status', 1)
                    ->whereIn('tahun_ajaran', [0])
                    ->get()
                    ->groupBy('unit_id')->keys()->toArray();

                $ceksma = Kelasnya::where('status', 1)->where('name', '10')->first();
                if ($ceksma) {
                    $csma = $ceksma->jurusan;
                }
            }

            $units = Unit::with('catnya')->whereIn('id', $cekkelas)->orderBy('id', 'asc')->get();
            return view('user.create', compact('step', 'pilihan', 'age', 'min_age', 'units', 'calon', 'csma'));
        }

        if ($step == 3) {
            return view('user.create', compact('step', 'pilihan', 'age', 'min_age'));
        }

        if ($step == 4) {
            $infos = SumberInfo::orderBy('id', 'asc')->get();
            $agama = Agama::orderBy('id', 'asc')->get();
            $ages = $min_age = Gelombang::where('id', $calon->gel_id)->first()->minimum_age;
            $age = date('d', strtotime($ages)) . ' ' . $bulan[(date('m', strtotime($ages)) - 1)] . ' ' . date('Y', strtotime($ages));

            return view('user.create', compact('step', 'pilihan', 'age', 'min_age', 'calon', 'agama', 'infos'));
        }

        if ($step == 5) {
            $provinsi = Provinsi::orderBy('name', 'asc')->get();
            $kota = $kecamatan = $kelurahan = "";
            if ($calon->provinsi) {
                $kota = Kota::where('prov_id', $calon->provinsi)->get();
                if ($calon->kota) {
                    $kecamatan = Kecamatan::where('kota_id', $calon->kota)->get();
                    if ($calon->kecamatan) {
                        $kelurahan = Kelurahan::where('camat_id', $calon->kecamatan)->get();
                    }
                }
            }
            return view('user.create', compact('step', 'pilihan', 'age', 'min_age', 'calon', 'provinsi', 'kota', 'kecamatan', 'kelurahan'));
        }

        if ($step == 6) {
            $pendidikan = Pendidikan::orderBy('id', 'asc')->get();
            $pekerjaan = Pekerjaan::orderBy('id', 'asc')->get();
            $penghasilan = Penghasilan::orderBy('id', 'asc')->get();
            return view('user.create', compact('step', 'pilihan', 'age', 'min_age', 'calon', 'pendidikan', 'pekerjaan', 'penghasilan'));
        }

        if ($step == 7) {
            $provinsi = Provinsi::orderBy('name', 'asc')->get();
            $kota = $kecamatan = $kelurahan = "";
            if ($calon->asal_propinsi_sekolah) {
                $kota = Kota::where('prov_id', $calon->asal_propinsi_sekolah)->get();
                if ($calon->asal_kota_sekolah) {
                    $kecamatan = Kecamatan::where('kota_id', $calon->asal_kota_sekolah)->get();
                    if ($calon->asal_kecamatan_sekolah) {
                        $kelurahan = Kelurahan::where('camat_id', $calon->asal_kecamatan_sekolah)->get();
                    }
                }
            }
            return view('user.create', compact('step', 'pilihan', 'age', 'min_age', 'calon', 'provinsi', 'kota', 'kecamatan', 'kelurahan'));
        }

        if ($step == 8) {
            $agreement = Agreement::orderBy('id', 'asc')->get();
            return view('user.create', compact('step', 'pilihan', 'age', 'min_age', 'calon', 'agreement'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->step == 1) {
            if ($request->pindahan == 'ya') {
                $ok = true;
            }

            if ($request->pindahan == 'tidak') {
                $ok = false;
            }

            $calon = DraftCalon::updateOrCreate(
                [
                    'user_id' => auth()->user()->id,
                ],
                [
                    'tgl_daftar' => date('Y-m-d'),
                    'pindahan' => $ok,
                    'step' => 2,
                    'user_id' => auth()->user()->id,
                ]
            );

            $step = 2;
        }

        if ($request->step == 2) {
            $gelombang = Gelombang::where('unit_id', $request->unit)->latest()->first()->id;
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $jurusan = '-';

            if ($calon->pindahan) {
                $ceksma = substr($request->kelas_tujuan, -4);
                if ($ceksma == 'MIPA' || $ceksma == '-IPS') {
                    $k = explode('-', $request->kelas_tujuan);
                    $kelas = $k[0];
                    $jurusan = $ceksma;
                    if ($ceksma == '-IPS') {
                        $jurusan = 'IPS';
                    }
                } else {
                    $kelas = $request->kelas_tujuan;
                }
            }

            if (!$calon->pindahan) {
                $ceksma = substr($request->unit, -4);
                if ($ceksma == 'MIPA' || $ceksma == '-IPS') {
                    $jurusan = $ceksma;
                    if ($ceksma == '-IPS') {
                        $jurusan = 'IPS';
                    }
                }
                $unit = Unit::where('id', $request->unit)->first()->cat_id;
                $cat = SchoolCategory::where('id', $unit)->first()->name;
                if ($cat === 'TK') {
                    $kelas = $request->kelas_tujuan;
                }
                if ($cat === 'SD') {
                    $kelas = Kelasnya::where('name', '1')->first()->id;
                }
                if ($cat === 'SMP') {
                    $kelas = Kelasnya::where('name', '7')->first()->id;
                }
                if ($cat === 'SMA') {
                    $kelas = Kelasnya::where('name', '10')->first()->id;
                }
            }
            $calon->update([
                'gel_id' => $gelombang,
                'kelas_tujuan' => $kelas,
                'step' => 3,
                'jurusan' => $jurusan
            ]);

            $step = 3;
        }

        if ($request->step == 3) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $cek = 1;
            if ($calon) {
                if ($calon->ck_id === 2) {
                    $cek = 2;
                }
                if ($calon->ck_id === 3) {
                    $cek = 3;
                }
            }
            if ($request->asal_nf) {
                $calon->update([
                    'ck_id' => $cek,
                    'asal_nf' => true,
                    'step' => 4,
                ]);

                $unit = Unit::where('id', $calon->unit)->first()->cat_id;
                $cat = SchoolCategory::where('id', $unit)->first()->name;
                if ($cat === 'SD') {
                    $calon->update([
                        'asal_sekolah' => 'TKIT Nurul Fikri',
                        'asal_alamat_sekolah' => 'Jalan Haji Rijin No. 100',
                        'asal_provinsi_sekolah' => 32,
                        'asal_kota_sekolah' => 3276,
                        'asal_kecamatan_sekolah' => 3276040,
                        'asal_kelurahan_sekolah' => 3276040012,
                    ]);
                }
                if ($cat === 'SMP') {
                    $calon->update([
                        'asal_sekolah' => 'SDIT Nurul Fikri',
                        'asal_alamat_sekolah' => 'Jl. Tugu Raya No. 61 Kelapa Dua',
                        'asal_provinsi_sekolah' => 32,
                        'asal_kota_sekolah' => 3276,
                        'asal_kecamatan_sekolah' => 3276040,
                        'asal_kelurahan_sekolah' => 3276040012,
                    ]);
                }
                if ($cat === 'SMA') {
                    $calon->update([
                        'asal_sekolah' => 'SMPIT Nurul Fikri',
                        'asal_alamat_sekolah' => 'Jl. Tugu Raya No. 61 Kelapa Dua',
                        'asal_provinsi_sekolah' => 32,
                        'asal_kota_sekolah' => 3276,
                        'asal_kecamatan_sekolah' => 3276040,
                        'asal_kelurahan_sekolah' => 3276040012,
                    ]);
                }
                $calon->update([
                    'ck_id' => $cek,
                    'asal_nf' => true,
                    'step' => 4,
                ]);
            } else {
                $calon->update([
                    'ck_id' => $cek,
                    'asal_nf' => false,
                    'step' => 4,
                ]);
            }

            $step = 4;
        }

        if ($request->step == 4) {
            $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            $pecah_tgl = explode(' ', $request->tgl_lahir);
            $m = (array_search($pecah_tgl[1], $bulan)) + 1;

            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $calon->update([
                'name' => $request->name,
                'panggilan' => $request->panggilan,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $pecah_tgl[2] . '-' . $m . '-' . $pecah_tgl[0],
                'jk' => $request->jk,
                'agama' => $request->agama,
                // 'nisn' => $request->nisn,
                // 'nik' => $request->nik,
                // 'info' => $request->info,
                // 'rencana_masuk' => $request->rencana_masuk,
                // 'step' => 5,
                'step' => 8,
            ]);

            // 'step' => 5,
            $step = 8;
        }

        if ($request->step == 5) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $calon->update($request->except('step') + ['step' => 6]);

            $step = 6;
        }

        if ($request->step == 6) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $calon->update($request->except('step') + ['step' => 7]);

            $step = 7;
            if ($calon->asal_nf == 1) {
                $calon->update(['step' => 8]);
                $step = 8;
            }
        }

        if ($request->step == 7) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $calon->update($request->except(
                'step',
                'provinsi',
                'kota',
                'kecamatan',
                'kelurahan'
            ) + [
                'step' => 8,
                'asal_propinsi_sekolah' => $request->provinsi,
                'asal_kota_sekolah' => $request->kota,
                'asal_kecamatan_sekolah' => $request->kecamatan,
                'asal_kelurahan_sekolah' => $request->kelurahan,
            ]);

            $step = 8;
        }

        if ($request->step == 8) {
            $draft = DraftCalon::where('user_id', auth()->user()->id)->first();
            $urut = Calon::where('gel_id', $draft['gel_id'])->get()->count();

            $calon = Calon::updateOrCreate([
                'gel_id' => $draft['gel_id'],
                'ck_id' => $draft['ck_id'],
                'tgl_daftar' => date('Y-m-d'),
                'urut' => $urut + 1,
                'nik' => $draft['nik'],
                'nisn' => $draft['nisn'],
                'name' => $draft['name'],
                'panggilan' => $draft['panggilan'],
                'jk' => $draft['jk'],
                'kelas_tujuan' => $draft['kelas_tujuan'],
                'jurusan' => $draft['jurusan'],
                'photo' => 'Belum Ada',
                'tempat_lahir' => $draft['tempat_lahir'],
                'tgl_lahir' => $draft['tgl_lahir'],
                'agama' => $draft['agama'],
                'rencana_masuk' => $draft['rencana_masuk'],
                'info' => $draft['info'],
                'status' => false,
                'setuju' => $draft['setuju'],
                'user_id' => auth()->user()->id,
                // 'alamat' => $draft['alamat'],
                // 'rt' => $draft['rt'],
                // 'rw' => $draft['rw'],
                // 'kodepos' => $draft['kodepos'],
                // 'provinsi' => $draft['provinsi'],
                // 'kota' => $draft['kota'],
                // 'kecamatan' => $draft['kecamatan'],
                // 'kelurahan' => $draft['kelurahan'],
                // 'phone' => $draft['phone'],
                // 'ayah_nama' => $draft['ayah_nama'],
                // 'ayah_pendidikan' => $draft['ayah_pendidikan'],
                // 'ayah_pekerjaan' => $draft['ayah_pekerjaan'],
                // 'ayah_penghasilan' => $draft['ayah_penghasilan'],
                // 'ayah_hp' => $draft['ayah_hp'],
                // 'ayah_email' => $draft['ayah_email'],
                // 'ibu_nama' => $draft['ibu_nama'],
                // 'ibu_pendidikan' => $draft['ibu_pendidikan'],
                // 'ibu_pekerjaan' => $draft['ibu_pekerjaan'],
                // 'ibu_penghasilan' => $draft['ibu_penghasilan'],
                // 'ibu_hp' => $draft['ibu_hp'],
                // 'ibu_email' => $draft['ibu_email'],
                'asal_nf' => $draft['asal_nf'],
                'pindahan' => $draft['pindahan'],
                'tahun_sekarang' => $draft['tahun_sekarang'],
                'asal_sekolah' => $draft['asal_sekolah'],
                'asal_alamat_sekolah' => $draft['asal_alamat_sekolah'],
                'asal_propinsi_sekolah' => $draft['asal_propinsi_sekolah'],
                'asal_kota_sekolah' => $draft['asal_kota_sekolah'],
                'asal_kecamatan_sekolah' => $draft['asal_kecamatan_sekolah'],
                'asal_kelurahan_sekolah' => $draft['asal_kelurahan_sekolah'],
            ]);

            $biaya = BiayaTes::where('gel_id', $draft['gel_id'])
                ->where('ck_id', $draft['ck_id'])
                ->get()->first();
            if ($biaya) {
                $maja = Maja::create($calon->uruts, $biaya->biaya, $calon->name, $calon->tgl_daftar, date("Y-m-d", strtotime("+3 days")), auth()->user()->email);
                $calonbiaya = CalonBiayaTes::updateOrCreate([
                    'calon_id' => $calon->id
                ], [
                    'biaya_id' => $biaya->id,
                    'idTransaction' => $maja->data->transactionId,
                    'expired' => date("Y-m-d", strtotime("+3 days"))
                ]);

                $calonsnya = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')->where('id', $calon->id)->first();
                // Wa::kirim(auth()->user()->phone,'Terima kasih Bapak/Ibu '.auth()->user()->name.', Data calon siswa telah kami simpan.
                // Silahkan melakukan proses pembayaran ke rekening Bank Syariah Indonesia (BSI) dengan nomor pendaftaran '.$calon->uruts.'.
                // Tatacara pembayaran dapat dilihat melalui laman web https://ppdb.nurulfikri.sch.id/biayapendaftaran');
                // Mail::send('emails.biayates', compact('calonsnya'), function ($m) use ($calonsnya)
                //     {
                //         $m->to($calonsnya->usernya->email, $calonsnya->name)->from('psb@nurulfikri.sch.id', 'Panitia PPDB SIT Nurul Fikri')->subject('Biaya Tes SIT Nurul Fikri');
                //     }
                // );
            }

            $draft->delete();
            return redirect()->route('ppdb');
        }
        return redirect('tambahcalon/' . $step);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DraftCalon  $draftCalon
     * @return \Illuminate\Http\Response
     */
    public function show(DraftCalon $draftCalon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DraftCalon  $draftCalon
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $step = 4)
    {
        $calon = Calon::whereId($id)->first();
        $ages = $calon->tgl_lahir;
        $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $age = date('d', strtotime($ages)) . ' ' . $bulan[(date('m', strtotime($ages)) - 1)] . ' ' . date('Y', strtotime($ages));
        $gel = Gelombang::whereId($calon->gel_id)->first();
        $min_age = $gel->minimum_age;

        $pilihan = [
            // ['name' => 'Pilih Unit/Kelas', 'icon' => 'fas fa-school'],
            // ['name' => 'Orang Tua', 'icon' => 'fas fa-users'],
            ['name' => 'Data Pribadi', 'icon' => 'fas fa-user'],
            ['name' => 'Data Alamat', 'icon' => 'fas fa-home'],
            ['name' => 'Data Orang Tua', 'icon' => 'fas fa-users'],
            ['name' => 'Data Asal Sekolah', 'icon' => 'fas fa-school'],
            // ['name' => 'Form Persetujuan', 'icon' => 'fas fa-handshake'],
        ];

        if (!$calon) {
            return redirect()->route('home');
        }

        if ($step == 4) {
            $infos = SumberInfo::where('status', 1)->orderBy('id', 'asc')->get();
            $agama = Agama::orderBy('id', 'asc')->get();

            return view('user.edit', compact('step', 'pilihan', 'age', 'min_age', 'calon', 'infos', 'agama'));
        }

        if ($step == 5) {
            $provinsi = Provinsi::orderBy('name', 'asc')->get();
            $kota = $kecamatan = $kelurahan = "";
            if ($calon->provinsi) {
                $kota = Kota::where('prov_id', $calon->provinsi)->get();
                if ($calon->kota) {
                    $kecamatan = Kecamatan::where('kota_id', $calon->kota)->get();
                    if ($calon->kecamatan) {
                        $kelurahan = Kelurahan::where('camat_id', $calon->kecamatan)->get();
                    }
                }
            }
            return view('user.edit', compact('step', 'pilihan', 'age', 'min_age', 'calon', 'provinsi', 'kota', 'kecamatan', 'kelurahan'));
        }

        if ($step == 6) {
            $pendidikan = Pendidikan::orderBy('id', 'asc')->get();
            $pekerjaan = Pekerjaan::orderBy('id', 'asc')->get();
            $penghasilan = Penghasilan::orderBy('id', 'asc')->get();

            return view('user.edit', compact('step', 'pilihan', 'age', 'min_age', 'calon', 'pendidikan', 'pekerjaan', 'penghasilan'));
        }

        if ($step == 7) {
            $provinsi = Provinsi::orderBy('name', 'asc')->get();
            $kota = $kecamatan = $kelurahan = "";
            if ($calon->asal_propinsi_sekolah) {
                $kota = Kota::where('prov_id', $calon->asal_propinsi_sekolah)->get();
                if ($calon->asal_kota_sekolah) {
                    $kecamatan = Kecamatan::where('kota_id', $calon->asal_kota_sekolah)->get();
                    if ($calon->asal_kecamatan_sekolah) {
                        $kelurahan = Kelurahan::where('camat_id', $calon->asal_kecamatan_sekolah)->get();
                    }
                }
            }
            $edited = '';
            if ($calon->asal_nf == 1) {
                $edited = 'disabled';
            }
            return view('user.edit', compact('step', 'pilihan', 'age', 'min_age', 'calon', 'provinsi', 'kota', 'kecamatan', 'kelurahan', 'edited'));
        }

        // return redirect()->route('home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DraftCalon  $draftCalon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $calon = Calon::whereId($request->id)->where('user_id', auth()->user()->id)->first();
        if ($request->step == 4) {
            $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            $pecah_tgl = explode(' ', $request->tgl_lahir);
            $m = (array_search($pecah_tgl[1], $bulan)) + 1;

            $data = $request->only('name', 'panggilan', 'tempat_lahir', 'jk', 'agama', 'nik', 'nisn', 'info') + ['tgl_lahir' => $pecah_tgl[2] . '-' . $m . '-' . $pecah_tgl[0],];
            $step = 5;
        }

        if ($request->step == 5) {
            $data = $request->only('alamat', 'provinsi', 'kota', 'kecamatan', 'kelurahan', 'rt', 'rw', 'kodepos');
            $step = 6;
        }

        if ($request->step == 6) {
            $data = $request->only('ayah_nama', 'ayah_nik', 'ayah_pendidikan', 'ayah_pekerjaan', 'ayah_penghasilan', 'ayah_hp', 'ayah_email', 'ibu_nama', 'ibu_nik', 'ibu_pendidikan', 'ibu_pekerjaan', 'ibu_penghasilan', 'ibu_hp', 'ibu_email');
            $step = 7;
        }

        if ($request->step == 7) {
            $data = $request->only('asal_sekolah', 'asal_alamat_sekolah') + [
                'asal_propinsi_sekolah' => $request->provinsi,
                'asal_kota_sekolah' => $request->kota,
                'asal_kecamatan_sekolah' => $request->kecamatan,
                'asal_kelurahan_sekolah' => $request->kelurahan,
            ];
            $step = 'done';
        }

        if ($calon) {
            $calon->update($data);
            if ($step !== 'done') {
                return redirect('editcalon/' . $request->id . '/' . $step);
            }
        }

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DraftCalon  $draftCalon
     * @return \Illuminate\Http\Response
     */
    public function destroy(DraftCalon $draftCalon)
    {
        $draft = DraftCalon::where('user_id', auth()->user()->id)->first();
        $draft->delete();

        return redirect()->route('ppdb');
    }

    public function jurusan(Request $request)
    {
        try {
            $calon = Calon::whereId($request->id)->first();
            $calon->update([
                'jurusan' => $request->jurusan
            ]);
            return 'OKE';
        } catch (\Illuminate\Database\QueryException $e) {
            return 'EKO';
        }
    }

    public function photo($id)
    {
        $calon = Calon::where('id', $id)->where('user_id', auth()->user()->id)->first();
        return view('photo.create', compact('calon'));
    }

    public function photopp(Request $request)
    {
        $response = $this->FileController->upload($request->file('file'), 'pp', $request->id);
        return redirect()->route('ppdb');
    }
}

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

use App\Pegawai;
use App\Simmsit;

use App\Facades\Edupay;
use App\Facades\Maja;
use App\Notifications\Wa;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\FileController;
use App\SiswaNF;
use Illuminate\Support\Arr;

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
            ['no' => 1, 'icon' => 'mdi mdi-town-hall'],
            ['no' => 2, 'icon' => 'mdi mdi-account-group'],
            ['no' => 4, 'icon' => 'mdi mdi-account'],
            ['no' => 8, 'icon' => 'mdi mdi-handshake'],
        ];

        // Cek apakah sudah mulai belum pendaftarannya
        if (!$gelombang) {
            $start = date('M d, Y H:i:s', strtotime(date('Y') . '-09-01'));
            $step = 0;
            // return view('user.create', compact('step', 'pilihan', 'age', 'min_age', 'start'));
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
            if ($l <= $step && $step > 6) {
                if ($l < 6) {
                    $step = 6;
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
                $cekunit = Kelasnya::where('status', 1)
                    ->whereIn('tahun_ajaran', [0, 2])
                    ->get()
                    ->groupBy('unit_id')->keys()->toArray();
            }
            if ($ok === 0) {
                $cekunit = Kelasnya::where('status', 1)
                    ->where('tahun_ajaran', 1)
                    ->get()
                    ->groupBy('unit_id')->keys()->toArray();
            }

            $units = Unit::with('catnya')->whereIn('id', $cekunit)->orderBy('id', 'asc')->get();
            return view('user.create', compact('step', 'pilihan', 'age', 'min_age', 'units', 'calon'));
        }

        if ($step == 3) {
            $csma = '';

            $cekunit = Gelombang::whereId($calon->gel_id)->first()->unit_id;
            $cekkelas = Kelasnya::where('status', 1)
                ->where('unit_id', $cekunit)
                ->whereIn('tahun_ajaran', [0, 2])
                ->get();
            if ($cekunit == 1) {
                $cekkelas = Kelasnya::where('status', 1)
                    ->where('unit_id', $cekunit)
                    ->get();
            }
            return view('user.create', compact('step', 'pilihan', 'age', 'min_age', 'calon', 'csma', 'cekkelas', 'cekunit'));
        }

        if ($step == 4) {
            $cekunit = Gelombang::whereId($calon->gel_id)->first()->unit_id;
            return view('user.create', compact('step', 'cekunit', 'pilihan', 'age', 'min_age'));
        }

        if ($step == 5) {
            $cekunit = Gelombang::whereId($calon->gel_id)->first()->unit_id;
            return view('user.create', compact('step', 'cekunit', 'pilihan', 'age', 'min_age'));
        }

        if ($step == 6) {
            $cekunit = Gelombang::whereId($calon->gel_id)->first()->unit_id;
            return view('user.create', compact('step', 'cekunit', 'pilihan', 'age', 'min_age'));
        }

        if ($step == 7) {
            $infos = SumberInfo::orderBy('id', 'asc')->get();
            $agama = Agama::orderBy('id', 'asc')->get();
            $ages = $min_age = Gelombang::where('id', $calon->gel_id)->first()->minimum_age;
            // $age = date('d', strtotime($ages)) . ' ' . $bulan[(date('m', strtotime($ages)) - 1)] . ' ' . date('Y', strtotime($ages));
            $age = $ages;
            if ($calon->tgl_lahir) {
                $age = date('Y-m-d', strtotime($calon->tgl_lahir));
            }

            return view('user.create', compact('step', 'pilihan', 'age', 'min_age', 'calon', 'agama', 'infos'));
        }

        if ($step == 8) {
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

        if ($step == 9) {
            $pendidikan = Pendidikan::orderBy('id', 'asc')->get();
            $pekerjaan = Pekerjaan::orderBy('id', 'asc')->get();
            $penghasilan = Penghasilan::orderBy('id', 'asc')->get();
            return view('user.create', compact('step', 'pilihan', 'age', 'min_age', 'calon', 'pendidikan', 'pekerjaan', 'penghasilan'));
        }

        if ($step == 10) {
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

        if ($step == 11) {
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
            $tp = TahunPelajaran::where('status', 1)->first();
            $gelombang = Gelombang::where('unit_id', $request->unit)->where('tp', $tp->id)->first()->id;
            // $gelombang = Gelombang::where('unit_id', $request->unit)->where()->latest()->first()->id;
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();

            $cekUnit = Unit::whereId($request->unit)->first();
            if ($cekUnit->cat_id == 1 || $calon->pindahan == 1) {
                $calon->update(['gel_id' => $gelombang, 'step' => 3]);
                $step = 3;
            } else {
                $kelasTujuan = Kelasnya::where('unit_id', $cekUnit->cat_id)->where('status', 1)->whereIn('name', ['1', '7', '10'])->first();
                if (!$kelasTujuan) {
                    $step = 2;
                }
                $calon->update([
                    'gel_id' => $gelombang,
                    'kelas_tujuan' => $kelasTujuan->id,
                    'step' => 4,
                ]);
                $step = 4;
            }
        }

        if ($request->step == 3) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();

            $calon->update(['kelas_tujuan' => $request->kelas_tujuan, 'step' => 4]);
            $step = 4;
        }

        if ($request->step == 4) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            if ($calon) {
                $cek = $request->ck_id;
                if ($cek == 1) {
                    $asalNF = 0;
                    $step = 6;

                    $calon->update([
                        'ck_id' => $cek,
                        'asal_nf' => 0,
                        'step' => 7,
                    ]);
                }
                if ($cek == 2) {
                    $asalNF = 0;
                    $step = 6;

                    $calon->update([
                        'ck_id' => $cek,
                        'asal_nf' => 0,
                        'step' => 6,
                    ]);
                }
                if ($cek == 3) {
                    $asalNF = 0;
                    $step = 5;

                    $calon->update([
                        'ck_id' => $cek,
                        'asal_nf' => 0,
                        'step' => 5,
                    ]);
                }
            }
        }

        if ($request->step == 5) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            if ($calon) {
                if ($request->nip) {
                    $url = 'http://sdmsmart.nurulfikri.sch.id/api/api.php/AbsensiPegawaiNF/?id=' . $request->nip . '&sandi=' . $request->sdmsmart;
                    $obj = json_decode(file_get_contents($url), true);
                    if ($obj['message'] == 'Data show success') {
                        $cek = $obj['data'];
                        if (!empty($cek[0])) {
                            $calon->update([
                                'ck_id' => 3,
                                'step' => 6,
                            ]);
                            $step = 6;
                        } else {
                            $step = 5;
                            $notification = array(
                                'message' => 'Password Salah',
                                'alert-type' => 'error'
                            );
                            return redirect('tambahcalon/' . $step)->with($notification);
                        }
                    }
                }
            }
        }

        if ($request->step == 6) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            if ($calon) {
                $gelombang = Gelombang::whereId($calon->gel_id)->first();
                $unit = Unit::whereId($gelombang->unit_id)->first();
                $ta = (int)taAktif() - 1;

                if ($request->umum) {
                    $calon->update([
                        'asal_nf' => false,
                        'step' => 7,
                    ]);
                    $step = 7;
                } else {
                    if ($unit->cat_id == 2) {
                        $cekSimmsit = Simmsit::where('nama_unit', 'like', '%Depok')
                            ->where('nis', $request->nis)
                            ->where('tahun_ajaran', $ta)
                            ->where(function ($query) {
                                $query->where('kelas', 'like', 'A%')
                                    ->orWhere('kelas', 'like', 'B%');
                            })->first();
                        if (!$cekSimmsit) {
                            $cekSiswaNF = SiswaNF::where('nis', $request->nis)->first();
                            if ($cekSiswaNF) {
                                $cekSimmsit = $cekSiswaNF;
                                $adadariTKNF = $cekSiswaNF;
                                // $calon->update([
                                //     'asal_nf' => true,
                                //     'name' => $cekSiswaNF->nama,
                                //     'jk' => $jk,
                                //     'asal_sekolah' => 'TKIT Nurul Fikri',
                                //     'asal_alamat_sekolah' => 'Jl. Tugu Raya No. 61 Kelapa Dua',
                                //     'asal_provinsi_sekolah' => 32,
                                //     'asal_kota_sekolah' => 3276,
                                //     'asal_kecamatan_sekolah' => 3276040,
                                //     'asal_kelurahan_sekolah' => 3276040012,
                                //     'step' => 7,
                                // ]);
                                // $step = 7;
                            }
                        }
                    }
                    if ($unit->cat_id == 3) {
                        $cekSimmsit = Simmsit::where('nama_unit', 'like', '%Depok')
                            ->where('nis', $request->nis)
                            ->where('tahun_ajaran', $ta)
                            ->where('kelas', 'like', '6%')
                            ->first();
                    }
                    if ($unit->cat_id == 4) {
                        $cekSimmsit = Simmsit::where('nis', $request->nis)
                            ->where('tahun_ajaran', $ta)
                            ->where('kelas', 'like', '9%')
                            ->first();
                    }

                    if ($cekSimmsit) {
                        $jk = ($cekSimmsit->jk == "L" ? 1 : 2);
                        if ($unit->cat_id == 2) {
                            if (!$adadariTKNF) {
                                $calon->update([
                                    'name' => $cekSimmsit->nama,
                                    'jk' => $jk,
                                    'tempat_lahir' => $cekSimmsit->tempat_lahir,
                                    'tgl_lahir' => $cekSimmsit->tanggal_lahir,
                                    'asal_nf' => true,
                                    'asal_sekolah' => 'TKIT Nurul Fikri',
                                    'asal_alamat_sekolah' => 'Jalan Haji Rijin No. 100',
                                    'asal_provinsi_sekolah' => 32,
                                    'asal_kota_sekolah' => 3276,
                                    'asal_kecamatan_sekolah' => 3276040,
                                    'asal_kelurahan_sekolah' => 3276040012,
                                    'step' => 7,
                                ]);
                                $step = 7;
                            }
                            if ($adadariTKNF) {
                                $calon->update([
                                    'name' => $adadariTKNF->name,
                                    'jk' => $jk,
                                    'asal_nf' => true,
                                    'asal_sekolah' => 'TKIT Nurul Fikri',
                                    'asal_alamat_sekolah' => 'Jalan Haji Rijin No. 100',
                                    'asal_provinsi_sekolah' => 32,
                                    'asal_kota_sekolah' => 3276,
                                    'asal_kecamatan_sekolah' => 3276040,
                                    'asal_kelurahan_sekolah' => 3276040012,
                                    'step' => 7,
                                ]);
                                $step = 7;
                            }
                        }
                        if ($unit->cat_id == 3) {
                            $calon->update([
                                'nisn' => $cekSimmsit->nisn,
                                'name' => $cekSimmsit->nama,
                                'jk' => $jk,
                                'tempat_lahir' => $cekSimmsit->tempat_lahir,
                                'tgl_lahir' => $cekSimmsit->tanggal_lahir,
                                'asal_nf' => true,
                                'asal_sekolah' => 'SDIT Nurul Fikri',
                                'asal_alamat_sekolah' => 'Jl. Tugu Raya No. 61 Kelapa Dua',
                                'asal_provinsi_sekolah' => 32,
                                'asal_kota_sekolah' => 3276,
                                'asal_kecamatan_sekolah' => 3276040,
                                'asal_kelurahan_sekolah' => 3276040012,
                                'step' => 7,
                            ]);
                            $step = 7;
                        }
                        if ($unit->cat_id == 4) {
                            $calon->update([
                                'asal_nf' => true,
                                'name' => $cekSimmsit->nama,
                                'jk' => $jk,
                                'tempat_lahir' => $cekSimmsit->tempat_lahir,
                                'tgl_lahir' => $cekSimmsit->tanggal_lahir,
                                'asal_sekolah' => 'SMPIT Nurul Fikri',
                                'asal_alamat_sekolah' => 'Jl. Tugu Raya No. 61 Kelapa Dua',
                                'asal_provinsi_sekolah' => 32,
                                'asal_kota_sekolah' => 3276,
                                'asal_kecamatan_sekolah' => 3276040,
                                'asal_kelurahan_sekolah' => 3276040012,
                                'step' => 7,
                            ]);
                            $step = 7;
                        }
                    }
                    if (!$cekSimmsit) {
                        // $cekSiswaNF = SiswaNF::where('nis', $request->nis)->first();
                        // if ($cekSiswaNF) {
                        //     calon->update([
                        //         'asal_nf' => true,
                        //         'name' => $cekSiswaNF->nama,
                        //         'jk' => $jk,
                        //         'tempat_lahir' => $cekSimmsit->tempat_lahir,
                        //         'tgl_lahir' => $cekSimmsit->tanggal_lahir,
                        //         'asal_sekolah' => 'SMPIT Nurul Fikri',
                        //         'asal_alamat_sekolah' => 'Jl. Tugu Raya No. 61 Kelapa Dua',
                        //         'asal_provinsi_sekolah' => 32,
                        //         'asal_kota_sekolah' => 3276,
                        //         'asal_kecamatan_sekolah' => 3276040,
                        //         'asal_kelurahan_sekolah' => 3276040012,
                        //         'step' => 7,
                        //     ]);
                        //     $step = 7;
                        // }
                        $step = 6;
                        $notification = array(
                            'message' => 'Nomor Induk Siswa tidak ditemukan',
                            'alert-type' => 'error'
                        );
                        return redirect('tambahcalon/' . $step)->with($notification);
                    }
                }
            }
        }

        if ($request->step == 7) {
            // $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            // $pecah_tgl = explode(' ', $request->tgl_lahir);
            // $m = (array_search($pecah_tgl[1], $bulan)) + 1;

            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $calon->update([
                'name' => $request->name,
                'panggilan' => $request->panggilan,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                // 'tgl_lahir' => $pecah_tgl[2] . '-' . $m . '-' . $pecah_tgl[0],
                'jk' => $request->jk,
                'agama' => $request->agama,
                // 'nisn' => $request->nisn,
                // 'nik' => $request->nik,
                // 'info' => $request->info,
                // 'rencana_masuk' => $request->rencana_masuk,
                // 'step' => 5,
                'step' => 11,
            ]);

            // 'step' => 5,
            $step = 11;
        }

        if ($request->step == 8) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $calon->update($request->except('step') + ['step' => 9]);

            $step = 9;
        }

        if ($request->step == 9) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $calon->update($request->except('step') + ['step' => 10]);

            $step = 10;
            if ($calon->asal_nf == 1) {
                $calon->update(['step' => 11]);
                $step = 11;
            }
        }

        if ($request->step == 10) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $calon->update($request->except(
                'step',
                'provinsi',
                'kota',
                'kecamatan',
                'kelurahan'
            ) + [
                'step' => 11,
                'asal_propinsi_sekolah' => $request->provinsi,
                'asal_kota_sekolah' => $request->kota,
                'asal_kecamatan_sekolah' => $request->kecamatan,
                'asal_kelurahan_sekolah' => $request->kelurahan,
            ]);

            $step = 11;
        }

        if ($request->step == 11) {
            $draft = DraftCalon::where('user_id', auth()->user()->id)->first();
            $urut = Calon::where('gel_id', $draft['gel_id'])->get()->count();

            if ($draft['ck_id'] == 1 && $draft['asal_nf'] == 1) {
                $darinf = 2;
            } else {
                $darinf = $draft['ck_id'];
            }
            $calon = Calon::updateOrCreate([
                'gel_id' => $draft['gel_id'],
                'ck_id' => $darinf,
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

            $draft->delete();
            $biaya = BiayaTes::where('gel_id', $calon['gel_id'])
                ->where('ck_id', $calon['ck_id'])
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
        // $age = date('Y-m-d', strtotime($ages));
        $min_age = $gel->minimum_age;

        // $pilihan = [
        // ['name' => 'Pilih Unit/Kelas', 'icon' => 'fas fa-school'],
        // ['name' => 'Orang Tua', 'icon' => 'fas fa-users'],
        // ['name' => 'Data Pribadi', 'icon' => 'fas fa-user'],
        // ['name' => 'Data Alamat', 'icon' => 'fas fa-home'],
        // ['name' => 'Data Orang Tua', 'icon' => 'fas fa-users'],
        // ['name' => 'Data Asal Sekolah', 'icon' => 'fas fa-school'],
        // ['name' => 'Form Persetujuan', 'icon' => 'fas fa-handshake'],
        // ];

        $pilihan = [
            ['no' => 4, 'icon' => 'mdi mdi-account'],
            ['no' => 5, 'icon' => 'mdi mdi-home-account'],
            ['no' => 6, 'icon' => 'mdi mdi-account-supervisor-circle'],
            ['no' => 7, 'icon' => 'mdi mdi-town-hall'],
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

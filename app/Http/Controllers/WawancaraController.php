<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use App\Gelombang;
use App\Calon;
use App\TagihanPSB;
use App\TahunPelajaran;
use App\CalonTagihanPSB;
use App\Kelasnya;
use App\Jadwal;
use App\CalonJadwal;
use App\Provinsi;
use App\Kota;
use App\Kecamatan;
use App\Kelurahan;
use App\Agreement;

use Illuminate\Support\Arr;

class WawancaraController extends Controller
{
    protected $tp_berjalan;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->tp_berjalan = TahunPelajaran::where('status', 1)->first()->name;
    }

    public function wawancaraKeuangan()
    {
        return view('wawancara.keuangan');
    }

    public function PDFKeuangan($id)
    {
        if (auth()->user()->level == 2) {
            $ctg = CalonTagihanPSB::where('calon_id', $id)->first();
            $calon = Calon::findOrFail($id);
            if (auth()->user()->id !== $calon->user_id) {
                return redirect()->route('home');
            }
        }

        if (auth()->user()->level == 1 || auth()->user()->level == 4) {
            $ctg = CalonTagihanPSB::where('calon_id', $id)->first();
            $calon = Calon::findOrFail($id);
            if (!$ctg) {
                return redirect()->route('home');
            }
        }

        if ($calon->asal_nf == 1) {
            if ($ctg->potongan == 0) {
                $ctg->update([
                    'potongan' => 10,
                    'keterangan' => 'Asal dari NF (Depok/Bogor)'
                ]);
            }
        }

        $pindahan = 0;
        if ($calon->pindahan == 1) {
            $pindahan = 1;
        }

        $tp_now = TahunPelajaran::where('status', 1)->first()->name;
        $tp = explode("/", $tp_now);
        $tp_awal = intval($tp[0]);
        $tp_akhir = intval($tp[1]);

        if ($tp_awal < 2024) {
            $biayanya = ['Dana Pengembangan', 'Dana Pendidikan', 'SPP bulan Juli', 'Iuran Komite Sekolah / tahun', 'Seragam'];

            $security = $ctg->created_at;

            $id = $ctg->calon_id;
            // $tgh_id = $ctg->tagihanpsb_id;
            //Kalo ini ada yg di edit, maka di TagihanPSBController.show juga mulai dari baris ini
            $khusus = 0;

            if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                $tp_cek = $tp_awal - 1 . '/' . $tp_awal;
                $tp_pindahan = TahunPelajaran::where('name', $tp_cek)->first()->id;
                $unit_cek = Gelombang::where('id', $calon->gel_id)->first()->unit_id;
                $gel_pindahan = Gelombang::where('unit_id', $unit_cek)->where('tp', $tp_pindahan)->first()->id;
                $biayas = TagihanPSB::where('gel_id', $gel_pindahan)
                    ->where('kelas', $calon->kelas_tujuan)
                    ->where('kelamin', $calon->jk)
                    ->first();

                $biaya1 = $biayas->biaya1 + ['SPP bulan Juli' => $biayas->spppindahan];
                $total1 = $biayas->totalpindahan[1];
            } else {
                $biayas = TagihanPSB::where('gel_id', $calon->gel_id)
                    ->where('kelas', $calon->kelas_tujuan)
                    ->where('kelamin', $calon->jk)
                    ->first();

                $biaya1 = $biayas->biaya1 + ['SPP bulan Juli' => $biayas->spp];
                // $biaya2 = $biayas->biaya2;
                // $biaya3 = $biayas->biaya3;

                $total1 = $biayas->total[1];
                // $total2 = $biayas->total[2];
                // $total3 = $biayas->total[3];
            }

            if (TagihanPSB::where('gel_id', $calon->uruts)->exists()) {
                $biayas = TagihanPSB::where('gel_id', $calon->uruts)->first();
                $khusus = 1;
            }

            $diskonpegawai = 0;
            $diskonpegawai2 = 0;
            $diskonpegawai3 = 0;

            if ($ctg->keterangan === 'Diskon anak PEGAWAI TETAP' || $ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                $diskonpegawai = $biaya1['SPP bulan Juli'] * ($ctg->potongan / 100);
                $biaya1['SPP bulan Juli'] = $biaya1['SPP bulan Juli'] - $diskonpegawai;
                if ($ctg->keterangan != 'Diskon anak PEGAWAI KONTRAK') {
                    $diskonpegawai2 = $biaya1['Dana Pengembangan'] * ($ctg->potongan / 100);
                    $biaya1['Dana Pengembangan'] = $biaya1['Dana Pengembangan'] - $diskonpegawai2;

                    $diskonpegawai3 = $biaya1['Dana Pendidikan'] * ($ctg->potongan / 100);
                    $biaya1['Dana Pendidikan'] = $biaya1['Dana Pendidikan'] - $diskonpegawai3;
                }

                $total1 = $total1 - $diskonpegawai - $diskonpegawai2 - $diskonpegawai3;
            }

            // dd($biaya1);

            $kls = Kelasnya::where('id', $calon->kelas_tujuan)->first();
            $kelass = Kelasnya::where('unit_id', $kls->unit_id)->where('id', '>=', $kls->id)->get();

            $spp_naik = 100000;
            $daul = [
                'TK A' => 2000000,
                'TK B' => 2000000,
                '2' => 3750000,
                '3' => 4100000,
                '4' => 4500000,
                '5' => 4700000,
                '6' => 4900000,
                '8' => 4250000,
                '9' => 5000000,
                '11' => 5000000,
                '12' => 6000000,
            ];

            if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                $daul = [
                    'TK A' => 2000000,
                    'TK B' => 2000000,
                    '2' => 3500000,
                    '3' => 3750000,
                    '4' => 4100000,
                    '5' => 4500000,
                    '6' => 4900000,
                    '8' => 4000000,
                    '9' => 4250000,
                    '11' => 4500000,
                    '12' => 5000000,
                ];
            }

            $bln = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            $totalAll = [];
            $kelas = [];
            $no = 1;
            $dauls = 0;
            $totalth = 0;
            $tgh_id = 1;

            $bulanmasuk = 'SPP bulan ' . $bln[$calon->rencana_masuk];

            if ($calon->pindahan === 0) {
                $bulan = 'SPP ' . $bln[($calon->rencana_masuk) + 1] . ' ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                $hitungbln = 11;
            }
            if ($calon->pindahan === 1) {
                if ($calon->rencana_masuk >= 7) {
                    $bulan = 'SPP ' . $bln[($calon->rencana_masuk) + 1] . ' ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                    $hitungbln = 12 - $calon->rencana_masuk + 6;
                }

                if ($calon->rencana_masuk <= 6) {
                    $bulan = 'SPP ' . $bln[($calon->rencana_masuk) + 1] . ' s/d SPP Juni ' . ($tp_akhir + $no - 2);
                    $hitungbln = 6 - $calon->rencana_masuk;
                    $khusus = 1;
                }
            }

            foreach ($kelass as $k) {
                if ($no === 1) {
                    $sppnya = $biayas->spp;
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                        $sppnya = $biayas->spp * ($ctg->potongan / 100);
                    }
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI TETAP') {
                        $sppnya = $biayas->spp * ($ctg->potongan / 100);
                    }
                    if ($pindahan == 0) {
                        $kelas[$k->name]['ket'][0] = 'SPP Agustus ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                        $kelas[$k->name]['total'][0] = $sppnya * 11;
                        $totalth = $totalth + $sppnya * 11;
                    }
                    if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                        $sppnya = $biayas->spppindahan;
                    }
                    if ($pindahan == 1) {
                        // $kelas[$k->name]['ket'][0] = 'SPP Februari s/d SPP Juni '.($tp_akhir+$no-1-$khusus);
                        $kelas[$k->name]['ket'][0] = $bulan;
                        $kelas[$k->name]['total'][0] = $sppnya * $hitungbln;
                        $totalth = $totalth + $sppnya * $hitungbln;
                    }
                }
                if ($no > 1) {
                    $sppnya = $biayas->spp + ($spp_naik * ($no - 1));
                    if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                        $sppnya = $biayas->spppindahan + ($spp_naik * ($no - 1));
                    }
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                        $sppnya = ($biayas->spp + ($spp_naik * ($no - 1))) * ($ctg->potongan / 100);
                    }
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI TETAP') {
                        $sppnya = ($biayas->spp + ($spp_naik * ($no - 1))) * ($ctg->potongan / 100);
                    }

                    if ($k->name == 'TK A' || $k->name == 'TK B' || $k->name == 'PG') {
                        $sppnya = $biayas->spp + 100000;
                        if ($ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                            $sppnya = ($biayas->spp + 100000) * ($ctg->potongan / 100);
                        }
                        if ($ctg->keterangan === 'Diskon anak PEGAWAI TETAP') {
                            $sppnya = ($biayas->spp + 100000) * ($ctg->potongan / 100);
                        }
                    }
                    $kelas[$k->name]['ket'][$no - 1] = 'SPP Juli ' . ($tp_awal + $no - 1 - $khusus) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1 - $khusus);
                    $kelas[$k->name]['total'][$no - 1] = $sppnya * 12;
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI TETAP' || $ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                        $daul[$k->name] = $daul[$k->name] - ($daul[$k->name] * $ctg->potongan / 100);
                    }
                    $kelas[$k->name]['daul'][$no - 1] = $daul[$k->name];
                    $totalth = $totalth + $sppnya * 12 + $daul[$k->name];
                }
                $kelas[$k->name]['spp'][$no - 1] = $sppnya;
                $totalAll[$tgh_id] = $totalth;
                $kelas[$k->name]['kelas'] = $k->name;
                $no = $no + 1;
            }

            $now = new \DateTime();
            $unitd = str_replace('IT Nurul Fikri', '', Gelombang::unit($calon->gel_id));
            $diskonUnit = [
                0 => [
                    'TK' => 0,
                    'SD' => 0,
                    'SMP' => 0,
                    'SMA' => 0,
                ],
                1 => [
                    'TK' => 4000000,
                    'SD' => 4000000,
                    'SMP' => 4000000,
                    'SMA' => 4000000,
                ],
                2 => [
                    'TK' => 3000000,
                    'SD' => 3000000,
                    'SMP' => 3000000,
                    'SMA' => 3000000,
                ],
                3 => [
                    'TK' => 2000000,
                    'SD' => 1500000,
                    'SMP' => 1500000,
                    'SMA' => 1500000,
                ]
            ];

            $bataskolom = new \DateTime($ctg->created_at->toDateString());
            $diskon = array();
            $kontrak = false;

            $tgl = new \DateTime('2023-6-31');
            if ($tgl > $bataskolom) {
                $diskon = [
                    2 => [
                        'no' => 1,
                        'tgl' => new \DateTime('2023-1-1'),
                        'tanggal' => "",
                        'diskon' => $diskonUnit[0][$unitd]
                    ]
                ];
            }

            $tgl = new \DateTime('2022-12-1');
            if ($tgl > $bataskolom) {
                $kontrak = true;
                $diskon = [
                    1 => [
                        'no' => 1,
                        'tgl' => new \DateTime('2022-12-1'),
                        'tanggal' => "30 November 2022",
                        'diskon' => $diskonUnit[2][$unitd]
                    ],
                    2 => [
                        'no' => 2,
                        'tgl' => new \DateTime('2023-1-1'),
                        'tanggal' => "31 Desember 2022",
                        'diskon' => $diskonUnit[3][$unitd]
                    ]
                ];
            }

            $tgl = new \DateTime('2022-11-1');
            if ($tgl > $bataskolom) {
                $kontrak = true;
                $diskon = [
                    1 => [
                        'no' => 1,
                        'tgl' => new \DateTime('2022-11-1'),
                        'tanggal' => "31 Oktober 2022",
                        'diskon' => $diskonUnit[1][$unitd]
                    ],
                    2 => [
                        'no' => 2,
                        'tgl' => new \DateTime('2022-12-1'),
                        'tanggal' => "30 November 2022",
                        'diskon' => $diskonUnit[2][$unitd]
                    ],
                    3 => [
                        'no' => 3,
                        'tgl' => new \DateTime('2023-1-1'),
                        'tanggal' => "31 Desember 2022",
                        'diskon' => $diskonUnit[3][$unitd]
                    ]
                ];
            }

            $batas = 0;

            if (array_key_exists(2, $diskon)) {
                if ($diskon[2]['tgl'] > $bataskolom) {
                    $batas = 1;
                }
            }

            if (array_key_exists(1, $diskon)) {
                if ($diskon[1]['tgl'] > $bataskolom) {
                    $batas = 2;
                }
            }

            $cjadwal = CalonJadwal::where('calon_id', $ctg->calon_id)->first()->jadwal_id;
            if ($cjadwal) {
                $pengumuman = Jadwal::whereId($cjadwal)->first()->pengumuman->addDays(30);
            }

            if ($ctg->khusus == 1) {
                $pdf = PDF::loadView('pdf.' . substr(auth()->user()->tp_name, 0, 4) . '.tagihanPSBKhusus', compact('biayanya', 'ctg', 'security', 'calon', 'biaya1', 'total1', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir', 'bulanmasuk'));
            }
            if ($ctg->khusus == 0) {
                $pdf = PDF::loadView('pdf.' . substr(auth()->user()->tp_name, 0, 4) . '.tagihanPSB', compact('biayanya', 'ctg', 'security', 'calon', 'biaya1', 'total1', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir', 'diskon', 'pengumuman', 'batas', 'bulanmasuk', 'kontrak'));
            }

            // if ($khusus == 1) {
            //     $pdf = PDF::loadView('pdf.tagihanPSBKhusus', compact('biayanya', 'ctg', 'security', 'calon', 'biaya1', 'biaya2', 'biaya3', 'total1', 'total2', 'total3', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir'));
            // }

            return $pdf->stream('');
        }

        if ($tp_awal == 2024) { //Sementara nanti diganti
            // if ($tp_awal == 2024) {
            $biayanya = ['Dana Pengembangan', 'Dana Pendidikan', 'Seragam'];

            $security = $ctg->created_at;

            $id = $ctg->calon_id;
            // $tgh_id = $ctg->tagihanpsb_id;
            //Kalo ini ada yg di edit, maka di TagihanPSBController.show juga mulai dari baris ini
            $khusus = 0;

            if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                $tp_cek = $tp_awal - 1 . '/' . $tp_awal;
                $tp_pindahan = TahunPelajaran::where('name', $tp_cek)->first()->id;
                $unit_cek = Gelombang::where('id', $calon->gel_id)->first()->unit_id;
                $gel_pindahan = Gelombang::where('unit_id', $unit_cek)->where('tp', $tp_pindahan)->first()->id;
                $biayas = TagihanPSB::where('gel_id', $gel_pindahan)
                    ->where('kelas', $calon->kelas_tujuan)
                    ->where('kelamin', $calon->jk)
                    ->first();

                $biaya1 = $biayas->biaya1;
                $total1 = $biayas->totalpindahan[1];
            } else {
                $biayas = TagihanPSB::where('gel_id', $calon->gel_id)
                    ->where('kelas', $calon->kelas_tujuan)
                    ->where('kelamin', $calon->jk)
                    ->first();

                $biaya1 = $biayas->biaya1;
                // $biaya2 = $biayas->biaya2;
                // $biaya3 = $biayas->biaya3;

                $total1 = $biayas->total[1];
                // $total2 = $biayas->total[2];
                // $total3 = $biayas->total[3];
            }

            if (TagihanPSB::where('gel_id', $calon->uruts)->exists()) {
                $biayas = TagihanPSB::where('gel_id', $calon->uruts)->first();
                $khusus = 1;
            }

            $totalpegawai = 0;
            $diskonpegawai = 0;
            $diskonpegawai2 = 0;
            $diskonpegawai3 = 0;

            if ($ctg->keterangan === 'Diskon anak PEGAWAI TETAP' || $ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                // $diskonpegawai = $biaya1['SPP bulan Juli'] * ($ctg->potongan / 100);
                // $biaya1['SPP bulan Juli'] = $biaya1['SPP bulan Juli'] - $diskonpegawai;
                // $biaya1['SPP bulan Juli'] = $biaya1['SPP bulan Juli'];
                // $totalpegawai = $biaya1['Dana Pengembangan'];

                if ($ctg->keterangan != 'Diskon anak PEGAWAI KONTRAK') {
                    $diskonpegawai2 = $biaya1['Dana Pengembangan'] * ($ctg->potongan / 100);
                    $biaya1['Dana Pengembangan'] = $biaya1['Dana Pengembangan'] - $diskonpegawai2;

                    $diskonpegawai3 = $biaya1['Dana Pendidikan'] * ($ctg->potongan / 100);
                    $biaya1['Dana Pendidikan'] = $biaya1['Dana Pendidikan'] - $diskonpegawai3;
                }

                $total1 = $total1 - $diskonpegawai - $diskonpegawai2 - $diskonpegawai3;
            }

            // dd($biaya1);

            $kls = Kelasnya::where('id', $calon->kelas_tujuan)->first();
            $kelass = Kelasnya::where('unit_id', $kls->unit_id)->where('id', '>=', $kls->id)->get();

            $spp_naik = [0, 0, 200000, 100000, 100000, 100000, 100000, 100000];
            $spp_naik_pindahan = [0, 0, 100000, 100000, 100000, 100000, 100000, 100000];
            // $spp_naik1 = 100000;
            // $spp_naik2 = 200000;

            $daul = [
                'TK A' => 2000000,
                'TK B' => 2000000,
                '2' => 3750000,
                '3' => 4100000,
                '4' => 4500000,
                '5' => 4700000,
                '6' => 4900000,
                '8' => 4250000,
                '9' => 5000000,
                '11' => 5000000,
                '12' => 6000000,
            ];

            if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                $daul = [
                    'TK A' => 2000000,
                    'TK B' => 2000000,
                    '2' => 3500000,
                    '3' => 3750000,
                    '4' => 4100000,
                    '5' => 4500000,
                    '6' => 4900000,
                    '8' => 4000000,
                    '9' => 4250000,
                    '11' => 4500000,
                    '12' => 5000000,
                ];
            }

            $bln = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            $totalAll = [];
            $kelas = [];
            $no = 1;
            $dauls = 0;
            $totalth = 0;
            $tgh_id = 1;

            $bulanmasuk = 'SPP bulan ' . $bln[$calon->rencana_masuk];

            if ($calon->pindahan === 0) {
                $bulan = 'SPP ' . $bln[($calon->rencana_masuk)] . ' ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                $hitungbln = 12;
            }
            if ($calon->pindahan === 1) {
                if ($calon->rencana_masuk == 7) {
                    $bulan = 'SPP ' . $bln[($calon->rencana_masuk)] . ' ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                    $hitungbln = 12;
                }

                if ($calon->rencana_masuk > 7) {
                    $bulan = 'SPP ' . $bln[($calon->rencana_masuk)] . ' ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                    $hitungbln = 12 - $calon->rencana_masuk + 7;
                }

                if ($calon->rencana_masuk <= 6) {
                    $bulan = 'SPP ' . $bln[($calon->rencana_masuk)] . ' s/d SPP Juni ' . ($tp_akhir + $no - 2);
                    $hitungbln = 6 - $calon->rencana_masuk;
                    $khusus = 1;
                }
            }

            foreach ($kelass as $k) {
                if ($no === 1) {
                    $sppfull = $biayas->spp;
                    $sppnya = $sppfull;
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                        $sppnya = $sppfull * ($ctg->potongan / 100);
                    }
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI TETAP') {
                        $sppnya = $sppfull * ($ctg->potongan / 100);
                    }
                    if ($pindahan == 0) {
                        $kelas[$k->name]['ket'][0] = 'SPP Juli ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                        $kelas[$k->name]['total'][0] = $sppnya * 12;
                        $totalth = $totalth + $sppnya * 12;
                    }
                    if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                        $sppnya = $biayas->spppindahan;
                    }
                    if ($pindahan == 1) {
                        // $kelas[$k->name]['ket'][0] = 'SPP Februari s/d SPP Juni '.($tp_akhir+$no-1-$khusus);
                        $kelas[$k->name]['ket'][0] = $bulan;
                        $kelas[$k->name]['total'][0] = $sppnya * $hitungbln;
                        $totalth = $totalth + $sppnya * $hitungbln;
                    }
                }
                if ($no > 1) {
                    $sppfull = $sppfull + $spp_naik[$no];
                    $sppnya = $sppfull;
                    // if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                    if ($calon->pindahan == 1) {
                        $sppnya = $biayas->spppindahan + ($spp_naik_pindahan[$no] * ($no - 1));
                    }
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                        $sppnya = $sppfull * ($ctg->potongan / 100);
                    }
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI TETAP') {
                        $sppnya = $sppfull * ($ctg->potongan / 100);
                    }

                    $kelas[$k->name]['ket'][$no - 1] = 'SPP Juli ' . ($tp_awal + $no - 1 - $khusus) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1 - $khusus);
                    $kelas[$k->name]['total'][$no - 1] = $sppnya * 12;
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI TETAP' || $ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                        $daul[$k->name] = $daul[$k->name] - ($daul[$k->name] * $ctg->potongan / 100);
                    }
                    $kelas[$k->name]['daul'][$no - 1] = $daul[$k->name];
                    $totalth = $totalth + $sppnya * 12 + $daul[$k->name];
                }
                $kelas[$k->name]['spp'][$no - 1] = $sppnya;
                $totalAll[$tgh_id] = $totalth;
                $kelas[$k->name]['kelas'] = $k->name;
                $no++;
            }

            $now = new \DateTime();
            $unitd = str_replace('IT Nurul Fikri', '', Gelombang::unit($calon->gel_id));
            $diskonUnit = [
                0 => [
                    'TK' => 0,
                    'SD' => 0,
                    'SMP' => 0,
                    'SMA' => 0,
                ],
                1 => [
                    'TK' => 4000000,
                    'SD' => 4000000,
                    'SMP' => 4000000,
                    'SMA' => 4000000,
                ],
                2 => [
                    'TK' => 3000000,
                    'SD' => 2000000,
                    'SMP' => 2000000,
                    'SMA' => 2000000,
                ],
                3 => [
                    'TK' => 2000000,
                    'SD' => 1500000,
                    'SMP' => 1500000,
                    'SMA' => 1500000,
                ]
            ];

            $bataskolom = new \DateTime($ctg->created_at->toDateString());
            $diskon = array();
            $kontrak = false;

            $tgl = new \DateTime('2024-6-31');
            if ($tgl > $bataskolom) {
                $diskon = [
                    2 => [
                        'no' => 1,
                        'tgl' => new \DateTime('2024-1-1'),
                        'tanggal' => "",
                        'diskon' => $diskonUnit[0][$unitd]
                    ]
                ];
            }

            $tgl = new \DateTime('2024-1-1');
            if ($tgl > $bataskolom) {
                $kontrak = true;
                $diskon = [
                    1 => [
                        'no' => 1,
                        'tgl' => new \DateTime('2024-1-1'),
                        'tanggal' => "31 Desember 2023",
                        'diskon' => $diskonUnit[3][$unitd]
                    ],
                    2 => [
                        'no' => 2,
                        'tgl' => new \DateTime('2024-1-1'),
                        'tanggal' => "",
                        'diskon' => $diskonUnit[0][$unitd]
                    ]
                ];
            }

            $tgl = new \DateTime('2023-12-1');
            if ($tgl > $bataskolom) {
                $kontrak = true;
                $diskon = [
                    1 => [
                        'no' => 1,
                        'tgl' => new \DateTime('2023-12-1'),
                        'tanggal' => "30 November 2023",
                        'diskon' => $diskonUnit[2][$unitd]
                    ],
                    2 => [
                        'no' => 2,
                        'tgl' => new \DateTime('2024-1-1'),
                        'tanggal' => "31 Desember 2023",
                        'diskon' => $diskonUnit[3][$unitd]
                    ]
                ];
            }

            $tgl = new \DateTime('2023-11-1');
            if ($tgl > $bataskolom) {
                $kontrak = true;
                $diskon = [
                    1 => [
                        'no' => 1,
                        'tgl' => new \DateTime('2023-11-1'),
                        'tanggal' => "31 Oktober 2023",
                        'diskon' => $diskonUnit[1][$unitd]
                    ],
                    2 => [
                        'no' => 2,
                        'tgl' => new \DateTime('2023-12-1'),
                        'tanggal' => "30 November 2023",
                        'diskon' => $diskonUnit[2][$unitd]
                    ],
                    3 => [
                        'no' => 3,
                        'tgl' => new \DateTime('2024-1-1'),
                        'tanggal' => "31 Desember 2023",
                        'diskon' => $diskonUnit[3][$unitd]
                    ]
                ];
            }

            $batas = 0;

            if (array_key_exists(3, $diskon)) {
                if ($diskon[2]['tgl'] > $bataskolom) {
                    $batas = 1;
                }
            }

            if (array_key_exists(2, $diskon)) {
                if ($diskon[2]['tgl'] > $bataskolom) {
                    $batas = 1;
                }
            }

            if (array_key_exists(1, $diskon)) {
                if ($diskon[1]['tgl'] > $bataskolom) {
                    $batas = 2;
                }
            }

            $cjadwal = CalonJadwal::where('calon_id', $ctg->calon_id)->first()->jadwal_id;
            if ($cjadwal) {
                $pengumuman = Jadwal::whereId($cjadwal)->first()->pengumuman->addDays(30);
            }

            if ($ctg->khusus == 1) {
                $pdf = PDF::loadView('pdf.' . substr(auth()->user()->tp_name, 0, 4) . '.tagihanPSBKhusus', compact('biayanya', 'ctg', 'security', 'calon', 'biaya1', 'total1', 'totalpegawai', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir', 'bulanmasuk'));
            }
            if ($ctg->khusus == 0) {
                $pdf = PDF::loadView('pdf.' . substr(auth()->user()->tp_name, 0, 4) . '.tagihanPSB', compact('biayanya', 'ctg', 'security', 'calon', 'biaya1', 'total1', 'totalpegawai', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir', 'diskon', 'pengumuman', 'batas', 'bulanmasuk', 'kontrak', 'hitungbln', 'bulan'));
            }

            // if ($khusus == 1) {
            //     $pdf = PDF::loadView('pdf.tagihanPSBKhusus', compact('biayanya', 'ctg', 'security', 'calon', 'biaya1', 'biaya2', 'biaya3', 'total1', 'total2', 'total3', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir'));
            // }

            return $pdf->stream('');
        }

        if ($tp_awal >= 2025) {
            $biayanya = ['Dana Pengembangan', 'Dana Pendidikan', 'Seragam'];

            $security = $ctg->created_at;

            $id = $ctg->calon_id;
            // $tgh_id = $ctg->tagihanpsb_id;
            //Kalo ini ada yg di edit, maka di TagihanPSBController.show juga mulai dari baris ini
            $khusus = 0;

            if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                $tp_cek = $tp_awal - 1 . '/' . $tp_awal;
                $tp_pindahan = TahunPelajaran::where('name', $tp_cek)->first()->id;
                $unit_cek = Gelombang::where('id', $calon->gel_id)->first()->unit_id;
                $gel_pindahan = Gelombang::where('unit_id', $unit_cek)->where('tp', $tp_pindahan)->first()->id;
                $biayas = TagihanPSB::where('gel_id', $gel_pindahan)
                    ->where('kelas', $calon->kelas_tujuan)
                    ->where('kelamin', $calon->jk)
                    ->first();

                $biaya1 = $biayas->biaya1;
                $total1 = $biayas->totalpindahan[1];
            } else {
                $biayas = TagihanPSB::where('gel_id', $calon->gel_id)
                    ->where('kelas', $calon->kelas_tujuan)
                    ->where('kelamin', $calon->jk)
                    ->first();

                $biaya1 = $biayas->biaya1;
                // $biaya2 = $biayas->biaya2;
                // $biaya3 = $biayas->biaya3;

                $total1 = $biayas->total[1];
                // $total2 = $biayas->total[2];
                // $total3 = $biayas->total[3];
            }

            if (TagihanPSB::where('gel_id', $calon->uruts)->exists()) {
                $biayas = TagihanPSB::where('gel_id', $calon->uruts)->first();
                $khusus = 1;
            }

            $totalpegawai = 0;
            $diskonpegawai = 0;
            $diskonpegawai2 = 0;
            $diskonpegawai3 = 0;

            if ($ctg->keterangan === 'Diskon anak PEGAWAI TETAP' || $ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                // $diskonpegawai = $biaya1['SPP bulan Juli'] * ($ctg->potongan / 100);
                // $biaya1['SPP bulan Juli'] = $biaya1['SPP bulan Juli'] - $diskonpegawai;
                // $biaya1['SPP bulan Juli'] = $biaya1['SPP bulan Juli'];
                // $totalpegawai = $biaya1['Dana Pengembangan'];

                if ($ctg->keterangan != 'Diskon anak PEGAWAI KONTRAK') {
                    $diskonpegawai2 = $biaya1['Dana Pengembangan'] * ($ctg->potongan / 100);
                    $biaya1['Dana Pengembangan'] = $biaya1['Dana Pengembangan'] - $diskonpegawai2;

                    $diskonpegawai3 = $biaya1['Dana Pendidikan'] * ($ctg->potongan / 100);
                    $biaya1['Dana Pendidikan'] = $biaya1['Dana Pendidikan'] - $diskonpegawai3;
                }

                $total1 = $total1 - $diskonpegawai - $diskonpegawai2 - $diskonpegawai3;
            }

            // dd($biaya1);

            $kls = Kelasnya::where('id', $calon->kelas_tujuan)->first();
            $kelass = Kelasnya::where('unit_id', $kls->unit_id)->where('id', '>=', $kls->id)->get();

            $spp_naik = [0, 0, 100000, 100000, 100000, 100000, 100000, 100000];
            $spp_naik_pindahan = [0, 0, 100000, 100000, 100000, 100000, 100000, 100000];
            // $spp_naik1 = 100000;
            // $spp_naik2 = 200000;

            $daul = [
                'TK A' => 2000000,
                'TK B' => 2000000,
                '2' => 3750000,
                '3' => 4100000,
                '4' => 4500000,
                '5' => 4700000,
                '6' => 4900000,
                '8' => 4250000,
                '9' => 5000000,
                '11' => 5000000,
                '12' => 6000000,
            ];

            $bln = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            $totalAll = [];
            $kelas = [];
            $no = 1;
            $dauls = 0;
            $totalth = 0;
            $tgh_id = 1;

            $bulanmasuk = 'SPP bulan ' . $bln[$calon->rencana_masuk];

            if ($calon->pindahan === 0) {
                $bulan = 'SPP ' . $bln[($calon->rencana_masuk)] . ' ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                $hitungbln = 12;
            }
            if ($calon->pindahan === 1) {
                if ($calon->rencana_masuk == 7) {
                    $bulan = 'SPP ' . $bln[($calon->rencana_masuk)] . ' ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                    $hitungbln = 12;
                }

                if ($calon->rencana_masuk > 7) {
                    $bulan = 'SPP ' . $bln[($calon->rencana_masuk)] . ' ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                    $hitungbln = 12 - $calon->rencana_masuk + 7;
                }

                if ($calon->rencana_masuk <= 6) {
                    $bulan = 'SPP ' . $bln[($calon->rencana_masuk)] . ' s/d SPP Juni ' . ($tp_akhir + $no - 2);
                    $hitungbln = 6 - $calon->rencana_masuk;
                    $khusus = 1;
                }
            }

            $unitd = str_replace('IT Nurul Fikri', '', Gelombang::unit($calon->gel_id));
            // Tambahan script untuk Pembiayaan Program NF
            $programNF = '';
            $skema = '';
            $ketProgramNF = '';
            $biayaProgram = [
                '2025' => [
                    'TK' => [
                        'nama' => '-',
                        'langsung' => 0,
                        'tahunan' => [
                            1 => 0,
                            2 => 0,
                            3 => 0
                        ],
                        'bulanan' => [
                            1 => 0,
                            2 => 0,
                            3 => 0
                        ]
                    ],
                    'SD' => [
                        'nama' => '-',
                        'langsung' => 0,
                        'tahunan' => [
                            1 => 0,
                            2 => 0,
                            3 => 0
                        ],
                        'bulanan' => [
                            1 => 0,
                            2 => 0,
                            3 => 0
                        ]
                    ],
                    'SMP' => [
                        'nama' => 'Program Umroh plus Quran Character Camp (QCC)',
                        'langsung' => 40000000,
                        'tahunan' => [
                            1 => 15000000,
                            2 => 15000000,
                            3 => 10000000
                        ],
                        'bulanan' => [
                            1 => 1250000,
                            2 => 1250000,
                            3 => 2000000
                        ]
                    ],
                    'SMA' => [
                        'nama' => 'Immersion Program Nurul Fikri',
                        'langsung' => 30000000,
                        'tahunan' => [
                            1 => 24000000,
                            2 => 6000000
                        ],
                        'bulanan' => [
                            1 => 2000000,
                            2 => 2000000
                        ]
                    ],
                ]
            ];

            $biayaProgramNF = $biayaProgram['2025'][$unitd]['langsung'];
            $ketProgramNF = $biayaProgram['2025'][$unitd]['nama'];
            $programNF = [
                'langsung' => $biayaProgram['2025'][$unitd]['langsung'],
                'tahunan' => $biayaProgram['2025'][$unitd]['tahunan'],
                'bulanan' => $biayaProgram['2025'][$unitd]['bulanan']
            ];

            if (!empty($ctg->lain)) {
                $skema = $ctg->lain['program'];
            }
            // $totalth = $totalth + $biayaProgramNF;
            foreach ($kelass as $k) {
                if ($no === 1) {
                    $sppfull = $biayas->spp;
                    $sppnya = $sppfull;
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                        $sppnya = $sppfull * ($ctg->potongan / 100);
                    }
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI TETAP') {
                        $sppnya = $sppfull * ($ctg->potongan / 100);
                    }
                    if ($pindahan == 0) {
                        $kelas[$k->name]['ket'][0] = 'SPP Juli ' . ($tp_awal + $no - 1) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1);
                        $kelas[$k->name]['total'][0] = $sppnya * 12;
                        $totalth = $totalth + $sppnya * 12;
                    }
                    if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                        $sppnya = $biayas->spppindahan;
                    }
                    if ($pindahan == 1) {
                        // $kelas[$k->name]['ket'][0] = 'SPP Februari s/d SPP Juni '.($tp_akhir+$no-1-$khusus);
                        $kelas[$k->name]['ket'][0] = $bulan;
                        $kelas[$k->name]['total'][0] = $sppnya * $hitungbln;
                        $totalth = $totalth + $sppnya * $hitungbln;
                    }
                }
                if ($no > 1) {
                    $sppfull = $sppfull + $spp_naik[$no];
                    $sppnya = $sppfull;
                    // if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                    if ($calon->pindahan == 1) {
                        $sppnya = $biayas->spppindahan + ($spp_naik_pindahan[$no] * ($no - 1));
                    }
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                        $sppnya = $sppfull * ($ctg->potongan / 100);
                    }
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI TETAP') {
                        $sppnya = $sppfull * ($ctg->potongan / 100);
                    }

                    $kelas[$k->name]['ket'][$no - 1] = 'SPP Juli ' . ($tp_awal + $no - 1 - $khusus) . ' s/d SPP Juni ' . ($tp_akhir + $no - 1 - $khusus);
                    $kelas[$k->name]['total'][$no - 1] = $sppnya * 12;
                    if ($ctg->keterangan === 'Diskon anak PEGAWAI TETAP' || $ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                        $daul[$k->name] = $daul[$k->name] - ($daul[$k->name] * $ctg->potongan / 100);
                    }
                    $kelas[$k->name]['daul'][$no - 1] = $daul[$k->name];
                    $totalth = $totalth + $sppnya * 12 + $daul[$k->name];
                }

                $kelas[$k->name]['spp'][$no - 1] = $sppnya;
                $totalAll[$tgh_id] = $totalth;
                $kelas[$k->name]['kelas'] = $k->name;
                $no++;
            }

            $now = new \DateTime();
            $diskonUnit = [
                0 => [
                    'TK' => 0,
                    'SD' => 0,
                    'SMP' => 0,
                    'SMA' => 0,
                ],
                1 => [
                    'TK' => 4000000,
                    'SD' => 4000000,
                    'SMP' => 4000000,
                    'SMA' => 4000000,
                ],
                2 => [
                    'TK' => 3000000,
                    'SD' => 2000000,
                    'SMP' => 2000000,
                    'SMA' => 2000000,
                ],
                3 => [
                    'TK' => 2000000,
                    'SD' => 1500000,
                    'SMP' => 1500000,
                    'SMA' => 1500000,
                ]
            ];

            $cjadwal = CalonJadwal::where('calon_id', $ctg->calon_id)->first();
            if ($cjadwal) {
                $pengumuman = Jadwal::whereId($cjadwal->jadwal_id)->first()->pengumuman->addDays(30);
            } else {
                $pengumuman = $ctg->created_at->addDays(5);
            }

            $bataskolom = new \DateTime($ctg->created_at->toDateString());
            $diskon = array();
            $kontrak = false;

            $tgl = new \DateTime('2025-6-31 00:00:00');
            if ($tgl > $bataskolom) {
                $diskon = [
                    2 => [
                        'no' => 1,
                        'tgl' => new \DateTime('2025-1-1 00:00:00'),
                        'tanggal' => "",
                        'diskon' => $diskonUnit[0][$unitd]
                    ]
                ];
            }

            $tgl = new \DateTime('2025-1-1 00:00:00');
            if ($tgl > $bataskolom) {
                $kontrak = true;
                $diskon = array();
                $diskon = [
                    1 => [
                        'no' => 1,
                        'tgl' => new \DateTime('2025-1-1 00:00:00'),
                        'tanggal' => "31 Desember 2024",
                        'diskon' => $diskonUnit[3][$unitd]
                    ],
                    2 => [
                        'no' => 2,
                        'tgl' => new \DateTime('2025-1-1 00:00:00'),
                        'tanggal' => "",
                        'diskon' => $diskonUnit[0][$unitd]
                    ]
                ];
            }

            $tgl = new \DateTime('2024-12-1 00:00:00');
            if ($tgl > $bataskolom) {
                $kontrak = true;
                $diskon = array();
                $diskon = [
                    1 => [
                        'no' => 1,
                        'tgl' => new \DateTime('2024-12-1 00:00:00'),
                        'tanggal' => "30 November 2024",
                        'diskon' => $diskonUnit[2][$unitd]
                    ],
                    2 => [
                        'no' => 2,
                        'tgl' => new \DateTime('2025-1-1 00:00:00'),
                        'tanggal' => "31 Desember 2024",
                        'diskon' => $diskonUnit[3][$unitd]
                    ]
                ];
            }

            $tgl = new \DateTime('2024-11-1 00:00:00');
            if ($tgl > $bataskolom) {
                $kontrak = true;
                $diskon = array();
                $diskon = [
                    1 => [
                        'no' => 1,
                        'tgl' => new \DateTime('2024-11-1 00:00:00'),
                        'tanggal' => "31 Oktober 2024",
                        'diskon' => $diskonUnit[1][$unitd]
                    ],
                    2 => [
                        'no' => 2,
                        'tgl' => new \DateTime('2024-12-1 00:00:00'),
                        'tanggal' => "30 November 2024",
                        'diskon' => $diskonUnit[2][$unitd]
                    ],
                    3 => [
                        'no' => 3,
                        'tgl' => new \DateTime('2025-1-1 00:00:00'),
                        'tanggal' => "31 Desember 2024",
                        'diskon' => $diskonUnit[3][$unitd]
                    ]
                ];
            }

            if ($pengumuman < $diskon[1]['tgl']) {
                $diskon = array();
                $diskon = [
                    1 => [
                        'no' => 1,
                        'tgl' => new \DateTime('2024-11-1 00:00:00'),
                        'tanggal' => formatIndo($pengumuman),
                        'diskon' => $diskonUnit[1][$unitd]
                    ]
                ];
            }

            // $cekdiskon[1] = $diskon[1]['diskon'];
            // $cekdiskon[2] = $diskon[2]['diskon'];

            $batas = 0;

            if (array_key_exists(3, $diskon)) {
                if ($diskon[2]['tgl'] > $bataskolom) {
                    $batas = 1;
                }
            }

            if (array_key_exists(2, $diskon)) {
                if ($diskon[2]['tgl'] > $bataskolom) {
                    $batas = 1;
                }
            }

            if (array_key_exists(1, $diskon)) {
                if ($diskon[1]['tgl'] > $bataskolom) {
                    $batas = 2;
                }
            }

            $agreement = Agreement::orderBy('id', 'asc')->get();
            if ($ctg->khusus == 1) {
                $pdf = PDF::loadView('pdf.' . substr(auth()->user()->tp_name, 0, 4) . '.tagihanPSBKhusus', compact('biayanya', 'ctg', 'security', 'calon', 'biaya1', 'total1', 'totalpegawai', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir', 'bulanmasuk'));
            }
            if ($ctg->khusus == 0) {
                $pdf = PDF::loadView('pdf.' . substr(auth()->user()->tp_name, 0, 4) . '.tagihanPSB', compact('biayanya', 'ctg', 'security', 'calon', 'biaya1', 'total1', 'totalpegawai', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir', 'diskon', 'pengumuman', 'batas', 'bulanmasuk', 'kontrak', 'hitungbln', 'bulan', 'ketProgramNF', 'programNF', 'biayaProgramNF', 'agreement'));
            }

            // if ($khusus == 1) {
            //     $pdf = PDF::loadView('pdf.tagihanPSBKhusus', compact('biayanya', 'ctg', 'security', 'calon', 'biaya1', 'biaya2', 'biaya3', 'total1', 'total2', 'total3', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir'));
            // }

            return $pdf->stream('');
        }
    }

    public function getCalon($id)
    {
        $tp = $this->tp_berjalan;
        $calon = Calon::with('gelnya.unitnya.catnya', 'kelasnya')
            ->whereId($id)->first();

        $now = new \DateTime();
        $tglbatas = "31 Mei 2021";
        $reg1 = new \DateTime('2021-02-1');
        $reg2 = new \DateTime('2021-03-1');
        $reg3 = new \DateTime('2021-04-1');

        if ($reg3 > $now) {
            $tglbatas = "31 April 2021";
        }

        if ($reg2 > $now) {
            $tglbatas = "31 Maret 2021";
        }

        if ($reg1 > $now) {
            $tglbatas = "31 Januari 2021";
        }

        return view('wawancara.invoice', compact('calon', 'tglbatas', 'tp'));

        // $id = $request->id;
        // $va = substr($id, 0, 6);
        // $urt = intval(substr($id, 6));
        // if(auth()->user()->isAdmin() || auth()->user()->isAdminKeu()) {
        //     $gelombang = Gelombang::where('kode_va', $va)->get()->pluck('id');
        //     if(count($gelombang) > 0){
        //         $calon = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'usernya')
        //                 ->where('gel_id',$gelombang)
        //                 ->where('urut',$urt)
        //                 ->where('status',1)->first();
        //         $tagihans = TagihanPSB::where('kelas', $calon->kelas_tujuan)->get();
        //         $no = 1;
        //         return view('wawancara.invoice', compact('calon', 'tagihans', 'no'));
        //     }
        //     return redirect()->back()->with('error', 'Maaf, No. Pendaftaran : '. $id .' tidak ditemukan');
        // }
    }

    public function editbio($id)
    {
        $calon = Calon::whereId($id)->first();
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
        return view('wawancara.editbio', compact('calon', 'provinsi', 'kota', 'kecamatan', 'kelurahan'));
    }

    public function updatebio(Request $request)
    {
        $calon = Calon::whereId($request->id)->first();
        $calon->update($request->all());

        return redirect()->route('getCalon', $request->id);
    }

    public function editkeu($id)
    {
        $calon = Calon::whereId($id)->first();
        $potongan = CalonTagihanPSB::where('calon_id', $id)->first();

        return view('wawancara.editkeu', compact('calon', 'potongan'));
    }

    public function updatekeu(Request $request)
    {
        $calon = CalonTagihanPSB::where('calon_id', $request->id)->first();
        $pots = [
            [
                'potongan' => 0,
                'keterangan' => 'Tidak ada potongan',
                'notif' => 0
            ],
            [
                'potongan' => 10,
                'keterangan' => 'Asal dari NF (Depok/Bogor)',
                'notif' => 0
            ],
            [
                'potongan' => 5,
                'keterangan' => 'Memiliki Saudara kandung PERTAMA di NF',
                'notif' => 1
            ],
            [
                'potongan' => 10,
                'keterangan' => 'Memiliki Saudara kandung KEDUA di NF',
                'notif' => 1
            ],
            [
                'potongan' => 10,
                'keterangan' => 'Diskon Mendaftarkan lebih dari 1',
                'notif' => 1
            ],
            [
                'potongan' => 50,
                'keterangan' => 'Diskon anak PEGAWAI TETAP',
                'notif' => 1
            ],
            [
                'potongan' => 50,
                'keterangan' => 'Diskon anak PEGAWAI KONTRAK',
                'notif' => 1
            ],
            [
                'potongan' => 25,
                'keterangan' => 'Diskon Undangan Khusus asal NF (Depok/Bogor)',
                'notif' => 0
            ],
            [
                'potongan' => 50,
                'keterangan' => 'Diskon Pemenang Lomba tingkat Nasional (Bertingkat)',
                'notif' => 0
            ],
            [
                'potongan' => 50,
                'keterangan' => 'Diskon Hafal minimal 15 Juz',
                'notif' => 0
            ],
            [
                'potongan' => 15,
                'keterangan' => 'Diskon Hafal minimal 4 Juz untuk Pendaftar SD',
                'notif' => 0
            ],
            [
                'potongan' => 15,
                'keterangan' => 'Diskon Hafal minimal 8 Juz untuk Pendaftar SMP',
                'notif' => 0
            ],
            [
                'potongan' => 15,
                'keterangan' => 'Diskon Hafal minimal 10 Juz untuk Pendaftar SMA',
                'notif' => 0
            ]
        ];
        $potongan = 0;
        $keterangan = $pots[0]['keterangan'];
        if ($request->potongan) {
            $potongan = $pots[$request->potongan]['potongan'];
            $keterangan = $pots[$request->potongan]['keterangan'];
        }
        // dd($keterangan);
        $calon->update([
            'potongan' => $potongan,
            'keterangan' => $keterangan,
            'infaq' => $request['infaq'],
            'infaqnfpeduli' => $request['infaqnfpeduli'],
            'saudara' => $request['saudara'],
        ]);

        return redirect()->route('wawancara-keu');
    }
}

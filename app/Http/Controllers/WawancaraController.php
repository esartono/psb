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
        if(auth()->user()->level == 2) {
            $ctg = CalonTagihanPSB::where('calon_id', $id)->first();
            $calon = Calon::findOrFail($id);
            if(auth()->user()->id !== $calon->user_id) {
                return redirect()->route('home');
            }
        }

        if(auth()->user()->level == 1 || auth()->user()->level == 4) {
            $ctg = CalonTagihanPSB::where('calon_id', $id)->first();
            $calon = Calon::findOrFail($id);
            if(!$ctg) {
                return redirect()->route('home');
            }
        }

        if ($calon->asal_nf == 1) {
            if ($ctg->potongan == 0){
                $ctg->update(['potongan' => 10]);
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

        $biayanya = ['Dana Pengembangan', 'Dana Pendidikan', 'SPP bulan Juli', 'Iuran Komite Sekolah / tahun', 'Seragam'];

        $security = $ctg->created_at;

        $id = $ctg->calon_id;
        // $tgh_id = $ctg->tagihanpsb_id;
        //Kalo ini ada yg di edit, maka di TagihanPSBController.show juga mulai dari baris ini
        $khusus = 0;
        
        if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
            $tp_cek = $tp_awal-1 . '/' . $tp_awal;
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

        if($ctg->keterangan === 'Diskon anak PEGAWAI TETAP' || $ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
            $diskonpegawai = $biaya1['SPP bulan Juli'] * ($ctg->potongan/100);
            $biaya1['SPP bulan Juli'] = $biaya1['SPP bulan Juli'] - $diskonpegawai;
            
            $diskonpegawai2 = $biaya1['Dana Pengembangan'] * ($ctg->potongan/100);
            $biaya1['Dana Pengembangan'] = $biaya1['Dana Pengembangan'] - $diskonpegawai2;
            
            $diskonpegawai3 = $biaya1['Dana Pendidikan'] * ($ctg->potongan/100);
            $biaya1['Dana Pendidikan'] = $biaya1['Dana Pendidikan'] - $diskonpegawai3;
            
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
                '6' => 4500000,
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

        $bulanmasuk = 'SPP bulan '.$bln[$calon->rencana_masuk];

        if($calon->pindahan === 0) {
            $bulan = 'SPP '.$bln[($calon->rencana_masuk)+1].' '.($tp_awal+$no-1).' s/d SPP Juni '.($tp_akhir+$no-1);
            $hitungbln = 11;
        }
        if($calon->pindahan === 1) {
            if($calon->rencana_masuk >= 7) {
                $bulan = 'SPP '.$bln[($calon->rencana_masuk)+1].' '.($tp_awal+$no-1).' s/d SPP Juni '.($tp_akhir+$no-1);
                $hitungbln = 12 - $calon->rencana_masuk + 6;
            }

            if($calon->rencana_masuk <= 6) {
                $bulan = 'SPP '.$bln[($calon->rencana_masuk)+1].' '.($tp_awal+$no-1).' s/d SPP Juni '.($tp_akhir+$no-1);
                $hitungbln = 6 - $calon->rencana_masuk;
            }
        }

        foreach($kelass as $k) {
            if ($no === 1){
                $sppnya = $biayas->spp;
                if($ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                    $sppnya = $biayas->spp * ($ctg->potongan/100);
                }
                if($ctg->keterangan === 'Diskon anak PEGAWAI TETAP') {
                    $sppnya = $biayas->spp * ($ctg->potongan/100);
                }
                if ($pindahan == 0) {
                    $kelas[$k->name]['ket'][0] = 'SPP Agustus '.($tp_awal+$no-1).' s/d SPP Juni '.($tp_akhir+$no-1);
                    $kelas[$k->name]['total'][0] = $sppnya*11;
                    $totalth = $totalth + $sppnya*11;
                }
                if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                    $sppnya = $biayas->spppindahan;
                }
                if ($pindahan == 1) {
                    // $kelas[$k->name]['ket'][0] = 'SPP Februari s/d SPP Juni '.($tp_akhir+$no-1-$khusus);
                    $kelas[$k->name]['ket'][0] = $bulan;
                    $kelas[$k->name]['total'][0] = $sppnya*$hitungbln;
                    $totalth = $totalth + $sppnya*$hitungbln;
                }
            }
            if ($no > 1) {
                $sppnya = $biayas->spp + ($spp_naik*($no-1));
                if ($calon->pindahan == 1 && $calon->rencana_masuk != 7) {
                    $sppnya = $biayas->spppindahan + ($spp_naik*($no-1));
                }
                if($ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                    $sppnya = ($biayas->spp + ($spp_naik*($no-1))) * ($ctg->potongan/100);
                }
                if($ctg->keterangan === 'Diskon anak PEGAWAI TETAP') {
                    $sppnya = ($biayas->spp + ($spp_naik*($no-1))) * ($ctg->potongan/100);
                }

                if($k->name == 'TK A' || $k->name == 'TK B' || $k->name == 'PG') {
                    $sppnya = $biayas->spp + 100000;
                    if($ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                        $sppnya = ($biayas->spp + 100000) * ($ctg->potongan/100);
                    }
                    if($ctg->keterangan === 'Diskon anak PEGAWAI TETAP') {
                        $sppnya = ($biayas->spp + 100000) * ($ctg->potongan/100);
                    }
    
                }
                $kelas[$k->name]['ket'][$no-1] = 'SPP Juli '.($tp_awal+$no-1-$khusus).' s/d SPP Juni '.($tp_akhir+$no-1-$khusus);
                $kelas[$k->name]['total'][$no-1] = $sppnya*12;
                if($ctg->keterangan === 'Diskon anak PEGAWAI TETAP' || $ctg->keterangan === 'Diskon anak PEGAWAI KONTRAK') {
                    $daul[$k->name] = $daul[$k->name] - ($daul[$k->name] * $ctg->potongan/100);
                }
                $kelas[$k->name]['daul'][$no-1] = $daul[$k->name];
                $totalth = $totalth + $sppnya*12 + $daul[$k->name];
            }
            $kelas[$k->name]['spp'][$no-1] = $sppnya;
            $totalAll[$tgh_id] = $totalth;
            $kelas[$k->name]['kelas'] = $k->name;
            $no = $no + 1;
        }

        $now = new \DateTime();
        $diskon = [
            1 => [
                'tgl' => new \DateTime('2022-11-1'),
                'tanggal' => "31 Oktober 2022",
                'diskon' => 4000000
            ],
            2 => [
                'tgl' => new \DateTime('2022-12-1'),
                'tanggal' => "30 November 2022",
                'diskon' => 3000000
            ],
            3 => [
                'tgl' => new \DateTime('2023-1-1'),
                'tanggal' => "31 Desember 2022",
                'diskon' => 1500000
            ]
        ];

        $bataskolom = new \DateTime($ctg->created_at->toDateString());
        $batas = 0;

        if($diskon[2]['tgl'] > $bataskolom) {
            $batas = 1;
        }

        if($diskon[1]['tgl'] > $bataskolom) {
            $batas = 2;
        }

        $cjadwal = CalonJadwal::where('calon_id', $ctg->calon_id)->first()->jadwal_id;
        if($cjadwal) {
            $pengumuman = Jadwal::whereId($cjadwal)->first()->pengumuman->addDays(30);
        }

        // if ($ctg->khusus == 0) {
            $pdf = PDF::loadView('pdf.'.substr(auth()->user()->tp_name,0 ,4).'.tagihanPSB', compact('biayanya', 'ctg', 'security', 'calon', 'biaya1', 'total1', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir', 'diskon', 'pengumuman', 'batas', 'bulanmasuk'));
        // }

        // if ($khusus == 1) {
        //     $pdf = PDF::loadView('pdf.tagihanPSBKhusus', compact('biayanya', 'ctg', 'security', 'calon', 'biaya1', 'biaya2', 'biaya3', 'total1', 'total2', 'total3', 'kelass', 'kelas', 'totalAll', 'tp_awal', 'tp_akhir'));
        // }

        return $pdf->stream('');
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

        if($reg3 > $now) {
            $tglbatas = "31 April 2021";
        }

        if($reg2 > $now) {
            $tglbatas = "31 Maret 2021";
        }

        if($reg1 > $now) {
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

    public function editbio($id) {
        $calon = Calon::whereId($id)->first();
        $provinsi = Provinsi::orderBy('name', 'asc')->get();
        $kota = $kecamatan = $kelurahan = "";
        if($calon->provinsi){
            $kota = Kota::where('prov_id', $calon->provinsi)->get();
            if($calon->kota){
                $kecamatan = Kecamatan::where('kota_id', $calon->kota)->get();
                if($calon->kecamatan){
                    $kelurahan = Kelurahan::where('camat_id', $calon->kecamatan)->get();
                }
            }
        }
        return view('wawancara.editbio', compact('calon', 'provinsi', 'kota', 'kecamatan', 'kelurahan'));
    }

    public function updatebio(Request $request) {
        $calon = Calon::whereId($request->id)->first();
        $calon->update($request->all());

        return redirect()->route('getCalon', $request->id);
    }

    public function editkeu($id) {
        $calon = Calon::whereId($id)->first();
        $potongan = CalonTagihanPSB::where('calon_id', $id)->first();
        
        return view('wawancara.editkeu', compact('calon', 'potongan'));
    }

    public function updatekeu(Request $request) {
        $calon = CalonTagihanPSB::where('calon_id', $request->id)->first();
        $pots = [
            [
                'potongan' => 0,
                'keterangan' => 'Tidak ada potongan',
                'notif' => 0
            ],[
                'potongan' => 10,
                'keterangan' => 'Asal dari NF (Depok/Bogor)',
                'notif' => 0
            ],[
                'potongan' => 5,
                'keterangan' => 'Memiliki Saudara kandung PERTAMA di NF',
                'notif' => 1
            ],[
                'potongan' => 10,
                'keterangan' => 'Memiliki Saudara kandung KEDUA di NF',
                'notif' => 1
            ],[
                'potongan' => 10,
                'keterangan' => 'Diskon Mendaftarkan lebih dari 1',
                'notif' => 1
            ],[
                'potongan' => 50,
                'keterangan' => 'Diskon anak PEGAWAI TETAP',
                'notif' => 1
            ],[
                'potongan' => 50,
                'keterangan' => 'Diskon anak PEGAWAI KONTRAK',
                'notif' => 1
            ],[
                'potongan' => 25,
                'keterangan' => 'Diskon Undangan Khusus asal NF (Depok/Bogor)',
                'notif' => 0
            ],[
                'potongan' => 50,
                'keterangan' => 'Diskon Pemenang Lomba tingkat Nasional (Bertingkat)',
                'notif' => 0
            ],[
                'potongan' => 25,
                'keterangan' => 'Diskon Hafal minimal 15 Juz',
                'notif' => 0
            ]
        ];
        $potongan = 0;
        $keterangan = $pots[0]['keterangan'];
        if($request->potongan) {
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

<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Calon;
use App\Agama;
use App\BiayaTes;
use App\Kelasnya;
use App\Provinsi;
use App\Pekerjaan;
use App\Gelombang;
use App\Agreement;
use App\Pendidikan;
use App\DraftCalon;
use App\SumberInfo;
use App\CalonBiayaTes;
use App\CalonKategori;
use App\SchoolCategory;

use App\Edupay\Facades\Edupay;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class DraftCalonController extends Controller
{
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
        $step = 1;
        $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
        $kategories = CalonKategori::orderBy('id', 'asc')->get();
        $agreement = Agreement::orderBy('id','asc')->get();
        $infos = SumberInfo::orderBy('id', 'asc')->get();
        $agama = Agama::orderBy('id', 'asc')->get();
        $provinsi = Provinsi::orderBy('name', 'asc')->get();
        $pendidikan = Pendidikan::orderBy('id', 'asc')->get();
        $pekerjaan = Pekerjaan::orderBy('id', 'asc')->get();

        $pilihan = [
            ['name' => 'Pilih Unit', 'icon' => 'fas fa-school'],
            ['name' => 'Orang Tua', 'icon' => 'fas fa-users'],
            ['name' => 'Data Pribadi', 'icon' => 'fas fa-user'],
            ['name' => 'Data Alamat', 'icon' => 'fas fa-home'],
            ['name' => 'Data Orang Tua', 'icon'=> 'fas fa-users'],
            ['name' => 'Data Asal Sekolah', 'icon'=> 'fas fa-school'],
            ['name' => 'Form Persetujuan', 'icon' => 'fas fa-handshake'],
        ];

        if(!$calon) {
            return view('user.create', compact('step', 'pilihan', 'age'));
        }

        if($l) {
            if($calon) {
                $ok = $calon->pindahan;
                if($calon->tgl_lahir){
                    $age = $calon->tgl_lahir;
                } else {
                    $age = Gelombang::where('id', $calon->gel_id)->first()->minimum_age;
                }
                if(intval($l) <= $calon->step) {
                    $step = $l;
                } else {
                    $step = $calon->step;
                }
            }

        }

        if(!$l) {
            if($calon) {
                $ok = $calon->pindahan;
                $step = $calon->step;
                if($calon->tgl_lahir){
                    $age = $calon->tgl_lahir;
                } else {
                    $age = Gelombang::where('id', $calon->gel_id)->first()->minimum_age;
                }
            }
        }

        if($ok === true || $ok === 1){
            $cekkelas = Kelasnya::where('status', 1)
                ->whereIn('tahun_ajaran', [0,2])
                ->get()
                ->groupBy('unit_id')->keys()->toArray();
        } else {
            $cekkelas = Kelasnya::where('status', 1)
                ->whereIn('tahun_ajaran', [0,1])
                ->get()
                ->groupBy('unit_id')->keys()->toArray();
        }

        $units = Unit::with('catnya')->whereIn('id', $cekkelas)->orderBy('id', 'asc')->get();
        $min_age = Gelombang::where('id', $calon->gel_id)->first()->minimum_age;

        return view('user.create', compact(
            'agama',
            'age',
            'agreement',
            'calon',
            'infos',
            'kategories',
            'min_age',
            'pilihan',
            'provinsi',
            'pendidikan',
            'pekerjaan',
            'step',
            'units',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->step == 1) {
            if($request->pindahan == 'ya') {
                $ok = true;
            }

            if($request->pindahan == 'tidak') {
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

        if($request->step == 2) {
            $gelombang = Gelombang::where('unit_id', $request->unit)->latest()->first()->id;
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();

            if($calon->pindahan){
                $kelas = $request->kelas_tujuan;
            }

            if(!$calon->pindahan){
                $unit = Unit::where('id', $request->unit)->first()->cat_id;
                $cat = SchoolCategory::where('id', $unit)->first()->name;
                if($cat === 'TK'){
                    $kelas = $request->kelas_tujuan;
                }
                if($cat === 'SD'){
                    $kelas = Kelasnya::where('name', '1')->first()->id;
                }
                if($cat === 'SMP'){
                    $kelas = Kelasnya::where('name', '7')->first()->id;
                }
                if($cat === 'SMA'){
                    $kelas = Kelasnya::where('name', '10')->first()->id;
                }
            }
            $calon->update([
                'gel_id' => $gelombang,
                'kelas_tujuan' => $kelas,
                'step' => 3,
            ]);

            $step = 3;
        }

        if($request->step == 3) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $calon->update([
                'ck_id' => $request->ck_id,
                'asal_nf' => $request->asal_nf,
                'step' => 4,
            ]);

            $step = 4;
        }

        if($request->step == 4) {
            $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            $pecah_tgl = explode(' ', $request->tgl_lahir);
            $m = (array_search($pecah_tgl[1], $bulan))+1;

            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $calon->update([
                'name' => $request->name,
                'panggilan' => $request->panggilan,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $pecah_tgl[2].'-'.$m.'-'.$pecah_tgl[0],
                'jk' => $request->jk,
                'agama' => $request->agama,
                'nisn' => $request->nisn,
                'nik' => $request->nik,
                'info' => $request->info,
                'step' => 5,
            ]);

            $step = 5;
        }

        if($request->step == 5) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $calon->update($request->except('step')+['step'=>6]);

            $step = 6;
        }

        if($request->step == 6) {
            $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
            $calon->update($request->except('step')+['step'=>7]);

            $step = 7;
            if($calon->asal_nf == 1) {
                $calon->update(['step'=>8]);
                $step = 8;
            }
        }

        if($request->step == 7) {
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

        if($request->step == 8) {
            $draft = DraftCalon::where('user_id', auth()->user()->id)->first();
            $draft->update(['step'=>8]);

            $urut = Calon::where('gel_id', $draft['gel_id'])->get()->count();

        if ($request['jurusan']) {
            $jurusan = $request['jurusan'];
        } else {
            $jurusan = "-";
        }

        $calon = Calon::create([
            'gel_id' => $draft['gel_id'],
            'ck_id' => $draft['ck_id'],
            'tgl_daftar' => date('Y-m-d'),
            'urut' => $urut+1,
            'nisn' => $draft['nisn'],
            'nik' => $draft['nik'],
            'name' => $draft['name'],
            'panggilan' => $draft['panggilan'],
            'jk' => $draft['jk'],
            'kelas_tujuan' => $draft['kelas_tujuan'],
            'jurusan' => $jurusan,
            'photo' => 'Belum Ada',
            'tempat_lahir' => $draft['tempat_lahir'],
            'tgl_lahir' => $draft['tgl_lahir'],
            'agama' => $draft['agama'],
            'info' => $draft['info'],
            'status' => false,
            'setuju' => $draft['setuju'],
            'user_id' => auth()->user()->id,
            'alamat' => $draft['alamat'],
            'rt' => $draft['rt'],
            'rw' => $draft['rw'],
            'kodepos' => $draft['kodepos'],
            'provinsi' => $draft['provinsi'],
            'kota' => $draft['kota'],
            'kecamatan' => $draft['kecamatan'],
            'kelurahan' => $draft['kelurahan'],
            'phone' => $draft['phone'],
            'ayah_nama' => $draft['ayah_nama'],
            'ayah_pendidikan' => $draft['ayah_pendidikan'],
            'ayah_pekerjaan' => $draft['ayah_pekerjaan'],
            'ayah_penghasilan' => $draft['ayah_penghasilan'],
            'ayah_hp' => $draft['ayah_hp'],
            'ayah_email' => $draft['ayah_email'],
            'ibu_nama' => $draft['ibu_nama'],
            'ibu_pendidikan' => $draft['ibu_pendidikan'],
            'ibu_pekerjaan' => $draft['ibu_pekerjaan'],
            'ibu_penghasilan' => $draft['ibu_penghasilan'],
            'ibu_hp' => $draft['ibu_hp'],
            'ibu_email' => $draft['ibu_email'],
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
        if($biaya) {
            $calonbiaya = CalonBiayaTes::create([
                'calon_id' => $calon->id,
                'biaya_id' => $biaya->id,
                'expired' => date("Y-m-d", strtotime("+3 days"))
            ]);

            Edupay::create($calon->uruts, $biaya->biaya, $calon->name, $calon->tgl_daftar, date("Y-m-d", strtotime("+3 days")));
            $calonsnya = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya','usernya')->where('id',$calon->id)->first();
            Mail::send('emails.biayates', compact('calonsnya'), function ($m) use ($calonsnya)
                {
                    $m->to($calonsnya->usernya->email, $calonsnya->name)->from('psb@nurulfikri.sch.id', 'Panitia PSB SIT Nurul Fikri')->subject('Biaya Tes SIT Nurul Fikri');
                }
            );
        }
        dd('EKO');
        // return redirect('tambahcalon/'.$step);
        }
        return redirect('tambahcalon/'.$step);
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
    public function edit(DraftCalon $draftCalon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DraftCalon  $draftCalon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DraftCalon $draftCalon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DraftCalon  $draftCalon
     * @return \Illuminate\Http\Response
     */
    public function destroy(DraftCalon $draftCalon)
    {
        //
    }
}

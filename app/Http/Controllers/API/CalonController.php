<?php

namespace App\Http\Controllers\API;

use App\BiayaTes;
use App\Calon;
use App\CalonBiayaTes;
use App\CalonJadwal;
use App\Facades\Maja;
use App\Gelombang;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCalonRequest;
use App\Kecamatan;
use App\Kelurahan;
use App\Kota;
use App\CalonSeragam;
use App\JDoku;

use Excel;
use App\Exports\SiswaBaruExport;
use App\Exports\CpdBaruExport;
use App\Exports\CpdAktifExport;
use App\Exports\CpdJadwalTes;
use App\Exports\CpdExportBank;
use App\Exports\CpdExportSeragam;

class CalonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api')->except('exportsiswabaru', 'exportbaru', 'exportaktif', 'exportjadwal', 'exportBank', 'exportSeragam', 'updateJurusan');
    }

    public function index()
    {
        if (auth('api')->user()->isUser()) {
            $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('id');
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya');

            return $calons->where('user_id', auth('api')->user()->id)
                ->where('aktif', true)
                ->whereIn('gel_id', $gelombang)->get()->toArray();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCalonRequest $request)
    {
        $urut = Calon::where('gel_id', $request['gel_id'])->get()->count();

        if ($request['jurusan']) {
            $jurusan = $request['jurusan'];
        } else {
            $jurusan = "-";
        }

        $calon = Calon::create([
            'gel_id' => $request['gel_id'],
            'ck_id' => $request['ck_id'],
            'tgl_daftar' => date('Y-m-d'),
            'urut' => $urut + 1,
            'nisn' => $request['nisn'],
            'nik' => $request['nik'],
            'name' => $request['name'],
            'panggilan' => $request['panggilan'],
            'jk' => $request['jk'],
            'kelas_tujuan' => $request['kelas_tujuan'],
            'jurusan' => $jurusan,
            'photo' => 'Belum Ada',
            'tempat_lahir' => $request['tempat_lahir'],
            'tgl_lahir' => $request['tgl_lahir'],
            'agama' => $request['agama'],
            'info' => $request['info'],
            'status' => false,
            'setuju' => $request['setuju'],
            'user_id' => auth('api')->user()->id,
            'alamat' => $request['alamat'],
            'rt' => $request['rt'],
            'rw' => $request['rw'],
            'kodepos' => '13791',
            'provinsi' => $request['provinsi'],
            'kota' => $request['kota'],
            'kecamatan' => $request['kecamatan'],
            'kelurahan' => $request['kelurahan'],
            'phone' => $request['phone'],
            'ayah_nama' => $request['ayah_nama'],
            'ayah_pendidikan' => $request['ayah_pendidikan'],
            'ayah_pekerjaan' => $request['ayah_pekerjaan'],
            'ayah_penghasilan' => $request['ayah_penghasilan'],
            'ayah_hp' => $request['ayah_hp'],
            'ayah_email' => $request['ayah_email'],
            'ibu_nama' => $request['ibu_nama'],
            'ibu_pendidikan' => $request['ibu_pendidikan'],
            'ibu_pekerjaan' => $request['ibu_pekerjaan'],
            'ibu_penghasilan' => $request['ibu_penghasilan'],
            'ibu_hp' => $request['ibu_hp'],
            'ibu_email' => $request['ibu_email'],
            'asal_nf' => $request['asal_nf'],
            'pindahan' => $request['pindahan'],
            'tahun_sekarang' => $request('tahun_sekarang'),
            'asal_sekolah' => $request['asal_sekolah'],
            'asal_alamat_sekolah' => $request['asal_alamat_sekolah'],
            'asal_propinsi_sekolah' => $request['asal_propinsi_sekolah'],
            'asal_kota_sekolah' => $request['asal_kota_sekolah'],
            'asal_kecamatan_sekolah' => $request['asal_kecamatan_sekolah'],
            'asal_kelurahan_sekolah' => $request['asal_kelurahan_sekolah'],
        ]);

        $biaya = BiayaTes::where('gel_id', $request['gel_id'])
            ->where('ck_id', $request['ck_id'])
            ->get()->first();
        if ($biaya) {
            $calonbiaya = CalonBiayaTes::create([
                'calon_id' => $calon->id,
                'biaya_id' => $biaya->id,
                'expired' => date("Y-m-d", strtotime("+3 days"))
            ]);

            // Maja::create($calon->uruts, $biaya->biaya, $calon->name, $calon->tgl_daftar, date("Y-m-d", strtotime("+3 days")));
            $calonsnya = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')->where('id', $calon->id)->first();
            // Mail::send('emails.biayates', compact('calonsnya'), function ($m) use ($calonsnya)
            //     {
            //         $m->to($calonsnya->usernya->email, $calonsnya->name)->from('psb@nurulfikri.sch.id', 'Panitia PPDB SIT Nurul Fikri')->subject('Biaya Tes SIT Nurul Fikri');
            //     }
            // );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth('api')->user()->isUser()) {
            $calon = Calon::with('gelnya.unitnya.catnya')
                ->where('user_id', auth('api')->user()->id)
                ->where('id', $id)
                ->first();

            if ($calon) {
                $kota = Kota::where('prov_id', $calon->provinsi)->get();
                $camat = Kecamatan::where('kota_id', $calon->kota)->get();
                $lurah = Kelurahan::where('camat_id', $calon->kecamatan)->get();
                $kota_sekolah = Kota::where('prov_id', $calon->asal_propinsi_sekolah)->get();
                $camat_sekolah = Kecamatan::where('kota_id', $calon->asal_kota_sekolah)->get();
                $lurah_sekolah = Kelurahan::where('camat_id', $calon->asal_kecamatan_sekolah)->get();
                return compact('calon', 'kota', 'camat', 'lurah', 'kota_sekolah', 'camat_sekolah', 'lurah_sekolah');
            } else {
                return response()->json(['message' => 'Not Found!'], 404);
            }
        }

        if (auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
            $calon = Calon::with('gelnya.unitnya.catnya')->where('id', $id)->first();

            if ($calon) {
                $kota = Kota::where('prov_id', $calon->provinsi)->get();
                $camat = Kecamatan::where('kota_id', $calon->kota)->get();
                $lurah = Kelurahan::where('camat_id', $calon->kecamatan)->get();
                $kota_sekolah = Kota::where('prov_id', $calon->asal_propinsi_sekolah)->get();
                $camat_sekolah = Kecamatan::where('kota_id', $calon->asal_kota_sekolah)->get();
                $lurah_sekolah = Kelurahan::where('camat_id', $calon->asal_kecamatan_sekolah)->get();
                return compact('calon', 'kota', 'camat', 'lurah', 'kota_sekolah', 'camat_sekolah', 'lurah_sekolah');
            } else {
                return response()->json(['message' => 'Not Found!'], 404);
            }
        }
    }

    public function indexAdmin($id)
    {
        if (auth('api')->user()->isAdmin() || auth('api')->user()->isAdminKeu() || auth('api')->user()->isPsikotes() || auth('api')->user()->isPengadaan()) {
            $gelombang = Gelombang::where('tp', auth('api')->user()->tpid)->get()->pluck('id');
        }

        if (auth('api')->user()->isAdminUnit()) {
            $unit = auth('api')->user()->unit_id;
            $gelombang = Gelombang::where('unit_id', $unit)->where('tp', auth('api')->user()->tpid)->get()->pluck('id');
        }

        if (auth('api')->user()->isAdmin() || auth('api')->user()->isAdminKeu()) {
            if ($id === '1000') {
                return DB::table('calons')
                    ->select(
                        'calons.id',
                        'calons.name',
                        'jk',
                        'pindahan',
                        'kelasnyas.name as kelas',
                        'gelombangs.kode_va',
                        'users.name as ygwawancara',
                        'urut',
                        DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
                    )
                    ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                    ->leftJoin('calon_tagihan_p_s_b_s', 'calons.id', '=', 'calon_tagihan_p_s_b_s.calon_id')
                    ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
                    ->leftJoin('users', 'calon_tagihan_p_s_b_s.pewawancara', '=', 'users.id')
                    ->whereIn('gel_id', $gelombang)
                    ->where('calons.status', 1)
                    ->where('calons.aktif', true)
                    ->orderBy('ygwawancara', 'asc')
                    ->orderBy('calons.name', 'asc')
                    ->get()
                    ->toArray();
            }
        }

        if (auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit()) {
            if ($id === '1001') {
                $calons = DB::table('calons')
                    ->select(
                        'calons.id',
                        'calons.ck_id',
                        'calons.name',
                        'calons.asal_nf',
                        'units.name as unit',
                        DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts'),
                        DB::raw("GROUP_CONCAT(j_dokus.name ORDER BY j_dokus.name SEPARATOR ',') as sudah")
                    )
                    ->groupBy('calons.id')
                    ->leftJoin('dokus', 'calons.id', '=', 'dokus.calon_id')
                    ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                    ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                    ->leftJoin('j_dokus', 'dokus.jdoku', '=', 'j_dokus.code')
                    ->whereIn('gel_id', $gelombang)
                    ->where('calons.status', 1)
                    ->where('calons.aktif', true)
                    ->orderBy('calons.name', 'asc')
                    ->get();

                return $calons->map(function ($arr) {
                    // $ck = array('', 'Umum', 'Siswa SIT NF', 'Pegawai SIT NF');
                    // $cknya = $ck[$arr->ck_id];
                    // if ($arr->asal_nf == 1) {
                    //     $cknya = 'Siswa SIT NF';
                    // }
                    $jdoku['TK'] = JDoku::where('unit', 'like', '%TK%')->pluck('name')->toArray();
                    // ->where('khusus', 'like', '%' . $cknya . '%')->pluck('name')->toArray();
                    $jdoku['SD'] = JDoku::where('unit', 'like', '%SD%')->pluck('name')->toArray();
                    // ->where('khusus', 'like', '%' . $cknya . '%')->pluck('name')->toArray();
                    $jdoku['SMP'] = JDoku::where('unit', 'like', '%SMP%')->pluck('name')->toArray();
                    // ->where('khusus', 'like', '%' . $cknya . '%')->pluck('name')->toArray();
                    $jdoku['SMA'] = JDoku::where('unit', 'like', '%SMA%')->pluck('name')->toArray();
                    // ->where('khusus', 'like', '%' . $cknya . '%')->pluck('name')->toArray();

                    $u = trim(str_replace('IT Nurul Fikri', '', $arr->unit));
                    $s = explode(',', $arr->sudah);
                    $sdh = implode(', ', array_diff($jdoku[$u], $s));

                    return [
                        'id' => $arr->id,
                        'name' => $arr->name,
                        'unit' => $arr->unit,
                        'uruts' => $arr->uruts,
                        'sudah' => ($sdh == '') ? 'Lengkap' : $sdh
                    ];
                });

                // return compact('calons');
            }
        }

        if (auth('api')->user()->isAdmin() || auth('api')->user()->isPsikotes()) {
            if ($id === '101') {
                return DB::table('calons')
                    ->select(
                        'calons.id',
                        'calons.name',
                        'units.name as unit',
                        'users.email as email',
                        DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
                    )
                    ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                    ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                    ->leftJoin('users', 'calons.user_id', '=', 'users.id')
                    ->whereIn('gel_id', $gelombang)
                    ->where('calons.status', 1)
                    ->where('calons.aktif', true)
                    ->orderBy('calons.name', 'asc')
                    ->get()
                    ->toArray();
            }
        }

        if (auth('api')->user()->isAdmin() || auth('api')->user()->isPengadaan()) {
            if ($id === '102') {
                return DB::table('calon_seragams')
                    ->select(
                        'calons.id',
                        'calons.name',
                        'units.name as unit',
                        'calon_seragams.atas as atas',
                        'calon_seragams.bawah as bawah',
                        DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts'),
                        DB::raw('IF(calons.jk=1, "L", "P") as kelamin')
                    )
                    ->leftJoin('calons', 'calon_seragams.calon_id', '=', 'calons.id')
                    ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                    ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                    ->whereIn('gel_id', $gelombang)
                    ->orderBy('calons.name', 'asc')
                    ->get()
                    ->toArray();
            }
        }

        if (auth('api')->user()->isAdmin() || auth('api')->user()->isAdminUnit() || auth('api')->user()->isAdminKeu()) {
            if ($id === '100') {
                // return Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'usernya')
                //     ->whereIn('gel_id', $gelombang)
                //     ->where('aktif', true)
                //     ->get()->toArray();
                return DB::table('calons')
                    ->select(
                        'calons.id',
                        'calons.name',
                        'jk',
                        'tempat_lahir',
                        'tgl_lahir',
                        'ayah_nama',
                        'ibu_nama',
                        'users.email as email',
                        'users.phone as phone',
                        'jurusan',
                        'asal_sekolah',
                        'calon_kategoris.name as ck',
                        'gelombangs.kode_va',
                        'urut',
                        'units.name as unit',
                        DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
                    )
                    ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                    ->leftJoin('calon_kategoris', 'calons.ck_id', '=', 'calon_kategoris.id')
                    ->leftJoin('users', 'calons.user_id', '=', 'users.id')
                    ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
                    ->whereIn('gel_id', $gelombang)
                    ->where('aktif', true)
                    ->get()->toArray();
            }
            if ($id === '1') {
                return DB::table('calons')
                    ->select(
                        'calons.id',
                        'calons.name',
                        'jk',
                        'tempat_lahir',
                        'tgl_lahir',
                        'kelasnyas.name as kelas',
                        'ayah_nama',
                        'ayah_hp',
                        'ibu_nama',
                        'ibu_hp',
                        'asal_sekolah',
                        'calon_kategoris.name as ck',
                        'gelombangs.kode_va',
                        'urut',
                        'pindahan',
                        'tgl_daftar',
                        'users.phone as phone',
                        DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
                    )
                    ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                    ->leftJoin('calon_kategoris', 'calons.ck_id', '=', 'calon_kategoris.id')
                    ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
                    ->leftJoin('users', 'calons.user_id', '=', 'users.id')
                    // ->rightJoin('calon_biaya_tes', 'calons.id', '=', 'calon_biaya_tes.calon_id')
                    ->whereIn('gel_id', $gelombang)
                    ->where('calons.status', $id)
                    ->where('aktif', true)
                    // ->orderBy('calon_biaya_tes.expired', 'desc')
                    ->get()->toArray();
                // return Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'usernya')
                //     ->whereIn('gel_id', $gelombang)
                //     ->where('status',$id)
                //     ->get()->toArray();
            }
            if ($id === '0') {
                return DB::table('calons')
                    ->select(
                        'calons.id',
                        'calons.name',
                        'jk',
                        'tempat_lahir',
                        'tgl_lahir',
                        'kelasnyas.name as kelas',
                        'ayah_nama',
                        'ayah_hp',
                        'ibu_nama',
                        'ibu_hp',
                        'asal_sekolah',
                        'calon_kategoris.name as ck',
                        'gelombangs.kode_va',
                        'urut',
                        'pindahan',
                        'tgl_daftar',
                        'expired',
                        'users.phone as phone',
                        DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
                    )
                    ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
                    ->leftJoin('calon_kategoris', 'calons.ck_id', '=', 'calon_kategoris.id')
                    ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
                    ->leftJoin('users', 'calons.user_id', '=', 'users.id')
                    ->rightJoin('calon_biaya_tes', 'calons.id', '=', 'calon_biaya_tes.calon_id')
                    ->whereIn('gel_id', $gelombang)
                    ->where('calons.status', $id)
                    ->where('aktif', true)
                    ->orderBy('calon_biaya_tes.expired', 'desc')
                    ->get()->toArray();
                // return Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'usernya')
                //     ->whereIn('gel_id', $gelombang)
                //     ->where('status',$id)
                //     ->get()->toArray();
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $calon = Calon::findOrFail($id);
        $calon->update($request->all());
    }

    public function updateJurusan(Request $request)
    {
        $calon = Calon::whereId($request->id);
        $calon->update([
            'jurusan' => $request->jurusan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calon = Calon::findOrFail($id);
        $calon->update(['aktif' => false]);

        $calonBiaya = CalonBiayaTes::where('calon_id', $id)->first();
        Maja::delete($calon->uruts, $calonBiaya->idTransaction);
    }

    public function exportsiswabaru()
    {
        return Excel::download(new SiswaBaruExport, 'Siswa Baru - PPDB.xlsx');
    }

    public function exportbaru()
    {
        return Excel::download(new CpdBaruExport, 'cpdBaru.xlsx');
    }

    public function exportaktif()
    {
        return Excel::download(new CpdAktifExport, 'cpdAktif.xlsx');
    }

    public function exportjadwal()
    {
        return Excel::download(new CpdJadwalTes, 'cpdTes.xlsx');
    }

    public function exportSeragam()
    {
        return Excel::download(new CpdExportSeragam, 'Data Seragam.xlsx');
    }

    public function exportBank($id)
    {
        if ($id === "1") {
            return Excel::download(new CpdExportBank(1), 'Ajuan VA Bank Muamalat.xlsx');
        }
        if ($id === "2") {
            return Excel::download(new CpdExportBank(2), 'Ajuan VA Bank BJBS.xlsx');
        }
        if ($id === "3") {
            return Excel::download(new CpdExportBank(3), 'Tagihan PPDB ' . str_replace("/", "-", auth()->user()->tpname) . '.xlsx');
        }
    }
}

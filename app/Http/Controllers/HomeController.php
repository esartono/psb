<?php

namespace App\Http\Controllers;

use App\Facades\Edupay;
use App\Notifications\Wa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Gelombang;
use App\TahunPelajaran;
use App\User;
use App\Unit;
use App\Berita;
use App\Calon;
use App\CalonHasil;
use App\CalonBiayaTes;
use App\Jadwal;
use App\TagihanPSB;
use App\FileGdrive;
use App\Faq;
use App\BayarSpp;

// use Wa;
use Auth;
use Telegram;
use Avatar;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    protected $tp_berjalan;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth'])->except(
            'adminLogin',
            'depan',
            'alur',
            'biaya',
            'jadwal',
            'edupay',
            'download',
            'daftarulang',
            'faq',
            'hasil',
            'gethasil',
            'jadwalkesehatan',
            'syarat',
            'tatacara',
            'ukuranseragam',
            'waitinglist',
            'simpanwaitinglist',
            'coba',
            'sitemap',
            'tesPPDB',
        );
        $this->tp_berjalan = TahunPelajaran::where('status', 1)->first()->name;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->isAdmin() || auth()->user()->isAdminUnit() || auth()->user()->isAdminKeu()) {
            return redirect()->route('dashboard');
            // return view('home');
        }

        if (auth()->user()->isUser()) {
            return redirect()->route('ppdb');
            // return view('psb');
        }

        if (auth()->user()->isPsikotes()) {
            return redirect()->route('email');
            // return view('psb');
        }

        if (auth()->user()->isPengadaan()) {
            return redirect()->route('seragam');
            // return view('psb');
        }
    }

    public function adminLogin()
    {
        return view('auth.admin');
    }

    public function loginJadiUser()
    {
        if (auth()->user()->isAdministrator()) {
            return view('auth.loginsebagai');
        }
    }

    public function login_as(Request $request)
    {
        if (auth()->user()->isAdministrator()) {
            if (filter_var($request->daftar, FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $request->daftar)->first();
                if ($user) {
                    Auth::loginUsingId($user->id);
                }
            } else {
                $gel = Gelombang::where('kode_va', substr($request->daftar, 0, 6))->first();
                if ($gel) {
                    $id = $gel->id;
                    $urut = intval(substr($request->daftar, 6));
                    $calon = DB::table('calons')
                        ->select('user_id')
                        ->where('urut', $urut)
                        ->where('gel_id', $id)
                        ->first()
                        ->user_id;
                    Auth::loginUsingId($calon);
                }
            }
            return redirect()->route('home');
        }
    }

    public function front()
    {
        return view('front');
    }

    public function tes($id)
    {
        return view('profile', compact('id'));
    }

    public function apiCalon($id)
    {
        $va = substr($id, 0, 6);
        $urt = intval(substr($id, 6));
        $gelombang = Gelombang::where('kode_va', $va)->get()->pluck('id');
        return Calon::where('gel_id', $gelombang)->where('urut', $urt)->where('status', 1)->get()->toArray();
    }

    public function sitemap()
    {
        return response()->view('front.sitemap')->header('Content-Type', 'text/xml');
    }

    public function profile()
    {
        return view('profile');
    }

    public function faq()
    {
        $faq = Faq::where('status', 1)->get();
        $tp = TahunPelajaran::where('status', 1)->first();
        return view('front.faq', compact('faq', 'tp'));
    }

    public function dashboardUser()
    {
        if (auth()->user()->isUser()) {
            $gelombang = Gelombang::where('tp', auth()->user()->tpid)->get()->pluck('id');
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
                ->where('user_id', auth()->user()->id)
                ->whereIn('gel_id', $gelombang)->get();
        }

        return view('user.dashboard', compact('calons'));
        // return view('psb');
    }

    public function baru()
    {
        return view('user.baru');
    }

    public function psb()
    {
        session()->put('locale', 'id');

        $cek = auth()->user()->phone;
        if ($cek === null || $cek === '') {
            // return view('user.baru');
            return redirect()->route('baru');
        }

        $gelombang = Gelombang::where('tp', auth()->user()->tpid)->get()->pluck('id');
        $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
            ->where('user_id', auth()->user()->id)
            ->where('aktif', true)
            ->whereIn('gel_id', $gelombang)
            ->orderBy('calons.name', 'asc')
            ->get();

        $cekTotalCalons = count($calons);

        if ($cekTotalCalons == 0) {
            return view('user.kosong');
        }

        if ($cekTotalCalons == 1) {
            return redirect()->route('ppdb_detail', $calons[0]->id);
        }
        return view('user.dashboard', compact('calons', 'cekTotalCalons'));
    }

    public function detailCalon($id)
    {
        $gelombang = Gelombang::where('tp', auth()->user()->tpid)->get()->pluck('id');
        $calons = DB::table('calons')
            ->select(
                'calons.id',
                'calons.name',
                DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
            )
            ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
            ->where('user_id', auth()->user()->id)
            ->where('aktif', true)
            ->whereIn('gel_id', $gelombang)
            ->orderBy('id', 'asc')->get();

        if (!$calons) {
            return redirect()->route('home');
        }
        // $calon = DB::table('calons')
        //     ->select(
        //         'calons.id',
        //         'calons.name',
        //         'calons.jk',
        //         'calons.tempat_lahir',
        //         'calons.tgl_lahir',
        //         'calons.gel_id',
        //         'calons.kelas_tujuan',
        //         'calons.tgl_daftar',
        //         'kelasnyas.name as kelasnya',
        //         'gelombangs.unit_id',
        //         DB::raw('IF(calons.jk=1, "Laki-laki", "Perempuan") as kelamin'),
        //         DB::raw('CONCAT(gelombangs.kode_va, LPAD(urut, 3, 0)) as uruts')
        //     )
        //     ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
        //     ->leftJoin('kelasnyas', 'calons.kelas_tujuan', '=', 'kelasnyas.id')
        //     ->where('user_id', auth()->user()->id)
        //     ->where('aktif', true)
        //     ->where('calons.id', $id)->first();

        $calon = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
            ->where('user_id', auth()->user()->id)
            ->where('aktif', true)
            ->whereIn('gel_id', $gelombang)
            ->where('calons.id', $id)->first();

        $bayarspp = 'Belum';
        if ($calon) {
            $spp = 100000000;
            $pp = $this->pProfile($calon->id);
            $biayas = TagihanPSB::where('gel_id', $calon->gel_id)
                ->where('kelas', $calon->kelas_tujuan)
                ->where('kelamin', $calon->jk)
                ->first();
            if ($biayas) {
                $diskonSPP = array(
                    242531058 => 675000,
                    242532009 => 1000000,
                    242532069 => 700000,
                    242532146 => 1000000,
                    242532018 => 1000000,
                    242532079 => 1000000,
                    242532092 => 1000000,
                    242532156 => 1000000,
                    242532118 => 1000000,
                    242532177 => 1000000,
                    242533085 => 1050000,
                    242533114 => 1050000,
                    242533040 => 1050000,
                    242533146 => 1680000,
                    242533064 => 1050000,
                    242533229 => 1050000,
                    242533025 => 1050000,
                    242534100 => 1050000,
                    242534197 => 1050000,
                    242534080 => 1050000,
                    242534057 => 1050000,
                    242534101 => 1050000,
                    242534016 => 1050000,
                    242534312 => 1050000,
                    242534070 => 1050000,
                );
                if (array_key_exists($calon->uruts, $diskonSPP)) {
                    $spp = $diskonSPP[$calon->uruts];
                } else {
                    $spp = $biayas->spp;
                }
            }
            $cekbayarspp = BayarSpp::where('calon_id', $calon->id)->first();
            if ($cekbayarspp) {
                $bayarspp = 'Sudah';
            }
        } else {
            return redirect()->route('home');
        }

        $cekCalons = count($calons);
        return view('user.dashboard', compact('calons', 'calon', 'pp', 'spp', 'bayarspp', 'cekbayarspp', 'cekCalons'));
    }

    public function addUser(Request $request)
    {
        $user = User::where('email', $request->email)->where('level', 2)->first();
        $user->update($request->only('name', 'phone'));
        // Wa::kirim(
        //     $user->phone,
        //     'Terima kasih Bapak/Ibu '.$user->name.', Anda sudah menjadi user di aplikasi PPDB SIT Nurul Fikri.
        //     Silahkan melanjutkan proses berikutnya melalui laman https://ppdb.nurulfikri.sch.id');
        return redirect()->route('home');
    }

    public function password()
    {
        return view('user.password');
    }

    public function tesPPDB()
    {
        return view('tes');
    }

    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);
        $user = User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('home');
    }

    public function edupay()
    {
        $tp = TahunPelajaran::where('status', 1)->first();

        $gelombang = Gelombang::with('unitnya.catnya')->where('tp', $tp->id)
            ->orderBy('unit_id', 'asc')->get()->toArray();

        $cek = 'Update Pendaftaran PPDB SIT NF' . PHP_EOL . 'Tanggal: ' . date('d M Y') . ' (' . date('H:i') . ')' . PHP_EOL;
        foreach ($gelombang as $gel) {
            $cek = $cek . PHP_EOL . $gel['unitnya']['name'] . ' : ' . PHP_EOL .
                'Umum : ' . $gel['jlhrekap']['umumaktif'] . PHP_EOL .
                'Internal : ' . $gel['jlhrekap']['nfaktif'] . PHP_EOL .
                'Pegawai : ' . $gel['jlhrekap']['pegaktif'] . PHP_EOL .
                'TOTAL : ' . ($gel['jlhrekap']['umumaktif'] + $gel['jlhrekap']['nfaktif'] + $gel['jlhrekap']['pegaktif']) . PHP_EOL;
        }

        Telegram::sendMessage([
            'chat_id' => '643982879',
            'text' => $cek
        ]);
        return view('profile');
    }

    public function alur()
    {
        return view('front.alur');
    }

    public function biaya()
    {
        $tp = $this->tp_berjalan;

        if ($tp === '2022/2023') {
            $biaya = [
                ['komponen' => 'Dana Pengembangan', 'tka' => 8000000, 'tkb' => 5000000, 'sd' => 22500000, 'smp' => 21500000, 'sma' => 21500000],
                ['komponen' => 'Dana Pendidikan', 'tka' => 8500000, 'tkb' => 8000000, 'sd' => 12500000, 'smp' => 14000000, 'sma' => 14000000],
                ['komponen' => 'SPP bulan Juli', 'tka' => 1250000, 'tkb' => 1250000, 'sd' => 1900000, 'smp' => 2000000, 'sma' => 2000000],
                ['komponen' => 'Komite Sekolah tahun pertama', 'tka' => 300000, 'tkb' => 300000, 'sd' => 400000, 'smp' => 450000, 'sma' => 450000],
            ];
            $seragam = [
                ['komponen' => 'Seragam Putra', 'tka' => 1200000, 'tkb' => 1200000, 'sd' => 1800000, 'smp' => 1900000, 'sma' => 2000000],
                ['komponen' => 'Seragam Putri', 'tka' => 1400000, 'tkb' => 1400000, 'sd' => 2400000, 'smp' => 2650000, 'sma' => 2700000],
            ];
        }

        if ($tp === '2023/2024') {
            $biaya = [
                ['komponen' => 'Dana Pengembangan', 'tka' => 8500000, 'tkb' => 6000000, 'sd' => 22500000, 'smp' => 22500000, 'sma' => 22500000],
                ['komponen' => 'Dana Pendidikan', 'tka' => 8500000, 'tkb' => 8000000, 'sd' => 14000000, 'smp' => 15000000, 'sma' => 15000000],
                ['komponen' => 'SPP bulan Juli', 'tka' => 1350000, 'tkb' => 1350000, 'sd' => 2000000, 'smp' => 2100000, 'sma' => 2100000],
                ['komponen' => 'Komite Sekolah tahun pertama', 'tka' => 300000, 'tkb' => 300000, 'sd' => 400000, 'smp' => 450000, 'sma' => 450000],
            ];
            $seragam = [
                ['komponen' => 'Seragam Putra', 'tka' => 1200000, 'tkb' => 1200000, 'sd' => 1800000, 'smp' => 1900000, 'sma' => 2000000],
                ['komponen' => 'Seragam Putri', 'tka' => 1400000, 'tkb' => 1400000, 'sd' => 2400000, 'smp' => 2650000, 'sma' => 2700000],
            ];
        }

        if ($tp === '2024/2025') {
            $biaya = [
                ['komponen' => 'Dana Pengembangan', 'tka' => 8500000, 'tkb' => 6000000, 'sd' => 22500000, 'smp' => 22500000, 'sma' => 22500000],
                ['komponen' => 'Dana Pendidikan', 'tka' => 8500000, 'tkb' => 8000000, 'sd' => 14000000, 'smp' => 15000000, 'sma' => 15000000],
            ];
            $seragam = [
                ['komponen' => 'Seragam Putra', 'tka' => 1200000, 'tkb' => 1200000, 'sd' => 1800000, 'smp' => 1900000, 'sma' => 2000000],
                ['komponen' => 'Seragam Putri', 'tka' => 1400000, 'tkb' => 1400000, 'sd' => 2400000, 'smp' => 2650000, 'sma' => 2700000],
            ];
        }

        if ($tp === '2025/2026') {
            $biaya = [
                ['komponen' => 'Dana Pengembangan', 'tka' => 8500000, 'tkb' => 6000000, 'sd' => 22500000, 'smp' => 22500000, 'sma' => 22500000],
                ['komponen' => 'Dana Pendidikan', 'tka' => 8500000, 'tkb' => 8000000, 'sd' => 14000000, 'smp' => 15000000, 'sma' => 15000000],
            ];
            $seragam = [
                ['komponen' => 'Seragam Putra', 'tka' => 1300000, 'tkb' => 1300000, 'sd' => 1900000, 'smp' => 2000000, 'sma' => 2100000],
                ['komponen' => 'Seragam Putri', 'tka' => 1600000, 'tkb' => 1600000, 'sd' => 2500000, 'smp' => 2900000, 'sma' => 2900000],
            ];
        }

        $patokan = (int)substr($tp, 0, 4);

        if (isset($biaya)) {
            return view('front.' . $patokan . '.biaya', compact('biaya', 'seragam', 'tp', 'patokan'));
        } else {
            return view('front.belumada.biaya', compact('tp'));
        }
    }

    public function hasil()
    {
        $calons = null;
        return view('front.hasil', compact('calons'));
    }

    public function gethasil(Request $request)
    {
        $id = $request->id;
        $va = substr($id, 0, 6);
        $urut = intval(substr($id, 6));
        $arrayhasil = array("-", "DITERIMA", "CADANGAN", "TIDAK DITERIMA");

        $calons = null;
        $hasils = CalonHasil::where('pendaftaran', $id)->first();

        if ($hasils) {
            $gelombang = Gelombang::where('kode_va', $va)->first();
            $calons = Calon::where('gel_id', $gelombang->id)->where('urut', $urut)->where('status', 1)->get();
            return view('front.hasil', compact('calons', 'hasils', 'arrayhasil'));
        }
        return view('front.hasil', compact('calons'));
    }

    public function jadwal()
    {
        $tp = $this->tp_berjalan;
        $patokan = (int)substr($tp, 0, 4);

        // $tpid = TahunPelajaran::where('name', $tp)->first();
        // $gelombang = Gelombang::where('tp', $tpid->id)->pluck('id');
        // $jadwal = Jadwal::whereIn('gel_id', $gelombang)->first();
        $jadwal = 'ada';

        if ($jadwal) {
            return view('front.' . $patokan . '.jadwal', compact('tp'));
        } else {
            return view('front.belumada.jadwal', compact('tp'));
        }
    }

    public function tatacara()
    {
        $tp = $this->tp_berjalan;
        $kode = substr($tp, 2, 2) . substr($tp, 7, 2) . '31001';
        return view('front.tatacara', compact('tp', 'kode'));
        // return view('front.tatacara');
    }

    public function syarat()
    {
        $tp = $this->tp_berjalan;
        $patokan = (int)substr($tp, 0, 4);
        return view('front.syarat', compact('tp', 'patokan'));
    }

    public function daftarulang()
    {
        $tp = $this->tp_berjalan;
        $patokan = (int)substr($tp, 0, 4);
        return view('front.daftarulang', compact('tp', 'patokan'));
    }

    public function jadwalkesehatan()
    {
        return view('front.kesehatan');
    }

    public function download()
    {
        return view('front.download');
    }

    public function depan()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $tp = TahunPelajaran::where('status', 1)->first();

        // $gelombang = Gelombang::with('unitnya', 'tpnya')->where('tp', $tp->id)->orderBy('start', 'asc')->first();
        $gelombang = Gelombang::where('tp', $tp->id)->orderBy('start', 'asc')->first();
        if ($gelombang) {
            $start = date('M d, Y H:i:s', strtotime($gelombang->start));
        } else {
            $start = date('M d, Y H:i:s', strtotime(date('Y') . '-09-01'));
        }

        $units = Unit::with('catnya')->orderBy('id', 'asc')->get();
        $berita = Berita::orderBy('updated_at', 'desc')->paginate(3);

        return view('front.depan', compact('start', 'tp', 'units', 'berita'));
        // return view('front.template_lama.depan', compact('start', 'tp', 'units', 'berita'));
    }

    public function ukuranseragam()
    {
        return view('front.ukuranseragam');
    }

    public function pProfile($id)
    {
        $urls = 'https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg';
        if (auth()->user()->isAdmin() || auth()->user()->isAdminUnit()) {
            // $path = storage_path('dokumen/' . $calon . '/' . $doku->file);
        }

        if (auth()->user()->isUser()) {
            $calon = Calon::where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->first();

            if ($calon) {
                $fileid = FileGdrive::where('fileName', 'Photo-' . $calon->uruts)->first();
                if ($fileid) {
                    $urls = Storage::disk('gdrive')->url($fileid->fileId);
                }
            }
        }

        return $urls;
    }

    public function coba(Request $request)
    {
        return view('tes_wawancara.index');
    }
}

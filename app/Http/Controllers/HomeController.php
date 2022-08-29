<?php

namespace App\Http\Controllers;

use App\Facades\Edupay;
use App\Notifications\Wa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

// use Wa;
use Auth;
use Telegram;
use Avatar;

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
            'depan',
            'biaya',
            'jadwal',
            'edupay',
            'download',
            'hasil',
            'gethasil',
            'jadwalkesehatan',
            'syarat',
            'biayapendaftaran'
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
        if(auth()->user()->isAdmin() || auth()->user()->isAdminUnit() || auth()->user()->isAdminKeu()){
            return redirect()->route('dashboard');
            // return view('home');
        }

        if(auth()->user()->isUser()){
            return redirect()->route('ppdb');
            // return view('psb');
        }

        if(auth()->user()->isPsikotes()){
            return redirect()->route('email');
            // return view('psb');
        }
    }

    public function loginJadiUser()
    {
        if(auth()->user()->isAdministrator()){
            return view('auth.loginsebagai');
        }
    }
    public function login_as(Request $request)
    {
        if(auth()->user()->isAdministrator()){
            if (filter_var($request->daftar, FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $request->daftar)->first()->id;
                Auth::loginUsingId($user);
            } else {
                $gel = Gelombang::where('kode_va', substr($request->daftar,0,6))->first();
                if($gel){
                    $id = $gel->id;
                    $urut = intval(substr($request->daftar,6));
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
        return Calon::where('gel_id',$gelombang)->where('urut',$urt)->where('status',1)->get()->toArray();
    }

    public function profile()
    {
        return view('profile');
    }

    public function dashboardUser()
    {
        if (auth()->user()->isUser()){
            $gelombang = Gelombang::where('tp', auth()->user()->tpid)->get()->pluck('id');
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
                    ->where('user_id', auth()->user()->id)
                    ->whereIn('gel_id', $gelombang)->get();
        }

        return view('user.dashboard', compact('calons'));
        // return view('psb');
    }

    public function psb_old()
    {
        return view('psb_old');
    }

    public function psb()
    {
        // Cek user baru atau lama
        // dd(Avatar::create('Joko Widodo')->toBase64());
        $cek = auth()->user()->phone;
        if($cek === null || $cek === '') {
            return view('user.baru');
        }

        $gelombang = Gelombang::where('tp', auth()->user()->tpid)->get()->pluck('id');
        $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
                ->where('user_id', auth()->user()->id)
                ->where('aktif', true)
                ->whereIn('gel_id', $gelombang)->get();

        if($calons->count() > 0) {
            return view('user.dashboard', compact('calons'));
        }
        return view('user.awal');
    }

    public function addUser(Request $request)
    {
        $user = User::where('email', $request->email)->where('level', 2)->first();
        $user->update($request->only('name', 'phone'));
        Wa::kirim(
            $user->phone,
            'Terima kasih Bapak/Ibu '.$user->name.', Anda sudah menjadi user di aplikasi PPDB SIT Nurul Fikri. Silahkan melanjutkan proses berikutnya.');
        return redirect()->route('home');
    }
    
    public function password()
    {
        return view('user.password');
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

        $cek = 'Update Pendaftaran PPDB SIT NF'.PHP_EOL.'Tanggal: '.date('d M Y').' ('.date('H:i').')'.PHP_EOL;
        foreach ($gelombang as $gel) {
            $cek = $cek.PHP_EOL.$gel['unitnya']['name'] . ' : '.PHP_EOL.
                'Umum : '.$gel['jlhrekap']['umumaktif'].PHP_EOL.
                'Internal : '.$gel['jlhrekap']['nfaktif'].PHP_EOL.
                'Pegawai : '.$gel['jlhrekap']['pegaktif'].PHP_EOL.
                'TOTAL : '.($gel['jlhrekap']['umumaktif']+$gel['jlhrekap']['nfaktif']+$gel['jlhrekap']['pegaktif']).PHP_EOL;
        }

        Telegram::sendMessage([
            'chat_id' => '643982879',
            'text' => $cek
        ]);
        return view('profile');
    }

    public function biaya()
    {
        $tp = $this->tp_berjalan;

        if($tp === '2022/2023') {
            $biaya = [
                ['komponen' => 'Dana Pengembangan', 'tka'=>8000000, 'tkb'=>5000000, 'sd'=>22500000, 'smp'=>21500000, 'sma'=>21500000],
                ['komponen' => 'Dana Pendidikan', 'tka'=>8500000, 'tkb'=>8000000, 'sd'=>12500000, 'smp'=>14000000, 'sma'=>14000000],
                ['komponen' => 'SPP bulan Juli', 'tka'=>1250000, 'tkb'=>1250000, 'sd'=>1900000, 'smp'=>2000000, 'sma'=>2000000],
                ['komponen' => 'Komite Sekolah tahun pertama', 'tka'=>300000, 'tkb'=>300000, 'sd'=>400000, 'smp'=>450000, 'sma'=>450000],
            ];
            $seragam = [
                ['komponen' => 'Seragam Putra', 'tka'=>1200000, 'tkb'=>1200000, 'sd'=>1800000, 'smp'=>1900000, 'sma'=>2000000],
                ['komponen' => 'Seragam Putri', 'tka'=>1400000, 'tkb'=>1400000, 'sd'=>2400000, 'smp'=>2650000, 'sma'=>2700000],
            ];
        }

        if($tp === '2023/2024') {
            $biaya = [
                ['komponen' => 'Dana Pengembangan', 'tka'=>8500000, 'tkb'=>6000000, 'sd'=>22500000, 'smp'=>22500000, 'sma'=>22500000],
                ['komponen' => 'Dana Pendidikan', 'tka'=>8500000, 'tkb'=>8000000, 'sd'=>14000000, 'smp'=>15000000, 'sma'=>15000000],
                ['komponen' => 'SPP bulan Juli', 'tka'=>1350000, 'tkb'=>1350000, 'sd'=>2000000, 'smp'=>2100000, 'sma'=>2100000],
                ['komponen' => 'Komite Sekolah tahun pertama', 'tka'=>300000, 'tkb'=>300000, 'sd'=>400000, 'smp'=>450000, 'sma'=>450000],
            ];
            $seragam = [
                ['komponen' => 'Seragam Putra', 'tka'=>1200000, 'tkb'=>1200000, 'sd'=>1800000, 'smp'=>1900000, 'sma'=>2000000],
                ['komponen' => 'Seragam Putri', 'tka'=>1400000, 'tkb'=>1400000, 'sd'=>2400000, 'smp'=>2650000, 'sma'=>2700000],
            ];
        }
        
        $patokan = (int)substr($tp,0,4);

        return view('front.'.$patokan.'.biaya', compact('biaya', 'seragam', 'tp', 'patokan'));
    }

    public function hasil()
    {
        $calons = null;
        return view('front.hasil', compact('calons'));
    }

    public function gethasil(Request $request)
    {
        $id = $request->id;
        $va = substr($id,0,6);
        $urut = intval(substr($id,6));
        $arrayhasil = array("-", "DITERIMA", "CADANGAN", "TIDAK DITERIMA");

        $calons = null;
        $hasils = CalonHasil::where('pendaftaran', $id)->first();

        if($hasils){
            $gelombang = Gelombang::where('kode_va', $va)->first();
            $calons = Calon::where('gel_id', $gelombang->id)->where('urut', $urut)->where('status', 1)->get();
            return view('front.hasil', compact('calons', 'hasils', 'arrayhasil'));
        }
        return view('front.hasil', compact('calons'));
    }

    public function jadwal()
    {
        $tp = $this->tp_berjalan;
        return view('front.jadwal', compact('tp'));
    }
    
    public function biayapendaftaran()
    {
        $tp = $this->tp_berjalan;
        $kode = substr($tp,2,2).substr($tp,7,2).'31001';
        return view('front.tatacara', compact('tp','kode'));
        // return view('front.tatacara');
    }

    public function syarat()
    {
        $tp = $this->tp_berjalan;
        $patokan = (int)substr($tp,0,4);
        return view('front.syarat', compact('tp', 'patokan'));
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
        if(Auth::check()){
            return redirect()->route('home');
        }

        $tp = TahunPelajaran::where('status', 1)->first();

        // $gelombang = Gelombang::with('unitnya', 'tpnya')->where('tp', $tp->id)->orderBy('start', 'asc')->first();
        $gelombang = Gelombang::where('tp', $tp->id)->orderBy('start', 'asc')->first();
        if($gelombang){
            $start = date('M d, Y H:i:s', strtotime($gelombang->start));
        } else {
            $start = date('M d, Y H:i:s', strtotime(date('Y').'-09-01'));
        }

        $units = Unit::with('catnya')->orderBy('id', 'asc')->get();
        $berita = Berita::orderBy('updated_at', 'desc')->paginate(3);

        return view('front.depan', compact('start', 'tp', 'units', 'berita'));
    }
}

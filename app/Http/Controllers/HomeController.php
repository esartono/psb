<?php

namespace App\Http\Controllers;

use App\Edupay\Facades\Edupay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Gelombang;
use App\TahunPelajaran;
use App\Unit;
use App\Berita;
use App\Calon;
use App\CalonHasil;
use App\CalonBiayaTes;
use App\Jadwal;

use Auth;
use Telegram;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('depan', 'biaya', 'jadwal', 'edupay', 'download', 'hasil', 'gethasil', 'jadwalkesehatan');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->isAdmin()){
            return redirect()->route('dashboard');
            // return view('home');
        }

        if(auth()->user()->isUser()){
            return redirect()->route('psb');
            // return view('psb');
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

    public function wawancaraKeuangan()
    {
        return view('wawancara.keuangan');
    }

    public function wawancaraKeuanganPrint()
    {
        return view('wawancara.invoiceprint');
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

    public function psb()
    {
        return view('psb');
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
        return view('front.biaya');
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
        return view('front.jadwal');
    }

    public function jadwalkesehatan()
    {
        return view('front.kesehatan');
    }

    public function download()
    {
        $tp = TahunPelajaran::where('status', 1)->first();

        $gelombang = Gelombang::with('unitnya', 'tpnya')->where('tp', $tp->id)->orderBy('start', 'asc')->first();

        $start = date('M d, Y H:i:s', strtotime($gelombang->start));
        $units = Unit::with('catnya')->orderBy('id', 'asc')->get();
        $berita = Berita::orderBy('updated_at', 'desc')->paginate(3);

        return view('front.download', compact('start'));
    }

    public function depan()
    {
        if(Auth::check()){
            return redirect()->route('home');
        }

        $tp = TahunPelajaran::where('status', 1)->first();

        $gelombang = Gelombang::with('unitnya', 'tpnya')->where('tp', $tp->id)->orderBy('start', 'asc')->first();

        $start = date('M d, Y H:i:s', strtotime($gelombang->start));
        $units = Unit::with('catnya')->orderBy('id', 'asc')->get();
        $berita = Berita::orderBy('updated_at', 'desc')->paginate(3);

        return view('front.depan', compact('start', 'tp', 'units', 'berita'));
    }
}

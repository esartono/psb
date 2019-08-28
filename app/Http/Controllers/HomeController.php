<?php

namespace App\Http\Controllers;

use App\Edupay\Facades\Edupay;
use Illuminate\Http\Request;
use App\Gelombang;
use App\TahunPelajaran;
use App\Unit;
use App\Berita;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('depan');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function front()
    {
        return view('front');
    }

    public function profile()
    {
        return view('profile');
    }

    public function psb()
    {
        return view('psb');
    }

    public function cpd()
    {
        return view('cpd');
    }

    public function edupay()
    {
        return view('profile');
    }

    public function depan()
    {
        $tp = TahunPelajaran::where('status', 1)->first();

        $gelombang = Gelombang::with('unitnya', 'tpnya')->where('tp', $tp->id)->orderBy('start', 'asc')->first();

        $start = date('M d, Y H:i:s', strtotime($gelombang->start));
        $units = Unit::with('catnya')->orderBy('id', 'asc')->get();
        $berita = Berita::orderBy('updated_at', 'desc')->paginate(3);

        return view('front.depan', compact('start', 'tp', 'units', 'berita'));
    }
}

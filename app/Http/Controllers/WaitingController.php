<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Unit;
use App\Waiting;
use App\TahunPelajaran;

class WaitingController extends Controller
{
    protected $tp_berjalan;

    public function __construct()
    {
        $this->tp_berjalan = TahunPelajaran::where('status', 1)->first()->name;
    }

    public function index()
    {
        if (auth()->user()->isAdmin()) {
            return $data = Waiting::where('status', 1)->orderBy('created_at', 'desc')->get()->toArray();
        }

        if (auth()->user()->isAdminUnit()) {
            $adminUnit = auth()->user()->unit_id;
            $unit = Unit::whereId($adminUnit)->first();
            $unitnya = strtolower(substr($unit->name, 0, 3));

            if ($unitnya === 'sdi' || $unitnya === 'tki') {
                $unitnya = substr($unitnya, 0, 2);
            }

            return $data = Waiting::where('status', 1)
                ->where('unit', $unitnya)
                ->orderBy('created_at', 'desc')
                ->get()->toArray();
        }
    }

    public function create()
    {
        $tp = $this->tp_berjalan;
        $patokan = (int)substr($tp, 0, 4);
        return view('front.waiting', compact('tp', 'patokan'));
    }

    public function store(Request $request)
    {
        Waiting::create([
            'nama' => $request['calon'],
            'asal_sekolah' => $request['asalSekolah'],
            'unit' => $request['jenjang'],
            'ta' => $request['ta'],
            'wa' => $request['hportu'],
            'email' => $request['emailortu'],
        ]);

        $tp = $this->tp_berjalan;
        $patokan = (int)substr($tp, 0, 4);
        return view('front.waitingShow', compact('tp', 'patokan'));
    }

    public function show($id)
    {
        // return view('doku.create', compact('calon'));
    }

    public function update($id)
    {
        $data = Waiting::whereId($id)->first();

        if ($data) {
            $data->update(['status' => 0]);
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }
}

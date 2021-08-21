<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Kelasnya;
use App\Gelombang;
use App\DraftCalon;
use App\CalonKategori;
use App\SchoolCategory;

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
            return view('user.create', compact('step', 'pilihan'));
        }

        if($l) {
            if($calon) {
                $ok = $calon->pindahan;
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

        return view('user.create', compact('step', 'units', 'pilihan', 'calon', 'kategories'));
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
                'step' => 4,
            ]);

            $step = 4;
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

<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Gelombang;
use App\DraftCalon;

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
        if($l) {
            $step = $l;
        }
        $calon = DraftCalon::where('user_id', auth()->user()->id)->first();
        if($calon) {
            $step = $calon->step;
        }
        return view('user.create', compact('step'));
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
                    'step' => 1,
                    'user_id' => auth()->user()->id,
                    ]
                );

            $step = 2;
            $units = Unit::with('catnya')->orderBy('id', 'asc')->get();
            return view('user.create', compact('step', 'units'));
        }

        if($request->step == 2) {
            $gelombang = Gelombang::where('unit_id', $request->unit)->first()->id;
            
            DraftCalon::updateOrCreate(
                [
                    'user_id' => auth()->user()->id,
                ],
                [
                    'gel_id' => $gelombang,
                    'user_id' => auth()->user()->id,
                    ]
                );
        }
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

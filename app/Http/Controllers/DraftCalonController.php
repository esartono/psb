<?php

namespace App\Http\Controllers;

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
        //
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

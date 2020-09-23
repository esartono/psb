<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\TagihanPSB;

class TagihanPSBController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    public function index()
    {
        return TagihanPSB::with('gelnya.unitnya', 'gelnya.tpnya', 'kelasnya')
                ->whereHas('gelnya', function ($query) {
                    $query->where('tp', auth('api')->user()->tpid);
                })
                ->orderBy('id', 'asc')
                ->get()
                ->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TagihanPSB::create([
            'gel_id' => $request['gel_id'],
            'kelas' => $request['kelas'],
            'kelamin' => $request['kelamin'],
            'biaya1' => $request['biaya1'],
            'biaya2' => $request['biaya2'],
            'biaya3' => $request['biaya3'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $biaya = TagihanPSB::findOrFail($id);
        $biaya->update($request->all());
    }

    public function destroy($id)
    {
        $biaya = TagihanPSB::findOrFail($id);
        $biaya->delete();
    }
}

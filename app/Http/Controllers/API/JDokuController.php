<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\JDoku;

class JDokuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return JDoku::orderBy('id', 'asc')->get()->toArray();
    }

    public function store(Request $request)
    {
        $unit = implode(",", $request->unit);
        JDoku::create([
            'code' => $request['code'],
            'name' => $request['name'],
            'unit' => $unit
        ]);
    }

    public function update(Request $request, $id)
    {
        $unit = implode(",", $request->unit);
        $jd = JDoku::findOrFail($id);
        $jd->update($request->only('code', 'name') + ['unit' => $unit]);
    }

    public function show($id)
    {
        $jd = JDoku::findOrFail($id);
        $jd->delete();
    }

    public function destroy($id)
    {
        //
    }
}

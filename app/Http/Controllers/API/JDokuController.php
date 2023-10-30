<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\JDoku;
use App\Doku;

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
        $khusus = implode(",", $request->khusus);
        JDoku::create([
            'code' => $request['code'],
            'name' => $request['name'],
            'unit' => $unit,
            'khusus' => $khusus
        ]);
    }

    public function update(Request $request, $id)
    {
        $unit = implode(",", $request->unit);
        $khusus = implode(",", $request->khusus);
        $jd = JDoku::findOrFail($id);
        $jd->update($request->only('code', 'name') + ['unit' => $unit, 'khusus' => $khusus]);
    }

    public function show($id)
    {
        // $jd = JDoku::findOrFail($id);
        // $jd->delete();
    }

    public function destroy($id)
    {
        $jd = JDoku::findOrFail($id);
        $jd->delete();
    }
}

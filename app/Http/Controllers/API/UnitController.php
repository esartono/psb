<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Excel;

use App\Exports\UnitExport;

use App\Unit;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('dataUnit', 'index');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::with('catnya')->orderBy('id', 'asc')->get()->toArray();
        return $units;
    }

    public function unitnya()
    {
        return Unit::orderBy('name', 'asc')->paginate(100);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Unit::create([
            'name' => $request['name'],
            'cat_id' => $request['cat_id'],
            'logo' => 'belum ada',
            'address' => $request['address'],
            'email' => $request['email'],
            'phone' => $request['phone'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $unit = Unit::findOrFail($id);
        $unit->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $unit = Unit::findOrFail($id);
        $unit->delete();
    }

    public function export()
    {
        return Excel::download(new UnitExport, 'units.xlsx');
    }

}

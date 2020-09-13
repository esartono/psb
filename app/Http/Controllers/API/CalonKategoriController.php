<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CalonKategori;

class CalonKategoriController extends Controller
{
    public function index()
    {
        return CalonKategori::orderBy('id', 'asc')->get()->toArray();
    }

    public function store(Request $request)
    {
        CalonKategori::create([
            'name' => $request['name'],
            'status' => $request['status']
        ]);
    }

    public function update(Request $request, $id)
    {
        $ck = CalonKategori::findOrFail($id);
        $ck->update($request->only('name', 'status'));
    }

    public function destroy($id)
    {
        $ck = CalonKategori::findOrFail($id);
        $ck->delete();
    }

    public function data()
    {
        return CalonKategori::where('status', true)->orderBy('id', 'asc')->get()->toArray();
    }

    public function dataCK()
    {
        return CalonKategori::orderBy('id', 'asc')->paginate(1000);
    }

}

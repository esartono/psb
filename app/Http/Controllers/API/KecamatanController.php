<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Kecamatan;

class KecamatanController extends Controller
{
    public function index()
    {
        return Kecamatan::orderBy('id', 'asc')->get()->toArray();
    }

    public function dataKecamatan($kota)
    {
        return Kecamatan::where('kota_id', $kota)->orderBy('id', 'asc')->get()->toArray();
    }

    public function kecamatan($kota)
    {
        $camat = Kecamatan::where('kota_id', $kota)->orderBy('id', 'asc')->get()->pluck("name","id");
        return response()->json($camat);

    }

}

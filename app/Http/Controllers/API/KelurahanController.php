<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Kelurahan;

class KelurahanController extends Controller
{
    public function index()
    {
        return Kelurahan::orderBy('id', 'asc')->get()->toArray();
    }

    public function dataKelurahan($camat)
    {
        return Kelurahan::where('camat_id', $camat)->orderBy('id', 'asc')->get()->toArray();
    }

    public function kelurahan($camat)
    {
        $lurah = Kelurahan::where('camat_id', $camat)->orderBy('id', 'asc')->get()->pluck("name","id");
        return response()->json($lurah);
    }

}

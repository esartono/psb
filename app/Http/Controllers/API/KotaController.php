<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Kota;

class KotaController extends Controller
{
    public function index()
    {
        return Kota::orderBy('id', 'asc')->get()->toArray();
    }

    public function dataKota($prov)
    {
        return Kota::where('prov_id', $prov)->orderBy('id', 'asc')->get()->toArray();
    }

}

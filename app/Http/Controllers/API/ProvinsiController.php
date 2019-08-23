<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Excel;

//use App\Exports\KelasExport;

use App\Provinsi;

class ProvinsiController extends Controller
{
    public function index()
    {
        return Provinsi::orderBy('id', 'asc')->get()->toArray();
    }
}

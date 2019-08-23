<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Excel;

//use App\Exports\KelasExport;

use App\CalonKategori;

class CalonKategoriController extends Controller
{
    public function index()
    {
        return CalonKategori::orderBy('id', 'asc')->get()->toArray();
    }

    public function dataCK()
    {
        return CalonKategori::orderBy('id', 'asc')->paginate(1000);
    }

}

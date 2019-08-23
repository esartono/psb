<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Penghasilan;

class PenghasilanController extends Controller
{
    public function index()
    {
        return Penghasilan::orderBy('id', 'asc')->get()->toArray();
    }
}

<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Agama;

class AgamaController extends Controller
{
    public function index()
    {
        return Agama::orderBy('id', 'asc')->get()->toArray();
    }

    public function dataAgama()
    {
        return Agama::orderBy('id', 'asc')->get()->toArray();
    }

}

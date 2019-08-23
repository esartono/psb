<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Pekerjaan;

class PekerjaanController extends Controller
{
    public function index()
    {
        return Pekerjaan::orderBy('id', 'asc')->get()->toArray();
    }
}

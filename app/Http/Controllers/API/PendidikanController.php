<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Pendidikan;

class PendidikanController extends Controller
{
    public function index()
    {
        return Pendidikan::orderBy('id', 'asc')->get()->toArray();
    }
}

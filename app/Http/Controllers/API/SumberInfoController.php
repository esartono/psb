<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\SumberInfo;

class SumberInfoController extends Controller
{
    public function index()
    {
        return SumberInfo::orderBy('id', 'asc')->get()->toArray();
    }

}

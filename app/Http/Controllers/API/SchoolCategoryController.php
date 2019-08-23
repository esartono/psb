<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\SchoolCategory;


class SchoolCategoryController extends Controller
{
    public function index()
    {
        return SchoolCategory::orderBy('id', 'asc')->get()->toArray();
    }
}

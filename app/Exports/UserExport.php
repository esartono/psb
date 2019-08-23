<?php

namespace App\Exports;

use App\User;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{
    public function view() : view
    {
        return view('exports.user', [
            'users' => User::orderBy('name', 'asc')->get(),
            'no' => 1,
        ]);
    }
}

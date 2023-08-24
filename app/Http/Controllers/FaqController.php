<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Faq;

class FaqController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            return $data = Faq::where('status', 1)->get()->toArray();
        }
    }

    public function store(Request $request)
    {
        Faq::create([
            'tanya' => $request['tanya'],
            'jawab' => $request['jawab'],
        ]);
    }

    public function update(Request $request, Faq $faq)
    {
        $faq->update($request->all());
    }

    public function destroy($id)
    {
        $data = Faq::whereId($id)->first();

        if ($data) {
            $data->update(['status' => 0]);
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }
}

<?php

namespace App\Http\Controllers;
use App\Calon;
use PDF;

use Illuminate\Http\Request;

class CalonPDFController extends Controller
{
    public function biayates($id)
    {
        if (auth()->user()->isUser()){
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya','usernya')
                        ->where('id',$id)->where('user_id', auth()->user()->id);
            if($calons->get()->count() > 0) {
                $calonsnya = $calons->first();
                $pdf = PDF::loadView('pdf.biayates', compact('calonsnya'));
                return $pdf->stream('');
            } else {
                return redirect('psb');
            }
        }
    }

    public function seleksi($id)
    {
        if (auth()->user()->isUser()){
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya','usernya')
                        ->where('id',$id)->where('status', true)->where('user_id', auth()->user()->id);
            if($calons->get()->count() > 0) {
                $calonsnya = $calons->first();
                $pdf = PDF::loadView('pdf.seleksi', compact('calonsnya'));
                return $pdf->stream('');
            } else {
                return redirect('psb');
            }
        }
    }
}

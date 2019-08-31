<?php

namespace App\Http\Controllers;
use App\Calon;
use PDF;

use Illuminate\Http\Request;

class CalonPDFController extends Controller
{
    public function biayates($id)
    {
        $calonsnya = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya','usernya')->where('id',$id)->first();

        $pdf = PDF::loadView('pdf.biayates', compact('calonsnya'));
        return $pdf->stream('');
    }
}

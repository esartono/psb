<?php

namespace App\Http\Controllers;

use App\Calon;
use App\Jadwal;
use App\CalonJadwal;
use App\Gelombang;
use App\Tagihan;
use App\CalonTagihan;
use App\CalonTagihanPSB;
use App\CalonDaul;
use App\TagihanSeragam;
use App\AmbilSeragam;
use App\AmbilBuku;
use PDF;
use Auth;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tag;

class CalonPDFController extends Controller
{
    public function biayates($id)
    {
        if (auth()->user()->isUser()) {
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
                ->where('id', $id)->where('user_id', auth()->user()->id);
            if ($calons->get()->count() > 0) {
                $calonsnya = $calons->first();
                $pdf = PDF::loadView('pdf.biayates', compact('calonsnya'));
                return $pdf->stream('');
            } else {
                return redirect('ppdb');
            }
        }

        if (auth()->user()->isAdmin() || auth()->user()->isAdminUnit()) {
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')->where('id', $id);
            if ($calons->get()->count() > 0) {
                $calonsnya = $calons->first();
                $pdf = PDF::loadView('pdf.biayates', compact('calonsnya'));
                return $pdf->stream('');
            } else {
                return redirect('home');
            }
        }
    }

    public function seleksi($id)
    {
        ini_set('max_execution_time', 1200);
        if (auth()->user()->isUser()) {
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
                ->where('id', $id)->where('status', 1)->where('user_id', auth()->user()->id);
            if ($calons->get()->count() > 0) {
                $calonsnya = $calons->first();
                $pdf = PDF::loadView('pdf.seleksi', compact('calonsnya'));
                return $pdf->stream('');
            } else {
                return redirect('ppdb');
            }
        }

        if (auth()->user()->isAdmin() || auth()->user()->isAdminUnit()) {
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
                ->where('id', $id)->where('status', 1);
            if ($calons->get()->count() > 0) {
                $calonsnya = $calons->first();
                $pdf = PDF::loadView('pdf.seleksi', compact('calonsnya'));
                return $pdf->stream('');
            } else {
                return redirect('home');
            }
        }
    }

    public function PrintKartuTes($id)
    {
        ini_set('max_execution_time', 1200);
        if ($id == 0) {
            return redirect('home');
        }
        if (auth()->user()->isAdmin() || auth()->user()->isAdminUnit()) {
            //query Jadwal yg dipilih
            $jadwalnya = Jadwal::whereId($id)->first();

            $jadwal = CalonJadwal::where('jadwal_id', $id)->get();
            $nis = $jadwal->pluck('calon_id');
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya')
                ->whereIn('id', $nis)->where('status', 1)->get();

            // $pdf = PDF::loadView('pdf.seleksiAdmin', compact('calons'))->setPaper('a6', 'potrait');
            $pdf = PDF::loadView('pdf.seleksiAdmin', compact('calons'));
            return $pdf->stream('Kartu Tes - ' . formatIndo($jadwalnya->seleksi));
        }
        return redirect('home');
    }

    public function bayarPPDB($id)
    {
        ini_set('max_execution_time', 1200);
        if (auth()->user()->isUser()) {
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya')
                ->where('id', $id)->where('status', 1)->where('user_id', auth()->user()->id);
            if ($calons->get()->count() > 0) {
                $calon = $calons->first();
                $pdf = PDF::loadView('pdf.bayarPPDB', compact('calon'));
                return $pdf->stream('');
            } else {
                return redirect('ppdb');
            }
        }

        if (auth()->user()->isAdmin() || auth()->user()->isAdminKeu()) {
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya')
                ->where('id', $id)->where('status', 1);
            if ($calons->get()->count() > 0) {
                $calon = $calons->first();
                $pdf = PDF::loadView('pdf.bayarPPDB', compact('calon'));
                return $pdf->stream('');
            } else {
                return redirect('ppdb');
            }
        }
    }

    public function daul($id)
    {
        ini_set('max_execution_time', 1200);
        if (auth()->user()->isUser()) {
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
                ->where('id', $id)->where('status', 1)->where('user_id', auth()->user()->id);
            if ($calons->first()) {
                $pend = $calons->first()->uruts;

                $pd = CalonDaul::where('pendaftaran', $pend)->first();
                if (!$pd) {
                    return redirect('ppdb');
                }
                if ($pd->lunas == 0) {
                    return redirect('ppdb');
                }
            }

            if ($calons->get()->count() > 0) {
                $calonsnya = $calons->first();
                $pdf = PDF::loadView('pdf.daul', compact('calonsnya'));
                return $pdf->stream('');
            } else {
                return redirect('ppdb');
            }
        }

        if (auth()->user()->isAdmin() || auth()->user()->isAdminUnit()) {
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
                ->where('id', $id)->where('status', 1);
            if ($calons->get()->count() > 0) {
                $calonsnya = $calons->first();
                $pdf = PDF::loadView('pdf.daul', compact('calonsnya'));
                return $pdf->stream('');
            } else {
                return redirect('home');
            }
        }
    }

    public function terima($pendaftaran)
    {
        ini_set('max_execution_time', 1200);
        $gel = Gelombang::where('kode_va', substr($pendaftaran, 0, 6))->first()->id;
        $urut = intval(substr($pendaftaran, 6));
        if (auth()->user()->isUser()) {
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
                ->where('urut', $urut)->where('gel_id', $gel)
                ->where('status', 1)->where('user_id', auth()->user()->id);
            if ($calons->first()) {
                $pd = CalonTagihanPSB::where('calon_id', $id)->first();
                if (!$pd) {
                    return redirect('ppdb');
                }
                if ($pd->lunas == 0) {
                    return redirect('ppdb');
                }
            }

            if ($calons->get()->count() > 0) {
                $calonsnya = $calons->first();
                $pdf = PDF::loadView('pdf.terima', compact('calonsnya'));
                return $pdf->stream('');
            } else {
                return redirect('ppdb');
            }
        }

        if (auth()->user()->isAdmin() || auth()->user()->isAdminUnit()) {
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
                ->where('urut', $urut)->where('gel_id', $gel)->where('status', 1);
            if ($calons->get()->count() > 0) {
                $calonsnya = $calons->first();
                $pdf = PDF::loadView('pdf.terima', compact('calonsnya'));
                return $pdf->stream('');
            } else {
                return redirect('home');
            }
        }
    }

    public function seragam($id)
    {
        ini_set('max_execution_time', 1200);
        if (auth()->user()->isUser()) {
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
                ->where('id', $id)->where('status', 1)->where('user_id', auth()->user()->id);
            if ($calons->first()) {
                $pend = $calons->first()->uruts;

                // $pd = CalonTagihan::where('pendaftaran', $pend)->first()->lunas;
                // if($pd == 0) {
                //     return redirect('ppdb');
                // }
            }

            if ($calons->get()->count() > 0) {
                $calonsnya = $calons->first();
                // $lunas = CalonTagihan::where('pendaftaran', $calonsnya->uruts)->first()->lunas;
                $seragam = AmbilSeragam::where('pendaftaran', $calonsnya->uruts)->first();

                if (!$seragam) {
                    $pdf = PDF::loadView('pdf.seragam_blmsiap', compact('calonsnya'));
                    return $pdf->stream('');
                }
                // $pdf = PDF::loadView('pdf.seragam', compact('calonsnya', 'lunas', 'seragam'));
                // $pdf = PDF::loadView('pdf.seragam', compact('calonsnya', 'seragam'));

                if ($seragam->lunas_daul === 'Lunas' && $seragam->siap === 'SIAP') {
                    // $pdf = PDF::loadView('pdf.seragam', compact('calonsnya', 'lunas', 'seragam'));
                    $pdf = PDF::loadView('pdf.' . substr(Auth::user()->tp_name, 0, 4) . '.seragam', compact('calonsnya', 'seragam'));
                }

                if ($seragam->lunas_daul === 'Belum Lunas') {
                    // $pdf = PDF::loadView('pdf.seragam_blmlunas', compact('calonsnya', 'lunas', 'seragam'));
                    $pdf = PDF::loadView('pdf.seragam_blmlunas', compact('calonsnya', 'seragam'));
                }

                if ($seragam->siap === 'BELUM') {
                    // $pdf = PDF::loadView('pdf.seragam_blmsiap', compact('calonsnya', 'lunas', 'seragam'));
                    $pdf = PDF::loadView('pdf.seragam_blmsiap', compact('calonsnya', 'seragam'));
                }

                if ($calonsnya->ck_id === 3 && $seragam->siap === 'SIAP') {
                    // $pdf = PDF::loadView('pdf.seragam', compact('calonsnya', 'lunas', 'seragam'));
                    $pdf = PDF::loadView('pdf.' . substr(Auth::user()->tp_name, 0, 4) . '.seragam', compact('calonsnya', 'seragam'));
                }

                if ($calonsnya->ck_id === 3 && $seragam->siap === 'BELUM') {
                    // $pdf = PDF::loadView('pdf.seragam_blmsiap', compact('calonsnya', 'lunas', 'seragam'));
                    $pdf = PDF::loadView('pdf.seragam_blmsiap', compact('calonsnya', 'seragam'));
                }

                return $pdf->stream('');
            } else {
                return redirect('ppdb');
            }
        }

        if (auth()->user()->isAdmin() || auth()->user()->isAdminUnit()) {
            $calonsnya = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
                ->whereId($id)->first();
            $gel = Gelombang::where('id', $calonsnya->gel_id)->first();
            $pendaftaran = $gel->kode_va . sprintf("%03d", $calonsnya->urut);

            $seragam = AmbilSeragam::where('pendaftaran', $pendaftaran)->first();

            if ($seragam) {
                $pdf = PDF::loadView('pdf.' . substr(Auth::user()->tp_name, 0, 4) . '.seragam', compact('calonsnya', 'seragam'));

                if ($seragam->lunas_daul === 'Lunas' && $seragam->siap === 'SIAP') {
                    $pdf = PDF::loadView('pdf.' . substr(Auth::user()->tp_name, 0, 4) . '.seragam', compact('calonsnya', 'seragam'));
                }

                if ($seragam->lunas_daul === 'Belum Lunas') {
                    $pdf = PDF::loadView('pdf.seragam_blmlunas', compact('calonsnya', 'seragam'));
                }

                if ($seragam->siap === 'BELUM') {
                    $pdf = PDF::loadView('pdf.seragam_blmsiap', compact('calonsnya', 'seragam'));
                }

                if ($calonsnya->ck_id === 3 && $seragam->siap === 'SIAP') {
                    $pdf = PDF::loadView('pdf.' . substr(Auth::user()->tp_name, 0, 4) . '.seragam', compact('calonsnya', 'seragam'));
                }

                if ($calonsnya->ck_id === 3 && $seragam->siap === 'BELUM') {
                    $pdf = PDF::loadView('pdf.seragam_blmsiap', compact('calonsnya', 'seragam'));
                }
            } else {
                $pdf = PDF::loadView('pdf.seragam_blmsiap', compact('calonsnya', 'seragam'));
            }
            return $pdf->stream('');
        }
    }

    public function buku($id)
    {
        ini_set('max_execution_time', 1200);
        if (auth()->user()->isUser()) {
            $calons = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
                ->where('id', $id)->where('status', 1)->where('user_id', auth()->user()->id);
            if ($calons->first()) {
                $pend = $calons->first()->uruts;
            }

            if ($calons->get()->count() > 0) {
                $calonsnya = $calons->first();
                $buku = AmbilBUKU::where('pendaftaran', $calonsnya->uruts)->first();

                if (!$buku) {
                    $pdf = PDF::loadView('pdf.buku_blmsiap', compact('calonsnya'));
                    return $pdf->stream('');
                }

                if ($buku->lunas_daul === 'Lunas' && $buku->siap === 'SIAP') {
                    $pdf = PDF::loadView('pdf.' . substr(Auth::user()->tp_name, 0, 4) . '.buku', compact('calonsnya', 'buku'));
                }

                if ($buku->lunas_daul === 'Belum Lunas') {
                    $pdf = PDF::loadView('pdf.buku_blmlunas', compact('calonsnya', 'buku'));
                }

                if ($buku->siap === 'BELUM') {
                    $pdf = PDF::loadView('pdf.buku_blmsiap', compact('calonsnya', 'buku'));
                }

                if ($calonsnya->ck_id === 3 && $buku->siap === 'SIAP') {
                    $pdf = PDF::loadView('pdf.' . substr(Auth::user()->tp_name, 0, 4) . '.buku', compact('calonsnya', 'buku'));
                }

                if ($calonsnya->ck_id === 3 && $buku->siap === 'BELUM') {
                    $pdf = PDF::loadView('pdf.buku_blmsiap', compact('calonsnya', 'buku'));
                }

                return $pdf->stream('');
            } else {
                return redirect('ppdb');
            }
        }

        if (auth()->user()->isAdmin() || auth()->user()->isAdminUnit()) {
            $calonsnya = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya', 'usernya')
                ->whereId($id)->first();
            $gel = Gelombang::where('id', $calonsnya->gel_id)->first();
            $pendaftaran = $gel->kode_va . sprintf("%03d", $calonsnya->urut);

            $buku = AmbilBuku::where('pendaftaran', $pendaftaran)->first();

            if ($buku) {
                $pdf = PDF::loadView('pdf.' . substr(Auth::user()->tp_name, 0, 4) . '.buku', compact('calonsnya', 'buku'));

                if ($buku->lunas_daul === 'Lunas' && $buku->siap === 'SIAP') {
                    $pdf = PDF::loadView('pdf.' . substr(Auth::user()->tp_name, 0, 4) . '.buku', compact('calonsnya', 'buku'));
                }

                if ($buku->lunas_daul === 'Belum Lunas') {
                    $pdf = PDF::loadView('pdf.buku_blmlunas', compact('calonsnya', 'buku'));
                }

                if ($buku->siap === 'BELUM') {
                    $pdf = PDF::loadView('pdf.buku_blmsiap', compact('calonsnya', 'buku'));
                }

                if ($calonsnya->ck_id === 3 && $buku->siap === 'SIAP') {
                    $pdf = PDF::loadView('pdf.' . substr(Auth::user()->tp_name, 0, 4) . '.buku', compact('calonsnya', 'buku'));
                }

                if ($calonsnya->ck_id === 3 && $buku->siap === 'BELUM') {
                    $pdf = PDF::loadView('pdf.buku_blmsiap', compact('calonsnya', 'buku'));
                }
            } else {
                $pdf = PDF::loadView('pdf.buku_blmsiap', compact('calonsnya', 'buku'));
            }
            return $pdf->stream('');
        }
    }

    public function getCalon(Request $request)
    {
        ini_set('max_execution_time', 1200);
        $id = $request->id;
        $va = substr($id, 0, 6);
        $urt = intval(substr($id, 6));
        if (auth()->user()->isAdmin()) {
            $gelombang = Gelombang::where('kode_va', $va)->get()->pluck('id');
            $calon = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'usernya')
                ->where('gel_id', $gelombang)
                ->where('urut', $urt)
                ->where('status', 1)->first();
            $tagihans = Tagihan::where('kelas_id', $calon->kelas_tujuan)->get();
            $tagihanseragam = TagihanSeragam::where('gel_id', $gelombang)->where('jk', $calon->jk)->first();
            $totaltagihan = $tagihans->sum('biaya') + $tagihanseragam->biaya;
            $no = 1;
            return view('wawancara.invoice', compact('calon', 'tagihans', 'tagihanseragam', 'totaltagihan', 'no'));
        }
    }
}

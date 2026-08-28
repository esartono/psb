<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Calon;
use App\User;
use App\Gelombang;
use App\TahunPelajaran;

class GraphController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']); //->except();
    }
    public function harian()
    {
        if (auth()->user()->isAdmin()) {
            // $userData = Calon::select(\DB::raw("COUNT(*) as count"))
            //     ->where('status', 1)
            //     ->groupBy(\DB::raw("Month(created_at)"))
            //     ->pluck('count');

            $tp = TahunPelajaran::where('status', 1)->first();
            $gelombang = Gelombang::where('tp', $tp->id)->orderBy('unit_id', 'asc')->get()->toArray();

            // $jedaHari = (int)(date_diff($start, $end, true)->format('%a'));
            $label = $datatk = $datasd = $datasmp = $datasma = array();
            $i = 0;

            $begin = new \DateTime((int)taAktif() - 1 . '-09-01');
            $end = new \DateTime('now');

            $interval = \DateInterval::createFromDateString('4 day');
            $period = new \DatePeriod($begin, $interval, $end);

            // Mulai Grafik
            $label[0] = "";
            $datatk[0] = $datasd[0] = $datasmp[0] = $datasma[0] = 0;
            $targettk[0] = 120;
            $targetsd[0] = 180;
            $targetsmp[0] = 210;
            $targetsma[0] = 400;
            $i++;

            foreach ($period as $dt) {
                $label[$i] = $dt->format("d-m-Y");


                //Unit TK
                $datatk[$i] = Calon::where('tgl_daftar', '<=', $dt->format("Y-m-d"))
                    ->where('gel_id', $gelombang[0]['id'])
                    ->where('aktif', true)->where('status', 1)
                    ->get()->count();
                $targettk[$i] = $targettk[0];

                //Unit SD
                $datasd[$i] = Calon::where('tgl_daftar', '<=', $dt->format("Y-m-d"))
                    ->where('gel_id', $gelombang[1]['id'])
                    ->where('aktif', true)->where('status', 1)
                    ->get()->count();
                $targetsd[$i] = $targetsd[0];

                //Unit SMP
                $datasmp[$i] = Calon::where('tgl_daftar', '<=', $dt->format("Y-m-d"))
                    ->where('gel_id', $gelombang[2]['id'])
                    ->where('aktif', true)->where('status', 1)
                    ->get()->count();
                $targetsmp[$i] = $targetsmp[0];

                //Unit SMA
                $datasma[$i] = Calon::where('tgl_daftar', '<=', $dt->format("Y-m-d"))
                    ->where('gel_id', $gelombang[3]['id'])
                    ->where('aktif', true)->where('status', 1)
                    ->get()->count();
                $targetsma[$i] = $targetsma[0];
                $i++;
            }

            $tk = [
                'label' => 'Unit TK',
                'backgroundColor' => '#f87979',
                'data' => $datatk
            ];

            // $tk = (object)$tk;
            // $sd = ['data' => $datasd];
            // $smp = ['data' => $datasmp];
            // $sma = ['data' => $datasma];

            $tk = ['data' => $datatk, 'target' => $targettk];
            $sd = ['data' => $datasd, 'target' => $targetsd];
            $smp = ['data' => $datasmp, 'target' => $targetsmp];
            $sma = ['data' => $datasma, 'target' => $targetsma];

            return view('graph', compact('tk', 'sd', 'smp', 'sma', 'label'));
            // $data = [$tk, $label];
            // return response()->json(['data' => $data]);
        }

        return redirect()->route('ppdb');
    }

    public function grafikNya($harinya)
    {
        if (auth()->user()->isAdmin()) {

            $tp = TahunPelajaran::where('status', 1)->first();
            $gelombang = Gelombang::where('tp', $tp->id)->orderBy('unit_id', 'asc')->get()->toArray();

            $label = $datatk = $datasd = $datasmp = $datasma = array();
            $i = 0;

            $begin = new \DateTime((int)taAktif() - 1 . '-08-10');
            $end = new \DateTime('now');

            $interval = \DateInterval::createFromDateString($harinya . ' day');
            $period = new \DatePeriod($begin, $interval, $end);

            // Mulai Grafik
            $label[0] = "";
            $dataccec[0] = $datatk[0] = $datasd[0] = $datasmp[0] = $datasma[0] = 0;
            $targetccec[0] = 120;
            $targettk[0] = 120;
            $targetsd[0] = 180;
            $targetsmp[0] = 210;
            $targetsma[0] = 400;
            $i++;

            foreach ($period as $dt) {
                $label[$i] = $dt->format("d-m-Y");

                //Unit CCEC
                $dataccec[$i] = Calon::where('tgl_daftar', '<=', $dt->format("Y-m-d"))
                    ->where('gel_id', $gelombang[0]['id'])
                    ->where('aktif', true)->where('status', 1)
                    ->get()->count();
                $targetccec[$i] = $targetccec[0];

                //Unit TK
                $datatk[$i] = Calon::where('tgl_daftar', '<=', $dt->format("Y-m-d"))
                    ->where('gel_id', $gelombang[1]['id'])
                    ->where('aktif', true)->where('status', 1)
                    ->get()->count();
                $targettk[$i] = $targettk[0];

                //Unit SD
                $datasd[$i] = Calon::where('tgl_daftar', '<=', $dt->format("Y-m-d"))
                    ->where('gel_id', $gelombang[2]['id'])
                    ->where('aktif', true)->where('status', 1)
                    ->get()->count();
                $targetsd[$i] = $targetsd[0];

                //Unit SMP
                $datasmp[$i] = Calon::where('tgl_daftar', '<=', $dt->format("Y-m-d"))
                    ->where('gel_id', $gelombang[3]['id'])
                    ->where('aktif', true)->where('status', 1)
                    ->get()->count();
                $targetsmp[$i] = $targetsmp[0];

                //Unit SMA
                $datasma[$i] = Calon::where('tgl_daftar', '<=', $dt->format("Y-m-d"))
                    ->where('gel_id', $gelombang[4]['id'])
                    ->where('aktif', true)->where('status', 1)
                    ->get()->count();
                $targetsma[$i] = $targetsma[0];
                $i++;
            }

            $ccec = ['data' => $dataccec, 'target' => $targetccec, 'color' => 'red'];
            $tk = ['data' => $datatk, 'target' => $targettk, 'color' => 'orange'];
            $sd = ['data' => $datasd, 'target' => $targetsd, 'color' => 'green'];
            $smp = ['data' => $datasmp, 'target' => $targetsmp, 'color' => 'blue'];
            $sma = ['data' => $datasma, 'target' => $targetsma, 'color' => 'brown'];

            // return view('graph', compact('tk', 'sd', 'smp', 'sma', 'label'));
            $data = [
                'label' => $label,
                'ccec' => $ccec,
                'tk' => $tk,
                'sd' => $sd,
                'smp' => $smp,
                'sma' => $sma
            ];
            return response()->json(['data' => $data]);
        }

        return redirect()->route('ppdb');
    }
}

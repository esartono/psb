<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Excel;
use Auth;

use App\Calon;
use App\Gelombang;
use App\TahunPelajaran;
use App\CalonTagihanPSB;

class GelombangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    public function index()
    {
        return Gelombang::with('unitnya.catnya', 'tpnya')
            ->where('tp', auth('api')->user()->tpid)
            ->orderBy('unit_id', 'asc')->get()->toArray();
    }

    public function impruf()
    {
        $total = $null = $belum = $bulanan = $tahunan = array();

        // Ambil data unit 
        $gel_smp = Gelombang::where('unit_id', 3)->where('tp', taId())->pluck('id');
        $gel_sma = Gelombang::where('unit_id', 4)->where('tp', taId())->pluck('id');

        $calonsmp = Calon::whereIn('gel_id', $gel_smp)->pluck('id');
        $calonsma = Calon::whereIn('gel_id', $gel_sma)->pluck('id');

        $null['smp'] = CalonTagihanPSB::with('calonnya')->whereIn('calon_id', $calonsmp)->where('lain', 'like', '%: null%')->get()->count();
        $null['sma'] = CalonTagihanPSB::with('calonnya')->whereIn('calon_id', $calonsma)->where('lain', 'like', '%: null%')->get()->count();

        $belum['smp'] = CalonTagihanPSB::with('calonnya')->whereIn('calon_id', $calonsmp)->where('lain', 'like', '%belum%')->get()->count();
        $belum['sma'] = CalonTagihanPSB::with('calonnya')->whereIn('calon_id', $calonsma)->where('lain', 'like', '%belum%')->get()->count();

        $bulanan['smp'] = CalonTagihanPSB::with('calonnya')->whereIn('calon_id', $calonsmp)->where('lain', 'like', '%bulanan%')->get()->count();
        $bulanan['sma'] = CalonTagihanPSB::with('calonnya')->whereIn('calon_id', $calonsma)->where('lain', 'like', '%bulanan%')->get()->count();

        $tahunan['smp'] = CalonTagihanPSB::with('calonnya')->whereIn('calon_id', $calonsmp)->where('lain', 'like', '%tahunan%')->get()->count();
        $tahunan['sma'] = CalonTagihanPSB::with('calonnya')->whereIn('calon_id', $calonsma)->where('lain', 'like', '%tahunan%')->get()->count();

        $total['smp'] = $null['smp'] + $belum['smp'] + $bulanan['smp'] + $tahunan['smp'];
        $total['sma'] = $null['sma'] + $belum['sma'] + $bulanan['sma'] + $tahunan['sma'];

        return compact('null', 'belum', 'bulanan', 'tahunan', 'total');
    }

    public function show($id)
    {
        $tgl_sekarang = Carbon::now('Asia/Jakarta');

        $gelombang = Gelombang::with('unitnya.catnya', 'tpnya')
            ->where('unit_id', $id)
            ->whereDate('start', '<=', $tgl_sekarang)
            ->whereDate('end', '>=', $tgl_sekarang)
            ->where('tp', auth('api')->user()->tpid)
            ->first();

        if ($gelombang !== null) {
            return $gelombang->toArray();
        }
    }

    public function store(Request $request)
    {
        Gelombang::create([
            'name' => $request['name'],
            'tp' => $request['tp'],
            'unit_id' => $request['unit_id'],
            'minimum_age' => $request['minimum_age'],
            'kuota' => $request['kuota'],
            'kuota_inklusi' => $request['kuota_inklusi'],
            'kode_va' => $request['kode_va'],
            'start' => $request['start'],
            'end' => $request['end'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $gelombang = Gelombang::findOrFail($id);
        $gelombang->update($request->all());
    }

    public function destroy($id)
    {
        $gelombang = Gelombang::findOrFail($id);
        $gelombang->delete();
    }
}

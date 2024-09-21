<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\TahunPelajaran;

class TahunPelajaranController extends Controller
{

    public function ta()
    {
        $ta = TahunPelajaran::where('status', true)->first();

        $ta_skrg = intval(substr($ta->name, 0, 4));
        $tanya = ($ta_skrg - 1) . '/' . $ta_skrg;
        $tas = array(
            [
                'id' => 0,
                'name' => $tanya . ' dan ' . $ta->name,
            ],
            [
                'id' => 1,
                'name' => $ta->name,
            ],
            [
                'id' => 2,
                'name' => $tanya,
            ],
            [
                'id' => 3,
                'name' => 'Tidak Tersedia',
            ],
        );
        return $tas;
    }

    public function index()
    {
        return TahunPelajaran::orderBy('name', 'asc')->get()->toArray();
    }

    public function store(Request $request)
    {
        if ($request['status'] === 1) {
            DB::table('tahun_pelajarans')->update(['status' => 0]);
        }

        TahunPelajaran::create([
            'name' => $request['name'],
            'status' => $request['status']
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request['status'] === 1) {
            DB::table('tahun_pelajarans')->update(['status' => 0]);
        }

        $tp = TahunPelajaran::findOrFail($id);
        $tp->update($request->all());
    }

    public function destroy($id)
    {
        $tp = TahunPelajaran::findOrFail($id);
        $tp->delete();
    }

    public function dataTP()
    {
        return TahunPelajaran::orderBy('name', 'asc')->paginate(1000);
    }
}

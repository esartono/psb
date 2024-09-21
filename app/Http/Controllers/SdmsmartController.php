<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SdmsmartController extends Controller
{
    public function datapegawai()
    {
        if (auth()->user()->isAdmin()) {
            $url = 'http://sdmsmart.nurulfikri.sch.id/api/api.php/AbsensiPegawaiNF/?id=semua';
            $obj = json_decode(file_get_contents($url), true);
            if ($obj['message'] == 'Data show success') {
                // return $obj['data'][0]['nama'];
                $datas = array();
                $pegawais = $obj['data'];
                foreach ($pegawais as $p) {
                    $datas[] = $p['id'] . ' - ' . $p['nama'];
                }
                return $datas;
            }
        }
    }
}

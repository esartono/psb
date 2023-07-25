<?php

use App\TahunPelajaran;

if (!function_exists("taAktif")) {
    function taAktif()
    {
        return TahunPelajaran::where('status', 1)->first()->name;
    }
}

if (!function_exists("folderID")) {
    function folderID()
    {
        return TahunPelajaran::where('status', 1)->first()->folderID;
    }
}

if (!function_exists("namaBulan")) {
    function namaBulan($x)
    {
        $namaBulan = array(
            1 => "Januari",
            2 => "Februari",
            3 => "Maret",
            4 => "April",
            5 => "Mei",
            6 => "Juni",
            7 => "Juli",
            8 => "Agustus",
            9 => "September",
            10 => "Oktober",
            11 => "November",
            12 => "Desember"
        );

        return $namaBulan[$x];
    }
}

<?php

use App\Gelombang;
use App\TahunPelajaran;

if (!function_exists("opened")) {
    function opened()
    {
        $tp = TahunPelajaran::where('status', 1)->first()->id;
        $open = Gelombang::where('tp', $tp)->orderby('start', 'asc')->first();
        return $open;
    }
}

if (!function_exists("taId")) {
    function taId()
    {
        return TahunPelajaran::where('status', 1)->first()->id;
    }
}

if (!function_exists("taAktif")) {
    function taAktif()
    {
        return TahunPelajaran::where('status', 1)->first()->name;
    }
}

if (!function_exists("taKemarin")) {
    function taKemarin()
    {
        $taSekarang = (int)TahunPelajaran::where('status', 1)->first()->name;
        return $taSekarang - 1 . '/' . $taSekarang;
    }
}

if (!function_exists("folderID")) {
    function folderID()
    {
        return TahunPelajaran::where('status', 1)->first()->folderID;
    }
}

if (!function_exists("unit")) {
    function unit($id)
    {
        $unit = ["", "tk", "sd", "smp", "sma"];
        return $unit[$id];
    }
}

if (!function_exists("mataPelajaran")) {
    function mataPelajaran($unit)
    {
        $mp = [
            'SMP' => ['Pendidikan Agama Islam', 'Bahasa Indonesia', 'Matematika', 'IPA', 'IPS'],
            'SMA' => ['Pendidikan Agama Islam', 'Bahasa Indonesia', 'Bahasa Inggris', 'Matematika', 'IPA', 'IPS']
        ];
        return $mp[$unit];
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

if (!function_exists("formatIndo")) {
    function formatIndo($x)
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

        $split = substr($x, 0, 10);
        $split = explode('-', $split);
        return $split[2] . ' ' . $namaBulan[(int)$split[1]] . ' ' . $split[0];
    }
}

if (!function_exists("breadCrumb")) {
    function breadCrumb($label)
    {
        $label = str_replace("_", " ", $label);
        return ucwords($label);
    }
}

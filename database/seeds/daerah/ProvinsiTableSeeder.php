<?php

use Illuminate\Database\Seeder;
use App\Provinsi;

class ProvinsiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provinsi::create(['id' => 11 , 'name' => 'ACEH',]);
        Provinsi::create(['id' => 12 , 'name' => 'SUMATERA UTARA',]);
        Provinsi::create(['id' => 13 , 'name' => 'SUMATERA BARAT',]);
        Provinsi::create(['id' => 14 , 'name' => 'RIAU',]);
        Provinsi::create(['id' => 15 , 'name' => 'JAMBI',]);
        Provinsi::create(['id' => 16 , 'name' => 'SUMATERA SELATAN',]);
        Provinsi::create(['id' => 17 , 'name' => 'BENGKULU',]);
        Provinsi::create(['id' => 18 , 'name' => 'LAMPUNG',]);
        Provinsi::create(['id' => 19 , 'name' => 'KEPULAUAN BANGKA BELITUNG',]);
        Provinsi::create(['id' => 21 , 'name' => 'KEPULAUAN RIAU',]);
        Provinsi::create(['id' => 31 , 'name' => 'DKI JAKARTA',]);
        Provinsi::create(['id' => 32 , 'name' => 'JAWA BARAT',]);
        Provinsi::create(['id' => 33 , 'name' => 'JAWA TENGAH',]);
        Provinsi::create(['id' => 34 , 'name' => 'DI YOGYAKARTA',]);
        Provinsi::create(['id' => 35 , 'name' => 'JAWA TIMUR',]);
        Provinsi::create(['id' => 36 , 'name' => 'BANTEN',]);
        Provinsi::create(['id' => 51 , 'name' => 'BALI',]);
        Provinsi::create(['id' => 52 , 'name' => 'NUSA TENGGARA BARAT',]);
        Provinsi::create(['id' => 53 , 'name' => 'NUSA TENGGARA TIMUR',]);
        Provinsi::create(['id' => 61 , 'name' => 'KALIMANTAN BARAT',]);
        Provinsi::create(['id' => 62 , 'name' => 'KALIMANTAN TENGAH',]);
        Provinsi::create(['id' => 63 , 'name' => 'KALIMANTAN SELATAN',]);
        Provinsi::create(['id' => 64 , 'name' => 'KALIMANTAN TIMUR',]);
        Provinsi::create(['id' => 65 , 'name' => 'KALIMANTAN UTARA',]);
        Provinsi::create(['id' => 71 , 'name' => 'SULAWESI UTARA',]);
        Provinsi::create(['id' => 72 , 'name' => 'SULAWESI TENGAH',]);
        Provinsi::create(['id' => 73 , 'name' => 'SULAWESI SELATAN',]);
        Provinsi::create(['id' => 74 , 'name' => 'SULAWESI TENGGARA',]);
        Provinsi::create(['id' => 75 , 'name' => 'GORONTALO',]);
        Provinsi::create(['id' => 76 , 'name' => 'SULAWESI BARAT',]);
        Provinsi::create(['id' => 81 , 'name' => 'MALUKU',]);
        Provinsi::create(['id' => 82 , 'name' => 'MALUKU UTARA',]);
        Provinsi::create(['id' => 91 , 'name' => 'PAPUA BARAT',]);
        Provinsi::create(['id' => 94 , 'name' => 'PAPUA',]);
    }
}

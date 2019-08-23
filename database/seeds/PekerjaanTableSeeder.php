<?php

use Illuminate\Database\Seeder;
use App\Pekerjaan;

class PekerjaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pekerjaan::create(['name' =>'Tidak Bekerja']);
        Pekerjaan::create(['name' =>'Nelayan']);
        Pekerjaan::create(['name' =>'Peternak']);
        Pekerjaan::create(['name' =>'PNS/TNI/Polri']);
        Pekerjaan::create(['name' =>'Petani']);
        Pekerjaan::create(['name' =>'Karyawan Swasta']);
        Pekerjaan::create(['name' =>'Wiraswasta']);
        Pekerjaan::create(['name' =>'Karyawan BUMN/BUMD']);
        Pekerjaan::create(['name' =>'Pensiunan']);
        Pekerjaan::create(['name' =>'Guru/Dosen']);
        Pekerjaan::create(['name' =>'Ibu Rumah Tangga']);
        Pekerjaan::create(['name' =>'Lainnya']);

    }
}

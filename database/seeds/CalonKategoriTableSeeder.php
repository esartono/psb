<?php

use App\CalonKategori;
use Illuminate\Database\Seeder;

class CalonKategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CalonKategori::create([
            'name' =>'Umum'
        ]);

        CalonKategori::create([
            'name' =>'Siswa SIT NF'
        ]);

        CalonKategori::create([
            'name' =>'Pegawai SIT NF'
        ]);
    }
}

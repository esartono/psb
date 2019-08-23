<?php

use Illuminate\Database\Seeder;
use App\Penghasilan;

class PenghasilanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Penghasilan::create(['name' =>'Kurang dari Rp. 5.000.000,-']);
        Penghasilan::create(['name' =>'Rp. 5.000.000-Rp. 10.000.000,-']);
        Penghasilan::create(['name' =>'Rp. 10.000.000-Rp. 15.000.000,-']);
        Penghasilan::create(['name' =>'Rp. 15.000.000-Rp. 20.000.000,-']);
        Penghasilan::create(['name' =>'Rp. 20,000,000 - Rp. 25.000.000,-']);
        Penghasilan::create(['name' =>'Lebih dari Rp. 25.000.000,-']);
    }
}

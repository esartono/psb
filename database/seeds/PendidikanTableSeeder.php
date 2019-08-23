<?php

use Illuminate\Database\Seeder;
use App\Pendidikan;

class PendidikanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pendidikan::create(['name' =>'Tidak Sekolah']);
        Pendidikan::create(['name' =>'SD Sederajat']);
        Pendidikan::create(['name' =>'SMP Sederajat']);
        Pendidikan::create(['name' =>'SMA Sederajat']);
        Pendidikan::create(['name' =>'D1']);
        Pendidikan::create(['name' =>'D2']);
        Pendidikan::create(['name' =>'D3']);
        Pendidikan::create(['name' =>'D4/S1']);
        Pendidikan::create(['name' =>'S2']);
        Pendidikan::create(['name' =>'S3']);
    }
}

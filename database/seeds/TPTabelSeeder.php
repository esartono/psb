<?php

use Illuminate\Database\Seeder;
use App\TahunPelajaran;

class TPTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TahunPelajaran::create(['name' => '2019/2020', 'status' => 0]);
        TahunPelajaran::create(['name' => '2020/2021', 'status' => 0]);
        TahunPelajaran::create(['name' => '2021/2022', 'status' => 1]);
    }
}

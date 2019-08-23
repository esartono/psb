<?php

use App\Gelombang;
use Illuminate\Database\Seeder;

class GelombangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gelombang::create([
            'name' =>'Satu',
            'tp' => 1,
            'unit_id' => 1,
            'kuota' => 75,
            'kuota_inklusi' => 75,
            'kode_va' => 202131,
            'start' => '2019-09-01',
            'end' => '2020-05-30'
        ]);
    }
}

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
            'tp' => 2,
            'unit_id' => 1,
            'minimum_age' => '2018-07-01',
            'kuota' => 75,
            'kuota_inklusi' => 0,
            'kode_va' => 202131,
            'start' => '2019-09-01',
            'end' => '2020-05-30'
        ]);

        Gelombang::create([
            'name' =>'Satu',
            'tp' => 2,
            'unit_id' => 2,
            'minimum_age' => '2014-07-01',
            'kuota' => 120,
            'kuota_inklusi' => 0,
            'kode_va' => 202132,
            'start' => '2019-09-01',
            'end' => '2020-05-30'
        ]);

        Gelombang::create([
            'name' =>'Satu',
            'tp' => 2,
            'unit_id' => 3,
            'minimum_age' => '2007-07-01',
            'kuota' => 128,
            'kuota_inklusi' => 0,
            'kode_va' => 202133,
            'start' => '2019-09-01',
            'end' => '2020-05-30'
        ]);

        Gelombang::create([
            'name' =>'Satu',
            'tp' => 2,
            'unit_id' => 4,
            'minimum_age' => '2006-07-01',
            'kuota' => 168,
            'kuota_inklusi' => 0,
            'kode_va' => 202134,
            'start' => '2019-09-01',
            'end' => '2020-05-30'
        ]);
    }
}

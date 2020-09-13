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
            'tp' => 3,
            'unit_id' => 1,
            'minimum_age' => '2019-07-01',
            'kuota' => 75,
            'kuota_inklusi' => 0,
            'kode_va' => 212231,
            'start' => '2020-09-01',
            'end' => '2020-12-30'
        ]);

        Gelombang::create([
            'name' =>'Satu',
            'tp' => 3,
            'unit_id' => 2,
            'minimum_age' => '2015-07-01',
            'kuota' => 120,
            'kuota_inklusi' => 0,
            'kode_va' => 212232,
            'start' => '2020-09-01',
            'end' => '2020-12-30'
        ]);

        Gelombang::create([
            'name' =>'Satu',
            'tp' => 3,
            'unit_id' => 3,
            'minimum_age' => '2008-07-01',
            'kuota' => 128,
            'kuota_inklusi' => 0,
            'kode_va' => 212233,
            'start' => '2020-09-01',
            'end' => '2020-12-30'
        ]);

        Gelombang::create([
            'name' =>'Satu',
            'tp' => 3,
            'unit_id' => 4,
            'minimum_age' => '2007-07-01',
            'kuota' => 168,
            'kuota_inklusi' => 0,
            'kode_va' => 212234,
            'start' => '2020-09-01',
            'end' => '2020-12-30'
        ]);
    }
}

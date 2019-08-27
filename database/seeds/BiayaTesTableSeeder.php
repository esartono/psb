<?php

use App\BiayaTes;
use Illuminate\Database\Seeder;

class BiayaTesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BiayaTes::create([
            'gel_id' => 1,
            'ck_id' => 1,
            'biaya' => 750000
        ]);

        BiayaTes::create([
            'gel_id' => 1,
            'ck_id' => 2,
            'biaya' => 550000
        ]);

        BiayaTes::create([
            'gel_id' => 1,
            'ck_id' => 3,
            'biaya' => 350000
        ]);

        BiayaTes::create([
            'gel_id' => 2,
            'ck_id' => 1,
            'biaya' => 850000
        ]);

        BiayaTes::create([
            'gel_id' => 2,
            'ck_id' => 2,
            'biaya' => 550000
        ]);

        BiayaTes::create([
            'gel_id' => 2,
            'ck_id' => 3,
            'biaya' => 350000
        ]);

        BiayaTes::create([
            'gel_id' => 3,
            'ck_id' => 1,
            'biaya' => 950000
        ]);

        BiayaTes::create([
            'gel_id' => 3,
            'ck_id' => 2,
            'biaya' => 650000
        ]);

        BiayaTes::create([
            'gel_id' => 3,
            'ck_id' => 3,
            'biaya' => 450000
        ]);

        BiayaTes::create([
            'gel_id' => 4,
            'ck_id' => 1,
            'biaya' => 1050000
        ]);

        BiayaTes::create([
            'gel_id' => 4,
            'ck_id' => 2,
            'biaya' => 950000
        ]);

        BiayaTes::create([
            'gel_id' => 4,
            'ck_id' => 3,
            'biaya' => 750000
        ]);

    }
}

<?php

use Illuminate\Database\Seeder;
use App\Kelasnya;

class KelasnyaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelasnya::create([
            'unit_id' => 1,
            'name' =>'Toddler'
        ]);

        Kelasnya::create([
            'unit_id' => 1,
            'name' =>'Play Group'
        ]);

        Kelasnya::create([
            'unit_id' => 1,
            'name' =>'TK A'
        ]);

        Kelasnya::create([
            'unit_id' => 1,
            'name' =>'TK B'
        ]);

        Kelasnya::create([
            'unit_id' => 2,
            'name' =>'1'
        ]);

        Kelasnya::create([
            'unit_id' => 2,
            'name' =>'2'
        ]);

        Kelasnya::create([
            'unit_id' => 2,
            'name' =>'3'
        ]);

        Kelasnya::create([
            'unit_id' => 2,
            'name' =>'4'
        ]);

        Kelasnya::create([
            'unit_id' => 2,
            'name' =>'5'
        ]);

        Kelasnya::create([
            'unit_id' => 2,
            'name' =>'6'
        ]);

        Kelasnya::create([
            'unit_id' => 3,
            'name' =>'7'
        ]);

        Kelasnya::create([
            'unit_id' => 3,
            'name' =>'8'
        ]);

        Kelasnya::create([
            'unit_id' => 3,
            'name' =>'9'
        ]);

        Kelasnya::create([
            'unit_id' => 4,
            'name' =>'10'
        ]);

        Kelasnya::create([
            'unit_id' => 4,
            'name' =>'11'
        ]);

        Kelasnya::create([
            'unit_id' => 4,
            'name' =>'12'
        ]);

    }
}

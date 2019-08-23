<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
            'id' => 1,
            'name' =>'Administrator'
        ]);

        Level::create([
            'id' => 2,
            'name' =>'User'
        ]);

        Level::create([
            'id' => 3,
            'name' =>'Admin Unit'
        ]);

        Level::create([
            'id' => 4,
            'name' =>'Keuangan'
        ]);

        Level::create([
            'id' => 5,
            'name' =>'Supervisor'
        ]);

        Level::create([
            'id' => 6,
            'name' =>'Pengadaan'
        ]);

    }
}

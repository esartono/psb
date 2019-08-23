<?php

use Illuminate\Database\Seeder;
use App\SumberInfo;

class SumberInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SumberInfo::create(['name' =>'Teman']);
        SumberInfo::create(['name' =>'Internet']);
        SumberInfo::create(['name' =>'Spanduk/Baliho']);
        SumberInfo::create(['name' =>'Brosur']);
        SumberInfo::create(['name' =>'Internet']);
        SumberInfo::create(['name' =>'Lainnya']);
    }
}

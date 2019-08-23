<?php

use Illuminate\Database\Seeder;
use App\SchoolCategory;

class SchoolCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        SchoolCategory::create([
            'name' =>'TK'
        ]);

        SchoolCategory::create([
            'name' =>'SD'
        ]);

        SchoolCategory::create([
            'name' =>'SMP'
        ]);

        SchoolCategory::create([
            'name' =>'SMA'
        ]);

    }
}

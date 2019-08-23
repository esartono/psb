<?php

use Illuminate\Database\Seeder;
use App\Unit;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'name' => 'TKIT Nurul Fikri',
            'cat_id' => 1,
            'address' => 'Jl. H. Rijin Tugu Kelapa Dua',
            'phone' => '021-1234',
            'email' => 'psb@nurulfikri.sch.id, tkit@nurulfikri.sch.id'
        ]);

        Unit::create([
            'name' => 'SDIT Nurul Fikri',
            'cat_id' => 2,
            'address' => 'Jl. Tugu Raya No. 61 Tugu Kelapa Dua',
            'phone' => '021-1234',
            'email' => 'psb@nurulfikri.sch.id, sdit@nurulfikri.sch.id'
        ]);

        Unit::create([
            'name' => 'SMPIT Nurul Fikri',
            'cat_id' => 3,
            'address' => 'Jl. Tugu Raya No. 61 Tugu Kelapa Dua',
            'phone' => '021-1234',
            'email' => 'psb@nurulfikri.sch.id, smpit@nurulfikri.sch.id'
        ]);

        Unit::create([
            'name' => 'SMAIT Nurul Fikri',
            'cat_id' => 4,
            'address' => 'Jl. H.Sairi Tugu Kelapa Dua',
            'phone' => '021-1234',
            'email' => 'psb@nurulfikri.sch.id, smait@nurulfikri.sch.id'
        ]);

    }
}

<?php

use App\Agreement;
use Illuminate\Database\Seeder;

class AgreementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agreement::create([
            'agreement' =>''
        ]);
    }
}

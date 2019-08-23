<?php

use App\Agama;
use Illuminate\Database\Seeder;

class AgamaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agama::create([
            'name' =>'Islam'
        ]);

        Agama::create([
            'name' =>'Protestan'
        ]);

        Agama::create([
            'name' =>'Katolik'
        ]);

        Agama::create([
            'name' =>'Hindu'
        ]);

        Agama::create([
            'name' =>'Buddha'
        ]);

        Agama::create([
            'name' =>'Khonghucu'
        ]);

    }
}

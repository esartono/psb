<?php

use Illuminate\Database\Seeder;
use App\JDoku;

class JDokuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('j_dokus')->insert([
        [
            'code' => 'akte',
            'name' => 'Akte Kelahiran',
            'unit' => 'TK,SD,SMP,SMA',
            'created_at' => now(),
            'updated_at' => now()
        ],[
            'code' => 'kk',
            'name' => 'Kartu Keluarga',
            'unit' => 'TK,SD,SMP,SMA',
            'created_at' => now(),
            'updated_at' => now()
        ],[
            'code' => 'ktp_ayah',
            'name' => 'KTP Ayah',
            'unit' => 'TK,SD,SMP,SMA',
            'created_at' => now(),
            'updated_at' => now()
        ],[
            'code' => 'ktp_ibu',
            'name' => 'KTP Ibu',
            'unit' => 'TK,SD,SMP,SMA',
            'created_at' => now(),
            'updated_at' => now()
        ]
        ]);
    }
}

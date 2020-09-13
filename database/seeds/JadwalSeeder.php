<?php

use Illuminate\Database\Seeder;
use App\Jadwal;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jadwal::create([
            'gel_id' => 1,
            'internal' => 0,
            'seleksi' => '2020-10-05',
            'kuota' => 30,
            'ikut' => 0,
            'keterangan' => '19 - 23 Oktober 2020',
        ],[
            'gel_id' => 2,
            'internal' => 1,
            'seleksi' => '2020-10-05',
            'kuota' => 30,
            'ikut' => 0,
            'keterangan' => '19 - 23 Oktober 2020',
        ],[
            'gel_id' => 2,
            'internal' => 0,
            'seleksi' => '2020-10-06',
            'kuota' => 30,
            'ikut' => 0,
            'keterangan' => '19 - 23 Oktober 2020',
        ],[
            'gel_id' => 3,
            'internal' => 1,
            'seleksi' => '2020-10-07',
            'kuota' => 30,
            'ikut' => 0,
            'keterangan' => '19 - 23 Oktober 2020',
        ],[
            'gel_id' => 3,
            'internal' => 0,
            'seleksi' => '2020-10-08',
            'kuota' => 30,
            'ikut' => 0,
            'keterangan' => '19 - 23 Oktober 2020',
        ],[
            'gel_id' => 4,
            'internal' => 1,
            'seleksi' => '2020-10-09',
            'kuota' => 30,
            'ikut' => 0,
            'keterangan' => '19 - 23 Oktober 2020',
        ],[
            'gel_id' => 4,
            'internal' => 0,
            'seleksi' => '2020-10-10',
            'kuota' => 30,
            'ikut' => 0,
            'keterangan' => '19 - 23 Oktober 2020',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Berita;

class BeritaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Berita::create([
            'judul' => 'PPDB Open',
            'Berita' => 'PPDB SIT Nurul Fikri akan dibuka pada tanggal 1 September 2020, segera daftarkan putra/i Anda.'
        ]);
    }
}

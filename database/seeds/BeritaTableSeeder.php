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
            'judul' => 'PSB Open',
            'Berita' => 'PSB SIT Nurul Fikri akan dibuka pada tanggal 1 September 2019, segera daftarkan putra/i Anda.'
        ]);
        
    }
}

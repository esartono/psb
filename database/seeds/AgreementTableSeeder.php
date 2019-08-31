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
            'agreement' =>'Menerima keputusan hasil tes seleksi siswa baru.'
        ]);

        Agreement::create([
            'agreement' =>'Menyelesaikan kewajiban pembiayaan pendidikan yang meliputi SPP sebelum tanggal 10 setiap bulannya, biaya daftar ulang tahunan, biaya komite sekolah tahunan.'
        ]);

        Agreement::create([
            'agreement' =>'Menyepakati seluruh pola pendidikan dan pembelajaran yang dilaksanakan sekolah.'
        ]);

        Agreement::create([
            'agreement' =>'Menaati seluruh peraturan dan tata tertib yang ditetapkan sekolah.'
        ]);

        Agreement::create([
            'agreement' =>'Bersedia mengikuti kegiatan parenting yang diselenggarakan sekolah.'
        ]);
    }
}

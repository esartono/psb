<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(LevelTableSeeder::class);
        $this->call(SchoolCategoryTableSeeder::class);
        $this->call(UnitTableSeeder::class);
        $this->call(PekerjaanTableSeeder::class);
        $this->call(PendidikanTableSeeder::class);
        $this->call(PenghasilanTableSeeder::class);
        $this->call(SumberInfoTableSeeder::class);
        $this->call(KelasnyaTableSeeder::class);
        //$this->call(ProvinsiTableSeeder::class);
        //$this->call(KotaTableSeeder::class);
        //$this->call(KecamatanTableSeeder::class);
        //$this->call(KelurahanTableSeeder::class);
        $this->call(TPTabelSeeder::class);
        $this->call(CalonKategoriTableSeeder::class);
        $this->call(AgamaTableSeeder::class);
        $this->call(GelombangTableSeeder::class);
        $this->call(AgreementTableSeeder::class);
    }
}

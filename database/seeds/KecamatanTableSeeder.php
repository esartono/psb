<?php

use JeroenZwart\CsvSeeder\CsvSeeder;

class KecamatanTableSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
        $this->file = '/database/seeds/daerah/master_kecamatan.csv';
        $this->tablename = 'kecamatans';
        $this->delimiter = ',';
        $this->mapping = ['id', 'kota_id', 'name'];
		$this->header = FALSE;
    }

    public function run()
    {
        DB::disableQueryLog();
	    parent::run();
    }
}

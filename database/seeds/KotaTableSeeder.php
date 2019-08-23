<?php

use JeroenZwart\CsvSeeder\CsvSeeder;

class KotaTableSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
        $this->file = '/database/seeds/daerah/master_kabupaten.csv';
        $this->tablename = 'kotas';
        $this->delimiter = ',';
        $this->mapping = ['id', 'prov_id', 'name'];
		$this->header = FALSE;
    }

    public function run()
    {
        DB::disableQueryLog();
	    parent::run();
    }
}

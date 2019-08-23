<?php

use JeroenZwart\CsvSeeder\CsvSeeder;

class ProvinsiTableSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function __construct()
    {
        $this->file = '/database/seeds/daerah/master_provinsi.csv';
        $this->tablename = 'provinsis';
        $this->delimiter = ',';
        $this->mapping = ['id', 'name'];
		$this->header = FALSE;
    }

    public function run()
    {
        DB::disableQueryLog();
	    parent::run();
    }
}

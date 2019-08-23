<?php

use JeroenZwart\CsvSeeder\CsvSeeder;

class KelurahanTableSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
        $this->file = '/database/seeds/daerah/master_kelurahan.csv';
        $this->tablename = 'kelurahans';
        $this->delimiter = ',';
        $this->mapping = ['id', 'camat_id', 'name'];
		$this->header = FALSE;
    }

    public function run()
    {
        DB::disableQueryLog();
	    parent::run();
    }
}

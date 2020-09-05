<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BenerinWawancara extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calon_jadwals', function(Blueprint $table) {
            $table->renameColumn('wawancara', 'wawancara_ortu');
        });

        Schema::table('calon_jadwals', function(Blueprint $table) {
            $table->date('wawancara')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

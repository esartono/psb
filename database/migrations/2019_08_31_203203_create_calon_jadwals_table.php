<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalonJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_jadwals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('calon_id')->unsigned();
            $table->integer('jadwal_id')->unsigned();
            $table->date('kesehatan')->nullable();
            $table->date('wawancara_ortu')->nullable();
            $table->date('wawancara_siswa')->nullable();
            $table->date('wawancara_inggris')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calon_jadwals');
    }
}

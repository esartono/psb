<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalonTagihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_tagihans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pendaftaran');
            $table->integer('pengembangan')->unsigned();
            $table->integer('pendidikan')->unsigned();
            $table->integer('spp')->unsigned();
            $table->integer('komite')->unsigned();
            $table->integer('seragam')->unsigned();
            $table->integer('diskon')->unsigned()->default(0);
            $table->integer('infaq')->unsigned()->default(0);
            $table->boolean('lunas')->default(false);
            $table->string('pewawancara')->default("");
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
        Schema::dropIfExists('calon_tagihans');
    }
}

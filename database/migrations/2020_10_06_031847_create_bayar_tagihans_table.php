<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBayarTagihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bayar_tagihans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('calon_id');
            $table->date('tgl_bayar');
            $table->integer('bayar');
            $table->string('keterangan');
            $table->bigInteger('admin');
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
        Schema::dropIfExists('bayar_tagihans');
    }
}

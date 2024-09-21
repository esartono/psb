<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBayarSppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bayar_spps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('calon_id')->unsigned();
            $table->date('tanggal_bayar');
            $table->integer('jumlahbayar')->unsigned();
            $table->string('file');
            $table->string('keterangan')->nullable();
            $table->boolean('lunas')->default(0);
            $table->boolean('status')->default(1);
            $table->boolean('verifikasi')->default(0);
            $table->integer('verificator')->unsigned()->nullable();
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
        Schema::dropIfExists('bayar_spps');
    }
}

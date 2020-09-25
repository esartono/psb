<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalonTagihanPSBSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_tagihan_p_s_b_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('calon_id');
            $table->bigInteger('tagihanpsb_id');
            $table->integer('potongan');
            $table->integer('infaq');
            $table->boolean('daul');
            $table->boolean('lunas');
            $table->bigInteger('pewawancara');
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
        Schema::dropIfExists('calon_tagihan_p_s_b_s');
    }
}

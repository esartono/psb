<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagihanPSBSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihan_p_s_b_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('gel_id')->unsigned();
            $table->integer('kelas')->unsigned();
            $table->boolean('kelamin')->default(1);
            $table->json('biaya1');
            $table->json('biaya2');
            $table->json('biaya3');
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
        Schema::dropIfExists('tagihan_p_s_b_s');
    }
}

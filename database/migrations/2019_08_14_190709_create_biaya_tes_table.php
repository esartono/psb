<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiayaTesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biaya_tes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gel_id')->unsigned();
            $table->integer('ck_id')->unsigned();
            $table->integer('biaya')->unsigned();
            $table->timestamps();

            $table->foreign('gel_id')
                ->references('id')->on('gelombangs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biaya_tes');
    }
}

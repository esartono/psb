<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGelombangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gelombangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('tp');
            $table->integer('unit_id')->unsigned();
            $table->integer('kuota')->unsigned();
            $table->integer('kuota_inklusi')->unsigned();
            $table->string('kode_va');
            $table->date('start');
            $table->date('end');
            $table->timestamps();

            $table->foreign('unit_id')
                ->references('id')->on('units')
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
        Schema::dropIfExists('gelombangs');
    }
}

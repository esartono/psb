<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('calon_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('jdoku');
            $table->string('file');
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
        Schema::dropIfExists('dokus');
    }
}

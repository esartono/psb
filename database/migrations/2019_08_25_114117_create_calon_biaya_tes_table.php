<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalonBiayaTesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_biaya_tes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('calon_id')->unsigned();
            $table->integer('biaya_id')->unsigned();
            $table->boolean('lunas')->default(0);
            $table->date('expired');
            $table->timestamps();

            $table->foreign('calon_id')
                ->references('id')->on('calons')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('biaya_id')
                ->references('id')->on('biaya_tes')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calon_biaya_tes');
    }
}

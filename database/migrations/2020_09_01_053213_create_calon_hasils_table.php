<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalonHasilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_hasils', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pendaftaran');
            $table->integer('lulus')->unsigned()->default(0);
            $table->string('catatan')->nullable();
            $table->string('va')->nullable();
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
        Schema::dropIfExists('calon_hasils');
    }
}

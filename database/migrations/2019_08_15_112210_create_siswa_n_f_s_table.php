<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaNFSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_n_f_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nis');
            $table->string('name');
            $table->boolean('jk')->default(1);
            $table->integer('unit')->unsigned();
            $table->integer('tp')->unsigned();
            $table->integer('kelas')->unsigned();
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
        Schema::dropIfExists('siswa_n_f_s');
    }
}

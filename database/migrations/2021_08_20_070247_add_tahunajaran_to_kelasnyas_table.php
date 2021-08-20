<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTahunajaranToKelasnyasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelasnyas', function (Blueprint $table) {
            $table->integer('tahun_ajaran')->default(1)->after('jurusan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelasnyas', function (Blueprint $table) {
            $table->dropColumn('tahun_ajaran');
        });
    }
}

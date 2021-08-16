<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKelaminToKelasnyasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelasnyas', function (Blueprint $table) {
            $table->integer('kelamin')->default('0')->after('status');
            $table->string('jurusan')->default('TIDAK')->after('kelamin');
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
            $table->dropColumn('kelamin');
            $table->dropColumn('jurusan');
        });
    }
}

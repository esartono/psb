<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBaruToCalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calons', function (Blueprint $table) {
            $table->boolean('tahun_sekarang')->default(1)->after('pindahan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calons', function (Blueprint $table) {
            $table->dropColumn('tahun_sekarang');
        });
    }
}

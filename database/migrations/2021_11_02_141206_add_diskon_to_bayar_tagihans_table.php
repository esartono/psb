<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiskonToBayarTagihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bayar_tagihans', function (Blueprint $table) {
            $table->integer('tambah_infaq')->default(0)->after('bayar');
            $table->integer('diskon')->default(0)->after('tambah_infaq');
        });

        Schema::table('calon_tagihan_p_s_b_s', function (Blueprint $table) {
            $table->dropColumn('tambah_infaq');
            $table->dropColumn('diskon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bayar_tagihans', function (Blueprint $table) {
            $table->dropColumn('tambah_infaq');
            $table->dropColumn('diskon');
        });
    }
}

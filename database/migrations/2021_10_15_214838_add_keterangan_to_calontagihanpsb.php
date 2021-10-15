<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeteranganToCalontagihanpsb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calon_tagihan_p_s_b_s', function (Blueprint $table) {
            $table->string('keterangan')->nullable()->after('potongan');
            $table->string('saudara')->nullable()->after('keterangan');
            $table->integer('tambah_infaq')->default(0)->after('infaqnfpeduli');
            $table->integer('diskon')->default(0)->after('tambah_infaq');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calon_tagihan_p_s_b_s', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKhususToCalonTagihanPSB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calon_tagihan_p_s_b_s', function (Blueprint $table) {
            $table->integer('khusus')->default(0)->after('calon_id');
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

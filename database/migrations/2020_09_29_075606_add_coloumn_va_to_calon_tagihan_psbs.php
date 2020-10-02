<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColoumnVaToCalonTagihanPsbs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calon_tagihan_p_s_b_s', function (Blueprint $table) {
            $table->renameColumn('tagihanpsb_id', 'va1');
        });
        Schema::table('calon_tagihan_p_s_b_s', function (Blueprint $table) {
            $table->string('va1')->nullable()->change();
            $table->string('va2')->nullable()->after('va1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calon_tagihan_psbs', function (Blueprint $table) {
            //
        });
    }
}

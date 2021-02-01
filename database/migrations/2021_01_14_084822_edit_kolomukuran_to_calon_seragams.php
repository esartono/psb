<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditKolomukuranToCalonSeragams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calon_seragams', function (Blueprint $table) {
            $table->string('atas')->nullable()->after('calon_id');
            $table->string('bawah')->nullable()->after('atas');
            $table->string('lain')->nullable()->after('bawah');
            $table->dropColumn(['seragam_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calon_seragams', function (Blueprint $table) {
            //
        });
    }
}

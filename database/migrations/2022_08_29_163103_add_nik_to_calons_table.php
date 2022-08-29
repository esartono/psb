<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNikToCalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calons', function (Blueprint $table) {
            $table->string('ayah_nik')->nullable()->after('ayah_nama');
            $table->string('ibu_nik')->nullable()->after('ibu_nama');
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
            $table->dropColumn('ayah_nik');
            $table->dropColumn('ibu_nik');
        });
    }
}

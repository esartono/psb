<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDateToStringInCalonJadwals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calon_jadwals', function(Blueprint $table) {
            $table->string('wawancara_ortu')->nullable()->change();
            $table->string('wawancara_siswa')->nullable()->change();
        });

        Schema::table('jadwals', function(Blueprint $table) {
            $table->string('akademik_link')->nullable()->after('keterangan');
            $table->string('psikologi')->nullable()->after('akademik_link');
            $table->string('wawancara_ortu')->nullable()->after('psikologi');
            $table->string('wawancara_siswa')->nullable()->after('wawancara_ortu');
            $table->string('wawancara_keu')->nullable()->after('wawancara_siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

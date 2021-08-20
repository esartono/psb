<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDraftCalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draft_calons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('gel_id')->nullable()->unsigned();
            $table->integer('ck_id')->nullable()->unsigned();
            $table->date('tgl_daftar');
            $table->string('nisn')->nullable();
            $table->string('nik')->default('-');
            $table->string('name')->default('-');
            $table->string('panggilan')->default('-');
            $table->boolean('jk')->default(1);
            $table->integer('kelas_tujuan')->default(0)->unsigned();
            $table->string('jurusan')->default('-');
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->integer('agama')->default(1);
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kodepos')->nullable();
            $table->integer('provinsi')->nullable()->unsigned();
            $table->integer('kota')->nullable()->unsigned();
            $table->integer('kecamatan')->nullable()->unsigned();
            $table->bigInteger('kelurahan')->nullable()->unsigned();
            $table->string('phone')->nullable();
            $table->string('ayah_nama')->nullable();
            $table->integer('ayah_pendidikan')->nullable()->unsigned();
            $table->integer('ayah_pekerjaan')->nullable()->unsigned();
            $table->string('ayah_penghasilan')->nullable();
            $table->string('ayah_hp')->nullable();
            $table->string('ayah_email')->nullable();
            $table->string('ibu_nama')->nullable();
            $table->integer('ibu_pendidikan')->nullable()->unsigned();
            $table->integer('ibu_pekerjaan')->nullable()->unsigned();
            $table->string('ibu_penghasilan')->nullable();
            $table->string('ibu_hp')->nullable();
            $table->string('ibu_email')->nullable();
            $table->boolean('asal_nf')->default(0);
            $table->boolean('pindahan')->default(0);
            $table->boolean('tahun_sekarang')->default(0);
            $table->string('asal_sekolah')->nullable();
            $table->string('asal_alamat_sekolah')->nullable();
            $table->integer('asal_propinsi_sekolah')->nullable()->unsigned();
            $table->integer('asal_kota_sekolah')->nullable()->unsigned();
            $table->integer('asal_kecamatan_sekolah')->nullable()->unsigned();
            $table->integer('asal_kelurahan_sekolah')->nullable()->unsigned();
            $table->integer('info')->nullable()->unsigned();
            $table->boolean('setuju')->default(0);
            $table->integer('step')->default(1)->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('draft_calons');
    }
}

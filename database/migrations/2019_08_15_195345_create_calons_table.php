<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('gel_id')->unsigned();
            $table->integer('ck_id')->unsigned();
            $table->date('tgl_daftar');
            $table->integer('urut')->nullable()->unsigned();
            $table->string('nisn')->nullable();
            $table->string('nik');
            $table->string('name');
            $table->string('panggilan');
            $table->boolean('jk')->default(1);
            $table->integer('kelas_tujuan')->unsigned();
            $table->string('jurusan')->default("-");
            $table->string('photo')->default('calon.jpg');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->integer('agama')->default(1);
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('kodepos')->nullable();
            $table->integer('provinsi')->unsigned();
            $table->integer('kota')->unsigned();
            $table->integer('kecamatan')->unsigned();
            $table->bigInteger('kelurahan')->unsigned();
            $table->string('phone')->nullable();
            $table->string('ayah_nama')->nullable();
            $table->integer('ayah_pendidikan')->nullable()->unsigned();
            $table->integer('ayah_pekerjaan')->nullable()->unsigned();
            $table->string('ayah_penghasilan')->nullable();
            $table->string('ayah_hp')->nullable()->nullable();
            $table->string('ayah_email')->nullable()->nullable();
            $table->string('ibu_nama')->nullable();
            $table->integer('ibu_pendidikan')->nullable()->unsigned();
            $table->integer('ibu_pekerjaan')->nullable()->unsigned();
            $table->string('ibu_penghasilan')->nullable();
            $table->string('ibu_hp')->nullable()->nullable();
            $table->string('ibu_email')->nullable()->nullable();
            $table->boolean('asal_nf')->default(0);
            $table->boolean('pindahan')->default(0);
            $table->string('asal_sekolah')->nullable();
            $table->string('asal_alamat_sekolah')->nullable();
            $table->integer('asal_propinsi_sekolah')->nullable()->unsigned();
            $table->integer('asal_kota_sekolah')->nullable()->unsigned();
            $table->integer('asal_kecamatan_sekolah')->nullable()->unsigned();
            $table->integer('asal_kelurahan_sekolah')->nullable()->unsigned();
            $table->integer('info')->nullable()->unsigned();
            $table->boolean('status')->default(0);
            $table->boolean('aktif')->default(1);
            $table->boolean('setuju')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calons');
    }
}

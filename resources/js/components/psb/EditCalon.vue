<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-2" v-bind:class="level === false ? 'col-md-10' : 'col-md-12' ">
            <div class="card card-primary card-outline">
                <div class="card-header bg-primary">
                    <h3 class="card-title">
                        <i class="fas fa-user-edit"></i>
                        Form Pendaftaran
                    </h3>
                    <div class="card-tools">
                        <a v-if="level === false" href="psb" type="button" class="btn bg-danger btn-sm">
                            <i class="fas fa-times"></i>
                        </a>
                        <a v-else @click="$router.go(-1)" type="button" class="btn bg-danger btn-sm">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form-wizard
                        @on-complete="onComplete"
                        ref="wizard"
                        title=""
                        subtitle=""
                        stepSize="xs"
                        shape="circle"
                        color="#20a0ff"
                        error-color="#ff4949">
                        <tab-content title="Data Pribadi" icon="fas fa-user">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Jenjang Pendidikan</label>
                                    <div class="col-md-4">
                                        <input
                                        type="text"
                                        class="form-control"
                                        disabled="disabled"
                                        :value="unit.name"
                                        >
                                    </div>
                                    <label class="col-md-2 col-form-label">Kelas Tujuan</label>
                                    <div class="col-md-2">
                                        <select :disabled="form.ck_id == 2" v-model="form.kelas_tujuan" name="kelas_tujuan" class="form-control" id="kelas_tujuan">
                                            <option
                                                v-for="kls in kelass"
                                                :key="kls.id"
                                                v-bind:value="kls.id"
                                            >{{ kls.name }}</option>
                                        </select>
                                        <has-error :form="form" field="kelas_tujuan"></has-error>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-md-4">
                                        <input
                                            v-model="form.name"
                                            type="text"
                                            name="name"
                                            class="form-control"
                                            :disabled="form.ck_id == 2"
                                            :class="{ 'is-invalid':form.errors.has('name') }"
                                            id="name"
                                            placeholder="Nama Lengkap"
                                        >
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                    <label class="col-md-2 col-form-label">Panggilan</label>
                                    <div class="col-md-3">
                                        <input
                                            v-model="form.panggilan"
                                            type="text"
                                            name="panggilan"
                                            class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('panggilan') }"
                                            id="panggilan"
                                            placeholder="Nama Panggilan"
                                        >
                                        <has-error :form="form" field="panggilan"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Tempat Lahir</label>
                                    <div class="col-md-4">
                                        <input
                                            v-model="form.tempat_lahir"
                                            type="text"
                                            name="tempat_lahir"
                                            class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('tempat_lahir') }"
                                            id="tempat_lahir"
                                            placeholder="Tempat Lahir"
                                        >
                                        <has-error :form="form" field="tempat_lahir"></has-error>
                                    </div>
                                    <label class="col-md-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-md-3">
                                        <VueDatePicker
                                            v-model="form.tgl_lahir"
                                            format="DD MMMM YYYY"
                                            format-output="YYYY/MM/DD"
                                            placeholder="Tgl/Bln/Tahun"
                                            v-bind:max-date="minimum_age"
                                            :locale='{ lang: {
                                                "name": "id",
                                                "weekdays": ["Ahad","Senin","Selasa","Rabu","Kamis","Jum`at","Sabtu"],
                                                "weekdaysShort": ["Ahd","Sen","Sel","Rab","Kam","Jum","Sab"],
                                                "weekStart": 1,
                                                "months": ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
                                                "monthsShort": ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Ags","Sep","Okt","Nov","Des"],
                                                "formats": {
                                                    "LT": "HH:mm",
                                                    "LTS": "HH:mm:ss",
                                                    "L": "DD/MM/YYYY",
                                                    "LL": "D MMMM YYYY",
                                                    "LLL": "D MMMM YYYY HH:mm",
                                                    "LLLL": "dddd D MMMM YYYY HH:mm"
                                                }
                                                } }'
                                            class="form-control"
                                        no-header/>
                                        <has-error :form="form" field="tgl_lahir"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Jenis Kelamin</label>
                                    <div class="col-md-3">
                                        <select v-model="form.jk" name="jk" class="form-control" id="jk">
                                            <option value=1>Laki-Laki</option>
                                            <option value=2>Perempuan</option>
                                        </select>
                                        <has-error :form="form" field="jk"></has-error>
                                    </div>
                                    <label class="col-md-2 offset-md-1 col-form-label">Agama</label>
                                    <div class="col-md-2">
                                        <select v-model="form.agama" name="agama" class="form-control" id="agama">
                                            <option
                                                v-for="agama in agamas"
                                                :key="agama.id"
                                                v-bind:value="agama.id"
                                            >{{ agama.name }}</option>
                                        </select>
                                        <has-error :form="form" field="agama"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row" v-show="unit_ck !== 'TK' && unit_ck !== 'SD'">
                                    <label class="col-md-3 col-form-label">NISN</label>
                                    <div class="col-md-4">
                                        <input
                                        v-model="form.nisn"
                                        type="text"
                                        name="nisn"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('nisn') }"
                                        id="nisn"
                                        placeholder="NISN"
                                        >
                                        <has-error :form="form" field="nisn"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">NIK</label>
                                    <div class="col-md-4">
                                        <input
                                        v-model="form.nik"
                                        type="text"
                                        name="nik"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('nik') }"
                                        id="nik"
                                        placeholder="Nomor Induk Kependudukan"
                                        >
                                        <has-error :form="form" field="nik"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Sumber Informasi PSB</label>
                                    <div class="col-md-4">
                                        <select v-model="form.info" name="info" class="form-control" id="info">
                                            <option
                                                v-for="info in infos"
                                                :key="info.id"
                                                v-bind:value="info.id"
                                            >{{ info.name }}</option>
                                        </select>
                                        <has-error :form="form" field="info"></has-error>
                                    </div>
                                </div>
                        </tab-content>
                        <tab-content title="Data Alamat" icon="fas fa-home">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Alamat Tempat Tinggal</label>
                                    <div class="col-md-9">
                                        <input
                                        v-model="form.alamat"
                                        type="text"
                                        name="alamat"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('alamat') }"
                                        id="alamat"
                                        placeholder="Alamat Tempat Tinggal"
                                        >
                                        <has-error :form="form" field="alamat"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Provinsi</label>
                                    <div class="col-md-3">
                                        <select v-model="form.provinsi" v-on:change="listKota($event)" name="provinsi" class="form-control" id="provinsi">
                                            <option
                                                v-for="prov in provinsi"
                                                :key="prov.id"
                                                v-bind:value="prov.id"
                                            >{{ prov.name }}</option>
                                        </select>
                                        <has-error :form="form" field="provinsi"></has-error>
                                    </div>
                                    <label class="col-md-2 offset-md-1 col-form-label">Kabupaten</label>
                                    <div class="col-md-3">
                                        <select v-model="form.kota" v-on:change="listCamat($event)" name="kota" class="form-control" id="kota">
                                            <option
                                                v-for="kota in kotas"
                                                :key="kota.id"
                                                v-bind:value="kota.id"
                                            >{{ kota.name }}</option>
                                        </select>
                                        <has-error :form="form" field="provinsi"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Kecamatan</label>
                                    <div class="col-md-3">
                                        <select v-model="form.kecamatan" v-on:change="listLurah($event)" name="kecamatan" class="form-control" id="kecamatan">
                                            <option
                                                v-for="camat in camats"
                                                :key="camat.id"
                                                v-bind:value="camat.id"
                                            >{{ camat.name }}</option>
                                        </select>
                                        <has-error :form="form" field="kecamatan"></has-error>
                                    </div>
                                    <label class="col-md-2 offset-md-1 col-form-label">Kelurahan</label>
                                    <div class="col-md-3">
                                        <select v-model="form.kelurahan" name="kelurahan" class="form-control" id="kelurahan">
                                            <option
                                                v-for="lurah in lurahs"
                                                :key="lurah.id"
                                                v-bind:value="lurah.id"
                                            >{{ lurah.name }}</option>
                                        </select>
                                        <has-error :form="form" field="kelurahan"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">RT / RW</label>
                                    <div class="col-md-2">
                                        <input
                                        v-model="form.rt"
                                        type="number"
                                        name="rt"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('rt') }"
                                        id="rt"
                                        min=0
                                        >
                                        <has-error :form="form" field="rt"></has-error>
                                    </div>
                                    <div class="col-md-2">
                                        <input
                                        v-model="form.rw"
                                        type="number"
                                        name="rw"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('rw') }"
                                        id="rw"
                                        min=0
                                        >
                                        <has-error :form="form" field="rt"></has-error>
                                    </div>
                                    <label class="col-md-2 col-form-label">Kodepos</label>
                                    <div class="col-md-3">
                                        <input
                                        v-model="form.kodepos"
                                        type="text"
                                        name="kodepos"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('kodepos') }"
                                        id="kodepos"
                                        >
                                        <has-error :form="form" field="kodepos"></has-error>
                                    </div>
                                </div>
                        </tab-content>
                        <tab-content title="Data Orang Tua" icon="fas fa-users">
                            <div class="card-group">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="text-center">Data Ayah</h3>
                                </div>
                                <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Nama Lengkap</label>
                                    <div class="col-md-7">
                                        <input
                                        v-model="form.ayah_nama"
                                        type="text"
                                        name="ayah_nama"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('ayah_nama') }"
                                        id="ayah_nama"
                                        placeholder="Nama Ayah"
                                        >
                                        <has-error :form="form" field="ayah_nama"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Pendidikan</label>
                                    <div class="col-md-7">
                                        <select v-model="form.ayah_pendidikan" name="ayah_pendidikan" class="form-control" id="ayah_pendidikan">
                                            <option
                                                v-for="didik in pendidikan"
                                                :key="didik.id"
                                                v-bind:value="didik.id"
                                            >{{ didik.name }}</option>
                                        </select>
                                        <has-error :form="form" field="ayah_pendidikan"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Pekerjaan</label>
                                    <div class="col-md-7">
                                        <select v-model="form.ayah_pekerjaan" name="ayah_pekerjaan" class="form-control" id="ayah_pekerjaan">
                                            <option
                                                v-for="kerja in pekerjaan"
                                                :key="kerja.id"
                                                v-bind:value="kerja.id"
                                            >{{ kerja.name }}</option>
                                        </select>
                                        <has-error :form="form" field="ayah_pekerjaan"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Penghasilan</label>
                                    <div class="col-md-7">
                                        <!-- <select v-model="form.ayah_penghasilan" name="ayah_penghasilan" class="form-control" id="ayah_penghasilan">
                                            <option
                                                v-for="gaji in gajis"
                                                :key="gaji.id"
                                                v-bind:value="gaji.id"
                                            >{{ gaji.name }}</option>
                                        </select> -->
                                        <input
                                        v-model="form.ayah_penghasilan"
                                        type="number"
                                        name="ayah_penghasilan"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('ayah_penghasilan') }"
                                        id="ayah_penghasilan"
                                        min=0
                                        step=500000
                                        >

                                        <has-error :form="form" field="ayah_penghasilan"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">No. Ponsel</label>
                                    <div class="col-md-7">
                                        <input
                                        v-model="form.ayah_hp"
                                        type="text"
                                        name="ayah_hp"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('ayah_hp') }"
                                        id="ayah_hp"
                                        >
                                        <has-error :form="form" field="ayah_hp"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Alamat E-mail</label>
                                    <div class="col-md-7">
                                        <input
                                        v-model="form.ayah_email"
                                        type="email"
                                        name="ayah_email"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('ayah_email') }"
                                        id="ayah_email"
                                        >
                                        <has-error :form="form" field="ayah_email"></has-error>
                                    </div>
                                </div>
                                </div>
                                </div>
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="text-center">Data Ibu</h3>
                                </div>
                                <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Nama Lengkap</label>
                                    <div class="col-md-7">
                                        <input
                                        v-model="form.ibu_nama"
                                        type="text"
                                        name="ibu_nama"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('ibu_nama') }"
                                        id="ibu_nama"
                                        placeholder="Nama Ibu"
                                        >
                                        <has-error :form="form" field="ibu_nama"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Pendidikan</label>
                                    <div class="col-md-7">
                                        <select v-model="form.ibu_pendidikan" name="ibu_pendidikan" class="form-control" id="ibu_pendidikan">
                                            <option
                                                v-for="didik in pendidikan"
                                                :key="didik.id"
                                                v-bind:value="didik.id"
                                            >{{ didik.name }}</option>
                                        </select>
                                        <has-error :form="form" field="ibu_pendidikan"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Pekerjaan</label>
                                    <div class="col-md-7">
                                        <select v-model="form.ibu_pekerjaan" name="ibu_pekerjaan" class="form-control" id="ibu_pekerjaan">
                                            <option
                                                v-for="kerja in pekerjaan"
                                                :key="kerja.id"
                                                v-bind:value="kerja.id"
                                            >{{ kerja.name }}</option>
                                        </select>
                                        <has-error :form="form" field="ibu_pekerjaan"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Penghasilan</label>
                                    <div class="col-md-7">
                                        <!-- <select v-model="form.ibu_penghasilan" name="ibu_penghasilan" class="form-control" id="ibu_penghasilan">
                                            <option
                                                v-for="gaji in gajis"
                                                :key="gaji.id"
                                                v-bind:value="gaji.id"
                                            >{{ gaji.name }}</option>
                                        </select> -->
                                        <input
                                        v-model="form.ibu_penghasilan"
                                        type="number"
                                        name="ibu_penghasilan"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('ibu_penghasilan') }"
                                        id="ibu_penghasilan"
                                        min=0
                                        step=500000
                                        >

                                        <has-error :form="form" field="ibu_penghasilan"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">No. Ponsel</label>
                                    <div class="col-md-7">
                                        <input
                                        v-model="form.ibu_hp"
                                        type="text"
                                        name="ibu_hp"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('ibu_hp') }"
                                        id="ibu_hp"
                                        >
                                        <has-error :form="form" field="ibu_hp"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Alamat E-mail</label>
                                    <div class="col-md-7">
                                        <input
                                        v-model="form.ibu_email"
                                        type="email"
                                        name="ibu_email"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('ibu_email') }"
                                        id="ibu_email"
                                        >
                                        <has-error :form="form" field="ibu_email"></has-error>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        </tab-content>
                        <tab-content title="Data Asal Sekolah" icon="fas fa-school">
                            <div v-if="form.asal_nf == 0">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nama Sekolah</label>
                                    <div class="col-md-5">
                                        <input
                                        v-model="form.asal_sekolah"
                                        type="text"
                                        name="asal_sekolah"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('asal_sekolah') }"
                                        id="asal_sekolah"
                                        placeholder="Nama Asal Sekolah"
                                        >
                                        <has-error :form="form" field="asal_sekolah"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Alamat Asal Sekolah</label>
                                    <div class="col-md-9">
                                        <input
                                        v-model="form.asal_alamat_sekolah"
                                        type="text"
                                        name="asal_alamat_sekolah"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('asal_alamat_sekolah') }"
                                        id="asal_alamat_sekolah"
                                        placeholder="Alamat Asal Sekolah"
                                        >
                                        <has-error :form="form" field="asal_alamat_sekolah"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Provinsi</label>
                                    <div class="col-md-3">
                                        <select v-model="form.asal_propinsi_sekolah" v-on:change="listKotaSekolah($event)" name="asal_propinsi_sekolah" class="form-control" id="asal_propinsi_sekolah">
                                            <option
                                                v-for="prov in provinsi"
                                                :key="prov.id"
                                                v-bind:value="prov.id"
                                            >{{ prov.name }}</option>
                                        </select>
                                        <has-error :form="form" field="asal_propinsi_sekolah"></has-error>
                                    </div>
                                    <label class="col-md-2 offset-md-1 col-form-label">Kabupaten</label>
                                    <div class="col-md-3">
                                        <select v-model="form.asal_kota_sekolah" v-on:change="listCamatSekolah($event)" name="asal_kota_sekolah" class="form-control" id="asal_kota_sekolah">
                                            <option
                                                v-for="kota in kotasekolah"
                                                :key="kota.id"
                                                v-bind:value="kota.id"
                                            >{{ kota.name }}</option>
                                        </select>
                                        <has-error :form="form" field="asal_kota_sekolah"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Kecamatan</label>
                                    <div class="col-md-3">
                                        <select v-model="form.asal_kecamatan_sekolah" v-on:change="listLurahSekolah($event)" name="asal_kecamatan_sekolah" class="form-control" id="asal_kecamatan_sekolah">
                                            <option
                                                v-for="camat in camatsekolah"
                                                :key="camat.id"
                                                v-bind:value="camat.id"
                                            >{{ camat.name }}</option>
                                        </select>
                                        <has-error :form="form" field="asal_kecamatan_sekolah"></has-error>
                                    </div>
                                    <label class="col-md-2 offset-md-1 col-form-label">Kelurahan</label>
                                    <div class="col-md-3">
                                        <select v-model="form.asal_kelurahan_sekolah" name="asal_kelurahan_sekolah" class="form-control" id="asal_kelurahan_sekolah">
                                            <option
                                                v-for="lurah in lurahsekolah"
                                                :key="lurah.id"
                                                v-bind:value="lurah.id"
                                            >{{ lurah.name }}</option>
                                        </select>
                                        <has-error :form="form" field="asal_kelurahan_sekolah"></has-error>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <h2>{{ form.asal_sekolah }}</h2>
                                <p>Alamat Asal Sekolah :</p>
                                <p>{{ form.asal_alamat_sekolah }} Kelurahan Tugu </p>
                                <p>Kec. Cimanggis Kota Depok - Jawa Barat</p>
                            </div>
                        </tab-content>
                        <button type="primary" class="btn btn-warning" slot="prev">Back</button>
                        <button type="primary" class="btn btn-primary" slot="next" v-on:click="cekform()">Next</button>
                        <button type="primary" class="btn btn-success" slot="finish"
                        >Data yang telah Saya isi adalah Benar </button>
                        <div v-if="salahs.length" class="alert alert-danger alert-dismissible">
                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                            <ul>
                                <li v-for="salah in salahs" :key="salah">{{ salah }}</li>
                            </ul>
                        </div>

                    </form-wizard>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { constants } from 'crypto';
    export default {
        data() {
            return {
                stepIndex:0,
                level: false,
                unit: {},
                unit_ck: "",
                minimum_age: "",
                Verror: {},
                agamas: {},
                infos: {},
                provinsi: {},
                kotas: {},
                camats: {},
                lurahs: {},
                kotasekolah: {},
                camatsekolah: {},
                lurahsekolah: {},
                pendidikan: {},
                pekerjaan: {},
                gajis: {},
                kelass: {},
                calon: [],
                salahs: [],
                form: new Form({
                    id: "",
                    nisn: "",
                    nik: "",
                    name: "",
                    panggilan: "",
                    jk: "",
                    kelas_tujuan: "",
                    photo: "",
                    tempat_lahir: "",
                    tgl_lahir: '1980-10-07',
                    agama: "",
                    info: "",
                    status: "",
                    user_id: "",
                    alamat: "",
                    rt: "",
                    rw: "",
                    kodepos: "",
                    provinsi: "",
                    kota: "",
                    kecamatan: "",
                    kelurahan: "",
                    phone: "",
                    ayah_nama: "",
                    ayah_pendidikan: "",
                    ayah_pekerjaan: "",
                    ayah_penghasilan: "",
                    ayah_hp: "",
                    ayah_email: "",
                    ibu_nama: "",
                    ibu_pendidikan: "",
                    ibu_pekerjaan: "",
                    ibu_penghasilan: "",
                    ibu_hp: "",
                    ibu_email: "",
                    asal_nf:"",
                    asal_sekolah: "",
                    asal_alamat_sekolah: "",
                    asal_propinsi_sekolah: "",
                    asal_kota_sekolah: "",
                    asal_kecamatan_sekolah: "",
                    asal_kelurahan_sekolah: "",
                })
            }
        },

        methods: {
            cekform() {
                var aI = this.$refs.wizard.activeTabIndex
                this.salahs = []
                switch(aI) {
                    case 0:
                        if(this.form.kelas_tujuan == ""){this.salahs.push('Kelas Tujuan harus diisi')}
                        if(this.form.name == ""){this.salahs.push('Nama Lengkap Calon Siswa harus diisi')}
                        if(this.form.panggilan == ""){this.salahs.push('Nama Panggilan Calon Siswa harus diisi')}
                        if(this.form.tempat_lahir == ""){this.salahs.push('Tempat Kelahiran Calon Siswa harus diisi')}
                        if(this.form.jk == ""){this.salahs.push('Jenis Kelamin Calon Siswa harus dipilih')}
                        if(this.form.nik == ""){this.salahs.push('Nomor Induk Kependudukan Calon Siswa salah input atau tidak diisi')}
                        if(this.form.info == ""){this.salahs.push('Sumber Info harus dipilih')}
                        if(this.salahs.length) {
                            this.$refs.wizard.changeTab(0,aI-1)
                        } else {
                            this.salahs = []
                            this.$refs.wizard.nextTab
                        }
                        break

                    case 1:
                        if(this.form.alamat == ""){this.salahs.push('Alamat Tempat Tinggal Calon Siswa harus diisi')}
                        if(this.form.provinsi == ""){this.salahs.push('Provinsi harus dipilih')}
                        if(this.form.kota == ""){this.salahs.push('Kota atau Kabupaten harus dipilih')}
                        if(this.form.kecamatan == ""){this.salahs.push('Kecamatan harus dipilih')}
                        if(this.form.kelurahan == ""){this.salahs.push('Kelurahan harus dipilih')}
                        if(this.form.rt == ""){this.salahs.push('No. RT harus diisi')}
                        if(this.form.rw == ""){this.salahs.push('No. RW harus diisi')}
                        if(this.salahs.length) {
                            this.$refs.wizard.changeTab(0,aI-1)
                        } else {
                            this.salahs = []
                            this.$refs.wizard.nextTab
                        }
                        break

                    case 2:
                        if(this.form.ayah_nama == ""){this.salahs.push('Nama Ayah Calon Siswa harus diisi')}
                        if(this.form.ayah_pendidikan == ""){this.salahs.push('Pendidikan Ayah harus dipilih')}
                        if(this.form.ayah_pekerjaan == ""){this.salahs.push('Pekerjaan Ayah harus dipilih')}
                        if(this.form.ayah_penghasilan == ""){this.salahs.push('Penghasilan Ayah harus diisi')}
                        if(this.form.ayah_hp == ""){this.salahs.push('Nomor Ponsel Ayah harus dipilih')}
                        if(this.form.ibu_nama == ""){this.salahs.push('Nama Ibu Calon Siswa harus diisi')}
                        if(this.form.ibu_pendidikan == ""){this.salahs.push('Pendidikan Ibu harus dipilih')}
                        if(this.form.ibu_pekerjaan == ""){this.salahs.push('Pekerjaan Ibu harus dipilih')}
                        if(this.form.ibu_hp == ""){this.salahs.push('Nomor Ponsel Ibu harus dipilih')}
                        if(this.salahs.length) {
                            this.$refs.wizard.changeTab(0,aI-1)
                        } else {
                            this.salahs = []
                            this.$refs.wizard.nextTab
                        }
                        break

                    default:
                        this.salahs = []
                        this.$refs.wizard.nextTab
                }
            },

            listKota(event) {
                axios
                    .get("../api/kota/" + event.target.value)
                    .then(({ data }) => (
                        (this.kotas = data),
                        (this.camats = ""),
                        (this.lurahs = "")
                    ))
            },

            listCamat(event) {
                axios
                    .get("../api/kecamatan/" + event.target.value)
                    .then(({ data }) => (
                        (this.camats = data),
                        (this.lurahs = "")
                    ))
            },

            listLurah(event) {
                axios
                    .get("../api/kelurahan/" + event.target.value)
                    .then(({ data }) => (this.lurahs = data))
            },

            listKotaSekolah(event) {
                axios
                    .get("../api/kota/" + event.target.value)
                    .then(({ data }) => (
                        (this.kotasekolah = data),
                        (this.camatsekolah = ""),
                        (this.lurahsekolah = "")
                    ))
            },

            listCamatSekolah(event) {
                axios
                    .get("../api/kecamatan/" + event.target.value)
                    .then(({ data }) => (
                        (this.camatsekolah = data),
                        (this.lurahsekolah = "")
                    ))
            },

            listLurahSekolah(event) {
                axios
                    .get("../api/kelurahan/" + event.target.value)
                    .then(({ data }) => (this.lurahsekolah = data))
            },

            onComplete: function() {
                this.$Progress.start();
                this.form
                    .put("../api/calons/"+this.form.id)
                    .then(() => {
                        Toast.fire({
                            type: "success",
                            title: "Edit Data Calon Siswa Berhasil"
                        });
                        this.$router.push('../psb')
                        this.$Progress.finish()
                    })
                    .catch((error) => {
                        Swal.fire({ 
                            title: 'Error!',
                            type: 'error',
                            html: '<h3 class="yellow bg-red">'+JSON.stringify(this.form.errors.errors)+'</h3>',
                        })
                        this.$Progress.fail()
                    });
            },

        },

        mounted() {
            var levelnya = this.$route.path
            var pecah = levelnya.split('/')
            if(pecah[1] === 'editcalons'){
                this.level = true
            }

            axios
                .get("../api/calons/"+this.$route.params.id)
                .then(( data ) => {
                    this.form.reset();
                    this.form.fill(data.data.calon)
                    this.kotas = data.data.kota
                    this.camats = data.data.camat
                    this.lurahs = data.data.lurah
                    this.kotasekolah = data.data.kota_sekolah
                    this.camatsekolah = data.data.camat_sekolah
                    this.lurahsekolah = data.data.lurah_sekolah
                    this.$refs.wizard.activateAll()
                    axios
                        .get("../api/gelombangs/" + data.data.calon.gel_id)
                        .then(( gel ) => {
                            this.unit = gel.data.unitnya
                            this.unit_ck = gel.data.unitnya.catnya.name
                            this.minimum_age = gel.data.minimum_age
                            axios
                                .get("../api/kelasnya/" + gel.data.unitnya.id)
                                .then(( kelas ) => {(this.kelass = kelas.data)
                    })

                    })
                })

            axios
                .get("../api/provinsi")
                .then(({ data }) => (this.provinsi = data));

            axios
                .get("../api/agama")
                .then(({ data }) => (this.agamas = data));

            axios
                .get("../api/sumberinfo")
                .then(({ data }) => (this.infos = data));

            axios
                .get("../api/pekerjaan")
                .then(({ data }) => (this.pekerjaan = data));

            axios
                .get("../api/pendidikan")
                .then(({ data }) => (this.pendidikan = data));

            axios
                .get("../api/penghasilan")
                .then(({ data }) => (this.gajis = data));

        }
    }
</script>

<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-2">
            <div class="card card-primary card-outline">
                <div class="card-header bg-primary">
                    <h3 class="card-title">
                        <i class="fas fa-user-edit"></i>
                        Form Pendaftaran Calon Siswa
                    </h3>
                    <div class="card-tools">
                        <router-link to="/psb" type="button" class="btn bg-danger btn-sm">
                            <i class="fas fa-times"></i>
                        </router-link>
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
                        <tab-content title="Form Persetujuan" icon="fas fa-handshake" :start-index="stepIndex">
                            <h5>Form Persetujuan</h5>
                            <div class="card offset-md-1 bg-light p-4 gulung" @scroll="gulungabis">
                                <froalaView v-model="agrees.agreement"></froalaView>
                            </div>
                            <div id="tombol-setuju" class="custom-control offset-md-1 custom-switch">
                                <input type="checkbox" class="custom-control-input" id="setujudonk" v-model="form.setuju">
                                <label class="custom-control-label" for="setujudonk">Saya setuju dengan ketentuan dan syarat yang berlaku</label>
                            </div>
                        </tab-content>
                        <tab-content title="Orang Tua" icon="fas fa-users" class="text-center">
                            <h5>Data Calon Siswa</h5>
                            <a
                                class="btn btn-app btn-lg white"
                                v-for="ck in cks"
                                :key="ck.id"
                                v-bind:class="backgroundnya[ck.id]"
                                v-on:click="pilihAsal(ck.id)">
                                <i v-if="ck.name == 'Umum'" class="fas fa-users"></i>
                                <i v-else-if="ck.name == 'Siswa SIT NF'" class="fas fa-address-card"></i>
                                <img v-else-if="ck.name == 'Pegawai SIT NF'" src="/img/logo.png" alt="Logo" height="70%" width="60%" class="mb-1">
                                <br v-else-if="ck.name == 'Pegawai SIT NF'">
                                {{ ck.name }}
                            </a>
                        </tab-content>
                        <tab-content title="Pilih Unit" icon="fas fa-school" class="text-center">
                            <h5>Pilih Unit</h5>
                            <a
                                class="btn btn-app btn-lg white"
                                v-for="unit in units"
                                :key="unit.id"
                                v-bind:class="unit.catnya.name"
                                v-on:click="pilihUnit(unit.id, unit.catnya.name)">
                                <i class="fas fa-address-card"></i>
                                {{ unit.name }}</a>
                        </tab-content>
                        <tab-content title="Data Pribadi" icon="fas fa-user">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Jenjang Pendidikan</label>
                                    <div class="col-md-4">
                                        <input
                                        type="text"
                                        class="form-control"
                                        disabled="disabled"
                                        :value="unit"
                                        >
                                    </div>
                                    <label class="col-md-2 col-form-label">Kelas Tujuan</label>
                                    <div class="col-md-2">
                                        <select v-model="form.kelas_tujuan" name="kelas_tujuan" class="form-control" id="kelas_tujuan">
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
                                        <input
                                            v-model="form.tgl_lahir"
                                            type="date"
                                            name="tgl_lahir"
                                            v-bind:max="minimum_age"
                                            onkeydown="return false"
                                            class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('tgl_lahir') }"
                                            id="tgl_lahir"
                                        >
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
                                    <label class="col-md-3 col-form-label">No. Telepon/Handphone</label>
                                    <div class="col-md-9">
                                        <input
                                        v-model="form.phone"
                                        type="text"
                                        name="phone"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('phone') }"
                                        id="phone"
                                        placeholder="No. HP"
                                        >
                                        <has-error :form="form" field="phone"></has-error>
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
                                        type="text"
                                        name="rt"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('rt') }"
                                        id="rt"
                                        placeholder="000"
                                        >
                                        <has-error :form="form" field="rt"></has-error>
                                    </div>
                                    <div class="col-md-2">
                                        <input
                                        v-model="form.rw"
                                        type="text"
                                        name="rw"
                                        class="form-control"
                                        :class="{ 'is-invalid':form.errors.has('rw') }"
                                        id="rw"
                                        placeholder="00"
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
                                        placeholder="00000"
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
                                        <select v-model="form.ayah_penghasilan" name="ayah_penghasilan" class="form-control" id="ayah_penghasilan">
                                            <option
                                                v-for="gaji in gajis"
                                                :key="gaji.id"
                                                v-bind:value="gaji.id"
                                            >{{ gaji.name }}</option>
                                        </select>
                                        <has-error :form="form" field="ayah_penghasilan"></has-error>
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
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">No. Handphone</label>
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
                                        <select v-model="form.ibu_penghasilan" name="ibu_penghasilan" class="form-control" id="ibu_penghasilan">
                                            <option
                                                v-for="gaji in gajis"
                                                :key="gaji.id"
                                                v-bind:value="gaji.id"
                                            >{{ gaji.name }}</option>
                                        </select>
                                        <has-error :form="form" field="ibu_penghasilan"></has-error>
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
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">No. Handphone</label>
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
                                </div>
                                </div>
                            </div>
                        </tab-content>
                        <tab-content title="Data Asal Sekolah" icon="fas fa-school">
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
                        </tab-content>
                        <tab-content title="Terima Kasih" icon="fas fa-thumbs-up">
                            <div
                                v-if="Object.keys(Verror).length > 0"
                                class="alert alert-danger" role="alert">
                                <ol>
                                    <li v-for="(pesan, index) in Verror"
                                        :key="index"
                                    >
                                        {{ pesan[0][0] }} --> {{ pesan[0][1] }}
                                    </li>
                                </ol>
                            </div>
                        </tab-content>
                        <hr>
                        <button type="primary" class="btn btn-warning" slot="prev" v-on:click="cekback_aktif()">Back</button>
                        <button type="primary" class="btn btn-primary" slot="next"
                            v-bind:style="ygaktif == true && form.setuju == true ? 'display:block' : 'display:none'"
                            v-on:click="cektmbl_aktif()"
                        >Next</button>
                        <button type="primary" class="btn btn-success" slot="finish">Data yang telah Saya isi adalah Benar </button>
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
                ygaktif: true,
                ceknya: "",
                unit: "",
                unit_ck: "",
                minimum_age: "",
                Verror: {},
                agrees: {},
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
                backgroundnya: [
                    'bg-red',
                    'bg-blue',
                    'bg-orange',
                    'bg-teal'
                ],
                units: {},
                cks: {},
                kelass: {},
                siswanfs: [],
                form: new Form({
                    gel_id: "",
                    ck_id: "",
                    tgl_daftar: "",
                    nisn: "",
                    nik: "",
                    name: "",
                    panggilan: "",
                    jk: "",
                    kelas_tujuan: "",
                    photo: "",
                    tempat_lahir: "",
                    tgl_lahir: "",
                    agama: 1,
                    info: "",
                    status: "",
                    setuju: false,
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
                    asal_nf: 0,
                    pindahan: 0,
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
            gulungabis ({ target: { scrollTop, clientHeight, scrollHeight }}) {
                if (scrollTop + clientHeight >= scrollHeight) {
                    document.getElementById('tombol-setuju').style.display='block'
                }
            },

            cekback_aktif() {
                if (this.$refs.wizard.activeTabIndex == 2 || this.$refs.wizard.activeTabIndex == 3) {
                    this.ygaktif = false
                } else {
                    this.ygaktif = true
                }

            },

            cektmbl_aktif() {
                if (this.$refs.wizard.activeTabIndex == 0 || this.$refs.wizard.activeTabIndex == 1) {
                    this.ygaktif = false
                } else {
                    this.ygaktif = true
                }
            },

            pilihAsal($asal) {
                this.form.ck_id = $asal
                if ($asal == 2) {
                    this.form.asal_nf == 1
                } else {
                    this.form.asal_nf == 0
                }
                this.$refs.wizard.changeTab(0,2)
            },

            pilihUnit($unit) {
                this.form
                    .get("../api/gelombangs/" + $unit)
                    .then((data) => {
                        this.unit = data['data']['unitnya']['name']
                        this.unit_ck = data['data']['unitnya']['catnya']['name']
                        this.form.gel_id = data['data']['id']
                        this.minimum_age = data['data']['minimum_age']
                        axios
                            .get("../api/kelasnya/" + $unit)
                            .then(({ data }) => (this.kelass = data))
                        this.ygaktif = true
                        this.$refs.wizard.changeTab(0,3)
                    })
                    .catch(() => {
                        Swal.fire(
                            "PENDAFTARAN!",
                            "Sudah Tutup atau Belum Ada",
                            "danger"
                        );
                        this.$refs.wizard.changeTab(0,1)
                    });
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
                    .post("../api/calons")
                    .then(() => {
                        Toast.fire({
                            type: "success",
                            title: "Tambah Data Unit Berhasil"
                        });
                        this.$router.push('psb')
                        this.$Progress.finish()
                    })
                    .catch((error) => {
                        this.Verror = this.form.errors.errors;
                        this.$Progress.fail()
                    });
            },

        },

        mounted() {
            axios
                .get("../api/agreements")
                .then(({ data }) => (this.agrees = data));

            axios
                .get("../api/units")
                .then(({ data }) => (this.units = data));

            axios
                .get("../api/cks")
                .then(({ data }) => (this.cks = data));

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

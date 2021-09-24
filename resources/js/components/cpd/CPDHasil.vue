<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 v-if="$route.params.id === '1'" class="card-title">Daftar Peserta Hasil Tes - Status : Diterima</h3>
                        <h3 v-else-if="$route.params.id === '2'" class="card-title">Daftar Peserta Hasil Tes - Status : Cadangan</h3>
                        <h3 v-else-if="$route.params.id === '3'" class="card-title">Daftar Peserta Hasil Tes - Status : Tidak Diterima</h3>
                        <h3 v-else-if="$route.params.id === '4'" class="card-title">Daftar Peserta Hasil Tes - Status : Mengundurkan Diri</h3>
                        <h3 v-else class="card-title">Daftar Peserta Hasil Tes - Status : - </h3>
                        <div class="card-tools">
                            <a v-if="($route.params.id === '1' || $route.params.id === '2')" class="btn btn-sm btn-danger mr-1 ml-3" @click="addModal">
                                <i class="fas fa-plus"></i> <b>Tambah Data Peserta Undur Diri</b>
                            </a>
                            <div class="input-group input-group-sm mt-1" style="width: 150px;">
                                <input v-model="filters.name.value" type="text" name="search"
                                    class="form-control float-right" placeholder="Cari data ..." />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <v-table :data="calons" :filters="filters" :currentPage.sync="currentPage" :pageSize="7"
                            @totalPagesChanged="totalPages = $event"
                            class="table table-mini table-bordered table-head-fixed table-hover">
                            <thead slot="head">
                                <tr>
                                    <th>No.</th>
                                    <v-th sortKey="unitnya.name">Unit</v-th>
                                    <v-th sortKey="cknya.name">Kategori</v-th>
                                    <v-th sortKey="pendaftaran">No. ID</v-th>
                                    <v-th sortKey="calonnya.name">Nama Lengkap</v-th>
                                    <th>JK</th>
                                    <v-th sortKey="calonnya.tgl_lahir">Tanggal Lahir</v-th>
                                    <v-th sortKey="calonnya.asal_sekolah">Asal Sekolah</v-th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ index+((currentPage-1) * 7)+1 }}</td>
                                    <td class="text-center">{{ row.unitnya.name }}</td>
                                    <td class="text-center">{{ row.calonnya.ck }}</td>
                                    <td class="text-center">{{ row.pendaftaran }}</td>
                                    <td>{{ row.calonnya.name }}</td>
                                    <td class="text-center">{{ (row.calonnya.jk == 1 ? 'L' : 'P') }}</td>
                                    <td>{{ row.calonnya.tempat_lahir }}, {{ row.calonnya.tgl_lahir | Tanggal}}</td>
                                    <td class="text-center">{{ row.calonnya.asal_sekolah }}</td>
                                    <th v-if="row.lulus === 1">Status : Diterima</th>
                                    <th v-else-if="row.lulus === 2">
                                        Status : Cadangan
                                        <a v-if="row.unitnya.school_type !== 'SMA'" @click="updateHasil(row.id+':1:')" class="btn btn-sm btn-success mb-2">Diterima</a>
                                        <a v-if="row.unitnya.school_type === 'SMA'" @click="updateHasil(row.id+':1:JURUSAN IPA')" class="btn btn-sm btn-success">Diterima IPA</a>
                                        <a v-if="row.unitnya.school_type === 'SMA'" @click="updateHasil(row.id+':1:JURUSAN IPS')" class="btn btn-sm btn-info mt-2 mb-2">Diterima IPS</a><br>
                                        <a @click="updateHasil(row.id+':3:')" class="btn btn-sm btn-danger">Tidak Diterima</a>
                                    </th>
                                    <th v-else-if="row.lulus === 3">Status : Tidak Diterima</th>
                                    <th v-else-if="row.lulus === 4">Status : Mengundurkan Diri</th>
                                    <th v-else>
                                        <a v-if="row.unitnya.school_type !== 'SMA'" @click="updateHasil(row.id+':1:')" class="btn btn-sm btn-success mb-2">Diterima</a>
                                        <a v-if="row.unitnya.school_type === 'SMA'" @click="updateHasil(row.id+':1:JURUSAN IPA')" class="btn btn-sm btn-success">Diterima IPA</a>
                                        <a v-if="row.unitnya.school_type === 'SMA'" @click="updateHasil(row.id+':1:JURUSAN IPS')" class="btn btn-sm btn-info mt-2 mb-2">Diterima IPS</a><br>
                                        <a @click="updateHasil(row.id+':2:')" class="btn btn-sm btn-warning mb-2">Cadangan</a><br>
                                        <a @click="updateHasil(row.id+':3:')" class="btn btn-sm btn-danger">Tidak Diterima</a>
                                    </th>
                                </tr>
                            </tbody>
                        </v-table>
                        <smart-pagination :currentPage.sync="currentPage" :totalPages="totalPages" :maxPageLinks="3"
                            :boundaryLinks="true" class="float-right" />
                    </div>
                    <!-- Modal -->
                    <div
                        class="modal fade"
                        id="addModal"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="addModalLabel"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form @submit.prevent="mundur()">
                                <div class="modal-header">
                                    <h5
                                    class="modal-title"
                                    id="addModalLabel"
                                    >Form Pengunduran Diri Peserta PPDB</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">No. Pendaftaran</label>
                                        <div class="col-sm-8">
                                            <input
                                            v-model="form.idpeserta"
                                            type="text"
                                            name="idpeserta"
                                            class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('idpeserta') }"
                                            placeholder="No. Pendaftaran"
                                            >
                                            <has-error :form="form" field="idpeserta"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Alasan</label>
                                        <div class="col-sm-8">
                                            <input
                                            v-model="form.alasan"
                                            type="text"
                                            name="alasan"
                                            class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('alasan') }"
                                            placeholder="Alasan"
                                            >
                                            <has-error :form="form" field="alasan"></has-error>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>/>

<script>
    export default {
        data() {
            return {
                calons: [],
                cks: {},
                filters: {
                    name: {
                        value: "",
                        keys: ["unitnya.name", "pendaftaran", "calonnya.name", "calonnya.tgl_lahir", "calonnya.asal_sekolah"]
                    }
                },
                currentPage: 1,
                totalPages: 0,
                form: new Form({
                    idpeserta: "",
                    alasan: "",
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/calonhasils/" + this.$route.params.id)
                    .then(({ data }) => (this.calons = data));
                this.$Progress.finish();
            },

            addModal() {
                this.form.reset();
                $("#addModal").modal("show");
            },

            updateHasil(id) {
                axios
                .put("../api/calonhasils/" + id)
                .then(() => {
                    $("#addModal").modal("hide");
                    Fire.$emit("listData");
                    Toast.fire({
                        type: "success",
                        title: "Berhasil Update Data Siswa"
                    });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            mundur(idpeserta) {
                this.form
                .post("../api/mundur")
                .then(() => {
                    $("#addModal").modal("hide");
                    Fire.$emit("listData");
                    $("#addModal").modal("show");
                    Toast.fire({
                        type: "success",
                        title: "Berhasil Update Data Siswa"
                    });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            }
        },

        created() {
            this.listData();
            Fire.$on("listData", () => {
                this.listData();
            });
        },

    };

</script>

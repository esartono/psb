<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Peserta ALL</h3>
                        <div class="card-tools">
                            <a :href="/EksportCpd/+filters.jadwal.value.jdl" class="btn btn-sm btn-warning mr-2 ml-2">
                                <i class="fas fa-file-excel"></i>
                                Export
                            </a>
                            <a :href="/EksportPsikotes/+filters.jadwal.value.jdl" class="btn btn-sm btn-warning mr-2 ml-2">
                                <i class="fas fa-file-excel"></i>
                                Export untuk Psikotes
                            </a>
                            <div class="input-group input-group-sm float-right ml-3" style="width: auto;">
                                <div class="input-group-prepend" style="margin-right: -46px;">
                                    <span class="input-group-text">Pilih Jadwal Tes :</span>
                                </div>
                                <select class="ml-5" v-model="filters.jadwal.value.jdl">
                                    <option v-for="jadwal in jadwals" :key="jadwal.id"
                                        v-bind:value="jadwal.id">{{ jadwal.seleksi | Tanggal }} - {{ jadwal.gelnya.unitnya.catnya.name }}</option>
                                </select>
                            </div>
                            <div class="input-group input-group-sm float-right" style="width: 150px;">
                                <input v-model="filters.name.value" type="text" name="search"
                                    class="form-control" placeholder="Cari data ..." />
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
                                    <v-th sortKey="gelnya.unitnya.name">Unit</v-th>
                                    <v-th sortKey="calonnya.cknya.name">Kategori</v-th>
                                    <v-th sortKey="calonnya.urut">No. ID</v-th>
                                    <v-th sortKey="calonnya.name">Nama Lengkap</v-th>
                                    <v-th sortKey="calonnya.asal_sekolah">Asal Sekolah</v-th>
                                    <v-th sortKey="jadwalnya.seleksi">Jadwal Tes</v-th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ index+((currentPage-1) * 7)+1 }}</td>
                                    <td class="text-center">{{ row.calonnya.unitnya }}</td>
                                    <td class="text-center">{{ row.calonnya.ck }}</td>
                                    <td class="text-center">{{ row.calonnya.uruts }}</td>
                                    <td>{{ row.calonnya.name }}</td>
                                    <td class="text-center">{{ row.calonnya.asal_sekolah }}</td>
                                    <td class="text-center">{{ row.jadwalnya.seleksi | Tanggal }}</td>
                                    <td class="text-center aksi" style="width: 100px !important">
                                        <a href="#" @click="editModal(row)">
                                            <i class="fas fa-edit blue"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </v-table>
                        <smart-pagination :currentPage.sync="currentPage" :totalPages="totalPages" :maxPageLinks="3"
                            :boundaryLinks="true" class="float-right" />
                    </div>
                </div>
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
                        <form @submit.prevent="updateData()">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Form Edit Jadwal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input v-model="form.id" type="hidden">
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">No. Pendaftaran :</label>
                                <div class="col-sm-7">
                                    <input
                                    v-model="form.calonnya.uruts"
                                    type="text"
                                    class="form-control"
                                    disabled
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Nama Calon Siswa :</label>
                                <div class="col-sm-7">
                                    <input
                                    v-model="form.calonnya.name"
                                    type="text"
                                    class="form-control"
                                    disabled
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Jadwal :</label>
                                <div class="col-sm-7">
                                    <select class="form-control" v-model="form.jadwal_id">
                                        <option v-for="jadwal in jadwals" :key="jadwal.id"
                                            v-bind:value="jadwal.id">{{ jadwal.seleksi | Tanggal }} - {{ jadwal.gelnya.unitnya.catnya.name }}</option>
                                    </select>
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
</template>/>

<script>
    export default {
        data() {
            return {
                calons: [],
                jadwals: {},
                filters: {
                    name: {
                        value: "",
                        keys: ["calonnya.gelnya.unitnya.name", "calonnya.cknya.name", "calonnya.uruts", "calonnya.name", "calonnya.asal_sekolah"]
                    },
                    jadwal: {
                        value: { jdl: 0},
                        custom: this.jadwalFilter
                    }
                },
                currentPage: 1,
                totalPages: 0,
                form: new Form({
                    id: "",
                    calonnya: {
                        uruts: "",
                        name: "",
                    },
                    jadwal_id: ""
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/calonjadwals")
                    .then(({ data }) => (this.calons = data.calons));
                axios.get("../api/jadwals")
                    .then(({ data }) => (this.jadwals = data));
                this.$Progress.finish();
            },

            jadwalFilter(pj, row) {
                if (pj.jdl == 0) {
                    return row.jadwal_id > 0
                }
                return row.jadwal_id == pj.jdl
            },

            editModal(jadwal) {
                this.editmode = true;
                this.form.reset();
                $("#addModal").modal("show");
                this.form.fill(jadwal);
            },

            updateData() {
                this.$Progress.start();
                this.form
                    .put("../api/calonjadwals/" + this.form.id)
                    .then(() => {
                    $("#addModal").modal("hide");
                    Fire.$emit("listData");
                    Toast.fire({
                        type: "success",
                        title: "Berhasil Update Data User"
                    });
                    this.$Progress.finish();
                    })
                    .catch(() => {
                    this.$Progress.fail();
                    });
            },
        },

        created() {
            this.listData();
            Fire.$on("listData", () => {
                this.listData();
            });
        },

    };

</script>

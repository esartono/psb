<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Biaya Pendidikan SIT Nurul Fikri</h3>

                        <div class="card-tools">
                            <a class="btn btn-sm btn-danger" @click="addModal">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                            <div class="input-group input-group-sm mt-1 mr-3" style="width: 150px;">
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
                        <v-table :data="tagihanpsbs" :filters="filters" :currentPage.sync="currentPage" :pageSize="7"
                            @totalPagesChanged="totalPages = $event"
                            class="table table-bordered table-hover table-head-fixed">
                            <thead slot="head">
                                <th>No.</th>
                                <th>Tahun Pelajaran</th>
                                <v-th sortKey="gel_id">Gelombang</v-th>
                                <v-th sortKey="gelnya.unitnya.name">Unit</v-th>
                                <v-th sortKey="kelasnya.name">Kelas</v-th>
                                <v-th sortKey="kelamin">Kelamin</v-th>
                                <th>Biaya PPDB</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <th>{{ index+((currentPage-1) * 4)+1 }}</th>
                                    <td class="text-center">{{ row.gelnya.tpnya.name }}</td>
                                    <td class="text-center">{{ row.gelnya.name }}</td>
                                    <td class="text-center" width="150px">{{ row.gelnya.unitnya.name }}</td>
                                    <td class="text-center">{{ row.kelasnya.name }}</td>
                                    <td class="text-center">{{ (row.kelamin == 1 ? 'Laki-laki' : 'Perempuan') }}</td>
                                    <td class="text-center">{{ row.total[1] | toCurrency }}</td>
                                    <td class="text-center aksi">
                                        <a href="#" @click="editModal(row)">
                                            <i class="fas fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteData(row.id)">
                                            <i class="fas fa-trash red"></i>
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
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form @submit.prevent="editmode ? updateData() : createData()">
                            <div class="modal-header">
                                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Tambah Data Biaya Pendidikan</h5>
                                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Data Biaya Pendidikan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-group">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label">Biaya Pendidikan</label>
                                                <div class="col-md-7">
                                                    <select v-model="form.gel_id" @change="pilihUnit($event)" name="gel_id" class="form-control" id="gel_id" required>
                                                        <option v-for="gel in gelombangs" :key="gel.id" v-bind:value="gel.id">{{ gel.unitnya.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label">Kelas</label>
                                                <div class="col-md-7">
                                                    <select v-model="form.kelas" @change="pilihKelas($event)" name="kelas" class="form-control" id="kelas" required>
                                                        <option v-for="k in kelass" :key="k.id" v-bind:value="k.id">{{ k.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label">Kelamin</label>
                                                <div class="col-md-7">
                                                    <select v-model="form.kelamin" name="kelamin" class="form-control" id="kelamin" required>
                                                        <option value=1>Laki-Laki</option>
                                                        <option value=2>Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <table width="100%">
                                                <tr v-for="b in biaya" :key="b.id">
                                                    <td width="60%"><label class="col-form-label">{{ b.name }}</label></td>
                                                    <td><input v-model="form.biaya1[b.name]" type="number" name="biaya1[b.name]" class="form-control" style="text-align: right" id="biaya" min=0/ step="500" required></td>
                                                </tr>
                                            </table>
                                        </div>
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
</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                gelombangs: {},
                kelass: {},
                tagihanpsbs: [],
                biaya: [
                    {
                        'id': 0,
                        'name': 'Dana Pengembangan',
                    },
                    {
                        'id': 1,
                        'name': 'Dana Pendidikan',
                    },
                    {
                        'id': 2,
                        'name': 'Iuran Komite Sekolah / tahun',
                    },
                    {
                        'id': 3,
                        'name': 'Seragam'
                    },
                ],
                filters: {
                    name: {
                        value: "",
                        keys: ["gel_id"]
                    }
                },
                currentPage: 1,
                totalPages: 0,
                form: new Form({
                    id: "",
                    gel_id: 0,
                    kelas: 0,
                    kelamin: "",
                    biaya1: {},
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/tagihanpsbs").then(({
                    data
                }) => (this.tagihanpsbs = data));
                this.$Progress.finish();
            },

            pilihUnit(event) {
                axios
                    .get("../api/kelasnya/" + event.target.value)
                    .then(({ data }) => (this.kelass = data))
            },

            addModal() {
                this.editmode = false;
                this.form.reset();
                $("#addModal").modal("show");
            },

            createData() {
                this.$Progress.start();
                this.form
                    .post("../api/tagihanpsbs")
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Tambah Data Biaya PPDB Berhasil"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            editModal(tagihanpsb) {
                axios
                    .get("../api/kelasnya/" + tagihanpsb.gel_id)
                    .then(({ data }) => (this.kelass = data))

                this.editmode = true;
                this.form.reset();
                $("#addModal").modal("show");
                this.form.fill(tagihanpsb);
            },

            updateData() {
                this.$Progress.start();
                this.form
                    .put("../api/tagihanpsbs/" + this.form.id)
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Berhasil Update Data Biaya PPDB"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            deleteData(id) {
                Swal.fire({
                    title: "Delete Data Biaya PPDB",
                    text: "Apakah anda yakin ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "red",
                    cancelButtonColor: "green",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal"
                }).then(result => {
                    if (result.value) {
                        this.form
                            .delete("../api/tagihanpsbs/" + id)
                            .then(() => {
                                Swal.fire("Berhasil!", "Data Biaya Tes telah di hapus.", "success");
                                Fire.$emit("listData");
                            })
                            .catch(() => {
                                Swal.fire(
                                    "gagal!",
                                    "Ada yang salah, hubungi Developer",
                                    "warning"
                                );
                            });
                    }
                });
            },

            modalOnHidden() {
                this.form.reset();
            }
        },

        created() {
            this.listData();
            Fire.$on("listData", () => {
                this.listData();
            });
        },

        mounted() {
            axios
                .get("../api/gelombangs")
                .then(({ data }) => (this.gelombangs = data));

            $("#addModal").on("hidden.bs.modal", this.modalOnHidden);
        }
    };

</script>

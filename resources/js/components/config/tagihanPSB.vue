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
                            <div class="input-group input-group-sm" style="width: 150px;">
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
                        <v-table :data="tagihanpsbs" :filters="filters" :currentPage.sync="currentPage" :pageSize="4"
                            @totalPagesChanged="totalPages = $event"
                            class="table table-bordered table-hover table-head-fixed">
                            <thead slot="head">
                                <th>No.</th>
                                <th>Tahun Pelajaran</th>
                                <v-th sortKey="gel_id">Gelombang</v-th>
                                <v-th sortKey="gelnya.unitnya.name">Unit</v-th>
                                <v-th sortKey="kelasnya.name">Kelas</v-th>
                                <v-th sortKey="kelamin">Kelamin</v-th>
                                <th>Biaya PSB</th>
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
                                    <td class="text-center">
                                        Reguler 1 : {{ row.total[1] | toCurrency }}<br>
                                        Reguler 2 : {{ row.total[2] | toCurrency }}<br>
                                        Reguler 3 : {{ row.total[3] | toCurrency }}
                                    </td>
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
                                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Tambah Data Gelombang</h5>
                                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Data Gelombang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Gelombang</label>
                                    <div class="col-md-3">
                                        <select v-model="form.gel_id" @change="pilihUnit($event)" name="gel_id" class="form-control" id="gel_id" required>
                                            <option v-for="gel in gelombangs" :key="gel.id" v-bind:value="gel.id">{{ gel.unitnya.name }}</option>
                                        </select>
                                    </div>
                                    <label class="col-md-1 col-form-label">Kelas</label>
                                    <div class="col-md-2">
                                        <select v-model="form.kelas" name="kelas" class="form-control" id="kelas" required>
                                            <option v-for="k in kelass" :key="k.id" v-bind:value="k.id">{{ k.name }}</option>
                                        </select>
                                    </div>
                                    <label class="col-md-2 col-form-label">Kelamin</label>
                                    <div class="col-md-2">
                                        <select v-model="form.kelamin" name="kelamin" class="form-control" id="kelamin" required>
                                            <option value=1>Laki-Laki</option>
                                            <option value=2>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <table width="100%">
                                    <tr>
                                        <th width="34%"></th>
                                        <th width="22%">Reguler 1</th>
                                        <th width="22%">Reguler 2</th>
                                        <th width="22%">Reguler 3</th>
                                    </tr>
                                    <tr v-for="b in biaya" :key="b.id">
                                        <td><label class="col-form-label">{{ b.name }}</label></td>
                                        <td><input v-model="form.biaya1[b.name]" type="number" name="biaya1[b.name]" class="form-control" id="biaya" min=0/ step="500" required></td>
                                        <td><input v-model="form.biaya2[b.name]" type="number" name="biaya2[b.name]" class="form-control" id="biaya" min=0/ step="500" required></td>
                                        <td><input v-model="form.biaya3[b.name]" type="number" name="biaya3[b.name]" class="form-control" id="biaya" min=0/ step="500" required></td>
                                    </tr>
                                </table>
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
                        'name': 'Iuran SPP Bulan Juli',
                    },
                    {
                        'id': 3,
                        'name': 'Iuran Komite Sekolah / tahun',
                    },
                    {
                        'id': 4,
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
                    biaya2: {},
                    biaya3: {}
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
                            title: "Tambah Data Biaya PSB Berhasil"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            editModal(tagihanpsb) {
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
                            title: "Berhasil Update Data Biaya PSB"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            deleteData(id) {
                Swal.fire({
                    title: "Delete Data Biaya PSB",
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

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Gelombang</h3>

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
                        <v-table :data="gelombangs" :filters="filters" :currentPage.sync="currentPage" :pageSize="7"
                            @totalPagesChanged="totalPages = $event"
                            class="table table-bordered table-hover table-head-fixed">
                            <thead slot="head">
                                <th>No.</th>
                                <v-th sortKey="name">Gelombang</v-th>
                                <th>Tahun Pelajaran</th>
                                <th>Unit</th>
                                <th>Maksimal Kelahiran</th>
                                <th>Kuota</th>
                                <th>Kuota Inklusi</th>
                                <th>Kode Registrasi</th>
                                <th>Mulai</th>
                                <th>Akhir</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <th>{{ index+((currentPage-1) * 7)+1 }}</th>
                                    <td class="text-center">{{ row.name }}</td>
                                    <td class="text-center">{{ row.tpnya.name }}</td>
                                    <td class="text-center" width="150px">{{ row.unitnya.name }}</td>
                                    <td class="text-center">{{ row.minimum_age | Tanggal }}</td>
                                    <td class="text-center">{{ row.kuota }}</td>
                                    <td class="text-center">{{ row.kuota_inklusi }}</td>
                                    <td class="text-center">{{ row.kode_va }}</td>
                                    <td class="text-center">{{ row.start }}</td>
                                    <td class="text-center">{{ row.end }}</td>
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
                <div class="modal-dialog" role="document">
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
                                    <label class="col-sm-4 col-form-label">Gelombang</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.name" type="text" name="name" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('name') }" id="name"
                                            placeholder="Gelombang" />
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Tahun Pelajaran</label>
                                    <div class="col-sm-8">
                                        <select v-model="form.tp" name="tp" class="form-control" id="tp">
                                            <option v-for="tp in tps" :key="tp.id"
                                                v-bind:value="tp.id">{{ tp.name }}</option>
                                        </select>
                                        <has-error :form="form" field="tp"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Unit</label>
                                    <div class="col-sm-8">
                                        <select v-model="form.unit_id" name="unit_id" class="form-control" id="unit_id">
                                            <option v-for="unit in units" :key="unit.id"
                                                v-bind:value="unit.id">{{ unit.name }}</option>
                                        </select>
                                        <has-error :form="form" field="unit_id"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Minimal Kelahiran</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.minimum_age" type="date" name="minimum_age" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('minimum_age') }" id="minimum_age" />
                                        <has-error :form="form" field="minimum_age"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Kuota</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.kuota" type="number" name="kuota" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('kuota') }" id="kuota"
                                            min=0 />
                                        <has-error :form="form" field="kuota"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Kuota Inklusi</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.kuota_inklusi" type="number" name="kuota_inklusi" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('kuota_inklusi') }" id="kuota_inklusi"
                                            min=0 />
                                        <has-error :form="form" field="kuota_inklusi"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Kode Registrasi</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.kode_va" type="text" name="kode_va" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('kode_va') }" id="kode_va"
                                            />
                                        <has-error :form="form" field="kode_va"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Tanggal Mulai</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.start" type="date" name="start" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('start') }" id="start"
                                            />
                                        <has-error :form="form" field="start"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Tanggal Berakhir</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.end" type="date" name="end" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('end') }" id="end"
                                            />
                                        <has-error :form="form" field="end"></has-error>
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
                tps: {},
                units: {},
                gelombangs: [],
                filters: {
                    name: {
                        value: "",
                        keys: ["name"]
                    }
                },
                currentPage: 1,
                totalPages: 0,
                form: new Form({
                    id: "",
                    name: "",
                    tp: 1,
                    unit_id: 1,
                    minimum_age: "",
                    kuota: 0,
                    kuota_inklusi: 0,
                    kode_va: "",
                    kode_unit: "",
                    start: "",
                    end: ""
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/gelombangs").then(({
                    data
                }) => (this.gelombangs = data));
                this.$Progress.finish();
            },

            addModal() {
                this.editmode = false;
                this.form.reset();
                $("#addModal").modal("show");
            },

            createData() {
                this.$Progress.start();
                this.form
                    .post("../api/gelombangs")
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Tambah Data Gelombang Berhasil"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            editModal(gelombang) {
                this.editmode = true;
                this.form.reset();
                $("#addModal").modal("show");
                this.form.fill(gelombang);
            },

            updateData() {
                this.$Progress.start();
                this.form
                    .put("../api/gelombangs/" + this.form.id)
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Berhasil Update Data Gelombang"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            deleteData(id) {
                Swal.fire({
                    title: "Delete Data Gelombang",
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
                            .delete("../api/gelombangs/" + id)
                            .then(() => {
                                Swal.fire("Berhasil!", "Data Gelombang telah di hapus.", "success");
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
                .get("../api/units")
                .then(({ data }) => (this.units = data));

            axios
                .get("../api/tps")
                .then(({ data }) => (this.tps = data));

            $("#addModal").on("hidden.bs.modal", this.modalOnHidden);
        }
    };

</script>

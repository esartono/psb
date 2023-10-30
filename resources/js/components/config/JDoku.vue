<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Jenis Dokumen</h3>

                        <div class="card-tools">
                            <a class="btn btn-sm btn-danger" @click="addModal">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                            <div class="mt-1 input-group input-group-sm" style="width: 150px;">
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
                        <v-table :data="jdokus" :filters="filters" :currentPage.sync="currentPage" :pageSize="7"
                            @totalPagesChanged="totalPages = $event"
                            class="table table-bordered table-hover table-head-fixed">
                            <thead slot="head">
                                <th>No.</th>
                                <v-th sortKey="code">Kode</v-th>
                                <v-th sortKey="name">Nama</v-th>
                                <th>Unit</th>
                                <th>Dokumen Khusus</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <th>{{ index+((currentPage-1) * 7)+1 }}</th>
                                    <td class="text-center">{{ row.code }}</td>
                                    <td class="text-center">{{ row.name }}</td>
                                    <td class="text-center">{{ row.unit }}</td>
                                    <td class="text-center">{{ row.khusus }}</td>
                                    <td class="text-center">
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
                                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Tambah Kategori</h5>
                                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Kategori</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Kode Dokumen</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.code" type="text" name="code" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('code') }" id="code"
                                            placeholder="Kode Dokumen" />
                                        <has-error :form="form" field="code"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Nama Dokumen</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.name" type="text" name="name" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('name') }" id="name"
                                            placeholder="Nama Dokumen" />
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Unit</label>
                                    <div class="col-sm-8">
                                        <select v-model="form.unit" name="unit" class="form-control" id="unit" multiple="true">
                                            <option v-for="unit in units" :key="unit.id"
                                                v-bind:value="unit.name">{{ unit.name }}</option>
                                        </select>
                                        <has-error :form="form" field="unit"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Calon Kategori</label>
                                    <div class="col-sm-8">
                                        <select v-model="form.khusus" name="khusus" class="form-control" id="khusus" multiple="true">
                                            <option v-for="cats in category" :key="cats.id"
                                                v-bind:value="cats.name">{{ cats.name }}</option>
                                        </select>
                                        <has-error :form="form" field="khusus"></has-error>
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
                units: {},
                category: {},
                jdokus: [],
                filters: {
                    name: {
                        value: "",
                        keys: ["name", "code"]
                    }
                },
                currentPage: 1,
                totalPages: 0,
                form: new Form({
                    id: "",
                    code: "",
                    name: "",
                    unit: [],
                    khusus: []
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/jdokus").then(({
                    data
                }) => (this.jdokus = data));
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
                    .post("../api/jdokus")
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Tambah Data Berhasil"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            editModal(jdoku) {
                this.editmode = true;
                this.form.reset();
                $("#addModal").modal("show");
                this.form.fill(jdoku);
                this.form.unit = jdoku.unit.split(",");
                this.form.khusus = jdoku.khusus.split(",");
            },

            updateData() {
                this.$Progress.start();
                this.form
                    .put("../api/jdokus/" + this.form.id)
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Berhasil Update Data"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            deleteData(id) {
                Swal.fire({
                    title: "Delete Data",
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
                            .delete("../api/jdokus/" + id)
                            .then(() => {
                                Swal.fire("Berhasil!", "Data telah di hapus.", "success");
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
                .get("../api/schoolcategories")
                .then(({ data }) => (this.units = data));
            axios
                .get("../api/cks")
                .then(({ data }) => (this.category = data));
            $("#addModal").on("hidden.bs.modal", this.modalOnHidden);
        }
    };

</script>

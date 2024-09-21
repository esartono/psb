<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Instrumen Wawancara</h3>
                        <div class="card-tools">
                            <a class="btn btn-sm btn-danger" @click="addModal">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <v-table :data="datas" :filters="filters" :currentPage.sync="currentPage" :pageSize="7"
                            @totalPagesChanged="totalPages = $event"
                            class="table table-bordered table-hover table-head-fixed">
                            <thead slot="head">
                                <th>No.</th>
                                <v-th sortKey="unitnya.name">Unit</v-th>
                                <v-th sortKey="instrumen">Instrumen Wawancara</v-th>
                                <v-th sortKey="singkatan">Singkatan</v-th>
                                <th>Aksi</th>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <th>{{ index+((currentPage-1) * 7)+1 }}</th>
                                    <td style="text-align: center;">{{ row.unit_id }}</td>
                                    <td>{{ row.instrumen }}</td>
                                    <td style="text-align: center;">{{ row.singkatan }}</td>
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
                                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Tambah Instrumen Wawancara</h5>
                                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Instrumen Wawancara</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Unit :</label>
                                    <div class="col-sm-8">
                                        <select multiple v-model="form.unit_id" name="unit_id" class="form-control" id="unit_id" required>
                                            <option v-for="unit in units" :key="unit.id"
                                                v-bind:value="unit.id">{{ unit.name }}</option>
                                        </select>
                                        <has-error :form="form" field="unit_id"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Nama Instrumen Wawancara :</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.instrumen" type="text" name="instrumen" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('instrumen') }" id="instrumen"/>
                                        <has-error :form="form" field="instrumen"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Singkatan :</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.singkatan" type="text" name="singkatan" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('singkatan') }" id="singkatan"/>
                                        <has-error :form="form" field="singkatan"></has-error>
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
                datas: [],
                units: [],
                filters: {
                    name: {
                        value: "",
                        keys: []
                    }
                },
                currentPage: 1,
                totalPages: 0,
                form: new Form({
                    id: "",
                    instrumen: "",
                    singkatan: "",
                    unit_id: []
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/instrumens").then(({data}) => (this.datas = data));
                axios.get("../api/units").then(({ data }) => (this.units = data));
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
                    .post("../api/instrumens")
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Tambah Instrumen Wawancara Berhasil"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            editModal(data) {
                this.editmode = true;
                this.form.reset();
                $("#addModal").modal("show");
                this.form.fill(data);
            },

            updateData() {
                this.$Progress.start();
                this.form
                    .put("../api/instrumens/" + this.form.id)
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Berhasil Update Instrumen Wawancara"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            deleteData(id) {
                Swal.fire({
                    title: "Delete Instrumen Wawancara",
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
                            .delete("../api/instrumens/" + id)
                            .then(() => {
                                Swal.fire("Berhasil!", "Instrumen Wawancara telah di hapus.", "success");
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
            $("#addModal").on("hidden.bs.modal", this.modalOnHidden);
        }
    };

</script>

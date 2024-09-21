<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Rubrik Wawancara</h3>
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
                                <v-th sortKey="id_instrumen">Instrumen</v-th>
                                <th>Pertanyaan</th>
                                <th>Rubrik</th>
                                <th>bobot</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <th>{{ index+((currentPage-1) * 7)+1 }}</th>
                                    <td style="text-align: center;">{{ row.id_instrumen }}</td>
                                    <td>{{ row.butir }}</td>
                                    <td>{{ row.rubrik }}</td>
                                    <td>{{ row.bobot }}</td>
                                    <td>{{ row.keterangan }}</td>
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
                                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Tambah Rubrik Wawancara</h5>
                                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Rubrik Wawancara</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Instrumen</label>
                                    <div class="col-sm-8">
                                        <select v-model="form.id_instrumen" name="id_instrumen" class="form-control" id="id_instrumen" required>
                                            <option v-for="i in instrumens" :key="i.id"
                                                v-bind:value="i.id">{{ i.instrumen }}</option>
                                        </select>
                                        <has-error :form="form" field="id_instrumen"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Pertanyaan</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.butir" type="text" name="butir" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('butir') }" id="butir"/>
                                        <has-error :form="form" field="butir"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Bobot</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.bobot" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Rubrik 1</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.rubrik[1]" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Rubrik 2</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.rubrik[2]" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Rubrik 3</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.rubrik[3]" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Rubrik 4</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.rubrik[4]" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Keterangan</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.keterangan" type="text" class="form-control"/>
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
                instrumens: {},
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
                    id_instrumen: "",
                    butir: "",
                    bobot: 0,
                    rubrik: [],
                    keterangan: ""
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/rubriks").then(({data}) => (this.datas = data));
                axios.get("../api/instrumens").then(({ data }) => (this.instrumens = data));
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
                    .post("../api/rubriks")
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Tambah Rubrik Wawancara Berhasil"
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
                    .put("../api/rubriks/" + this.form.id)
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Berhasil Update Rubrik Wawancara"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            deleteData(id) {
                Swal.fire({
                    title: "Delete Rubrik Wawancara",
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
                            .delete("../api/rubriks/" + id)
                            .then(() => {
                                Swal.fire("Berhasil!", "Rubrik Wawancara telah di hapus.", "success");
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

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">List Aspek Perilaku</h3>
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
                                <v-th sortKey="aspek">Aspek</v-th>
                                <v-th sortKey="observasi">Poin Observasi</v-th>
                                <v-th sortKey="keterangan">Keterangan</v-th>
                                <th>Aksi</th>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <th>{{ index+((currentPage-1) * 7)+1 }}</th>
                                    <td style="text-align: center;">{{ row.aspek }}</td>
                                    <td>{{ row.observasi }}</td>
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
                                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Tambah Aspek Perilaku</h5>
                                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Aspek Perilaku</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Aspek :</label>
                                    <div class="col-sm-8">
                                        <select v-model="form.aspek" name="aspek" class="form-control" id="aspek" required>
                                            <option value="Perhatian & Konsentrasi">Perhatian & Konsentrasi</option>
                                            <option value="Aktivitas Motorik & Impulsivitas">Aktivitas Motorik & Impulsivitas</option>
                                            <option value="Komunikasi & Interaksi Sosial">Komunikasi & Interaksi Sosial</option>
                                            <option value="Respon Emosi">Respon Emosi</option>
                                        </select>
                                        <has-error :form="form" field="aspek"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Poin Observasi :</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.observasi" type="text" name="observasi" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('observasi') }" id="observasi" required/>
                                        <has-error :form="form" field="observasi"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Keterangan :</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.keterangan" type="text" name="keterangan" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('keterangan') }" id="keterangan"/>
                                        <has-error :form="form" field="keterangan"></has-error>
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
                filters: {
                    name: {
                        value: "",
                        keys: ["aspek", "observasi"]
                    }
                },
                currentPage: 1,
                totalPages: 0,
                form: new Form({
                    id: "",
                    aspek: [],
                    observasi: "",
                    keterangan: ""
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/aspekperilakus").then(({data}) => (this.datas = data));
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
                    .post("../api/aspekperilakus")
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Tambah Aspek Perilaku Berhasil"
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
                    .put("../api/aspekperilakus/" + this.form.id)
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Berhasil Update Aspek Perilaku"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            deleteData(id) {
                Swal.fire({
                    title: "Delete Aspek Perilaku",
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
                            .delete("../api/aspekperilakus/" + id)
                            .then(() => {
                                Swal.fire("Berhasil!", "Aspek Perilaku telah di hapus.", "success");
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

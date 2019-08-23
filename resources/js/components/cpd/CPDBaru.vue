<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Peserta Baru</h3>
                        <div class="card-tools">
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
                    <div class="card-body table-responsive p-0">
                        <v-table :data="cpdbarus" :filters="filters" :currentPage.sync="currentPage" :pageSize="7"
                            @totalPagesChanged="totalPages = $event"
                            class="table table-bordered table-hover">
                            <thead slot="head">
                                <th>No.</th>
                                <v-th sortKey="gelnya.unitnya.name">Unit</v-th>
                                <v-th sortKey="ck_id">Calon Kategori</v-th>
                                <v-th sortKey="biaya">No. ID</v-th>
                                <v-th sortKey="biaya">Nama Lengkap</v-th>
                                <v-th sortKey="biaya">Tanggal Lahir</v-th>
                                <v-th sortKey="biaya">Asal Sekolah</v-th>
                                <v-th sortKey="biaya">Nama Ayah</v-th>
                                <v-th sortKey="biaya">Nama Ibu</v-th>
                                <v-th sortKey="biaya">Alamat</v-th>
                                <v-th sortKey="biaya">No. Telp</v-th>
                                <th>Aksi</th>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <th>{{ index+((currentPage-1) * 7)+1 }}</th>
                                    <td class="text-center">{{ row.gelnya.tpnya.name }}</td>
                                    <td class="text-center">{{ row.gelnya.name }}</td>
                                    <td class="text-center" width="150px">{{ row.gelnya.unitnya.name }}</td>
                                    <td class="text-center">{{ row.cknya.name }}</td>
                                    <td class="text-center">{{ row.biaya | toCurrency }}</td>
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
                                        <select v-model="form.gel_id" name="gel_id" class="form-control" id="gel_id">
                                            <option v-for="gel in gelombangs" :key="gel.id"
                                                v-bind:value="gel.id">{{ gel.name }} - {{ gel.unitnya.name }}</option>
                                        </select>
                                        <has-error :form="form" field="gel_id"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Calon Kategori</label>
                                    <div class="col-sm-8">
                                        <select v-model="form.ck_id" name="ck_id" class="form-control" id="ck_id">
                                            <option v-for="ck in cks" :key="ck.id"
                                                v-bind:value="ck.id">{{ ck.name }}</option>
                                        </select>
                                        <has-error :form="form" field="ck_id"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Biaya</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.biaya" type="number" name="biaya" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('biaya') }" id="biaya"
                                            min=0/>
                                        <has-error :form="form" field="biaya"></has-error>
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
                editmode: false,
                gelombangs: {},
                cks: {},
                cpdbarus: [],
                filters: {
                    name: {
                        value: "",
                        keys: ["gel_id", "gelnya.unitnya.name", "ck_id", "biaya"]
                    }
                },
                currentPage: 1,
                totalPages: 0,
                form: new Form({
                    id: "",
                    gel_id: 0,
                    ck_id: 0,
                    biaya: 0
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/cpdbarus").then(({
                    data
                }) => (this.cpdbarus = data));
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
                    .post("../api/cpdbarus")
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Tambah Data Biaya Tes Berhasil"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            editModal(cpdbaru) {
                this.editmode = true;
                this.form.reset();
                $("#addModal").modal("show");
                this.form.fill(cpdbaru);
            },

            updateData() {
                this.$Progress.start();
                this.form
                    .put("../api/cpdbarus/" + this.form.id)
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Berhasil Update Data Calon Siswa"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            deleteData(id) {
                Swal.fire({
                    title: "Delete Data Calon Siswa",
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
                            .delete("../api/cpdbarus/" + id)
                            .then(() => {
                                Swal.fire("Berhasil!", "Data Calon Siswa telah di hapus.", "success");
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

            axios
                .get("../api/cks")
                .then(({ data }) => (this.cks = data));

            $("#addModal").on("hidden.bs.modal", this.modalOnHidden);
        }
    };

</script>

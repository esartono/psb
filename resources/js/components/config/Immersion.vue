<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Biaya Program Immersion</h3>

                        <div class="card-tools">
                            <a class="btn btn-sm btn-danger" @click="addModal">
                                <i class="fas fa-plus"></i> Tambah Data
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
                        <v-table :data="immersions" :filters="filters" :currentPage.sync="currentPage" :pageSize="8"
                            @totalPagesChanged="totalPages = $event"
                            class="table table-bordered table-hover table-head-fixed">
                            <thead slot="head">
                                <th>No.</th>
                                <th>Tahun Pelajaran</th>
                                <th>Unit</th>
                                <th>Program</th>
                                <th>Biaya Langsung</th>
                                <th>Biaya Tahunan</th>
                                <th>Biaya Bulanan</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <th>{{ index+((currentPage-1) * 7)+1 }}</th>
                                    <td class="text-center">{{ row.tpnya.name }}</td>
                                    <td class="text-center" width="150px">{{ row.unitnya.name }}</td>
                                    <td>{{ row.name }}</td>
                                    <td class="text-center">{{ row.langsung | toCurrency }}</td>
                                    <td class="text-center">{{ row.tahunan | toCurrency }}</td>
                                    <td class="text-center">{{ row.bulanan | toCurrency }}</td>
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
                                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Tambah Data Biaya Program Immersion</h5>
                                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Data Biaya Program Immersion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
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
                                    <label class="col-sm-4 col-form-label">Nama Program</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.name" type="text" name="name" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('name') }" id="name"/>
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Biaya Langsung</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.langsung" type="number" name="langsung" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('langsung') }" id="langsung"
                                            min=0 />
                                        <has-error :form="form" field="langsung"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Biaya Tahunan</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.tahunan" type="number" name="tahunan" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('tahunan') }" id="tahunan"
                                            min=0 />
                                        <has-error :form="form" field="tahunan"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Biaya Bulanan</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.bulanan" type="number" name="bulanan" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('bulanan') }" id="bulanan"
                                            min=0 />
                                        <has-error :form="form" field="bulanan"></has-error>
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
                immersions: [],
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
                    tp: 0,
                    unit_id: 0,
                    langsung: 0,
                    tahunan: 0,
                    bulanan: 0,
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/immersions").then(({
                    data
                }) => (this.immersions = data));
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
                    .post("../api/immersions")
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Tambah Data Biaya Program Immersion Berhasil"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            editModal(immersions) {
                this.editmode = true;
                this.form.reset();
                $("#addModal").modal("show");
                this.form.fill(immersions);
            },

            updateData() {
                this.$Progress.start();
                this.form
                    .put("../api/immersions/" + this.form.id)
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Berhasil Update Data Biaya Program Immersion"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            deleteData(id) {
                Swal.fire({
                    title: "Delete Data Biaya Program Immersion",
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
                            .delete("../api/spps/" + id)
                            .then(() => {
                                Swal.fire("Berhasil!", "Data Biaya Program Immersion telah di hapus.", "success");
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
                .then(({ data }) => (this.tps = data.slice().reverse()));

            $("#addModal").on("hidden.bs.modal", this.modalOnHidden);
        }
    };

</script>

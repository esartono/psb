<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Surat Pengambilan Buku</h3>
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
                        <v-table :data="calons" :filters="filters" :currentPage.sync="currentPage" :pageSize="7"
                            @totalPagesChanged="totalPages = $event"
                            class="table table-mini table-bordered table-head-fixed table-hover">
                            <thead slot="head">
                                <tr>
                                    <th>No.</th>
                                    <v-th sortKey="unitnya.name">Unit</v-th>
                                    <v-th sortKey="pendaftaran">No. ID</v-th>
                                    <v-th sortKey="calonnya.name">Nama Lengkap</v-th>
                                    <v-th sortKey="lunas_daul">Lunas</v-th>
                                    <v-th sortKey="siap">SIAP</v-th>
                                    <th>Tanggal & Jam</th>
                                    <th>Chromebook</th>
                                    <th>Aksi</th>
                                    <th>Print</th>
                                </tr>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ index+((currentPage-1) * 7)+1 }}</td>
                                    <td class="text-center">{{ row.unitnya.name }}</td>
                                    <td class="text-center">{{ row.pendaftaran }}</td>
                                    <td>{{ row.calonnya.name }}</td>
                                    <td class="text-center">{{ row.lunas_daul }}</td>
                                    <td>{{ row.siap }}</td>
                                    <td>{{ (row.hari == '' ? 'belum' : row.hari + ', ' + row.tanggal + ' (' + row.jam + ')') }}</td>
                                    <td>{{ (row.chromebook == '' ? '-' : row.chromebook) }}</td>
                                    <td>
                                        <a href="#" @click="editModal(row)"><i class="fas fa-edit blue"></i> Edit</a>
                                    </td>
                                    <td>
                                        <a :href="'AmbilBukuPDF/'+row.calonnya.idc" class="btn btn-success"><i class="fas fa-print"></i>Print</a>
                                    </td>
                                </tr>
                            </tbody>
                        </v-table>
                        <smart-pagination :currentPage.sync="currentPage" :totalPages="totalPages" :maxPageLinks="3"
                            :boundaryLinks="true" class="float-right" />
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form @submit.prevent="editmode ? updateData() : createData()">
                            <div class="modal-header">
                                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Tambah Surat Seragam</h5>
                                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Surat Seragam</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">No. Pendaftaran :</label>
                                    <div class="col-md-8">
                                        <input v-model="form.pendaftaran" type="text" name="pendaftaran" class="form-control" id="pendaftaran"
                                            placeholder="Tulis No. Pendaftaran" :readonly="editmode"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Lunas :</label>
                                    <div class="col-md-8">
                                        <select v-model="form.lunas_daul" name="lunas_daul" class="form-control" id="lunas_daul">
                                            <option v-for="l in lunas" :key="l.id" v-bind:value="l.name">{{ l.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Kesiapan Buku dan Chromebook :</label>
                                    <div class="col-md-8">
                                        <select v-model="form.siap" name="siap" class="form-control" id="siap">
                                            <option v-for="s in siap" :key="s.id" v-bind:value="s.id">{{ s.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Hari :</label>
                                    <div class="col-md-8">
                                        <select v-model="form.hari" name="hari" class="form-control" id="hari">
                                            <option v-for="h in hari" :key="h.id" v-bind:value="h.id">{{ h.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Tanggal :</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.tanggal" type="text" name="tanggal" class="form-control" id="tanggal"
                                            placeholder="Tulis tanggalnya" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Jam :</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.jam" type="text" name="jam" class="form-control" id="jam"
                                            placeholder="Tulis Jamnya" />
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
                calons: [],
                lunas: [
                        { id: "Lunas", name: "Lunas" },
                        { id: "Belum Lunas", name: "Belum Lunas" },
                    ],
                siap: [
                        { id: "SIAP", name: "SIAP" },
                        { id: "BELUM", name: "BELUM" },
                    ],
                hari: [
                        { id: "Senin", name: "Senin" },
                        { id: "Selasa", name: "Selasa" },
                        { id: "Rabu", name: "Rabu" },
                        { id: "Kamis", name: "Kamis" },
                        { id: "Jumat", name: "Jumat" },
                        { id: "Sabtu", name: "Sabtu" },
                        { id: "Minggu", name: "Minggu" },
                    ],
                filters: {
                    name: {
                        value: "",
                        keys: ["unitnya.name", "pendaftaran", "calonnya.name", "lunas_daul", "siap"]
                    },
                },
                currentPage: 1,
                totalPages: 0,
                form: new Form({
                    id: "",
                    pendaftaran: "",
                    lunas_daul: "",
                    siap: "",
                    hari: "",
                    tanggal: "",
                    jam: ""
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/suratbuku")
                    .then(({ data }) => (this.calons = data));
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
                    .post("../api/suratbuku")
                    .then(function (e) {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        if(e.data == 'ERROR'){
                            Toast.fire({
                                type: "error",
                                title: "Data Sudah di Input, Gunakan Fasilitas EDIT"
                            });
                        } else {
                            Toast.fire({
                                type: "success",
                                title: "Tambah Data Surat Buku berhasil"
                            });
                        }
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            updateData() {
                this.$Progress.start();
                this.form
                    .put("../api/suratbuku/" + this.form.id)
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                        type: "success",
                        title: "Data Surat Pengambilan Buku"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            editModal(suratbuku) {
                this.editmode = true;
                this.form.reset();
                $("#addModal").modal("show");
                this.form.fill(suratbuku);
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

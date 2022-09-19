<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Jadwal Tes</h3>
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
                        <v-table :data="jadwals" :filters="filters" :currentPage.sync="currentPage" :pageSize="7"
                            @totalPagesChanged="totalPages = $event"
                            class="table table-bordered table-hover table-head-fixed">
                            <thead slot="head">
                                <th>No.</th>
                                <th>Tahun Pelajaran</th>
                                <v-th sortKey="gel_id">Gelombang</v-th>
                                <v-th sortKey="gelnya.unitnya.name">Unit</v-th>
                                <v-th sortKey="seleksi">Seleksi Offline</v-th>
                                <v-th sortKey="seleksi">Seleksi Online</v-th>
                                <v-th sortKey="seleksi">Pengumuman</v-th>
                                <v-th sortKey="internal">Internal</v-th>
                                <th>Kuota</th>
                                <!-- <th>Keterangan</th> -->
                                <th>Aksi</th>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <th>{{ index+((currentPage-1) * 7)+1 }}</th>
                                    <td class="text-center">{{ row.gelnya.tpnya.name }}</td>
                                    <td class="text-center">{{ row.gelnya.name }}</td>
                                    <td class="text-center" width="150px">{{ row.gelnya.unitnya.name }}</td>
                                    <td class="text-center">{{ row.seleksi | Tanggal }}</td>
                                    <td class="text-center">{{ row.seleksi_online | Tanggal }}</td>
                                    <td class="text-center">{{ row.pengumuman | Tanggal }}</td>
                                    <td class="text-center">{{ row.internal | YaTidak}}</td>
                                    <td class="text-center">{{ row.kuota }}</td>
                                    <!-- <td>
                                        <a class="btn btn-info btn-sm" @click="editZoom(row.id)">
                                            <i class="fas fa-edit blue"></i>
                                            Link Zoom
                                        </a>
                                    </td> -->
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
                                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Tambah Jadwal</h5>
                                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Jadwal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding-top: 0 !important">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Gelombang</label>
                                    <div class="col-sm-8">
                                        <select v-model="form.gel_id" name="gel_id" class="form-control" id="gel_id" required>
                                            <option v-for="gel in gelombangs" :key="gel.id"
                                                v-bind:value="gel.id">{{ gel.name }} - {{ gel.unitnya.name }}</option>
                                        </select>
                                        <has-error :form="form" field="gel_id"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Seleksi Offline</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.seleksi" type="date" name="seleksi" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('seleksi') }" id="seleksi"
                                            required/>
                                        <has-error :form="form" field="seleksi"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Seleksi Online</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.seleksi_online" type="date" name="seleksi_online" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('seleksi_online') }" id="seleksi_online"
                                            />
                                        <has-error :form="form" field="seleksi_online"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Pengumuman</label>
                                    <div class="col-sm-8">
                                        <input v-model="form.pengumuman" type="date" name="pengumuman" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('pengumuman') }" id="pengumuman"
                                            />
                                        <has-error :form="form" field="pengumuman"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Internal</label>
                                    <div class="col-sm-3">
                                        <select v-model="form.internal" name="internal" class="form-control" id="internal">
                                            <option value=0>Tidak</option>
                                            <option value=1>Ya</option>
                                        </select>
                                        <has-error :form="form" field="internal"></has-error>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Kuota</label>
                                    <div class="col-sm-3">
                                        <input v-model="form.kuota" type="number" name="kuota" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('kuota') }" id="kuota"
                                            min=0/>
                                        <has-error :form="form" field="kuota"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Keterangan</label>
                                    <div class="col-sm-8">
                                        <input name="keterangan" class="form-control" type="text" v-model="form.keterangan">
                                        <has-error :form="form" field="keterangan"></has-error>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="col-3 btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="col-3 btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Link Zoom-->
            <div class="modal fade" id="addZoom" tabindex="-1" role="dialog" aria-labelledby="addZoomLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form @submit.prevent="updateDataZoom()">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Form Edit Zoom Link</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row seleksiZoom">
                                    <div class="col-md-12 mt--5">
                                        <div class="form-group linkZoom">
                                            <label class="col-form-label">Link Zoom</label>
                                            <input name="link" class="form-control" type="text" v-model="form.link">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group linkZoom">
                                            <label class="col-form-label">Tanggal</label>
                                            <input name="tanggal" class="form-control" type="date" v-model="form.tanggal">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group linkZoom">
                                            <label class="col-form-label">Meeting ID</label>
                                            <input name="meetingID" class="form-control" type="text" v-model="form.meetingID">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group linkZoom">
                                            <label class="col-form-label">Password</label>
                                            <input name="password" class="form-control" type="text" v-model="form.assword">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group linkZoom">
                                            <label class="col-form-label">TOKEN Ujian</label>
                                            <input name="token" class="form-control" type="text" v-model="form.token">
                                        </div>
                                    </div>
                                    <span class="col-12 text-right" style="padding: 10px; font-size: 14px; background-color: antiquewhite;">
                                        Format Penulisan ( <b><code>Mata Pelajaran1: token1; Mata Pelajaran2: token2</code></b> )
                                    </span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="offset-2 col-4 btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="col-4 btn btn-primary">Simpan</button>
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
                jadwals: [],
                filters: {
                    name: {
                        value: "",
                        keys: ["gel_id", "gelnya.unitnya.name", "seleksi", "pengumuman", "internal"]
                    }
                },
                currentPage: 1,
                totalPages: 0,
                form: new Form({
                    id: "",
                    gel_id: 0,
                    seleksi: "",
                    seleksi_online: "",
                    pengumuman: "",
                    internal: 0,
                    kuota: 0,
                    keterangan: "",
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/jadwals").then(({
                    data
                }) => (this.jadwals = data));
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
                    .post("../api/jadwals")
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Tambah Jadwal Berhasil"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            editModal(jadwal) {
                this.editmode = true;
                this.form.reset();
                $("#addModal").modal("show");
                this.form.fill(jadwal);
            },

            updateData() {
                this.$Progress.start();
                this.form
                    .put("../api/jadwals/" + this.form.id)
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Berhasil Update Jadwal"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            deleteData(id) {
                Swal.fire({
                    title: "Delete Jadwal",
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
                            .delete("../api/jadwals/" + id)
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

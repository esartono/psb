<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Bayar Tagihan PPDB SIT Nurul Fikri</h3>
                        <div class="card-tools">
                            <a class="btn btn-sm btn-danger" @click="addModal">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                            <a href="/EksportBayar" class="btn btn-sm btn-success mr-2 ml-2">
                                <b><i class="fas fa-file-excel"></i>
                                Data Bayar Tagihan PPDB</b>
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
                                    <v-th sortKey="uruts">No. ID</v-th>
                                    <v-th sortKey="name">Nama Lengkap</v-th>
                                    <v-th sortKey="jk">JK</v-th>
                                    <v-th sortKey="tagihan['bayar']">Total Bayar</v-th>
                                    <v-th sortKey="tagihan['total']">Total Tagihan</v-th>
                                    <v-th sortKey="tagihan['diskon']">Diskon</v-th>
                                    <v-th sortKey="tagihan['sisa']">Sisa Tagihan</v-th>
                                    <th>Lunas</th>
                                    <th style="width: 18%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ index+((currentPage-1) * 7)+1 }}</td>
                                    <td class="text-center">{{ row.uruts }}</td>
                                    <td>{{ row.name }}</td>
                                    <td class="text-center">{{ (row.jk == 1 ? 'L' : 'P') }}</td>
                                    <td>{{ row.tagihan['bayar'] | toCurrency }}</td>
                                    <td>{{ row.tagihan['total'] | toCurrency }}</td>
                                    <td>{{ row.tagihan['diskon'] | toCurrency }}</td>
                                    <td>{{ row.tagihan['sisa'] | toCurrency }}</td>
                                    <th v-if="row.tagihan['lunas'] != 0">
                                        <a><i class="fas fa-check-circle green"></i></a>
                                    </th>
                                    <th v-else>
                                        <a><i class="fas fa-times-circle red"></i></a>
                                    </th>
                                    <td>
                                        <a class="btn btn-sm btn-info" @click="detailModal(row.calon_id)">Details</a>
                                        <a :href="'/buktiBayarPPDB/'+row.calon_id" class="btn btn-danger btn-sm" target="_blank">Cetak Bukti</a>
                                    </td>
                                </tr>
                            </tbody>
                        </v-table>
                        <smart-pagination :currentPage.sync="currentPage" :totalPages="totalPages" :maxPageLinks="3"
                            :boundaryLinks="true" class="float-right" />
                    </div>
                </div>
            </div>

            <!-- Modal Bayar-->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form @submit.prevent="editmode ? updateData() : createData()">
                            <div class="modal-header">
                                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Pembayaran Tagihan PPDB - SIT Nurul Fikri</h5>
                                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Edit Form Pembayaran Tagihan PPDB - SIT Nurul Fikri</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Nama Peserta</label>
                                    <div class="col-sm-7">
                                        <v-select v-show="!editmode" :options="registrasi" v-model="form.name"></v-select>
                                        <input v-show="editmode" v-model="form.name" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Tanggal Bayar</label>
                                    <div class="col-sm-7">
                                        <input v-model="form.tgl_bayar" type="date" name="tgl_bayar" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('tgl_bayar') }" id="tgl_bayar"
                                        />
                                        <has-error :form="form" field="tgl_bayar"></has-error>
                                        <span style="color:red; font-size: 10px;">Format tanggal : bulan/tanggal/tahun</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Pembayaran</label>
                                    <div class="col-sm-7">
                                        <input v-model="form.bayar" type="number" name="bayar" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('bayar') }" id="bayar"
                                        />
                                        <has-error :form="form" field="bayar"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Tambahan Infaq</label>
                                    <div class="col-sm-7">
                                        <input v-model="form.tambah_infaq" type="number" name="tambah_infaq" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('infaq') }" id="infaq"
                                        />
                                        <has-error :form="form" field="infaq"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Diskon Pembayaran</label>
                                    <div class="col-sm-7">
                                        <input v-model="form.diskon" type="number" name="diskon" class="form-control"
                                            :class="{ 'is-invalid':form.errors.has('diskon') }" id="diskon"
                                        />
                                        <has-error :form="form" field="diskon"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Pembayaran Lunas</label>
                                    <div class="col-sm-7">
                                        <v-select :options="listLunas" :reduce="ket => ket.val" label="ket" v-model="form.lunas"></v-select>
                                        <!-- <select v-model="form.lunas" class="form-control">
                                            <option value=0>Belum Lunas</option>
                                            <option value=1>Sudah Lunas</option>
                                        </select> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Keterangan</label>
                                    <textarea class="form-control" rows="2" v-model="form.keterangan"></textarea>
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

            <!-- Modal Detail-->
            <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-extra" role="document">
                    <div class="modal-content" style="padding: 20px;">
                        <table class="table table-mini table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Pendaftaran</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Bayar</th>
                                <th>Tambahan Infaq</th>
                                <th>Diskon</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                            <tr v-for="(d, index) in details" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ d.calonnya.uruts }}</td>
                                <td>{{ d.calonnya.name }}</td>
                                <td>{{ d.tgl_bayar | Tanggal }}</td>
                                <td>{{ d.bayar | toCurrency }}</td>
                                <td>{{ d.tambah_infaq | toCurrency }}</td>
                                <td>{{ d.diskon | toCurrency }}</td>
                                <td>{{ d.keterangan }}</td>
                                <td>
                                    <a class="btn btn-sm" @click="editBayar(d)"><i class="fas fa-edit blue"></i>Edit</a>
                                    <!-- <a class="btn btn-sm" @click="deleteData(d.id)"><i class="fas fa-trash red"></i></a> -->
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4"> TOTAL </th>
                                <th> {{ totalBayar | toCurrency }} </th>
                                <th colspan="3"></th>
                            </tr>
                        </table>
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
                listLunas: [
                    {val:0, ket: 'Belum Lunas'},
                    {val:1, ket: 'Sudah Lunas'},
                ],
                registrasi: [],
                calons: [],
                details: [],
                filters: {
                    name: {
                        value: "",
                        keys: ["uruts", "name"]
                    },
                },
                editmode: false,
                currentPage: 1,
                totalPages: 0,
                form: new Form({
                    // pendaftaran: "",
                    id: 0,
                    name: "",
                    tgl_bayar: "",
                    bayar: 0,
                    tambah_infaq:0,
                    diskon:0,
                    lunas: 0,
                    keterangan: ""
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/bayartagihans")
                    .then(({ data }) => (this.calons = data));
                this.$Progress.finish();
            },

            listNama() {
                axios.get("../api/registrasi")
                    .then((data) => {
                        this.registrasi = data.data
                    })
            },

            addModal() {
                this.form.reset();  
                this.listNama();
                $("#addModal").modal("show");
            },

            detailModal(id) {
                axios.get("../api/bayartagihans/" + id)
                    .then(({ data }) => (this.details = data));
                $("#detailModal").modal("show");
            },

            createData() {
                this.$Progress.start();
                this.form
                    .post("../api/bayartagihans")
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Tambah Pembayaran Berhasil"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            updateData() {
                this.$Progress.start();
                this.form
                    .put("../api/bayartagihans/" + this.form.id)
                    .then(() => {
                        $("#addModal").modal("hide");
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Berhasil Update Data Admin"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },

            deleteData(id) {
                Swal.fire({
                    title: "Delete Data Pembayaran",
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
                        .delete("../api/bayartagihans/" + id)
                        .then(() => {
                        Swal.fire("Berhasil!", "Data Bayar telah di hapus.", "success");
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

            editBayar(bayar) {
                this.editmode = true;
                this.form.reset();
                this.listNama();
                this.form.fill(bayar);
                this.form.name = bayar.calonnya.uruts + ' - ' + bayar.calonnya.name
                this.form.lunas = bayar.tagihan.lunas
                $("#detailModal").modal("hide");
                $("#addModal").modal("show");  
            },
            
            delBayar(id) {
                console.log(id)
            }

        },

        computed : {
            totalBayar: function() {
            let sum = 0;
            return this.details.reduce((sum, item) => sum + item.bayar, 0);
            }
        },

        created() {
            this.listData();
            Fire.$on("listData", () => {
                this.listData();
            });
        },

    };

</script>

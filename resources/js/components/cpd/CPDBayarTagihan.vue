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
                                Data Bayar Tagihan PSB</b>
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
                                    <v-th sortKey="calonnya.uruts">VA Muamalat</v-th>
                                    <v-th sortKey="calonnya.name">Nama Lengkap</v-th>
                                    <v-th sortKey="calonnya.jk">JK</v-th>
                                    <v-th sortKey="tagihan['akhir']">Tanggal Bayar</v-th>
                                    <v-th sortKey="tagihan['bayar']">Bayar</v-th>
                                    <v-th sortKey="tagihan['total']">Total Tagihan</v-th>
                                    <v-th sortKey="tagihan['sisa']">Sisa Tagihan</v-th>
                                    <th>LUNAS DAUL</th>
                                    <th>LUNAS PPDB</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ index+((currentPage-1) * 7)+1 }}</td>
                                    <td class="text-center">{{ row.calonnya.uruts }}</td>
                                    <td>{{ row.calonnya.name }}</td>
                                    <td class="text-center">{{ (row.calonnya.jk == 1 ? 'L' : 'P') }}</td>
                                    <td>{{ row.tagihan['akhir'] | Tanggal }}</td>
                                    <td>{{ row.tagihan['bayar'] | toCurrency }}</td>
                                    <td>{{ row.tagihan['total'] | toCurrency }}</td>
                                    <td>{{ row.tagihan['sisa'] | toCurrency }}</td>
                                    <th v-if="row.tagihan['bayar'] >= row.tagihan['sisa']">
                                        <a><i class="fas fa-2x fa-check-circle green"></i></a>
                                    </th>
                                    <th v-else>
                                        <a><i class="fas fa-2x fa-times-circle red"></i></a>
                                    </th>
                                    <th v-if="row.tagihan['sisa'] == 0">
                                        <a><i class="fas fa-2x fa-check-circle green"></i></a>
                                    </th>
                                    <th v-else>
                                        <a><i class="fas fa-2x fa-times-circle red"></i></a>
                                    </th>
                                    <th>
                                        <a class="btn btn-sm btn-info" @click="detailModal(row.calon_id)">Details</a>
                                        <a class="btn btn-sm btn-info" @click="detailModal(row.calon_id)">Details</a>
                                    </th>
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
                        <form @submit.prevent="createData()">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Form Pembayaran Tagihan PPDB - SIT Nurul Fikri</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">No. Pendaftaran</label>
                                    <div class="col-sm-7">
                                        <input v-model="form.pendaftaran" type="text" class="form-control" required />
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
                                <div class="form-group">
                                    <label class="col-form-label">Keterangan</label>
                                    <textarea class="form-control" rows="3" v-model="form.keterangan"></textarea>
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
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content" style="padding: 20px;">
                        <table class="table table-mini table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Pendaftaran</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Bayar</th>
                                <th>Keterangan</th>
                            </tr>
                            <tr v-for="(d, index) in details" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ d.calonnya.uruts }}</td>
                                <td>{{ d.calonnya.name }}</td>
                                <td>{{ d.tgl_bayar | Tanggal }}</td>
                                <td>{{ d.bayar | toCurrency }}</td>
                                <td>{{ d.keterangan }}</td>
                            </tr>
                            <tr>
                                <th colspan="4"> TOTAL </th>
                                <th> {{ totalBayar | toCurrency }} </th>
                                <th></th>
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
                calons: [],
                details: [],
                filters: {
                    name: {
                        value: "",
                        keys: ["calonnya.uruts", "calonnya.name"]
                    },
                },
                currentPage: 1,
                totalPages: 0,
                form: new Form({
                    pendaftaran: "",
                    tgl_bayar: "",
                    bayar: 0,
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

            addModal() {
                this.form.reset();
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

<template>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Siswa Diterima</h3>
                        <div class="card-tools">
                            <a class="btn btn-sm btn-danger" @click="addModal">
                                <i class="fas fa-plus"></i> Input data Pengambilan
                            </a>
                            <div class="input-group input-group-sm float-right mt-1" style="width: auto;">
                                <select class="ml-1 form-control" v-model="filters.unit.value">
                                    <option value="" selected disabled> -- Pilih Unit -- </option>
                                    <option v-for="unit in units" :key="unit.id"
                                        v-bind:value="unit.name">{{ unit.name }}</option>
                                </select>
                            </div>
                            <div class="input-group input-group-sm mt-1" style="width: 200px;">
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
                                    <v-th sortKey="unit">Unit</v-th>
                                    <v-th sortKey="ck">Kategori</v-th>
                                    <v-th sortKey="uruts">No. ID</v-th>
                                    <v-th sortKey="name">Nama Lengkap</v-th>
                                    <v-th sortKey="jk">JK</v-th>
                                    <!-- <v-th sortKey="tgl_lahir">Tanggal Lahir</v-th> -->
                                    <th>Seragam</th>
                                    <th>Chromebook</th>
                                    <th>Buku</th>
                                </tr>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-if="!calons.length">
                                    <th colspan="11" class="text-center">No Data</th>
                                </tr>
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ index+((currentPage-1) * 7)+1 }}</td>
                                    <td class="text-center">{{ row.unit }}</td>
                                    <td class="text-center">{{ row.ck }}</td>
                                    <td class="text-center">{{ row.uruts }}</td>
                                    <td>{{ row.name | Judul}}</td>
                                    <td class="text-center">{{ (row.jk == 1 ? 'L' : 'P') }}</td>
                                    <th v-if="row.seragam == 1">
                                        <a><i class="fas fa-check-circle green"></i></a>
                                    </th>
                                    <th v-else>
                                        <a><i class="fas fa-times-circle red"></i></a>
                                    </th>
                                    <th v-if="row.chromebook == 1">
                                        <a><i class="fas fa-check-circle green"></i></a>
                                    </th>
                                    <th v-else>
                                        <a><i class="fas fa-times-circle red"></i></a>
                                    </th>
                                    <th v-if="row.buku == 1">
                                        <a><i class="fas fa-check-circle green"></i></a>
                                    </th>
                                    <th v-else>
                                        <a><i class="fas fa-times-circle red"></i></a>
                                    </th>
                                </tr>
                            </tbody>
                        </v-table>
                        <smart-pagination :currentPage.sync="currentPage" :totalPages="totalPages" :maxPageLinks="3"
                            :boundaryLinks="true" class="float-right" />
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form @submit.prevent="createData()">
                            <div class="modal-header">
                                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Input Pengambilan</h5>
                                <!-- <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Pengambilan</h5> -->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">No. Pendaftaran :</label>
                                    <div class="col-md-8">
                                        <input v-model="form.pendaftaran" type="text" name="pendaftaran" 
                                            class="form-control" id="pendaftaran" maxlength="9"
                                            placeholder="Tulis No. Pendaftaran" @input="cekAmnbil"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Seragam :</label>
                                    <div class="col-md-8">
                                        <select v-model="form.seragam" name="lunas_daul" class="form-control" id="seragam">
                                            <option value=0>Belum diambil</option>
                                            <option value=1>Sudah diambil</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Keterangan Seragam</label>
                                    <div class="col-md-8">
                                        <input v-model="form.ket_seragam" type="text" name="ket_seragam" class="form-control" id="ket_seragam"
                                            placeholder="Keterangan" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Chromebook :</label>
                                    <div class="col-md-8">
                                        <select v-model="form.chromebook" name="chromebook" class="form-control" id="chromebook">
                                            <option value=0>Belum diambil</option>
                                            <option value=1>Sudah diambil</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">SN Chromebook</label>
                                    <div class="col-md-8">
                                        <input v-model="form.sn_chromebook" type="text" name="sn_chromebook" class="form-control" id="sn_chromebook"
                                            placeholder="Serial Number" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Keterangan Chromebook</label>
                                    <div class="col-md-8">
                                        <input v-model="form.ket_chromebook" type="text" name="ket_chromebook" class="form-control" id="ket_chromebook"
                                            placeholder="Keterangan" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Buku :</label>
                                    <div class="col-md-8">
                                        <select v-model="form.buku" name="buku" class="form-control" id="buku">
                                            <option value=0>Belum diambil</option>
                                            <option value=1>Sudah diambil</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Keterangan Buku</label>
                                    <div class="col-md-8">
                                        <input v-model="form.ket_buku" type="text" name="ket_buku" class="form-control" id="ket_buku"
                                            placeholder="Keterangan" />
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
</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                calons: [],
                units: [],
                cks: {},
                filters: {
                    name: {
                        value: "",
                        keys: ["uruts", "name"]
                    },
                    unit: {
                        value: "",
                        keys: ["unit"]
                    }
                },
                currentPage: 1,
                totalPages: 0,
                form: new Form({
                    pendaftaran: "",
                    seragam: 0,
                    ket_seragam: "",
                    chromebook: 0,
                    sn_chromebook: "",
                    ket_chromebook: "",
                    buku: 0,
                    ket_buku: "",
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/ambil").then(({ data }) => (this.calons = data));
                axios.get("../api/units").then(({ data }) => (this.units = data));
                this.$Progress.finish();
            },

            addModal() {
                // this.editmode = false;
                this.form.reset();
                $("#addModal").modal("show");
            },

            cekAmnbil() {
                // axios
                //     .get("../api/cekambil/" + this.form.pendaftaran)
                //     .then(function (data) {
                //         console.log(data.data['pendaftaran'])
                //         console.log('EKO')
                //         // this.form.seragam = data.
                //     });
            },

            createData() {
                this.$Progress.start();
                this.form
                    .post("../api/ambil")
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
        },

        created() {
            this.listData();
            Fire.$on("listData", () => {
                this.listData();
            });
        },

    };

</script>

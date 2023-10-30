<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 v-if="$route.params.id === '1'" class="card-title">Daftar Peserta Aktif</h3>
                        <h3 v-else class="card-title">Daftar Peserta Baru</h3>
                        <div class="card-tools">
                            <a v-if="$route.params.id === '1'" href="/EksportCpdAktif" class="btn btn-sm btn-warning mr-2 ml-2">
                                <i class="fas fa-file-excel"></i>
                                Export
                            </a>
                            <a v-else href="/EksportCpdBaru" class="btn btn-sm btn-warning mr-2 ml-2">
                                <i class="fas fa-file-excel"></i>
                                Export
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
                                    <v-th sortKey="cknya.name">Kategori</v-th>
                                    <v-th sortKey="uruts">No. ID</v-th>
                                    <v-th sortKey="name">Nama Lengkap</v-th>
                                    <v-th sortKey="tgl_lahir">Tanggal Lahir</v-th>
                                    <th>Usia</th>
                                    <v-th sortKey="kelas">Kelas Tujuan</v-th>
                                    <v-th sortKey="asal_sekolah">Asal Sekolah</v-th>
                                    <v-th sortKey="ayah_nama">Orang Tua</v-th>
                                    <th>No. Ponsel</th>
                                    <th v-if='$route.params.id == 0'>Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id" v-bind:style= "[row.pindahan > 0 ? {'background': '#FFE07D'} : '']">
                                    <td class="text-center">
                                        {{ index+((currentPage-1) * 7)+1 }}
                                        <a @click="deleteData(row.id)" class="btn btn-sm btn-danger text-white" v-if='$route.params.id == 0'>
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">{{ row.ck }}</td>
                                    <td class="text-center">{{ row.uruts }}</td>
                                    <td>{{ row.name }}</td>
                                    <td>{{ row.tempat_lahir }}, {{ row.tgl_lahir | Tanggal}}</td>
                                    <td>{{ row.tgl_lahir | Usia}}</td>
                                    <td class="text-center">{{ row.kelas }} {{ row.pindahan > 0 ? '(Pindahan)' : '' }}</td>
                                    <td class="text-center">{{ row.asal_sekolah }}</td>
                                    <td>{{ row.ayah_nama }}<hr>{{ row.ibu_nama }}</td>
                                    <td v-if="row.ayah_hp && row.ibu_hp">{{ row.ayah_hp }}<hr>{{ row.ibu_hp }}</td>
                                    <td v-else>{{ row.phone }}<hr>No. HP Pendaftar</td>
                                    <td class="text-center" v-if='$route.params.id == 0'>Daftar : {{ row.tgl_daftar | TanggalKecil }} <hr>
                                        Expired : {{ row.expired | TanggalKecil }}
                                    </td>
                                    <td class="text-center aksi" style="width: 100px !important">
                                        <router-link v-bind:to="'/editcalons/'+row.id">
                                            <i class="fas fa-edit blue"></i>
                                        </router-link>
                                        <br>
                                        <a v-if='$route.params.id == 1' :href="'/seleksiPDF/'+row.id">
                                            <i class="fas fa-file-pdf red"></i>
                                        </a>
                                        <a v-if='$route.params.id == 0' :href="'/biayatesPDF/'+row.id">
                                            <i class="fas fa-file-pdf red"></i>
                                        </a>
                                        <hr>
                                        <a @click="updateBiaya(row.id)" class="btn btn-sm btn-warning mt-2" v-if='$route.params.id == 0'>
                                            Edupay
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
        </div>
    </div>
</template>/>

<script>
    export default {
        data() {
            return {
                calons: [],
                cks: {},
                filters: {
                    name: {
                        value: "",
                        keys: ["ck", "uruts", "name", "tgl_lahir", "asal_sekolah", "ayah_nama", "ibu_nama"]
                    }
                },
                currentPage: 1,
                totalPages: 0,
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/indexadmin/" + this.$route.params.id)
                    .then(({ data }) => (this.calons = data));
                this.$Progress.finish();
            },

            updateBiaya(id) {
                axios
                .put("../api/calonbiayates/" + id)
                .then(() => {
                    $("#addModal").modal("hide");
                    Fire.$emit("listData");
                    Toast.fire({
                        type: "success",
                        title: "Berhasil perpanjang masa berlaku pembayaran"
                    });
                    this.$Progress.finish();
                    })
                    .catch(() => {
                    this.$Progress.fail();
                    });
            },

            deleteData(id) {
                Swal.fire({
                    title: "Delete Data Calon Siswa Baru",
                    html: "Apakah anda yakin ?<br>"+
                        "Pastikan Data Calon memang harus di hapus.<br>"+
                        "Kalau ada terjadi <b>kesalahan hapus</b>,<br>maka menjadi <b>tanggung jawab Anda</b>,<br>"+
                        "siap-siap <b>IT Pusat</b> bakal ngamuk!!!<hr>#EkoGalak",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "red",
                    cancelButtonColor: "green",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal"
                }).then(result => {
                    if (result.value) {
                        axios
                            .delete("../api/calons/" + id)
                            .then(() => {
                                Swal.fire("Berhasil!", "Data Calon Siswa Baru telah di hapus.", "success");
                                Fire.$emit("listData");
                            })
                            .catch(() => {
                                Swal.fire(
                                    "gagal!",
                                    "Ada yang salah, hubungi Developer",
                                    "warning"
                                );
                            });
                    } else {
                        Swal.fire("Gak Jadi!", "Hubungi Admin Pusat jika ingin menghapus DATA Calon Siswa.", "warning");
                    }
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

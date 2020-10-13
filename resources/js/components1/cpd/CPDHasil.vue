<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Peserta Hasil Tes</h3>
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
                    <div class="card-body p-0">
                        <v-table :data="calons" :filters="filters" :currentPage.sync="currentPage" :pageSize="7"
                            @totalPagesChanged="totalPages = $event"
                            class="table table-mini table-bordered table-head-fixed table-hover">
                            <thead slot="head">
                                <tr>
                                    <th>No.</th>
                                    <v-th sortKey="unitnya.name">Unit</v-th>
                                    <v-th sortKey="cknya.name">Kategori</v-th>
                                    <v-th sortKey="pendaftaran">No. ID</v-th>
                                    <v-th sortKey="calonnya.name">Nama Lengkap</v-th>
                                    <th>JK</th>
                                    <v-th sortKey="calonnya.tgl_lahir">Tanggal Lahir</v-th>
                                    <v-th sortKey="calonnya.asal_sekolah">Asal Sekolah</v-th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ index+((currentPage-1) * 7)+1 }}</td>
                                    <td class="text-center">{{ row.unitnya.name }}</td>
                                    <td class="text-center">{{ row.calonnya.ck }}</td>
                                    <td class="text-center">{{ row.pendaftaran }}</td>
                                    <td>{{ row.calonnya.name }}</td>
                                    <td class="text-center">{{ (row.calonnya.jk == 1 ? 'L' : 'P') }}</td>
                                    <td>{{ row.calonnya.tempat_lahir }}, {{ row.calonnya.tgl_lahir | Tanggal}}</td>
                                    <td class="text-center">{{ row.calonnya.asal_sekolah }}</td>
                                    <th v-if="row.lulus === 1">Diterima</th>
                                    <th v-else-if="row.lulus === 2">Cadangan</th>
                                    <th v-else-if="row.lulus === 3">Tidak Diterima</th>
                                    <th v-else>
                                        <a @click="updateHasil(row.id+':1:JURUSAN IPA')" class="btn btn-sm btn-success">Diterima IPA</a><br>
                                        <a @click="updateHasil(row.id+':1:JURUSAN IPS')" class="btn btn-sm btn-info mt-2 mb-2">Diterima IPS</a><br>
                                        <a @click="updateHasil(row.id+':2:')" class="btn btn-sm btn-warning mt-2 mb-2">Cadangan</a><br>
                                        <a @click="updateHasil(row.id+':3:')" class="btn btn-sm btn-danger">Tidak Diterima</a>
                                    </th>
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
                        keys: ["unitnya.name", "pendaftaran", "calonnya.name", "calonnya.tgl_lahir", "calonnya.asal_sekolah"]
                    }
                },
                currentPage: 1,
                totalPages: 0,
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/calonhasils/" + this.$route.params.id)
                    .then(({ data }) => (this.calons = data));
                this.$Progress.finish();
            },

            updateHasil(id) {
                axios
                .put("../api/calonhasils/" + id)
                .then(() => {
                    $("#addModal").modal("hide");
                    Fire.$emit("listData");
                    Toast.fire({
                        type: "success",
                        title: "Berhasil Update Data Pegawai"
                    });
                    this.$Progress.finish();
                    })
                    .catch(() => {
                    this.$Progress.fail();
                    });
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

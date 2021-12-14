<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Siswa Diterima</h3>
                        <div class="card-tools">
                            <a href="/EksportSiswaBaru" class="btn btn-sm btn-warning mr-2 ml-2">
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
                                    <v-th sortKey="unitnya.name">Unit</v-th>
                                    <v-th sortKey="cknya.name">Kategori</v-th>
                                    <v-th sortKey="pendaftaran">No. ID</v-th>
                                    <v-th sortKey="calonnya.name">Nama Lengkap</v-th>
                                    <th>JK</th>
                                    <v-th sortKey="calonnya.tgl_lahir">Tanggal Lahir</v-th>
                                    <!-- <v-th sortKey="calonnya.asal_sekolah">Asal Sekolah</v-th> -->
                                    <th>Daftar Ulang</th>
                                    <th>Seragam</th>
                                </tr>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ index+((currentPage-1) * 7)+1 }}</td>
                                    <td class="text-center">{{ row.gelnya.unitnya.name }}</td>
                                    <td class="text-center">{{ row.cknya.name }}</td>
                                    <td class="text-center">{{ row.uruts }}</td>
                                    <td>{{ row.name }}</td>
                                    <td class="text-center">{{ (row.jk == 1 ? 'L' : 'P') }}</td>
                                    <td>{{ row.tempat_lahir }}, {{ row.tgl_lahir | Tanggal}}</td>
                                    <!-- <td class="text-center">{{ row.asal_sekolah }}</td> -->
                                    <th>
                                        <a :href="'DaftarUlangPDF/'+row.id" target="_blank">
                                            <i class="fas fa-2x fa-file-pdf red"> </i><br>Daul
                                        </a>
                                    </th>
                                    <th>
                                        <a :href="'AmbilSeragamPDF/'+row.id" target="_blank">
                                            <i class="fas fa-2x fa-file-pdf green"></i><br>Seragam
                                        </a>
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
                        keys: ["unitnya.name", "calonnya.uruts", "calonnya.name", "calonnya.tgl_lahir", "calonnya.asal_sekolah"]
                    }
                },
                currentPage: 1,
                totalPages: 0,
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/calontagihans/1")
                    .then(({ data }) => (this.calons = data));
                this.$Progress.finish();
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

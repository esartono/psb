<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Tagihan Biaya PPDB SIT Nurul Fikri</h3>
                        <div class="card-tools">
                            <a href="/EksportVABank/1" class="btn btn-sm btn-muamalat mr-2 ml-2">
                                <i class="fas fa-file-excel"></i>
                                Export Muamalat
                            </a>
                            <a href="/EksportVABank/2" class="btn btn-sm btn-danger mr-2 ml-2">
                                <i class="fas fa-file-excel"></i>
                                Export BJBS
                            </a>
                            <a href="/EksportVABank/3" class="btn btn-sm btn-success mr-2 ml-2">
                                <b><i class="fas fa-file-excel"></i>
                                Tagihan PPDB</b>
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
                                    <v-th sortKey="wawancara">Pewawancara</v-th>
                                    <v-th sortKey="calonnya.uruts">No. ID</v-th>
                                    <v-th sortKey="calonnya.name">Nama Lengkap</v-th>
                                    <v-th sortKey="calonnya.jk">JK</v-th>
                                    <v-th sortKey="infaq">Infaq</v-th>
                                    <v-th sortKey="infaqnfpeduli">Infaq NF Peduli</v-th>
                                    <th>Tagihan</th>
                                    <th>Total Tagihan</th>
                                    <th>Lunas</th>
                                </tr>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ index+((currentPage-1) * 7)+1 }}</td>
                                    <td>{{ row.wawancara }}</td>
                                    <td class="text-center">{{ row.calonnya.uruts }}</td>
                                    <td>{{ row.calonnya.name }}</td>
                                    <td class="text-center">{{ (row.calonnya.jk == 1 ? 'L' : 'P') }}</td>
                                    <td>{{ row.infaq | toCurrency }}</td>
                                    <td>{{ row.infaqnfpeduli | toCurrency }}</td>
                                    <td>{{ row.tagihan[1] | toCurrency }}</td>
                                    <td>{{ row.infaq + row.infaqnfpeduli + row.tagihan[1]| toCurrency }}</td>
                                    <th v-if="row.lunas === 1">
                                        <a><i class="fas fa-2x fa-check-circle green"></i></a>
                                    </th>
                                    <th v-else>
                                        <!-- <a @click="updateData(row.id)" class="btn"><i class="fas fa-2x fa-times-circle red"></i></a> -->
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
                        keys: ["calonnya.uruts", "wawancara", "calonnya.name", "va2"]
                    },
                    nokosong: {
                        value: "kosong",
                        custom: this.noKosong
                    }
                },
                currentPage: 1,
                totalPages: 0,
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/calontagihanpsbs")
                    .then(({ data }) => (this.calons = data));
                this.$Progress.finish();
            },

            updateData(id) {
                // axios
                // .put("../api/calontagihans/" + id)
                // .then(() => {
                //     Fire.$emit("listData");
                //     Toast.fire({
                //         type: "success",
                //         title: "Peserta Berhasil Daftar Ulang"
                //     });
                //     this.$Progress.finish();
                //     })
                //     .catch(() => {
                //     this.$Progress.fail();
                //     });
            },

            noKosong(filterNya, row) {
                return row.va !== 'kosong'
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

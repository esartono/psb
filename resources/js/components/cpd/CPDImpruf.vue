<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Kesedian Mengikuti Impruf</h3>
                        <div class="card-tools">
                            <a href="/EksportImpruf" class="btn btn-sm btn-success mr-2 ml-2">
                                <b><i class="fas fa-file-excel"></i>
                                Impruf</b>
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
                                    <v-th sortKey="calonnya.uruts">No. Peserta</v-th>
                                    <v-th sortKey="calonnya.name">Nama Lengkap</v-th>
                                    <v-th sortKey="calonnya.jk">JK</v-th>
                                    <v-th sortKey="lain.program">Kesediaan</v-th>
                                </tr>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ index+((currentPage-1) * 7)+1 }}</td>
                                    <td class="text-center">{{ row.calonnya.uruts }}</td>
                                    <td>{{ row.calonnya.name }}</td>
                                    <td class="text-center">{{ (row.calonnya.jk == 1 ? 'L' : 'P') }}</td>
                                    <td>{{ row.lain.program }}</td>
                                    <!-- <th v-if="row.lain.program === 1">
                                        <a><i class="fas fa-2x fa-check-circle green"></i></a>
                                    </th> -->
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
                        keys: ["uruts", "name", "impruf"]
                    },
                },
                currentPage: 1,
                totalPages: 0,
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/calonimpruf")
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

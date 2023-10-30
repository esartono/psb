<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Peserta PPDB Online - SIT Nurul Fikri</h3>
                        <div class="card-tools">
                            <!-- <a href="/EksportCpdAll" class="btn btn-sm btn-warning mr-2 ml-2">
                                <i class="fas fa-file-excel"></i>
                                Export
                            </a> -->
                            <div class="input-group input-group-sm float-right mt-1" style="width: auto;">
                                <select class="ml-1 form-control" v-model="filters.unit.value">
                                    <option value="" selected disabled> -- Pilih Unit -- </option>
                                    <option value="TK">Unit TK</option>
                                    <option value="SD">Unit SD</option>
                                    <option value="SMP">Unit SMP</option>
                                    <option value="SMA">Unit SMA</option>
                                </select>
                            </div>
                            <div class="mt-1 input-group input-group-sm" style="width: 200px;">
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
                                    <v-th sortKey="nama">Nama Lengkap</v-th>
                                    <v-th sortKey="asal_sekolah">Asal Sekolah</v-th>
                                    <v-th sortKey="ta">Tahun Ajaran</v-th>
                                    <v-th sortKey="wa">No. Whatsapp</v-th>
                                    <v-th sortKey="email">E-mail</v-th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ index+((currentPage-1) * 7)+1 }}</td>
                                    <td class="text-center">{{ row.unit.toUpperCase() }}</td>
                                    <td>{{ row.nama }}</td>
                                    <td class="text-center">{{ row.asal_sekolah }}</td>
                                    <td class="text-center">{{ row.ta }}/{{ parseInt(row.ta)+1 }}</td>
                                    <td>{{ row.wa }}</td>
                                    <td>{{ row.email }}</td>
                                    <td class="text-center">
                                        <a @click="hapus(row.id)" class="btn"><i class="fas fa-2x fa-times-circle red"></i></a>
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
                        keys: ["nama", "ta", "asal_sekolah", "wa", "email"]
                    },
                    unit: {
                        value: "",
                        keys: ['unit']
                    }
                },
                currentPage: 1,
                totalPages: 0,
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../waiting")
                    .then(({ data }) => (this.calons = data));
                this.$Progress.finish();
            },

            hapus(id){
                this.$Progress.start();
                axios
                .put("../waiting/" + id)
                .then(() => {
                    Fire.$emit("listData");
                    Toast.fire({
                        type: "success",
                        title: "Peserta Berhasil Daftar Ulang"
                    });
                    this.$Progress.finish();
                    })
                .catch(() => {
                    this.$Progress.fail();
                });
                this.$Progress.finish();
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

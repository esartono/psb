<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Daftar Peserta Tes</h3>
                        <div class="card-tools">
                            <a href="/EksportTes" class="btn btn-sm btn-warning mr-2 ml-2">
                                <i class="fas fa-file-excel"></i>
                                Export
                            </a>
                            <!-- <select name="jadwal" v-model="jdn" @change="listData()" class="float-left mr-4" id="jadwal">
                                <option value=0>Pilih Tanggal Tes</option>
                                <option
                                    v-for="jd in jadwals"
                                    :key="jd.id"
                                    v-bind:value="jd.id"
                                >{{ jd.gelnya.unitnya.catnya.name }} - {{ jd.seleksi | Tanggal }}</option>
                            </select> -->
                            <div class="input-group input-group-sm" style="width: 200px;">
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
                                    <v-th sortKey="calonnya.gelnya.unitnya.catnya.name">Unit</v-th>
                                    <v-th sortKey="calonnya.uruts">ID</v-th>
                                    <v-th sortKey="calonnya.name">Nama Lengkap</v-th>
                                    <th>Tanggal Lahir</th>
                                    <th>Asal Sekolah</th>
                                    <th>Nama Ayah</th>
                                    <th>Nama Ibu</th>
                                </tr>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ index+((currentPage-1) * 7)+1 }}</td>
                                    <td class="text-center">{{ row.jadwalnya.gelnya.unitnya.catnya.name }}</td>
                                    <td class="text-center">{{ row.calonnya.uruts }}</td>
                                    <td>{{ row.calonnya.name }}</td>
                                    <td>{{ row.calonnya.tempat_lahir }}, {{ row.calonnya.tgl_lahir | Tanggal}}</td>
                                    <td class="text-center">{{ row.calonnya.asal_sekolah }}</td>
                                    <td>{{ row.calonnya.ayah_nama }}</td>
                                    <td>{{ row.calonnya.ibu_nama }}</td>
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
                calons: {},
                jadwals: {},
                jdn: 0,
                filters: {
                    name: {
                        value: "",
                        keys: ["calonnya.gelnya.unitnya.catnya.name", "calonnya.uruts", "calonnya.name"]
                    }
                },
                currentPage: 1,
                totalPages: 0,
            };
        },

        methods: {
            listJadwal() {
                this.$Progress.start();
                axios.get("../api/jadwals")
                    .then(({ data }) => (this.jadwals = data));
                Fire.$emit("listData");
                this.$Progress.finish();
            },

            listData() {
                if(this.jdn > 0) {
                    this.$Progress.start();
                    axios.get("../api/calonjadwals/"+this.jdn)
                        .then(({ data }) => (this.calons = data));
                    this.$Progress.finish();
                }
            },
        },

        created() {
            this.listJadwal();
            Fire.$on("listJadwal", () => {
                this.listJadwal();
            });
        },

    };

</script>

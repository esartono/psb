<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Data Kelengkapan Berkas PPDB</h3>
                        <div class="input-group input-group-sm float-right" style="width: 350px;">
                            <input v-model="filters.name.value" type="text" name="search"
                                class="form-control" placeholder="Cari data ..." />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <v-table
                            :data="calons"
                            :filters="filters"
                            :currentPage.sync="currentPage"
                            :pageSize="7"
                            @totalPagesChanged="totalPages = $event"
                            class="table table-sm table-bordered table-hover table-head-fixed"
                        >
                            <thead slot="head">
                                <th>No.</th>
                                <v-th sortKey="uruts">Unit</v-th>
                                <v-th sortKey="uruts">No. Pendaftaran</v-th>
                                <v-th sortKey="name">Nama</v-th>
                                <v-th sortKey="name">Kelengkapan Berkas</v-th>
                                <th>Aksi</th>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <th>{{ index+((currentPage-1) * 7)+1 }}</th>
                                    <td>{{ row.unit }}</td>
                                    <td>{{ row.uruts }}</td>
                                    <td>{{ row.name }}</td>
                                    <td v-if="row.sudah == 'Lengkap'">LENGKAP</td>
                                    <td v-else class="red">{{ row.sudah }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success white" @click="detailModal(row)"><i class="fas fa-file"></i> Detail</a>
                                    </td>
                                </tr>
                            </tbody>
                        </v-table>
                        <smart-pagination
                            :currentPage.sync="currentPage"
                            :totalPages="totalPages"
                            :maxPageLinks="3"
                            :boundaryLinks="true"
                            class="float-right"
                        />
                    </div>
                </div>
            </div>
            <div
                class="modal fade"
                id="detailModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="detailModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form @submit.prevent="updateData()">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel">Berkas Kelengkapan PPDB</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input v-model="form.id" type="hidden">
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">No. Pendaftaran :</label>
                                <div class="col-sm-7">
                                    <input
                                    v-model="form.uruts"
                                    type="text"
                                    class="form-control"
                                    disabled
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Nama Calon Siswa :</label>
                                <div class="col-sm-7">
                                    <input
                                    v-model="form.name"
                                    type="text"
                                    class="form-control"
                                    disabled
                                    />
                                </div>
                            </div>
                            <v-table
                                :data="berkas"
                                class="table table-sm table-bordered table-hover table-head-fixed"
                            >
                                <thead slot="head">
                                    <th>No.</th>
                                    <th>Berkas</th>
                                    <th>Download</th>
                                </thead>
                                <tbody slot="body" slot-scope="{displayData}">
                                    <tr v-for="(row, index) in displayData" :key="row.id">
                                        <th>{{ index+1 }}</th>
                                        <td>{{ row.name }}</td>
                                        <td v-if="row.id < 0">
                                            <a class="btn btn-danger white"> KOSONG</a>
                                        </td>
                                        <td v-else class="text-center">
                                            <a :href="'file/' + row.id" target="_blank" download class="btn btn-success white"> Download</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </v-table>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            calons: [],
            berkas: [],
            filters: {
                name: {
                    value: "",
                    keys: ["uruts", "name", "unit"]
                }
            },
            currentPage: 1,
            totalPages: 0,
            form: new Form({
                id: "",
                uruts: "",
                name: "",
            })
        };
    },

    methods: {
        listData() {
            this.$Progress.start();
            axios.get("../api/indexadmin/1001")
                .then(({ data }) => (this.calons = data));
            this.$Progress.finish();
        },

        detailModal(detail) {
            this.form.reset();
            $("#detailModal").modal("show");
                axios.get("../api/berkas/"+detail.id)
                .then(({ data }) => (this.berkas = data));
            this.form.fill(detail);
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

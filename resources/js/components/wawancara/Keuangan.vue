<template>
<div class="justify-content-center d-flex align-items-center">
  <div class="card col-md-12 p-2">
    <div class="card-header">
      <div class="d-flex justify-content-between">
        <h3 class="card-title">Data Calon Siswa</h3>
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
          <v-th sortKey="uruts">No. Pendaftaran</v-th>
          <th sortKey="uruts">No. VA BJB Syariah</th>
          <v-th sortKey="name">Nama</v-th>
          <v-th sortKey="name">Pewawancara</v-th>
          <th>Aksi</th>
        </thead>
        <tbody slot="body" slot-scope="{displayData}">
          <tr v-for="(row, index) in displayData" :key="row.id">
            <th>{{ index+((currentPage-1) * 7)+1 }}</th>
            <td class="text-center">{{ row.uruts }}</td>
            <td class="text-center">888 276 {{ row.uruts }} 0</td>
            <td>{{ row.name }}</td>
            <td>{{ row.ygwawancara }}</td>
            <td class="text-center">
              <a v-if="!row.ygwawancara" class="btn btn-success" :href="'/keuangan/' + row.id">Wawancara</a>
              <a v-if="row.ygwawancara" class="btn btn-danger" :href="'/PDFkeuangan/' + row.id">Print</a>
            </td>
          </tr>
        </tbody>
      </v-table>
      <smart-pagination
        :currentPage.sync="currentPage"
        :totalPages="totalPages"
        :maxPageLinks="5"
        :boundaryLinks="true"
        class="float-right"
      />
    </div>
  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      calons: [],
      filters: {
        name: {
          value: "",
          keys: ["uruts", "name"]
        }
      },
      currentPage: 1,
      totalPages: 0,
    };
  },

  methods: {
    listData() {
      this.$Progress.start();
        axios.get("../api/indexadmin/1000")
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

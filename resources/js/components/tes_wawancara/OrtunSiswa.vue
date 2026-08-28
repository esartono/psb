<template>
<div class="justify-content-center d-flex align-items-center">
  <div class="card col-md-12 p-2">
    <div class="card-header">
      <div class="d-flex justify-content-between">
        <h3 class="card-title">Data Calon Siswa</h3>
        <div class="card-tools">
          <!-- <a :href="/EksportTesWawancara/" class="btn btn-sm btn-warning mr-2 ml-1">
            <i class="fas fa-file-excel"></i>
              Export
          </a> -->
          <a @click="exportModal" class="btn btn-sm btn-info mr-2 ml-1 text-white">
            <i class="fas fa-file-excel"></i>
              Export Data
          </a>
          <div class="input-group input-group-sm" style="width: 350px;">
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
    </div>
    <div class="card-body">
      <v-table
        :data="calons"
        :filters="filters"
        :currentPage.sync="currentPage"
        :pageSize="pageSize"
        @totalPagesChanged="totalPages = $event"
        class="table table-sm table-bordered table-hover table-head-fixed"
      >
        <thead slot="head">
          <th>No.</th>
          <v-th sortKey="uruts">No. Pendaftaran</v-th>
          <v-th sortKey="name">Nama</v-th>
          <v-th sortKey="unit">Unit</v-th>
          <v-th sortKey="kelas">Kelas</v-th>
          <v-th sortKey="pewawancara">Pewawancara</v-th>
          <v-th sortKey="instrumen">Instrumen</v-th>
          <v-th sortKey="total">Skor <br> (skala 100)</v-th>
          <th width="12%">Aksi</th>
        </thead>
        <tbody slot="body" slot-scope="{displayData}">
          <tr v-for="(row, index) in displayData" :key="row.id" v-bind:style= "[row.pindahan > 0 ? {'background': '#FFE07D'} : '']">
            <th>{{ index+((currentPage-1) * pageSize)+1 }}</th>
            <td class="text-center">{{ row.uruts }}</td>
            <td>{{ row.name | Judul }}</td>
            <td>{{ row.unit }}</td>
            <td class="text-center">{{ row.kelas }}</td>
            <td>{{ row.pewawancara }}</td>
            <td>{{ row.instrumen }}</td>
            <td class="text-center">{{ row.total }}</td>
            <td class="text-center">
              <a v-if="row.status == 1 " class="btn btn-danger btn-sm" :href="'/PDFwawancara/' + row.id">Print</a>
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
    <!-- Modal -->
      <div
        class="modal fade"
        id="exportModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exportModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form @submit.prevent="exportData()">
              <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Form Export Data Wawancara</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Pilih Unit</label>
                  <div class="col-sm-8">
                    <select v-model="form.unit_id" name="unit_id" class="form-control" id="unit_id" required>
                      <option value="All">Semua Unit</option>
                      <option v-for="unit in units" :key="unit.id" v-bind:value="unit.id">{{ unit.name }}</option>
                    </select>
                    <has-error :form="form" field="unit_id"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Pilih Export/Print</label>
                  <div class="col-sm-8">
                    <select v-model="form.export" name="unit_id" class="form-control" id="unit_id" required>
                      <option value="excel">Export to Excel</option>
                      <option value="pdf">Print to PDF</option>
                    </select>
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
</div>
</template>

<script>
export default {
  data() {
    return {
      calons: [],
      units: {},
      filters: {
        name: {
          value: "",
          keys: ["uruts", "name", "pewawancara", "unit"]
        }
      },
      pageSize: 12,
      currentPage: 1,
      totalPages: 0,
      form: new Form({
        unit_id: 'All',
        export: 'excel',
      }),
    };
  },

  methods: {
    listData() {
      this.$Progress.start();
        axios.get("../api/indexadmin/1002")
          .then(({ data }) => (this.calons = data));
        this.$Progress.finish();
      },
    
    exportModal() {
      $("#exportModal").modal("show");
    },

    exportData() {
      window.open("/EksportDataTesWawancara/"+this.form.export+"/"+this.form.unit_id, '_blank');
      this.closeModal();
    },
    
    closeModal() {
      $("#exportModal").modal("hide");
      this.modalOnHidden();
    },

    modalOnHidden() {
      this.form.reset();
    }

  },

  created() {
    this.listData();
    Fire.$on("listData", () => {
      this.listData();
    });
  },

  mounted() {
    axios
      .get("../api/unit_wawancara")
      .then(({ data }) => (this.units = data));

      $("#exportModal").on("hidden.bs.modal", this.modalOnHidden);
  }
};
</script>

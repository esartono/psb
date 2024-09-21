<template>

  <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card border-primary">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> Daftar Bukti Pembayaran SPP
                      <div class="search-form float-right mr-1">
                        <div class="input-group input-group-sm">
                          <input
                            class="form-control"
                            v-model="filters.name.value"
                            type="text"
                            name="search"
                            placeholder="Cari data ..."
                          >
                          <div class="input-group-append">
                            <span class="input-group-append" @click="listData">
                              <button class="btn btn-secondary btn-sm" type="button">
                                <i class="fas fa-search"></i>
                              </button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <v-table
                        :data="bayarspp"
                        :filters="filters"
                        :currentPage.sync="currentPage"
                        :pageSize="10"
                        @totalPagesChanged="totalPages = $event"
                        class="table table-responsive-sm table-bordered table-striped table-sm"
                      >
                        <thead slot="head">
                          <th>No.</th>
                          <v-th sortKey="calonnya.uruts">NIS</v-th>
                          <v-th sortKey="calonnya.name">Nama Lengkap</v-th>
                          <v-th sortKey="calonnya.unitnya">Unit</v-th>
                          <th>tanggal Bayar</th>
                          <th>Jumlah Bayar</th>
                          <th>Status</th>
                          <th>Aksi</th>
                        </thead>
                        <tbody slot="body" slot-scope="{displayData}">
                          <tr v-for="(row, index) in displayData" :key="row.id">
                            <td class="text-center">{{ index+((currentPage-1) * 10)+1 }}</td>
                            <td class="text-center">{{ row.calonnya.uruts }}</td>
                            <td>{{ row.calonnya.name }}</td>
                            <td class="text-center">{{ row.calonnya.unitnya }}</td>
                            <td class="text-center">{{ row.tanggal_bayar | Tanggal }}</td>
                            <td class="text-center">{{ row.jumlahbayar | toCurrency }}</td>
                            <td class="text-center"><a @click="lihatGambar(row.calonnya.uruts)" class="btn btn-info btn-sm">Lihat Bukti</a></td>
                            <td class="text-center">
                              <a v-if="row.verifikasi == 0" @click="cekStatus(row)" class="btn btn-danger btn-sm">
                                Belum diverifikasi
                              </a>
                              <a v-if="row.verifikasi == 1" @click="cekStatus(row)" class="btn btn-success btn-sm">
                                <i class="fas fa-check-circle white"></i> Sudah terverifikasi
                              </a>
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
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel">Dokumen SPP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <img v-bind:src="'/lihatspp/' + buktinya" style="width:100%; max-width:400px;">
                        </div>
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
        bayarspp: [],
        filters: {
          name: { value: "", keys: ["calonnya.uruts", "calonnya.unitnya","calonnya.name"] }
        },
        currentPage: 1,
        totalPages: 0,
        buktinya: "",
      };
    },
  
    methods: {
      listData() {
        this.$Progress.start();
        axios.get("bayarSPP").then(({ data }) => (this.bayarspp = data));
        this.$Progress.finish();
      },

      cekStatus(row) {
        axios.post("bayarSPP", row)
        .then(() => {
            Fire.$emit("listData");
            Toast.fire({
              type: "success",
              title: "Data pembayaran telah terverifikasi"
            });
            this.$Progress.finish();
          })
          .catch(() => {
            this.$Progress.fail();
          });
      },

      lihatGambar(urut) {
        $("#detailModal").modal("show");
        this.buktinya = urut;
      }
    },
  
    created() {
      this.listData();
      Fire.$on("listData", () => {
        this.listData();
      });
    },
  
    mounted() {
    }
  };
  </script>
  
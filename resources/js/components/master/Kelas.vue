<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card border-info">
          <div class="card-header bg-info">
            <h3 class="card-title">Daftar Kelas</h3>

            <div class="card-tools">
              <a class="btn btn-sm btn-danger" @click="addModal">
                <i class="fas fa-plus"></i> Tambah Data
              </a>
              <a href="/EksportKelas" class="btn btn-sm btn-success">
                <i class="fas fa-file-excel"></i>
                Ekspor
              </a>
              <div class="input-group input-group-sm mt-1" style="width: 150px;">
                <input
                  v-model="filters.name.value"
                  type="text"
                  name="search"
                  class="form-control float-right"
                  placeholder="Cari data ..."
                />
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="fas fa-search"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body p-0">
            <v-table
              :data="kelasnyas"
              :filters="filters"
              :currentPage.sync="currentPage"
              :pageSize="8"
              @totalPagesChanged="totalPages = $event"
              class="table table-bordered table-hover table-head-fixed"
            >
              <thead slot="head">
                <th>No.</th>
                <v-th sortKey="name">Nama Kelas</v-th>
                <th>Unit</th>
                <th>Siswa Baru</th>
                <th>Kelas Putra/Putri</th>
                <th>Jurusan</th>
                <th>Aksi</th>
              </thead>
              <tbody slot="body" slot-scope="{displayData}">
                <tr v-for="(row, index) in displayData" :key="row.id">
                  <th>{{ index+((currentPage-1) * 7)+1 }}</th>
                  <td class="text-center">{{ row.name }}</td>
                  <td class="text-center">{{ row.unitnya.name }}</td>
                  <td class="text-center">{{ statusnya.data[row.status].name }}</td>
                  <td class="text-center">{{ kelasnya.data[row.kelamin].name }}</td>
                  <td class="text-center">{{ row.jurusan }}</td>
                  <td class="text-center">
                    <a href="#" @click="editModal(row)">
                      <i class="fas fa-edit blue"></i>
                    </a>
                    /
                    <a href="#" @click="deleteData(row.id)">
                      <i class="fas fa-trash red"></i>
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
      <!-- Modal -->
      <div
        class="modal fade"
        id="addModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="addModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form @submit.prevent="editmode ? updateData() : createData()">
              <div class="modal-header">
                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Tambah Data Kelas</h5>
                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Data Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nama Kelas</label>
                  <div class="col-sm-8">
                    <input
                      v-model="form.name"
                      type="text"
                      name="name"
                      class="form-control"
                      :class="{ 'is-invalid':form.errors.has('name') }"
                      id="name"
                      placeholder="Nama Kelas"
                    />
                    <has-error :form="form" field="name"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Unit Sekolah</label>
                  <div class="col-sm-8">
                    <select v-model="form.unit_id" name="unit_id" class="form-control" id="unit_id">
                      <option
                        v-for="unit in units"
                        :key="unit.id"
                        v-bind:value="unit.id"
                      >{{ unit.name }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Status</label>
                  <div class="col-sm-8">
                    <select v-model="form.status" name="status" class="form-control" id="status">
                      <option v-for="status in statusnya.data" :key="status.id"
                              v-bind:value="status.id">{{ status.name }}</option>
                    </select>
                    <has-error :form="form" field="status"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Kelas Putra/Putri</label>
                  <div class="col-sm-8">
                    <select v-model="form.kelamin" name="kelamin" class="form-control" id="kelamin">
                      <option v-for="kelamin in kelasnya.data" :key="kelamin.id"
                              v-bind:value="kelamin.id">{{ kelamin.name }}</option>
                    </select>
                    <has-error :form="form" field="kelamin"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Jurusan</label>
                  <div class="col-sm-8">
                    <select v-model="form.jurusan" name="jurusan" class="form-control" id="jurusan">
                      <option v-for="jurusan in jurusannya.data" :key="jurusan.id"
                              v-bind:value="jurusan.id">{{ jurusan.name }}</option>
                    </select>
                    <has-error :form="form" field="jurusan"></has-error>
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
      editmode: false,
      statusnya: {
        data: [{
            'id': 0,
            'name': 'Tidak Tersedia'
          },
          {
            'id': 1,
            'name': 'Tersedia'
          }
        ]},
      kelasnya: {
        data: [{
            'id': 0,
            'name': 'Putra dan Putri'
          },
          {
            'id': 1,
            'name': 'Putra'
          },
          {
            'id': 2,
            'name': 'Putri'
          }
        ]},
      jurusannya: {
        data: [{
            'id': 'TIDAK',
            'name': 'Tidak Ada/Semua Jurusan'
          },
          {
            'id': 'MIPA',
            'name': 'MIPA'
          },
          {
            'id': 'IPS',
            'name': 'IPS'
          }
        ]},
      units: {},
      kelasnyas: [],
      filters: {
        name: { value: "", keys: ["name", "unitnya.name"] }
      },
      currentPage: 1,
      totalPages: 0,
      form: new Form({
        id: "",
        name: "",
        unit_id: "",
        status: 1,
        kelamin: 0,
        jurusan: 'TIDAK'
      })
    };
  },

  methods: {
    listData() {
      this.$Progress.start();
      axios.get("../api/kelasnyas").then(({ data }) => (this.kelasnyas = data));
      this.$Progress.finish();
    },

    addModal() {
      this.editmode = false;
      this.form.reset();
      $("#addModal").modal("show");
    },

    createData() {
      this.$Progress.start();
      this.form
        .post("../api/kelasnyas")
        .then(() => {
          $("#addModal").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Tambah Data Kelas Berhasil"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    editModal(kelas) {
      this.editmode = true;
      this.form.reset();
      $("#addModal").modal("show");
      this.form.fill(kelas);
    },

    updateData() {
      this.$Progress.start();
      this.form
        .put("../api/kelasnyas/" + this.form.id)
        .then(() => {
          $("#addModal").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Berhasil Update Data Kelas"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    deleteData(id) {
      Swal.fire({
        title: "Delete Data Kelas",
        text: "Apakah anda yakin ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "green",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal"
      }).then(result => {
        if (result.value) {
          this.form
            .delete("../api/kelasnyas/" + id)
            .then(() => {
              Swal.fire("Berhasil!", "Data Kelas telah di hapus.", "success");
              Fire.$emit("listData");
            })
            .catch(() => {
              Swal.fire(
                "gagal!",
                "Ada yang salah, hubungi Developer",
                "warning"
              );
            });
        }
      });
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
      .get("../api/units")
      .then(({ data }) => (this.units = data));
    $("#addModal").on("hidden.bs.modal", this.modalOnHidden);
  }
};
</script>

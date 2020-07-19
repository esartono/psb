<template>
  <div class="main">
    <div class="container-fluid">
      <div id="ui-view">
        <div>
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <i class="fa fa-align-justify"></i> Daftar Nama Siswa SIT Nurul Fikri
                    <!-- Button trigger modal -->
                    <a class="btn btn-sm btn-primary mr-1" @click="addModal">
                      <i class="fas fa-plus"></i> Tambah Data
                    </a>
                    <a
                      class="btn btn-sm btn-success mr-1"
                      data-toggle="modal"
                      data-target="#importModel"
                    >
                      <i class="fas fa-file-excel"></i>
                      Import
                    </a>
                    <a href="/EksportUser" class="btn btn-sm btn-warning mr-1">
                      <i class="fas fa-file-excel"></i>
                      Export
                    </a>
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
                      :data="siswanfs"
                      :filters="filters"
                      :currentPage.sync="currentPage"
                      :pageSize="10"
                      @totalPagesChanged="totalPages = $event"
                      class="table table-responsive-sm table-bordered table-striped table-sm"
                    >
                      <thead slot="head">
                        <th>No.</th>
                        <v-th sortKey="nis">NIS</v-th>
                        <v-th sortKey="nama">Nama Lengkap</v-th>
                        <th>JK</th>
                        <th>Unit</th>
                        <th>Tahun Pelajaran</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                      </thead>
                      <tbody slot="body" slot-scope="{displayData}">
                        <tr v-for="(row, index) in displayData" :key="row.id">
                          <td class="text-center">{{ index+((currentPage-1) * 10)+1 }}</td>
                          <td class="text-center">{{ row.nis }}</td>
                          <td>{{ row.name }}</td>
                          <td class="text-center">{{ row.kelamin }}</td>
                          <td class="text-center">{{ row.unitnya.name }}</td>
                          <td class="text-center">{{ row.tpnya.name }}</td>
                          <td class="text-center">{{ row.kelasnya.name }}</td>
                          <td class="text-center">
                            <a href="#" @click="editModal(row)">
                              <i class="fas fa-edit blue"></i>
                            </a>
                            /
                            <a
                              href="#"
                              @click="deleteData(row.id)"
                            >
                              <i class="fas fa-trash red"></i>
                            </a>
                            <!--                             /
                            <router-link
                              href="#"
                              :to="{ name: '/users', params: { user: row.user_id }}"
                            >
                              <i class="fas fa-user-circle cyan"></i>
                            </router-link>-->
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
                        <h5
                          class="modal-title"
                          v-show="!editmode"
                          id="addModalLabel"
                        >Form Tambah Data Siswa SIT Nurul Fikri</h5>
                        <h5
                          class="modal-title"
                          v-show="editmode"
                          id="addModalLabel"
                        >Form Edit Data Siswa SIT Nurul Fikri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">NIS</label>
                          <div class="col-sm-8">
                            <input
                              v-model="form.nis"
                              type="text"
                              name="nis"
                              class="form-control"
                              :class="{ 'is-invalid':form.errors.has('nis') }"
                              id="nis"
                              placeholder="NIS"
                            >
                            <has-error :form="form" field="nis"></has-error>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Nama Lengkap</label>
                          <div class="col-sm-8">
                            <input
                              v-model="form.name"
                              type="text"
                              name="name"
                              class="form-control"
                              :class="{ 'is-invalid':form.errors.has('name') }"
                              id="name"
                              placeholder="Nama Lengkap"
                            >
                            <has-error :form="form" field="name"></has-error>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-8">
                                <select v-model="form.jk" name="jk" class="form-control" id="jk">
                                    <option value=1>Laki-Laki</option>
                                    <option value=2>Perempuan</option>
                                </select>
                                <has-error :form="form" field="jk"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tahun Pelajaran</label>
                            <div class="col-sm-8">
                                <select v-model="form.tp" name="tp" class="form-control" id="tp">
                                <option
                                    v-for="tp in tps"
                                    :key="tp.id"
                                    v-bind:value="tp.id"
                                >{{ tp.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Unit Sekolah</label>
                            <div class="col-sm-8">
                                <select 
                                    v-model="form.unit"
                                    name="unit"
                                    class="form-control"
                                    id="unit"
                                    v-on:change="listKelas(form.unit)"
                                >
                                <option
                                    v-for="unit in units"
                                    :key="unit.id"
                                    v-bind:value="unit.id"
                                >{{ unit.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Kelas</label>
                            <div class="col-sm-8">
                                <select v-model="form.kelas" name="kelas" class="form-control" id="kelas">
                                <option
                                    v-for="kls in kelass"
                                    :key="kls.id"
                                    v-bind:value="kls.id"
                                >{{ kls.name }}</option>
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
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="importModel"
      tabindex="-1"
      role="dialog"
      aria-labelledby="importModelLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="importModelLabel">Import Excel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Import Data Pegawai</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Upload</span>
                </div>
                <div class="custom-file">
                  <input
                    type="file"
                    name="file"
                    ref="file"
                    class="custom-file-input"
                    id="fileInput"
                    accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                    v-on:change="handleFileUpload()"
                    :class="{ 'is-invalid': form.errors.has('file') }"
                  >
                  <label class="custom-file-label" for="fileInput">Pilih File ...</label>
                </div>
              </div>
            </div>
            <label>
              <code>
                <b>{{ status_upload }}</b>
              </code>
            </label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button
              type="submit"
              @click.stop.prevent="importData()"
              class="btn btn-primary"
            >Import Data Siswa SIT Nurul Fikri</button>
          </div>
        </div>
      </div>
    </div>

    <!--Exit Modal-->
  </div>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      units: {},
      kelass: {},
      tps: {},
      siswanfs: [],
      filters: {
        name: { value: "", keys: ["name", "nis"] }
      },
      currentPage: 1,
      totalPages: 0,
      file: "",
      status_upload: "",
      form: new Form({
        nis: "",
        name: "",
        jk: "",
        unit: "",
        tp: "",
        kelas: ""
      })
    };
  },

  methods: {
    listData() {
      this.$Progress.start();
      axios.get("api/siswanfs").then(({ data }) => (this.siswanfs = data));
      this.$Progress.finish();
    },

    handleFileUpload() {
      this.file = this.$refs.file.files[0];
    },

    listKelas() {
      axios
        .get("../api/kelasnya/" + this.form.unit)
        .then(({ data }) => (this.kelass = data));
    },

    importData() {
      this.status_upload = "Tunggu Sampai Selesai";
      this.$Progress.start();
      let formData = new FormData();
      formData.append("file", this.file);

      axios
        .post("ImportSiswaNF", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(() => {
          $("#importModel").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Berhasil Import Data Siswa SIT Nurul Fikri"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          $("#importModel").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "error",
            title: "Gagal Import Data Siswa SIT Nurul Fikri"
          });

          this.$Progress.fail();
        });
    },

    addModal() {
      this.editmode = false;
      this.form.reset();
      $("#addModal").modal("show");
    },

    createData() {
      this.$Progress.start();
      this.form
        .post("api/siswanfs")
        .then(() => {
          $("#addModal").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Tambah Data Siswa SIT Nurul Fikri Berhasil"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    editModal(siswanf) {
      this.editmode = true;
      this.form.reset();
      $("#addModal").modal("show");
      this.form.fill(siswanf);
    },

    updateData() {
      this.$Progress.start();
      this.form
        .put("api/siswanfs/" + this.form.id)
        .then(() => {
          $("#addModal").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Berhasil Update Data Siswa SIT Nurul Fikri"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    deleteData(id) {
      Swal.fire({
        title: "Delete Data Siswa SIT Nurul Fikri",
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
            .delete("api/siswanfs/" + id)
            .then(() => {
              Swal.fire("Berhasil!", "Data Siswa SIT Nurul Fikri telah di hapus.", "success");
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
      this.$refs.file.type = 'text';
      this.$refs.file.type = 'file';
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
    axios
        .get("../api/tps")
        .then(({ data }) => (this.tps = data));
    $("#addModal").on("hidden.bs.modal", this.modalOnHidden);
    $("#importModel").on("hidden.bs.modal", this.modalOnHidden);
  }
};
</script>

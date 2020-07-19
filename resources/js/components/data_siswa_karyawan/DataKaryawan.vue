<template>

<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9">
        <div class="card border-primary">
                  <div class="card-header">
                    <i class="fa fa-align-justify"></i> Daftar Nama Pegawai
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
                      :data="pegawais"
                      :filters="filters"
                      :currentPage.sync="currentPage"
                      :pageSize="10"
                      @totalPagesChanged="totalPages = $event"
                      class="table table-responsive-sm table-bordered table-striped table-sm"
                    >
                      <thead slot="head">
                        <th>No.</th>
                        <v-th sortKey="nis">NIP</v-th>
                        <v-th sortKey="nama">Nama Lengkap</v-th>
                        <th>JK</th>
                        <th>Aksi</th>
                      </thead>
                      <tbody slot="body" slot-scope="{displayData}">
                        <tr v-for="(row, index) in displayData" :key="row.id">
                          <td class="text-center">{{ index+((currentPage-1) * 10)+1 }}</td>
                          <td class="text-center">{{ row.nip }}</td>
                          <td>{{ row.name }}</td>
                          <td class="text-center">{{ row.kelamin }}</td>
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
                        >Form Tambah Data Pegawai</h5>
                        <h5
                          class="modal-title"
                          v-show="editmode"
                          id="addModalLabel"
                        >Form Edit Data Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">No. Induk Pegawai</label>
                          <div class="col-sm-8">
                            <input
                              v-model="form.nip"
                              type="text"
                              name="nip"
                              class="form-control"
                              :class="{ 'is-invalid':form.errors.has('nip') }"
                              id="nis"
                              placeholder="NIP"
                            >
                            <has-error :form="form" field="nip"></has-error>
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
            >Import Data Pegawai</button>
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
      pegawais: [],
      filters: {
        name: { value: "", keys: ["name", "nip"] }
      },
      currentPage: 1,
      totalPages: 0,
      file: "",
      status_upload: "",
      form: new Form({
        nip: "",
        name: "",
        jk: "",
      })
    };
  },

  methods: {
    listData() {
      this.$Progress.start();
      axios.get("api/pegawais").then(({ data }) => (this.pegawais = data));
      this.$Progress.finish();
    },

    handleFileUpload() {
      this.file = this.$refs.file.files[0];
    },

    importData() {
      this.status_upload = "Tunggu Sampai Selesai";
      this.$Progress.start();
      let formData = new FormData();
      formData.append("file", this.file);

      axios
        .post("ImportPegawai", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(() => {
          $("#importModel").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Berhasil Import Data Pegawai"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          $("#importModel").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "error",
            title: "Gagal Import Data Pegawai"
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
        .post("api/pegawais")
        .then(() => {
          $("#addModal").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Tambah Data Pegawai Berhasil"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    editModal(pegawai) {
      this.editmode = true;
      this.form.reset();
      $("#addModal").modal("show");
      this.form.fill(pegawai);
    },

    updateData() {
      this.$Progress.start();
      this.form
        .put("api/pegawais/" + this.form.id)
        .then(() => {
          $("#addModal").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Berhasil Update Data Pegawai"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    deleteData(id) {
      Swal.fire({
        title: "Delete Data Pegawi",
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
            .delete("api/pegawais/" + id)
            .then(() => {
              Swal.fire("Berhasil!", "Data Pegawai telah di hapus.", "success");
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
    $("#addModal").on("hidden.bs.modal", this.modalOnHidden);
    $("#importModel").on("hidden.bs.modal", this.modalOnHidden);
  }
};
</script>

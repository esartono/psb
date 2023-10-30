<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card border-info">
          <div class="card-header bg-info">
            <h3 class="card-title">Daftar Nama Administrator</h3>

            <div class="card-tools">
              <div class="mt-1 input-group input-group-sm" style="width: 150px;">
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
              :data="admins"
              :filters="filters"
              :currentPage.sync="currentPage"
              :pageSize="7"
              @totalPagesChanged="totalPages = $event"
              class="table table-bordered table-hover table-head-fixed"
            >
              <thead slot="head">
                <th>No.</th>
                <v-th sortKey="name">Nama</v-th>
                <v-th sortKey="name">Email</v-th>
                <th>No. Ponsel</th>
                <th>Reset Password</th>
                <th>Aksi</th>
              </thead>
              <tbody slot="body" slot-scope="{displayData}">
                <tr v-for="(row, index) in displayData" :key="row.id">
                  <th>{{ index+((currentPage-1) * 7)+1 }}</th>
                  <td>{{ row.name }}</td>
                  <td>{{ row.email }}</td>
                  <td>{{ row.phone }}</td>
                  <td class="text-center">
                    <a href="#" @click="resetPass(row.id)" class="btn btn-sm btn-warning">
                      <i class="fas fa-key blue"> Reset</i>
                    </a>
                  </td>
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
                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Tambah Data Admin</h5>
                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Data Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
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
                    />
                    <has-error :form="form" field="name"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">E-Mail</label>
                  <div class="col-sm-8">
                    <input
                      v-model="form.email"
                      type="email"
                      name="email"
                      class="form-control"
                      :class="{ 'is-invalid':form.errors.has('email') }"
                      id="email"
                      placeholder="email@nurulfikri.sch.id"
                    />
                    <has-error :form="form" field="email"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">No. Ponsel</label>
                  <div class="col-sm-8">
                    <input
                      v-model="form.phone"
                      type="text"
                      name="phone"
                      class="form-control"
                      :class="{ 'is-invalid':form.errors.has('phone') }"
                      id="phone"
                    />
                    <has-error :form="form" field="name"></has-error>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" v-if="(form.id > 1)">Simpan</button>
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
      admins: [],
      filters: {
        name: { value: "", keys: ["name"] }
      },
      currentPage: 1,
      totalPages: 0,
      form: new Form({
        id: "",
        name: "",
        email: "",
        phone: "",
        password: ""
      })
    };
  },

  methods: {
    listData() {
      this.$Progress.start();
      axios.get("../api/admins").then(({ data }) => (this.admins = data));
      this.$Progress.finish();
    },

    resetPass(id) {
      axios
        .post("../api/rpass/" + id)
        .then(() => {
          $("#addModal").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Berhasil Update Data User"
          });
          this.$Progress.finish();
        })
        .catch(() => {
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
        .post("../api/admins")
        .then(() => {
          $("#addModal").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Tambah Data Admin Berhasil"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    editModal(admin) {
      this.editmode = true;
      this.form.reset();
      $("#addModal").modal("show");
      this.form.fill(admin);
    },

    updateData() {
      this.$Progress.start();
      this.form
        .put("../api/admins/" + this.form.id)
        .then(() => {
          $("#addModal").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Berhasil Update Data Admin"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    deleteData(id) {
      Swal.fire({
        title: "Delete Data Admin",
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
            .delete("../api/admins/" + id)
            .then(() => {
              Swal.fire("Berhasil!", "Data Admin telah di hapus.", "success");
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
    $("#addModal").on("hidden.bs.modal", this.modalOnHidden);
  }
};
</script>

<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card border-info">
          <div class="card-header bg-info">
            <h3 class="card-title">Daftar Nama User</h3>
            <div class="card-tools">
              <a class="btn btn-sm btn-danger" @click="addModal">
                <i class="fas fa-plus"></i> Tambah Data
              </a>
              <a href="/EksportUser" class="btn btn-sm btn-success">
                <i class="fas fa-file-excel"></i>
                Ekspor
              </a>
              <div class="input-group input-group-sm" style="width: 150px;">
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
              :data="users"
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
                <th>No. Handphone</th>
                <th>Aksi</th>
              </thead>
              <tbody slot="body" slot-scope="{displayData}">
                <tr v-for="(row, index) in displayData" :key="row.id">
                  <th>{{ index+((currentPage-1) * 7)+1 }}</th>
                  <td>{{ row.name }}</td>
                  <td>{{ row.email }}</td>
                  <td>{{ row.phone }}</td>
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
                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Tambah Data User</h5>
                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Data User</h5>
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
                  <label class="col-sm-4 col-form-label">Password</label>
                  <div class="col-sm-8">
                    <input
                      v-model="form.password"
                      type="password"
                      name="password"
                      class="form-control"
                      :class="{ 'is-invalid':form.errors.has('password') }"
                      id="password"
                    />
                    <has-error :form="form" field="passwords"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">No. Handphone</label>
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
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Level</label>
                  <div class="col-sm-8">
                    <select v-model="form.level" name="level" class="form-control" id="level">
                      <option
                        v-for="level in levels"
                        :key="level.id"
                        v-bind:value="level.id"
                      >{{ level.name }}</option>
                    </select>
                    <has-error :form="form" field="level"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Unit</label>
                  <div class="col-sm-8">
                    <select v-model="form.unit_id" name="unit_id" class="form-control" id="unit_id">
                      <option
                        v-for="unit in units"
                        :key="unit.id"
                        v-bind:value="unit.id"
                      >{{ unit.name }}</option>
                    </select>
                    <has-error :form="form" field="unit_id"></has-error>
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
      users: [],
      units: [],
      levels: [],
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
        password: "",
        level: "",
        unit_id: ""
      })
    };
  },

  methods: {
    listData() {
      this.$Progress.start();
      axios.get("../api/users").then((data) => {
        this.users = data.data.user
        this.levels = data.data.level
        this.units = data.data.unit
      });
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
        .post("../api/users")
        .then(() => {
          $("#addModal").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Tambah Data User Berhasil"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    editModal(user) {
      this.editmode = true;
      this.form.reset();
      $("#addModal").modal("show");
      this.form.fill(user);
    },

    updateData() {
      this.$Progress.start();
      this.form
        .put("../api/users/" + this.form.id)
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

    deleteData(id) {
      Swal.fire({
        title: "Delete Data User",
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
            .delete("../api/users/" + id)
            .then(() => {
              Swal.fire("Berhasil!", "Data User telah di hapus.", "success");
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
    this.listData();
    $("#addModal").on("hidden.bs.modal", this.modalOnHidden);
  }
};
</script>

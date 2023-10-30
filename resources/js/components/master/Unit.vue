<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card border-info">
          <div class="card-header bg-info">
            <h3 class="card-title">Daftar Unit</h3>

            <div class="card-tools">
              <a class="btn btn-sm btn-danger" @click="addModal">
                <i class="fas fa-plus"></i> Tambah Data
              </a>
              <a href="/EksportUnit" class="btn btn-sm btn-success">
                <i class="fas fa-file-excel"></i>
                Ekspor
              </a>
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
              :data="units"
              :filters="filters"
              :currentPage.sync="currentPage"
              :pageSize="7"
              @totalPagesChanged="totalPages = $event"
              class="table table-bordered table-hover table-head-fixed"
            >
              <thead slot="head">
                <th>No.</th>
                <v-th sortKey="name">Nama</v-th>
                <v-th sortKey="name">Kategori</v-th>
                <th>Logo</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No. Ponsel</th>
                <th>Aksi</th>
              </thead>
              <tbody slot="body" slot-scope="{displayData}">
                <tr v-for="(row, index) in displayData" :key="row.id">
                  <th>{{ index+((currentPage-1) * 7)+1 }}</th>
                  <td width="150px">{{ row.name }}</td>
                  <td class="text-center">{{ row.catnya.name }}</td>
                  <td>{{ row.logo }}</td>
                  <td>{{ row.address }}</td>
                  <td width="160px">{{ row.email }}</td>
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
                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Tambah Data Unit</h5>
                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Data Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nama Unit</label>
                  <div class="col-sm-8">
                    <input
                      v-model="form.name"
                      type="text"
                      name="name"
                      class="form-control"
                      :class="{ 'is-invalid':form.errors.has('name') }"
                      id="name"
                      placeholder="Nama Unit"
                    />
                    <has-error :form="form" field="name"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Kategori Sekolah</label>
                  <div class="col-sm-8">
                    <select v-model="form.cat_id" name="cat_id" class="form-control" id="cat_id">
                      <option
                        v-for="cats in category"
                        :key="cats.id"
                        v-bind:value="cats.id"
                      >{{ cats.name }}</option>
                    </select>
                    <has-error :form="form" field="name"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Logo</label>
                  <div class="col-sm-8">
                    <input
                      v-model="form.logo"
                      type="text"
                      name="logo"
                      class="form-control"
                      :class="{ 'is-invalid':form.errors.has('logo') }"
                      id="logo"
                      placeholder="logo"
                    />
                    <has-error :form="form" field="logo"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Alamat</label>
                  <div class="col-sm-8">
                    <input
                      v-model="form.address"
                      type="text"
                      name="address"
                      class="form-control"
                      :class="{ 'is-invalid':form.errors.has('address') }"
                      id="address"
                    />
                    <has-error :form="form" field="address"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Email</label>
                  <div class="col-sm-8">
                    <input
                      v-model="form.email"
                      type="text"
                      name="email"
                      class="form-control"
                      :class="{ 'is-invalid':form.errors.has('email') }"
                      id="email"
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
                    <has-error :form="form" field="phone"></has-error>
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
      category: {},
      units: [],
      filters: {
        name: { value: "", keys: ["name"] }
      },
      currentPage: 1,
      totalPages: 0,
      form: new Form({
        id: "",
        name: "",
        cat_id: "",
        logo: "",
        address: "",
        email: "",
        phone: ""
      })
    };
  },

  methods: {
    listData() {
      this.$Progress.start();
      axios.get("../api/units").then(({ data }) => (this.units = data));
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
        .post("../api/units")
        .then(() => {
          $("#addModal").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Tambah Data Unit Berhasil"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    editModal(unit) {
      this.editmode = true;
      this.form.reset();
      $("#addModal").modal("show");
      this.form.fill(unit);
    },

    updateData() {
      this.$Progress.start();
      this.form
        .put("../api/units/" + this.form.id)
        .then(() => {
          $("#addModal").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Berhasil Update Data Unit"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    deleteData(id) {
      Swal.fire({
        title: "Delete Data Unit",
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
            .delete("../api/units/" + id)
            .then(() => {
              Swal.fire("Berhasil!", "Data Unit telah di hapus.", "success");
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
      .get("../api/schoolcategories")
      .then(({ data }) => (this.category = data));
    $("#addModal").on("hidden.bs.modal", this.modalOnHidden);
  }
};
</script>

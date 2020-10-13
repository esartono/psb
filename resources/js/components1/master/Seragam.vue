<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card border-info">
          <div class="card-header bg-info">
            <h3 class="card-title">Daftar Ukuran Seragam</h3>

            <div class="card-tools">
              <a class="btn btn-sm btn-danger" @click="addModal">
                <i class="fas fa-plus"></i> Tambah Data
              </a>
              <a href="/EksportUnit" class="btn btn-sm btn-success">
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
              :data="seragams"
              :filters="filters"
              :currentPage.sync="currentPage"
              :pageSize="7"
              @totalPagesChanged="totalPages = $event"
              class="table table-bordered table-hover table-head-fixed"
            >
              <thead slot="head">
                <th>No.</th>
                <v-th sortKey="name">Tingkatan</v-th>
                <v-th sortKey="name">Jenis Kelamin</v-th>
                <th>Jenis</th>
                <th>Ukuran</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </thead>
              <tbody slot="body" slot-scope="{displayData}">
                <tr v-for="(row, index) in displayData" :key="row.id">
                  <th>{{ index+((currentPage-1) * 7)+1 }}</th>
                  <td class="text-center">{{ row.catnya.name }}</td>
                  <td class="text-center">{{ row.kelamin }}</td>
                  <td class="text-center">{{ row.jenis }}</td>
                  <td class="text-center">{{ row.ukuran }}</td>
                  <td>
                    <div v-for="(value, name) in row.keterangan" :key="name">
                      {{ name.replace('_', ' ') | Judul }} : {{ value }} cm
                    </div>
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
                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Form Tambah Ukuran Seragam</h5>
                <h5 class="modal-title" v-show="editmode" id="addModalLabel">Form Edit Ukuran Seragam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tingkatan</label>
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
                  <label class="col-sm-4 col-form-label">Jenis Seragam</label>
                  <div class="col-sm-8">
                    <select v-model="form.jenis" name="jenis" class="form-control" id="jenis">
                      <option value='Baju Atasan'>Baju Atasan</option>
                      <option value='Celana/Rok'>Celana/Rok</option>
                    </select>
                    <has-error :form="form" field="jenis"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Kode Ukuran</label>
                  <div class="col-sm-8">
                    <select v-model="form.ukuran" name="ukuran" class="form-control" id="ukuran">
                      <option
                        v-for="(value, name) in ukurannya"
                        :key="name"
                        v-bind:value="name"
                      >{{ value }}</option>
                    </select>
                    <has-error :form="form" field="ukuran"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Keterangan</label>
                  <div class="col-sm-8">
                    <table v-if="form.jenis === 'Baju Atasan'">
                      <tr>
                        <td width="130px">Lebar Bahu</td>
                        <td><input v-model="form.keterangan['lebar_bahu']" type="number" class="form-control"/></td>
                      </tr>
                      <tr>
                        <td>Lebar Dada</td>
                        <td><input v-model="form.keterangan['lebar_dada']" type="number" class="form-control"/></td>
                      </tr>
                      <tr>
                        <td>Lebar Perut</td>
                        <td><input v-model="form.keterangan['lebar_perut']" type="number" class="form-control"/></td>
                      </tr>
                      <tr>
                        <td>Panjang Badan</td>
                        <td><input v-model="form.keterangan['panjang_badan']" type="number" class="form-control"/></td>
                      </tr>
                      <tr>
                        <td>Panjang Lengan</td>
                        <td><input v-model="form.keterangan['panjang_lengan']" type="number" class="form-control"/></td>
                      </tr>
                      <tr>
                        <td>Lebar Lengan</td>
                        <td><input v-model="form.keterangan['lebar_lengan']" type="number" class="form-control"/></td>
                      </tr>
                    </table>
                    <table v-else>
                      <tr>
                        <td>Lingkar Pinggang</td>
                        <td><input v-model="form.keterangan['lingkar_pinggang']" type="number" class="form-control"/></td>
                      </tr>
                      <tr>
                        <td>Panjang Celana/Rok</td>
                        <td><input v-model="form.keterangan['panjang_celana/rok']" type="number" class="form-control"/></td>
                      </tr>
                    </table>
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
      ukurannya: {
        'XS': 'XS',
        'S': 'S',
        'M': 'M',
        'L': 'L',
        'XL': 'XL',
        '2XL': '2XL',
        '3XL': '3XL',
        '4XL': '4XL',
      },
      seragams: [],
      filters: {
        name: { value: "", keys: ["name"] }
      },
      currentPage: 1,
      totalPages: 0,
      form: new Form({
        id: "",
        cat_id: "",
        jk: 0,
        jenis: "Baju Atasan",
        ukuran:"",
        keterangan:{},
      })
    };
  },

  methods: {
    listData() {
      this.$Progress.start();
      axios.get("../api/seragams").then(({ data }) => (this.seragams = data));
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
        .post("../api/seragams")
        .then(() => {
          $("#addModal").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Tambah Ukuran Seragam Berhasil"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    editModal(seragam) {
      this.editmode = true;
      this.form.reset();
      $("#addModal").modal("show");
      this.form.fill(seragam);
    },

    updateData() {
      this.$Progress.start();
      this.form
        .put("../api/seragams/" + this.form.id)
        .then(() => {
          $("#addModal").modal("hide");
          Fire.$emit("listData");
          Toast.fire({
            type: "success",
            title: "Berhasil Update Ukuran Seragam"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    deleteData(id) {
      Swal.fire({
        title: "Delete Data Seragam",
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
            .delete("../api/seragams/" + id)
            .then(() => {
              Swal.fire("Berhasil!", "Ukuran Seragam telah di hapus.", "success");
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

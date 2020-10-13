<template>
<div class="justify-content-center d-flex align-items-center">
  <a
      class="btn btn-app btn-lg white mt-5 mr-2"
      v-for="r in reguler" :key="r.id"
      v-on:click="pilihBiaya(r.id)"
      v-bind:class="backgroundnya[r.id]">
      <i v-if="r.id == 1" class="fa fa-tags"></i>
      <i v-else-if="r.id == 2" class="fa fa-shopping-bag"></i>
      <i v-else-if="r.id == 3" class="fas fa-address-card"></i>
      {{ r.name }}
  </a>
</div>
</template>

<script>
export default {
  data() {
    return {
      tagihanpsb: [],
      reguler: [
        {
          'id': 1,
          'name': 'Reguler 1',
        },
        {
          'id': 2,
          'name': 'Reguler 2',
        },
        {
          'id': 3,
          'name': 'Reguler 3',
        },
      ],
      backgroundnya: [
        '',
        'bg-red',
        'bg-blue',
        'bg-orange',
        'bg-teal',
        'bg-green',
      ],
      form: new Form({
        id: "",
        calon_id: "",
        tagihan_id: "",
        potongan: 0,
        infaq: 0,
      })
    };
  },

  methods: {
    listData() {
      this.$Progress.start();
      axios.get("api/tagihanpsbs/"+this.eko_id).then(({ data }) => (this.tagihanpsb = data));
      this.$Progress.finish();
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
  },

  created() {
    this.listData();
    Fire.$on("listData", () => {
      this.listData();
    });
  },

};
</script>

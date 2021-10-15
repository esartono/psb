<template>
<div>
  <center>
    <a class="btn btn-app btn-lg white bg-red" v-on:click="pilihBiaya(1)">
        <i class="fa fa-tags"></i>
        Pembiayaan
    </a>
    <a class="btn btn-app btn-lg bg-teal" v-on:click="ketentuan()">
        <i class="fa fa-info"></i>
        Ketentuan Pembayaran
    </a>
    <br>
    <hr>
    <code>Tombol di bawah ini hanya boleh diklik,<br> ketika sudah menyimpan data</code><br>
    <a class="btn btn-app btn-lg black bg-yellow" v-on:click="formPotongan(1)">
        <i class="fas fa-percent"></i>
        Potongan Pembayaran
    </a>
    <a class="btn btn-app btn-lg white bg-green" :href="'/PDFkeuangan/' + this.$route.params.id">
        <i class="fas fa-file-pdf"></i>
        Print Tagihan PPDB
    </a>
  </center>
  <!-- Modal -->
  <div
    class="modal fade"
    id="addModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="addModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <form @submit.prevent="createData()">
          <!-- <div class="modal-header">
            <h5 class="modal-title" id="addModalLabel">Form Wawancara Keuangan - <code><b>{{ modelBayar }}</b></code></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->
          <div class="modal-body">
            <table class="table table-sm table-bordered">
              <tr>
                <td width="50%">
                  <table class="table table-striped table-sm" style="padding: 10px">
                    <tr v-for="b in biaya" :key="b.id">
                      <td width="55%"><label class="col-form-label">{{ b.name }}</label></td>
                      <td align="right"><label class="col-form-label">{{ tagihanpsb[b.name] | toCurrency }}</label></td>
                    </tr>
                    <tr>
                      <td><label class="col-form-label"> Infaq SIT Nurul Fikri</label></td>
                      <td><input v-model="form.infaq" type="number" name="infaq" class="form-control" min="0"/></td>
                    </tr>
                    <tr>
                      <td><label class="col-form-label"> Infaq NF Peduli</label></td>
                      <td><input v-model="form.infaqnfpeduli" type="number" name="infaq" class="form-control" min="0"/></td>
                    </tr>
                    <tr>
                      <td><label class="col-form-label"> TOTAL </label></td>
                      <td align="right"><label class="col-form-label">{{ totalBayar | toCurrency }}</label></td>
                    </tr>
                  </table>
                  <button type="button" class="btn btn-secondary col-md-4 offset-md-2" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary col-md-4">Simpan</button>
                </td>
                <td style="background-color: lightblue">
                  <center><b>Pembiayaan selama bersekolah di<br>Sekolah Islam Terpadu Nurul Fikri</b></center><br>
                  <table class="table table-sm table-bordered">
                    <tr>
                      <td colspan="2">TOTAL Biaya PPDB SIT Nurul Fikri</td>
                      <td>{{ totalBayar | toCurrency }}</td>
                    </tr>
                    <tr v-for="(k, index) in kelas" :key="index">
                      <td>{{ index }}</td>
                      <td>
                        Kelas {{ k['kelas'] }}<br>
                        <span style="font-size: 12px">{{ k['ket'] }}</span>
                        <span style="font-size: 12px">{{ k['spp'] }}</span><br>
                        <span style="font-size: 12px">{{ k['daul'] }}</span><br>
                      </td>
                      <td style="width: 120px !important;">{{ k['total'] }}</td>
                    </tr>
                    <tr>
                      <td colspan="3"><center>TOTAL Pembiayaan selama bersekolah <br> di Sekolah Islam Terpadu Nurul Fikri: <br><h4><b>{{ totalTahunan + totalBayar | toCurrency}}</b></h4></center></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Potongan -->
  <div
    class="modal fade"
    id="modalPotongan"
    tabindex="-1"
    role="dialog"
    aria-labelledby="addModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <form @submit.prevent="createData()">
          <div class="modal-body">
            <table class="table table-sm table-bordered">
              <tr>
                <td width="30%">
                  <center><b>Form Potongan Biaya PPDB<br>Sekolah Islam Terpadu Nurul Fikri</b></center><br>
                  <label class="col-form-label">Pilih Jenis Potongan :</label>
                  <select v-model="form.potongan" name="potongan" class="form-control" id="potongan">
                    <option v-for="p in pots" :key="p.id" v-bind:value="p.id">( {{ p.potongan  }}% ) -  {{ p.keterangan  }}</option>
                  </select>
                  <br>
                  <hr>
                  <label class="col-form-label">Keterangan <br><span class="badge badge-warning">diisi hanya untuk pilihan 'Memiliki Saudara di NF'</span></label>
                  <input v-model="form.saudara" type="text" name="saudara" class="form-control"/>
                  <hr>
                  <br>
                  <button type="button" class="btn btn-secondary col-md-4 offset-md-2" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary col-md-4">Simpan</button>
                </td>
                <td style="background-color: lightblue; font-size: 80%">
                  <center><b>Ketentuan Khusus Potongan Biaya PPDB</b></center><br>
                  <ol class="biasa">
                    <li>Ketentuan potongan khusus hanya berlaku jika pembayaran dilakukan lunas di rentang waktu pelunasan biaya daftar ulang (<b>30 hari setelah pengumuman</b>)</li>
                    <li>Ketentuan potongan khusus yang satu tidak dapat digabung dengan jenis potongan khusus lainnya</li>
                    <li>Jenis Potongan Khusus sebagai berikut:
                      <ol class="step1">
                        <li><div class="jarak"></div>
                          a. Potongan Saudara Kandung
                          <ol class="step2">
                            <li>Potongan Dana Pengembangan bagi calon siswa yang memiliki saudara kandung yang bersekolah di SIT Nurul Fikri, sebagai berikut:
                              <ol class="step3">
                                <li>Saudara kandung pertama mendapatkan potongan 5% dari Dana Pengembangan</li>
                                <li>Saudara kandung kedua dan seterusnya mendapatkan potongan 10% dari Dana Pengembangan</li>
                              </ol>
                            </li>
                            <li>Bagi orangtua calon siswa yang mendaftarkan lebih dari 1 siswa pada tahun pelajaran yang sama, berlaku ketentuan potongan point (1).</li>
                          </ol>
                        </li>
                        <li><div class="jarak"></div>
                          b. Potongan Internal
                          <ol class="step2">
                            <li>Potongan biaya sebesar Rp. 5.000.000 dari dana pengembangan, bagi Pendaftar SDIT Nurul Fikri yang berasal dari TKIT Nurul Fikri.</li>
                            <li>Potongan biaya sebesar 10% dari dana pengembangan bagi calon siswa berasal dari Sekolah Islam Terpadu Nurul Fikri dan Nurul Fikri Boarding School Bogor.</li>
                          </ol>
                        </li>
                        <li><div class="jarak"></div>
                          c. Potongan Prestasi
                          <ol class="step2">
                            <li>Potongan biaya 25% dari Dana Pengembangan dan bebas biaya pendaftaran bagi calon siswa yang berasal dari SIT Nurul Fikri dan NFBS Bogor yang mendapatkan undangan khusus dari YPPU Nurul Fikri.</li>
                            <li>Potongan biaya 50% dari Dana Pengembangan bagi calon siswa Pemenang Lomba Tingkat Nasional (Berjenjang) Juara 1 dan 2, yang dibuktikan dengan sertifikat dan diverifikasi oleh panitia.</li>
                            <li>Potongan biaya sebesar 15% dari Dana Pengembangan bagi calon siswa yang memiliki hafalan Al-Qur’an, sebagai berikut:
                              <ol class="step3">
                                <li>Pendaftar SD minimal 4 juz</li>
                                  <li>Pendaftar SMP minimal 8 juz</li>
                                  <li>Bagi siswa Pendaftar SMA minimal 10 juz</li>
                              </ol>
                            </li>
                            <li>Potongan biaya sebesar 50% dari Dana Pengembangan bagi calon siswa yang memiliki hafalan Al-Qur’an minimal 15 Juz dan sudah diverifikasi oleh SIT Nurul Fikri.</li>
                          </ol>
                        </li>
                      </ol>
                    </li>
                  </ol>
                </td>
              </tr>
            </table>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: ['tglbatas'],
  data() {
    return {
      tagihanpsb: {},
      kelas: {},
      total: 0,
      tampil: false,
      totalTahunan: 0,
      modelBayar: "",
      pots: [
        {
          'id': 0,
          'potongan': 0,
          'keterangan': 'Tidak ada potongan',
          'notif': 0
        },
        {
          'id': 1,
          'potongan': 10,
          'keterangan': 'Asal dari NF (Depok/Bogor)',
          'notif': 0
        },
        {
          'id': 2,
          'potongan': 5,
          'keterangan': 'Memiliki Saudara kandung PERTAMA di NF',
          'notif': 1
        },
        {
          'id': 3,
          'potongan': 10,
          'keterangan': 'Memiliki Saudara kandung KEDUA di NF',
          'notif': 1
        },
        // {
        //   'id': 4,
        //   'potongan': 25,
        //   'keterangan': 'Undangan Khusus asal NF (Depok/Bogor)',
        //   'notif': 0
        // },
        // {
        //   'id': 5,
        //   'potongan': 50,
        //   'keterangan': 'Pemenang Lomba tingkat Nasional (Bertingkat)',
        //   'notif': 0
        // },
        // {
        //   'id': 6,
        //   'potongan': 25,
        //   'keterangan': 'Hafal minimal 15 Juz',
        //   'notif': 0
        // },
      ],
      biaya: [
        {
          'id': 0,
          'name': 'Dana Pengembangan',
        },
        {
          'id': 1,
          'name': 'Dana Pendidikan',
        },
        {
          'id': 2,
          'name': 'SPP bulan Juli',
        },
        {
          'id': 3,
          'name': 'Iuran Komite Sekolah / tahun',
        },
        {
          'id': 4,
          'name': 'Seragam'
        },
      ],
      form: new Form({
        calon_id: "",
        tagihan_id: "",
        potongan: 0,
        saudara: "",
        infaq: 0,
        infaqnfpeduli: 0,
      })
    };
  },

  methods: {
    pilihBiaya(tgh) {
      this.$Progress.start();
      axios.get("../api/tagihanpsbs/"+this.$route.params.id+':'+tgh)
        .then((data) => {
            this.tagihanpsb = data.data.biaya;
            this.total = data.data.total;
            this.totalTahunan = data.data.totalTahunan;
            this.kelas = data.data.kelas;
            this.form.calon_id = this.$route.params.id;
            this.form.tagihan_id = tgh;
            // this.form.potongan = data.data.asalNF;
            // this.modelBayar = this.reguler[tgh-1].name;
            this.modelBayar = "PPDB SIT Nurul Fikri";
            $("#addModal").modal({backdrop: 'static', keyboard: false});
            $("#addModal").modal("show");
            this.$Progress.finish();
          })
          .catch(() => {
              this.$Progress.fail();
          });
      this.$Progress.finish();
    },

    createData() {
      this.$Progress.start();
        this.form
          .post("../api/calontagihanpsbs")
          .then(() => {
            $("#addModal").modal("hide");
            Fire.$emit("listData");
            Toast.fire({
              type: "success",
              title: "Data telah berhasil di Simpan"
            });
            this.$Progress.finish();
            tampil = true;
            // window.location = "/wawancara-keu"
          })
          .catch(() => {
            this.$Progress.fail();
          });
    },

    cekNotif($e) {
      var cek = this.pots[$e.target.value].notif
      if(cek == 1) {
        tampil = false
      }
    },

    ketentuan() {
      $("#ketentuanModal").modal("show");
    },

    formPotongan(tgh) {
      this.$Progress.start();
      this.form.calon_id = this.$route.params.id;
      $("#modalPotongan").modal({backdrop: 'static', keyboard: false});
      $("#modalPotongan").modal("show");
      this.$Progress.finish();
    },

  },

  computed: {
    totalBayar: function(){
      return (Number(this.total) + Number(this.form.infaq)) + Number(this.form.infaqnfpeduli) - (Number(this.pots[this.form.potongan].potongan) * Number(this.tagihanpsb['Dana Pengembangan'])/100)
      // return (Number(this.total) + Number(this.form.infaq) + Number(this.form.infaqnfpeduli))
    }
  }

};
</script>

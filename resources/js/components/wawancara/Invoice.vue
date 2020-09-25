<template>
<div class="justify-content-center align-items-center" style="padding: 50px">
  <a
      class="btn btn-app btn-lg white"
      v-for="r in reguler" :key="r.id"
      v-on:click="pilihBiaya(r.id)"
      v-bind:class="backgroundnya[r.id]">
      <i v-if="r.id == 1" class="fa fa-tags"></i>
      <i v-else-if="r.id == 2" class="fa fa-shopping-bag"></i>
      <i v-else-if="r.id == 3" class="fas fa-address-card"></i>
      {{ r.name }}
  </a>
  <a
      class="btn btn-app btn-lg white"
      style="width: 560px !important"
      v-on:click="ketentuan()"
      v-bind:class="backgroundnya[4]">
      <i class="fa fa-info"></i>
      Ketentuan Pembayaran
  </a>
  <!-- Modal -->
  <div
    class="modal fade"
    id="addModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="addModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form @submit.prevent="createData()">
          <div class="modal-header">
            <h5 class="modal-title" id="addModalLabel">Form Wawancara Keuangan - <code><b>{{ modelBayar }}</b></code></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-sm table-bordered">
              <tr>
                <td width="50%">
                  <table class="table table-striped table-sm" style="padding: 10px">
                    <tr v-for="b in biaya" :key="b.id">
                      <td width="60%"><label class="col-form-label">{{ b.name }}</label></td>
                      <td align="right"><label class="col-form-label">{{ tagihanpsb[b.name] | toCurrency }}</label></td>
                    </tr>
                    <!-- <tr>
                      <td><label class="col-form-label"> Potongan </label></td>
                      <td>
                        <select v-model="form.potongan" name="unit_id" class="form-control" id="unit_id">
                          <option v-for="p in pots" :key="p.id" v-bind:value="p.potongan">( p.potongan }} %) -  p.keterangan }}</option>
                        </select>
                      </td>
                    </tr> -->
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
                <td style="background-color: lightgrey">
                  <center><b>Pembiayaan selama bersekolah di<br>Sekolah Islam Terpadu Nurul Fikri</b></center><br>
                  <table class="table table-sm table-bordered">
                    <tr v-for="(k, index) in kelas" :key="index">
                      <td>{{ index }}</td>
                      <td>
                        Kelas {{ k['kelas'] }}<br>
                        <span style="font-size: 12px">{{ k['ket'] }}</span><br>
                        <span style="font-size: 12px">{{ k['spp'] }}</span><br>
                        <span style="font-size: 12px">{{ k['daul'] }}</span><br>
                      </td>
                      <td style="width: 120px !important;">{{ k['total'] }}</td>
                    </tr>
                    <tr>
                      <td colspan="3"><center>TOTAL : <br><h4><b>{{ totalTahunan+totalBayar | toCurrency}}</b></h4></center></td>
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

  <!-- Modal -->
  <div
    class="modal fade"
    id="ketentuanModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="ketentuanModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ketentuanModalLabel">Form Wawancara Keuangan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>A. Pembayaran Daftar Ulang PPDB</p>
          <ol>
            <li>Akan melakukan Daftar Ulang PPDB sesuai dengan waktu yang di tentukan dengan pembayaran minimal 50% dari total tagihan PPDB</li>
            <li>Apabila pelunasan Daftar Ulang PPDB dilakukan maksimal tanggal 31 Oktober 2020, maka nilai pembayaran yang berlaku adalah sesuai dengan pembiayaan Reguler 1 seperti yang tertera pada lampiran 1</li>
            <li>Apabila pelunasan Daftar Ulang PPDB dilakukan maksimal tanggal 30 November 2020, maka nilai pembayaran yang berlaku adalah sesuai dengan pembiayaan Reguler 2 seperti yang tertera pada lampiran 2</li>
            <li>Apabila pelunasan Daftar Ulang PPDB dilakukan maksimal tanggal 31 Januari 2021, maka nilai pembayaran yang berlaku adalah sesuai dengan pembiayaan Reguler 3 seperti yang tertera pada lampiran 3</li>
            <li>Apabila sampai dengan batas waktu yang ditentukan belum melakukan Pelunasan Daftar Ulang PPDB, maka dianggap mengundurkan diri sebagai Calon Peserta Didik Baru SIT NF TA 2021/2022</li>
            <li>Calon Peserta Didik yang mengundurkan diri setelah melakukan Daftar Ulang maka seluruh Biaya yang sudah dibayarkan tidak dapat dikembalikan</li>
          </ol>
          <p>B. Ketentuan Dana Pendidikan selama bersekolah di SIT NF :</p>
          <ol>
            <li>Sumbangan Pokok Pendidikan (SPP) dibayarkan selambat-lambatnya tanggal 10 setiap bulannya selama 12 bulan dalam satu tahun ajaran sesuai dengan tarif yang sudah di tentukan</li>
            <li>Iuran Komite Sekolah dibayarkan setiap tahun pada bulan Juli di awal tahun ajaran.</li>
            <li>Penyesuaian/kenaikan SPP akan diberlakukan sesuai ketentuan.</li>
            <li>Konsekuensi terhadap keterlambatan pembayaran biaya pendidikan siswa akan diberlakukan sesuai ketentuan.</li>
            <li>Biaya Pendidikan dan Dana Daftar Ulang Tahunan sudah termasuk biaya Buku Paket.</li>
          </ol>
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
      tagihanpsb: {},
      kelas: {},
      total: 0,
      totalTahunan: 0,
      modelBayar: "",
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
      pots: [
        {
          'id': 0,
          'potongan': 0,
          'keterangan': 'Tidak ada potongan',
        },
        {
          'id': 1,
          'potongan': 10,
          'keterangan': 'Asal dari NF (Depok/Bogor)',
        },
        {
          'id': 2,
          'potongan': 5,
          'keterangan': 'Memiliki Saudara kandung di NF',
        },
        {
          'id': 3,
          'potongan': 25,
          'keterangan': 'Undangan Khusus asal NF (Depok/Bogor)',
        },
        {
          'id': 4,
          'potongan': 50,
          'keterangan': 'Pemenang Lomba tingkat Nasional (Bertingkat)',
        },
        {
          'id': 5,
          'potongan': 25,
          'keterangan': 'Hafal minimail 15 Juz',
        },
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
          'name': 'Iuran SPP Bulan Juli',
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
      backgroundnya: [
        '',
        'bg-red',
        'bg-blue',
        'bg-orange',
        'bg-teal',
        'bg-green',
      ],
      form: new Form({
        calon_id: "",
        tagihan_id: "",
        // potongan: 0,
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
            this.modelBayar = this.reguler[tgh-1].name;
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
            // window.location = "/wawancara-keu"
          })
          .catch(() => {
            this.$Progress.fail();
          });
    },

    ketentuan() {
      $("#ketentuanModal").modal("show");
    }
  },

  computed: {
    totalBayar: function(){
      // return (Number(this.total) + Number(this.form.infaq)) - (Number(this.form.potongan) * Number(this.tagihanpsb['Dana Pengembangan'])/100)
      return (Number(this.total) + Number(this.form.infaq) + + Number(this.form.infaqnfpeduli))
    }
  }

};
</script>

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
          <strong>A. Ketentuan Umum Pembiayaan PPDB</strong>
            <ol>
              <li><strong>Peserta Didik</strong> adalah calon peserta didik yang sudah dinyatakan diterima dan melunasi biaya daftar ulang PPDB sesuai ketentuan.</li>
              <li><strong>Daftar Ulang PPDB</strong> adalah pembayaran biaya pendidikan sesuai dengan ketentuan, setelah calon peserta didik baru yang sudah dinyatakan <strong>diterima</strong> pada proses seleksi PPDB.</li>
              <li><strong>Pelunasan</strong> adalah <strong>pembayaran semua biaya</strong> pendidikan sesuai ketentuan biaya calon peserta didik baru SIT Nurul Fikri.</li>
              <li>Skema pembayaran PPDB SIT NF yang berlaku adalah regular 1, regular 2 dan regular 3.</li>
              <li>
                Calon peserta didik dinyatakan <strong>mengundurkan diri</strong> jika :
                <ul>
                    <li>Belum melakukan daftar ulang sesuai dengan ketentuan.</li>
                    <li>Belum melakukan pelunasan sampai dengan <strong>batas waktu yang ditentukan</strong>.</li>
                    <li>Mengajukan pengunduran diri atas kemauan sendiri</li>
                </ul>
              </li>
              <li><strong>Sumbangan Pokok Pendidikan (SPP)</strong> adalah biaya yang dibayarkan <strong>setiap bulan</strong> selama peserta didik menempuh pendidikan di SIT Nurul Fikri.</li>
              <li><strong>Dana Tahunan</strong> adalah biaya yang dibayarkan <strong>setiap tahun</strong> (termasuk biaya buku paket pada tahun berjalan) selama peserta didik menempuh pendidikan di SIT Nurul Fikri.</li>
              <li><strong>Iuran Komite Sekolah</strong> adalah biaya yang dikelola oleh komite sekolah (perwakilan orangtua peserta didik), yang dibayarkan <strong>setiap tahun</strong> selama peserta didik menempuh pendidikan di SIT Nurul Fikri</li>
            </ol>
            <strong>B. Ketentuan Pembayaran Biaya Daftar Ulang PPDB tahun Pelajaran 2021/2022</strong>
            <ol>
              <li><strong>Calon peserta didik melakukan Daftar Ulang PPDB</strong> dengan melakukan pembayaran biaya pendidikan <strong>minimal 50%</strong> dari total biaya daftar ulang peserta didik baru, sesuai dengan tanggal yang sudah ditentukan.</li>
              <li><strong>Skema Reguler 1</strong> berlaku bagi calon peserta didik yang melakukan <strong>pelunasan</strong> biaya daftar ulang <strong>selambat-lambatnya 31 Oktober 2020</strong>. Jika calon peserta didik belum melakukan pelunasan sampai dengan 31 Oktober 2020, maka berlaku ketentuan no 3.</li>
              <li><strong>Skema Reguler 2</strong> berlaku bagi calon peserta didik yang melakukan <strong>pelunasan</strong> biaya daftar ulang <strong>selambat-lambatnya 30 November 2020</strong>. Jika calon peserta didik belum melakukan pelunasan sampai dengan 30 November 2020, maka berlaku ketentuan no 4.</li>
              <li><strong>Skema Reguler 3</strong> berlaku bagi calon peserta didik yang melakukan <strong>pelunasan</strong> biaya daftar ulang <strong>setelah 30 November 2020.</strong></li>
              <li>Calon peserta didik diharuskan melakukan <strong>pelunasan biaya daftar ulang</strong> selambat-lambatnya <strong>{{ tglbatas }}</strong>. Apabila sampai dengan batas waktu yang ditentukan <strong>belum melakukan Pelunasan</strong> biaya daftar ulang PPDB, maka dianggap <strong>mengundurkan diri</strong> sebagai calon peserta didik baru SIT Nurul Fikri tahun pelajaran 2021/2022.</li>
              <li>Calon Peserta Didik yang mengundurkan diri <strong>setelah melakukan Daftar Ulang</strong> maka <strong>seluruh Biaya yang sudah dibayarkan tidak dapat dikembalikan</strong>.</li>
            </ol>
        <strong>C. Ketentuan Dana Pendidikan selama bersekolah</strong>
        <ol type="1">
            <li>SPP dibayarkan setiap bulannya selama 12 bulan dalam satu tahun ajaran sesuai dengan tarif yang sudah ditentukan.</li>
            <li>Dana Tahunan dibayarkan setiap bulan Juli pada tahun berjalan.</li>
            <li>Iuran Komite Sekolah dibayarkan setiap tahun pada bulan Juli di awal tahun ajaran.</li>
            <li>Penyesuaian/kenaikan SPP akan diberlakukan sesuai ketentuan.</li>
            <li>Biaya Pendidikan dan Dana Tahunan sudah termasuk biaya Buku Paket pada tahun berjalan.</li>
        </ol>
        <br>
        <strong>D. Ketentuan Administrasi Sekolah</strong>
        <ol type="1">
            <li>Pembayaran SPP dilakukan selambat-lambatnya tanggal 10 setiap bulannya sesuai dengan tata cara pembayaran yang sudah diberikan.</li>
            <li>Masa pembayaran SPP adalah satu tahun ajaran dimulai dari bulan Juli sampai bulan Juni tahun berikutnya atau selama 12 (dua belas bulan).</li>
            <li>
                Bagi yang melanjutkan ke kelas berikutnya, maka WAJIB melakukan Registrasi Daftar Ulang dengan melunasi:
                <ol type="a">
                    <li>seluruh kewajiban yang tertunggak di tahun ajaran sebelumnya</li>
                    <li>SPP bulan Juli</li>
                    <li>Dana Tahunan</li>
                </ol>
            </li>
            <li>Syarat pengambilan rapor, ijazah, SKHUN, dokumen kelulusan dan atau permohonan surat pindah (mutasi) adalah melunasi seluruh kewajiban administrasi sekolah.</li>
            <li>
                Apabila SPP dan atau tagihan lainnya belum dibayarkan tepat pada waktunya , maka akan diberikan teguran dan pemberlakuan konsekuensi sebagai berikut :
                <ol type="a">
                    <li>
                        Konsekuensi Terlambat  selama 1 (satu) bulan atau lebih terjadi pada akhir semester adalah:<br>
                        <strong><i>Siswa/i tidak diberikan rapor /ijazah</i></strong> sampai pelunasan dilakukan
                    </li>
                    <li>
                        Konsekuensi terlambat  selama 2 (dua) bulan adalah:<br>
                        <strong><i>Siswa/i tidak diikutsertakan dalam ujian (UAS/UTS/UKK) dan tidak akan diberikan rapor/ijazah, dengan terlebih dahulu dikonfirmasi melalui surat teguran kepada orang tua Siswa/i</i></strong>
                    </li>
                    <li>
                        Konsekuensi terlambat  selama 3 (tiga) bulan adalah:<br>
                        <strong><i>Siswa/i tidak diijinkan ikut dalam Kegiatan Belajar Mengajar (KBM), tidak di ikutsertakan dalam ujian baik UAS ataupun UN dan juga tidak akan diberikan rapor/ijazah, dengan terlebih dahulu akan dikonfirmasi melalui surat teguran kepada orang tua Siswa/i</i></strong>
                    </li>
                    <li>
                        Konsekuensi terlambat selama 4 (empat) bulan atau lebih adalah:<br>
                        <strong><i>Siswa/i dikembalikan/dipulangkan sementara kepada orang tua, dengan terlebih dahulu akan dikonfirmasi melalui surat pemberitahuan kepada orang tua Siswa/i</i></strong>
                    </li>
                    <li>
                        Konsekuensi tidak melakukan registrasi daftar ulang tahunan sesuai ketentuan dan melewati batas waktu yang telah ditentukan adalah:<br>
                        <strong><i>Siswa/i dianggap mengundurkan diri sebagai Siswa SIT Nurul Fikri</i></strong>
                    </li>
                </ol>
            </li>
          </ol>
        </div>
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

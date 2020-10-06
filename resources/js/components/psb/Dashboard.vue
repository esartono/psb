<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-3 p-1 mt-2">
            <router-link to="/tambahcalon" class="btn btn-success btn-lg"><i class="fas fa-user-plus"> </i><b> Tambah Calon Siswa </b></router-link>
        </div>
    </div>
    <div
        v-for="calon in calons" :key="calon.id"
        style="border-bottom: 2px solid grey"
        class="row justify-content-center mb-4"
    >
        <div class="col-md-5 mb-3">
            <div class="card h-100">
                <div class="card-header white" v-bind:class="'bg-'+calon.gelnya.unitnya.catnya.name+' card-'+calon.gelnya.unitnya.catnya.name+'-outline'">
                    <h5>Data Calon Peserta - {{ calon.gelnya.unitnya.name }}</h5>
                    <div class="card-tools">
                        <router-link v-bind:to="'/editcalon/'+calon.id" class="btn btn-sm btn-warning"><i class="fas fa-user-edit"> </i><b> Edit </b></router-link>
                    </div>
                </div>
                <div class="card-body box-profile">
                    <!-- <div class="text-center">
                        <img src="/img/logo.png" class="profile-user-img img-fluid img-circle" alt="Logo NF">
                    </div> -->
                    <h3 class="profile-username text-center text-uppercase">{{ calon.name }}</h3>
                    <p class="text-muted text-center">{{ calon.uruts }}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Tempat, Tanggal lahir</b> <a class="float-right">{{ calon.tempat_lahir }}, {{ calon.tgl_lahir | Tanggal }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Jenis Kelamin</b> <a class="float-right">{{ calon.kelamin }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Kelas Tujuan</b> <a class="float-right">Kelas {{ calon.kelasnya.name }} <b>{{ jurusannya }}</b></a>
                        </li>
                        <li class="list-group-item">
                            <b>Tanggal Daftar</b> <a class="float-right">{{ calon.tgl_daftar | Tanggal }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-7 mb-3">
            <div class="card h-100">
            <div class="card-header p-2" v-bind:class="'bg-'+calon.gelnya.unitnya.catnya.name+' card-'+calon.gelnya.unitnya.catnya.name+'-outline'">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link dashboard"
                            :href="'#daftar'+calon.id" data-toggle="tab">
                            Pendaftaran
                        </a>
                    </li>
                    <li class="nav-item">
                        <a v-if="calon.hasil.hasil == 'Kosong'" class="nav-link dashboard"
                            v-bind:class="calon.status == 1 ? 'active' : 'disabled'"
                            :href="'#seleksi'+calon.id" data-toggle="tab">
                            Seleksi
                        </a>
                        <a v-else class="nav-link dashboard"
                            v-bind:class="calon.status == 1 ? 'active' : 'disabled'"
                            :href="'#seleksi'+calon.id" data-toggle="tab">
                            Seleksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dashboard"
                            v-bind:class="calon.hasil.hasil == 'Kosong' ? 'disabled' : 'active'"
                            :href="'#pengumuman'+calon.id" data-toggle="tab">Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dashboard"
                            v-bind:class="calon.hasil.tagihan == 'Kosong' || calon.hasil.hasil.lulus !== 1 ? 'disabled' : ''"
                            :href="'#daul'+calon.id" data-toggle="tab">Daftar Ulang</a>
                    </li>
                    <li class="nav-item">
                        <a :href="'/dokumen/'+calon.id" class="btn btn-warning"><i class="fas fa-book"> </i><b> Upload Dokumen </b></a>
                    </li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane"
                        v-bind:class="calon.status == 0 ? 'active' : ''"
                        :id="'daftar'+calon.id">
                        <div v-if="calon.bt.biayanya !== '-'" class="clearfix text-center">
                            <h3>Biaya Pendaftaran PSB</h3>
                            <hr>
                            <h1>{{ calon.bt.biayanya.biaya | toCurrency }}</h1>
                            <hr>
                            <p>Dibayarkan melalui rekening Virtual Account Bank Syariah Mandiri (BSM):</p>
                            <h3><b>{{ calon.uruts }}</b></h3>
                            Paling lambat pembayaran dilakukan pada tanggal : <b>{{ calon.bt.biayates.expired | Tanggal }}</b>
                            <a v-bind:href="'biayatesPDF/'+ calon.id " class="btn btn-success mt-3">Cetak Tata Cara Pembayaran</a>
                        </div>
                        <div v-else class="clearfix text-center">
                            <h3>Belum Tersedia</h3>
                            <hr>
                            <p>Silahkan hubungi panitia PPDB Online - SIT Nurul Fikri</p>
                        </div>
                    </div>
                    <div class="tab-pane"
                        v-bind:class="calon.status == 1 && calon.hasil.hasil == 'Kosong' ? 'active' : 'disabled'"
                        :id="'seleksi'+calon.id">
                        <ul v-if="calon.jadwal.seleksi !== 'Belum Ada'" style="list-style-type: none;">
                            <li>
                                <a v-bind:href="'/seleksiPDF/'+ calon.id " v-show="calon.status == 1" class="btn btn-success mb-2">Cetak Kartu Seleksi</a>
                                <!-- <a v-bind:href="'/uploadRapot/'+ calon.id " v-show="calon.status == 1 && calon.gelnya.unit_id > 2" class="btn btn-info mb-2"><strong> Nilai Rapot</strong></a> -->
                            </li>
                            <hr>
                            <li>
                                <div class="timeline-item">
                                    <h4 class="timeline-header">Tes Seleksi - Online ( <b>{{ calon.jadwal.seleksi | Tanggal }}</b> )</h4>
                                    <div class="timeline-body">
                                        <p>
                                            Tahapan Tes terdiri dari :
                                            <ol v-show="calon.gelnya.unitnya.catnya.name == 'TK' || calon.gelnya.unitnya.catnya.name == 'SD'">
                                                <li>Tes Psikologi</li>
                                                <li>Wawancara Orangtua</li>
                                                <li>Wawancara administrasi sekolah</li>
                                            </ol>
                                            <ol v-show="calon.gelnya.unitnya.catnya.name == 'SMP'">
                                                <li>Tes akademik siswa (<i>online</i>) pada pukul 07.00 - 08.15</li>
                                                <li>Tes psikologi (<i>online, menggunakan aplikasi zoom dan aplikasi psikotes)</i> pada pukul 08.30 - 12.00</li>
                                                <li>Wawancara orangtua calon siswa (<i>online, menggunakan aplikasi zoom</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
                                                <li>Wawancara administrasi sekolah (<i>online, menggunakan aplikasi zoom</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
                                                <li>Wawancara calon siswa (<i>online, menggunakan aplikasi zoom</i>) pada pukul 13.00 - 15.00 (perSesi 30 menit sesuai jadwal)</li>
                                            </ol>
                                            <ol v-show="calon.gelnya.unitnya.catnya.name == 'SMA'">
                                                <li>Tes akademik siswa (<i>online</i>) pada pukul 07.00 - 08.30</li>
                                                <li>Tes psikologi (<i>online, menggunakan aplikasi zoom dan aplikasi psikotes)</i> pada pukul 08.45 - 12.00</li>
                                                <li>Wawancara orangtua calon siswa (<i>online, menggunakan aplikasi zoom</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
                                                <li>Wawancara administrasi sekolah (<i>online, menggunakan aplikasi zoom</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
                                                <li>Wawancara calon siswa (<i>online, menggunakan aplikasi zoom</i>) pada pukul 13.00 - 15.00 (perSesi 30 menit sesuai jadwal)</li>
                                            </ol>
                                        </p>
                                    </div>
                                    <!-- <hr class="mt--2 mb--2">
                                    <h4 class="timeline-header">Wawancara Orang Tua dan Siswa</h4>
                                        <p>Jadwal Wawancara : <b>{{ calon.wawancara.wawancara | Tanggal }}, waktu {{ calon.wawancara.waktu }}</b></p>
                                        <a :href="'/pilihJadwal/'+ calon.id " v-show="calon.status == 1" class="btn btn-primary mb-2">Pilih Jadwal Tes</a> -->
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane"
                        v-bind:class="calon.hasil.hasil == 'Kosong' ? 'disabled' : 'active'"
                        :id="'pengumuman'+calon.id">
                        <div class="clearfix text-center">
                            <h3>Pengumuman</h3>
                            <hr>
                            <p>Berdasarkan keputusan panitia PPDB SIT Nurul Fikri menyatakan:</p>
                            <h2 v-if="calon.hasil.hasil.lulus === 1"><b>Diterima</b></h2>
                            <h2 v-else-if="calon.hasil.hasil.lulus === 2"><b>Cadangan</b></h2>
                            <h2 v-else><b>Tidak Diterima</b></h2>
                            <hr>
                            <p>{{ calon.hasil.hasil.catatan }}</p>
                            <!-- <br>
                            <a v-if="calon.hasil.hasil.lulus === 1"
                            :href="'DaftarUlangPDF/'+calon.id" class="btn btn-success btn-lg">Cetak Bukti Daftar Ulang</a>
                            <a v-if="calon.hasil.hasil.lulus === 1"
                            :href="'AmbilSeragamPDF/'+calon.id" class="btn btn-success btn-lg">Cetak Bukti Pengambilan Seragam</a> -->

                        </div>
                    </div>
                    <div class="tab-pane"
                        v-bind:class="calon.hasil.tagihan == 'Kosong' ? 'disabled' : ''"
                        :id="'daul'+calon.id">
                        <div class="clearfix">
                            <h3 class="text-center">Daftar Ulang</h3>
                            <!-- <a v-show="calon.hasil.hasil.lulus === 1"
                            :href="'DaftarUlangPDF/'+calon.id" class="btn btn-success btn-lg">Cetak Bukti Daftar Ulang</a>
                            <a v-show="calon.hasil.hasil.lulus === 1"
                            :href="'AmbilSeragamPDF/'+calon.id" class="btn btn-success btn-lg">Cetak Bukti Pengambilan Seragam</a>
                            <hr> -->
                            <table width="100%" class="table-bordered">
                                <tr>
                                    <td width="100%">
                                        <ol>
                                            <li>Pembayaran dilakukan pada tanggal : <br><b>{{ calon.jadwal.keterangan }}</b></li>
                                            <li>Apabila sampai dengan batas waktu yang ditentukan belum melakukan pembayaran daftar ulang, maka siswa dianggap mengundurkan diri. </li>
                                            <li>Pembayaran melalui <strong>Rekening Virtual Bank Muamalat </strong>:
                                                <center><h3 class="mt-3 red"><u><b>860001{{ calon.gel_id }}{{ calon.uruts }}</b></u></h3>
                                                <p><strong>atas nama: {{ calon.name }}</strong></p></center>
                                            </li>
                                        </ol>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
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
                units: {},
                calons: [],
                jurusannya: "",
                form: new Form({
                    id: "",
                    jurusan: "",
                })
            };
        },

        methods: {
            cekJurusan(id, jurusan, unit) {
                if(jurusan === "-" && unit === "SMA"){
                    Swal.fire({
                        title: "Pilih Jurusan",
                        html:
                            '<hr><div class="form-group row">' +
                                '<label class="col-md-7 col-form-label">Jurusan yg diinginkan</label>' +
                                '<div class="col-md-5">' +
                                    '<select id="jurusan" class="form-control" required>'+
                                        '<option selected disabled>Pilih Jurusan</option>' +
                                        '<option value="IPA">IPA</option>' +
                                        '<option value="IPS">IPS</option>' +
                                    '</select>' +
                                '</div>' +
                            '</div>',
                        showCancelButton: false,
                        allowOutsideClick: false,
                        preConfirm: () => {
                            if(document.getElementById('jurusan').value !== "Pilih Jurusan") {
                                this.form.jurusan = document.getElementById('jurusan').value
                                this.form.id = id
                                this.form
                                    .post("api/cekJurusan")
                                    .then(() => {
                                        Toast.fire({
                                            type: "success",
                                            title: "Edit Jurusan Berhasil"
                                        });
                                        this.$Progress.finish()
                                    })
                                    .catch((error) => {
                                        Swal.fire({
                                            title: 'Error!',
                                            type: 'error',
                                        })
                                        this.$Progress.fail()
                                    });
                            }
                        }
                    })
                this.jurusannya = ' (Jurusan ' + this.form.jurusan + ')'
                }
                if (unit === "SMA" && jurusan !== "-") {
                    this.jurusannya = ' (Jurusan ' + jurusan + ')'
                }
            }
        },

        mounted() {
            axios
                .get("../api/calons")
                .then(({ data }) => (this.calons = data))
        },
    }
</script>

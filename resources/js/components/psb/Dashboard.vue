<template>
<div class="container">
    <div class="card col-md-2 offset-md-5 p-1 mt-2">
        <router-link to="/tambahcalon" class="btn btn-success"><i class="fas fa-plus-circle"> </i> Tambah Calon</router-link>
    </div>
    <div
        v-for="calon in calons" :key="calon.id"
        class="row justify-content-center"
    >
        <div class="col-md-5 mb-3">
            <div class="card card-primary card-outline h-100">
                <div class="card-header">
                    <h3 class="card-title">Data Calon Peserta PSB</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-sm btn-success">
                            <i class="fas fa-user-edit"> </i>
                            Edit User
                        </a>
                    </div>
                </div>
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img src="/img/user.svg" class="profile-user-img img-fluid img-circle" alt="Calon Siswa">
                    </div>
                    <h3 class="profile-username text-center">{{ calon.name }}</h3>
                    <p class="text-muted text-center">2021033001</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Tempat, Tanggal lahir</b> <a class="float-right">{{ calon.tempat_lahir }}, {{ calon.tgl_lahir | Tanggal }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Jenis Kelamin</b> <a class="float-right">Laki-Laki</a>
                        </li>
                        <li class="list-group-item">
                            <b>Kelas Tujuan</b> <a class="float-right">Kelas 1</a>
                        </li>
                        <li class="list-group-item">
                            <b>Tanggal Daftar</b> <a class="float-right">9 Agustus 2019</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-7 mb-3">
            <div class="card h-100">
            <div class="card-header p-2" v-bind:class="'bg-'+calon.gelnya.unitnya.catnya.name+' card-'+calon.gelnya.unitnya.catnya.name+'-outline'">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#daftar" data-toggle="tab">Pendaftaran</a></li>
                    <li class="nav-item"><a class="nav-link disabled" href="#seleksi" data-toggle="tab">Seleksi</a></li>
                    <li class="nav-item"><a class="nav-link disabled" href="#pengumuman" data-toggle="tab">Pengumuman</a></li>
                    <li class="nav-item"><a class="nav-link disabled" href="#daul" data-toggle="tab">Daftar Ulang</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="daftar">
                        <div class="post clearfix">
                            <p>Biaya Pendaftaran PSB : </p>
                            <h2>RP. 500.000,-</h2>
                            <p>Dibayarkan melalui rekening BSM : 20304489010</p>
                            <p>Paling lambat pembayaran dilakukan pada tanggal : 17 Agustus 2019</p>
                            <button class="btn btn-block btn-secondary mt-3 disabled">Cetak Kartu Seleksi</button>
                            <button class="btn btn-block btn-primary mt-3">Cetak Kartu Seleksi</button>
                        </div>
                    </div>
                    <div class="tab-pane" id="seleksi">
                        <ul class="timeline timeline-inverse">
                            <li class="time-label">
                                <span class="bg-danger">
                                    10 Feb. 2020
                                </span>
                            </li>
                            <li>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Tes PSB</h3>
                                    <div class="timeline-body">
                                        <p>Tes dilakukan di unit SMA IT Nurul Fikri pada pukul 08.00</p>
                                        <p>
                                            Tahapan Tes terdiri dari :
                                            <ul>
                                                <li>Tes Akademik Siswa</li>
                                                <li>Tes Wawancara Orang Tua</li>
                                                <li>Tes Wawancara Siswa</li>
                                            </ul>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="time-label">
                                <span class="bg-success">3 Jan. 2020 - 17 Feb. 2020</span>
                            </li>
                            <li>
                                <div class="timeline-item">
                                    <h3 class="timeline-header border-0">Tes Kesehatan</h3>
                                    <div class="timeline-body">
                                        <p>Dilakukan di Klinik Nurul Fikri</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="pengumuman">
                        <ul class="timeline timeline-inverse">
                            <li class="time-label">
                                <span class="bg-danger">
                                    10 Maret 2020
                                </span>
                            </li>
                            <li>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Tes PSB</h3>
                                    <div class="timeline-body">
                                        <p>Tes dilakukan di unit SMA IT Nurul Fikri pada pukul 08.00</p>
                                        <p>
                                            Tahapan Tes terdiri dari :
                                            <ul>
                                                <li>Tes Akademik Siswa</li>
                                                <li>Tes Wawancara Orang Tua</li>
                                                <li>Tes Wawancara Siswa</li>
                                            </ul>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="daul">
                        <ul class="timeline timeline-inverse">
                            <li class="time-label">
                                <span class="bg-danger">
                                    17 Juni 2020
                                </span>
                            </li>
                            <li>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Pengambilan Seragam</h3>
                                    <div class="timeline-body">
                                        <p>Tes dilakukan di unit SMA IT Nurul Fikri pada pukul 08.00</p>
                                    </div>
                                </div>
                            </li>
                            <li class="time-label">
                                <span class="bg-success">18 Juni 2020</span>
                            </li>
                            <li>
                                <div class="timeline-item">
                                    <h3 class="timeline-header border-0">Pengambilan Buku</h3>
                                    <div class="timeline-body">
                                        <p>Dilakukan di Toko Sekolah Nurul Fikri</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
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
                messageText: '',
            };
        },

        mounted() {
            axios
                .get("../api/calons")
                .then(({ data }) => (this.calons = data))
        }
    }
</script>

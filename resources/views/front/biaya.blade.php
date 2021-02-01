@extends('front.template')

@section('isi')
        <div class="container">
            <img src="" alt="">
            <h1 style="text-align:center;">Biaya Pendidikan SIT Nurul Fikri</h1>
        </div>
        <div id="exTab1" class="container">
            <ul class="nav nav-pills">
                <li class="active"><a href="#0a" data-toggle="tab">CCEC</a></li>
                <li><a href="#1a" data-toggle="tab">TKIT</a></li>
                <li><a href="#2a" data-toggle="tab">SDIT NF</a></li>
                <li><a href="#3a" data-toggle="tab">SMPIT NF</a></li>
                <li><a href="#4a" data-toggle="tab">SMAIT NF</a></li>
            </ul>

            <div class="tab-content clearfix">
                <div class="tab-pane active" id="0a">
                    @include('front.biaya.ccec')
                </div>
                <div class="tab-pane" id="1a">
                    @include('front.biaya.tk')
                </div>
                <div class="tab-pane" id="2a">
                    @include('front.biaya.sd')
                    </div>
                <div class="tab-pane" id="3a">
                    @include('front.biaya.smp')
                </div>
                <div class="tab-pane" id="4a">
                    @include('front.biaya.sma')
                </div>
            </div>
            <div>
                <h4>I. BIAYA PENDAFTARAN DAN SELEKSI </h4>
                <ol>
                    <li>CCEC : Rp. 550.000,-</li>
                    <li>TK : Rp. 550.000,-</li>
                    <li>SD : Rp. 700.000,-</li>
                    <li>SMP : Rp. 700.000,-</li>
                    <li>SMA : Rp. 700.000,-</li>
                </ol>
                <br>
                <h4>II. KETENTUAN UMUM BIAYA PENDIDIKAN:</h4>
                <ol>
                    <li><strong>Pembiayaan Reguler 2</strong>, berlaku untuk pendaftar yang melakukan <strong>daftar ulang dengan lunas selambat-lambatnya 30 November 2020.</strong></li>
                    <li><strong>Pembiayaan Reguler 3</strong>, berlaku untuk pendaftar yang melakukan <strong>daftar ulang dengan lunas setelah 30 November 2020.</strong></li>
                    <li><strong>Sumbangan Pokok Pendidikan (SPP)</strong> untuk reguler 1 berlaku untuk <strong>1 tahun pertama</strong>, untuk tahun kedua dan seterusnya sesuai dengan ketentuan kenaikan SPP.</li>
                    <li>Komponen <strong>Biaya Komite Sekolah</strong> dibayarkan pertahun bersamaan dengan SPP bulan Juli.</li>
                    <li>SPP yang dibayarkan <strong>tidak termasuk biaya catering.</strong></li>
                </ol>
                <br>
                <h4>III. KETENTUAN POTONGAN BIAYA PENERIMAAN SISWA BARU:</h4>
                <ol>
                    <li>Bagi siswa yang memiliki <strong>saudara kandung</strong> bersekolah di <strong>SIT Nurul Fikri</strong>, mendapatkan potongan biaya <b>5% dari Dana Pengembangan</b>.</li>
                    <li>Bagi siswa yang <strong>berasal dari sekolah SIT Nurul Fikri dan NFBS Bogor</strong> yang mendapatkan undangan khusus dari YPPU Nurul Fikri, maka mendapatkan benefit potongan biaya <b>25% dari Dana Pengembangan</b> dan bebas biaya pendaftaran, jika melakukan daftar ulang pada <b>periode reguler 1</b>.</li>
                    <li>Bagi Siswa <strong>Pemenang Lomba tingkat Nasional (Bertingkat)</strong> Juara 1 dan 2 yang dibuktikan dengan sertifikat dan diverifikasi oleh panitia, mendapatkan potongan biaya <b>50 % dari Dana Pengembangan</b>.</li>
                    <li>Bagi siswa yang memiliki <strong>hafalan minimal 15 Juz</strong> dan sudah diverifikasi oleh SIT NF, mendapatkan potongan biaya <b>25% dari Dana Pengembangan</b>.</li>
                    <li><b>Ketentuan potongan biaya tidak berlaku akumulatif dan tidak dapat digabung dengan jenis potongan lainnya</b>.</li>
                </ol>
                <br>
            </div>
        </div>
    </div>
@endsection

@extends('front.template1')

@section('isi')
<style type="text/css">

    .formBox{
        padding: 20px;
    }
    .inputBox{
        position: relative;
        box-sizing: border-box;
        margin-bottom: 50px;
    }
    .inputBox .inputText{
        position: absolute;
        ffont-size: 16px;
        line-height: 50px;
        transition: .5s;
        opacity: .5;
    }
    .inputBox .input{
        position: relative;
        width: 100%;
        height: 50px;
        background: transparent;
        border: none;
        outline: none;
        font-size: 16px;
        border-bottom: 1px solid rgba(0,0,0,.5);

    }
    .focus .inputText{
        transform: translateY(-30px);
        font-size: 18px;
        opacity: 1;
        color: #000;

    }
    textarea{
        height: 100px !important;
    }
    .required:after {
        content:" *";
        color: red;
    }
</style>
	<section class="banner-area relative">
		<div class="container">
			<div class="section-top-border justify-content-center">   
				<div class="progress-table-wrap mt-60">
                    <div class="progress-table" style="padding: 30px 0px">
                        <div class="formBox col-8 offset-2 col-sm-10 offset-sm-1 mt-20">
                            <form method="POST" action="{{ route('waiting.store') }}"">
                                @csrf
                                <div class="row mb-30">
                                    <div class="col-sm-12">
                                        <h4 class="mb-20"><i>Waiting List</i> - PPDB SIT Nurul Fikri</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="inputBox">
                                            <div class="inputText required">Nama Calon Siswa</div>
                                            <input type="text" name="calon" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="inputBox">
                                            <div class="inputText required">Asal Sekolah</div>
                                            <input type="text" name="asalSekolah" class="input" required>
                                            <span style="font-size: 75%; font-style: italic; color: red">Untuk yang belum bersekolah bisa input: -</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="inputBox focus">
                                            <div class="inputText required">Pilih Jenjang Pendidikan</div>
                                            <select name="jenjang" class="input" required>
                                                <option selected disabled>Pilih Jenjang</option>
                                                <option value="tk">TK</option>
                                                <option value="sd">SD</option>
                                                <option value="smp">SMP</option>
                                                <option value="sma">SMA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-sm-12">
                                        <div class="inputBox focus">
                                            <div class="inputText required">Pilih Pindahan/Baru</div>
                                            <select name="mutasi" class="input" required>
                                                <option selected disabled>Pilih Jenjang</option>
                                                <option value="0">Siswa Baru</option>
                                                <option value="1">Siswa Pindahan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="inputBox focus">
                                            <div class="inputText required">Pilih Tahun Ajaran</div>
                                            <select name="ta" class="input" required>
                                                <option selected disabled style="color: red">Pilih Tahun Ajaran</option>
                                                @for ($i = 0; $i < 4; $i++)
                                                    <option value="{{ $patokan+$i }}">{{ $patokan+$i }}/{{ $patokan+1+$i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="inputBox">
                                            <div class="inputText required">No. WhatsApp Orang Tua</div>
                                            <input 
                                                type="tel"
                                                name="hportu"
                                                class="input"
                                                required minlength="8"
                                                maxlength="15"
                                                oninput="this.value = this.value.replace(/[^0-9+()]/g, '');"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="inputBox">
                                            <div class="inputText required">Email Orang Tua</div>
                                            <input type="email" name="emailortu" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 offset-sm-3">
                                        <input type="submit" name="" class="btn btn-block btn-primary" value="Daftar Waiting List">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

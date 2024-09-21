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
                            <h1>Data telah kami simpan</h1>
                            <hr>
                            <a href= class="btn btn-primary btn-block"> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

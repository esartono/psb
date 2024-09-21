<!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard - PPDB SIT Nurul Fikri</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="/notika/css/bootstrap.min.css">
    <!-- font awesome CSS
		============================================ -->
    {{-- <link rel="stylesheet" href="/notika/css/font-awesome.min.css"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <!-- owl.carousel CSS
		============================================ -->
    {{-- <link rel="stylesheet" href="/notika/css/owl.carousel.css">
    <link rel="stylesheet" href="/notika/css/owl.theme.css">
    <link rel="stylesheet" href="/notika/css/owl.transitions.css">
    <!-- meanmenu CSS --}}
		============================================ -->
    {{-- <link rel="stylesheet" href="/notika/css/meanmenu/meanmenu.min.css"> --}}
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="/notika/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="/notika/css/normalize.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    {{-- <link rel="stylesheet" href="/notika/css/scrollbar/jquery.mCustomScrollbar.min.css"> --}}
    <!-- Notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="/notika/css/notika-custom-icon.css">
    <!-- dropzone CSS
		============================================ -->
    {{-- <link rel="stylesheet" href="/notika/css/dropzone/dropzone.css"> --}}
    <!-- summernote CSS
		============================================ -->
    {{-- <link rel="stylesheet" href="/notika/css/summernote/summernote.css"> --}}
    <!-- wave CSS
		============================================ -->
    {{-- <link rel="stylesheet" href="/notika/css/wave/waves.min.css">
    <link rel="stylesheet" href="/notika/css/wave/button.css"> --}}
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="/notika/css/main.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="/notika/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="/notika/css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    {{-- <script src="/notika/js/vendor/modernizr-2.8.3.min.js"></script> --}}
</head>

<body>
    @include('user.partials.header')
    <!-- Compose email area Start-->
    <div class="inbox-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="inbox-left-sd">
                        <div class="breadcomb-wp">
                            <div class="breadcomb-icon">
                                <i class="notika-icon notika-form"></i>
                            </div>
                            <div class="breadcomb-ctn">
                                <h2>Form Examples</h2>
                                <p>Welcome to Notika <span class="bread-ntd">Admin Template</span></p>
                            </div>
                        </div>
                        <hr>
                        <div class="inbox-status">
                            <ul class="inbox-st-nav inbox-ft">
                                <li><a href="#"><i class="notika-icon notika-mail"></i> Inbox<span class="pull-right">12</span></a></li>
                                <li><a href="#"><i class="notika-icon notika-sent"></i> Sent</a></li>
                                <li><a href="#"><i class="notika-icon notika-draft"></i> Draft</a></li>
                                <li><a href="#"><i class="notika-icon notika-trash"></i> Trash</a></li>
                            </ul>
                        </div>
                        <hr>
                        <div class="inbox-status">
                            <ul class="inbox-st-nav">
                                <li><a href="#"><i class="notika-icon notika-travel"></i> Travel</a></li>
                                <li><a href="#"><i class="notika-icon notika-finance"></i> Finance</a></li>
                                <li><a href="#"><i class="notika-icon notika-social"></i> Social</a></li>
                                <li><a href="#"><i class="notika-icon notika-promos"></i> Promos</a></li>
                                <li><a href="#"><i class="notika-icon notika-flag"></i> Updates</a></li>
                            </ul>
                        </div>
                        <hr>
                        <div class="inbox-status">
                            <ul class="inbox-st-nav inbox-nav-mg">
                                <li><a href="#"><i class="notika-icon notika-success"></i> Forum</a></li>
                                <li><a href="#"><i class="notika-icon notika-chat"></i> Chat</a></li>
                                <li><a href="#"><i class="notika-icon notika-star"></i> Work</a></li>
                                <li><a href="#"><i class="notika-icon notika-settings"></i> Settings</a></li>
                                <li><a href="#"><i class="notika-icon notika-support"></i> Support</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="view-mail-list sm-res-mg-t-30">
                        <div class="view-mail-hd">
                            <div class="view-mail-hrd">
                                <h2>New Message</h2>
                            </div>
                        </div>
                        <div class="cmp-int mg-t-20">
                            <div class="row">
                                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                    <div class="cmp-int-lb cmp-int-lb1 text-right">
                                        <span>To: </span>
                                    </div>
                                </div>
                                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <div class="nk-int-st cmp-int-in cmp-email-over">
                                            <input type="email" class="form-control" placeholder="example@email.com" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                    <div class="cmp-int-lb cmp-int-lb1 text-right">
                                        <span>Cc: </span>
                                    </div>
                                </div>
                                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <div class="nk-int-st cmp-int-in cmp-email-over">
                                            <input type="email" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                    <div class="cmp-int-lb text-right">
                                        <span>Subject: </span>
                                    </div>
                                </div>
                                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
                                    <div class="form-group cmp-em-mg">
                                        <div class="nk-int-st cmp-int-in cmp-email-over">
                                            <input type="text" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cmp-int-box mg-t-20">
                            <div class="html-editor-cm">
                                <h2>Hello Mamunur Roshid!</h2>
                                <p>Dummy text of the printing and typesetting industry. Lorem Ipsum has been the <b>dustrys standard dummy text</b> ever since the 1500s, when an unknown printer took a galley of types and scrambleded it to make a type specimenen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages <a href="#">Read more</a>.</p>
                                <p>All the Lorem Ipsum generators on the Internet tend to repeat the predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence crisity structures, to generate Lorem Ipsum which looks reasonable. recently with.Dummy text of the printing and typesetting industryunknown printer took a galley of type.</p>
                                <span class="vw-tr">Thanks and Regards</span>
                                <span>Mark Smith</span>
                            </div>
                        </div>
                        <div class="multiupload-sys">
                            <div id="dropzone" class="dropmail">
                                <form action="/upload" class="dropzone dropzone-custom needsclick" id="demo-upload">
                                    <div class="dz-message needsclick download-custom">
                                        <i class="notika-icon notika-cloud" aria-hidden="true"></i>
                                        <h2>Drop files here or click to upload.</h2>
                                        <p><span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="vw-ml-action-ls text-right mg-t-20">
                            <div class="btn-group ib-btn-gp active-hook nk-email-inbox">
                                <button class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-next"></i> Reply</button>
                                <button class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-right-arrow"></i> Forward</button>
                                <button class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-down-arrow"></i> Print</button>
                                <button class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-trash"></i> Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Compose email area End-->
    <!-- Start Footer area-->
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © 2018 . All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer area-->
    <!-- jquery
		============================================ -->
    <script src="/notika/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="/notika/js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="/notika/js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    {{-- <script src="/notika/js/jquery-price-slider.js"></script> --}}
    <!-- owl.carousel JS
		============================================ -->
    {{-- <script src="/notika/js/owl.carousel.min.js"></script> --}}
    <!-- scrollUp JS
		============================================ -->
    {{-- <script src="/notika/js/jquery.scrollUp.min.js"></script> --}}
    <!-- counterup JS
		============================================ -->
    {{-- <script src="/notika/js/counterup/jquery.counterup.min.js"></script>
    <script src="/notika/js/counterup/waypoints.min.js"></script>
    <script src="/notika/js/counterup/counterup-active.js"></script> --}}
    <!-- mCustomScrollbar JS
		============================================ -->
    {{-- <script src="/notika/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> --}}
    <!-- sparkline JS
		============================================ -->
    {{-- <script src="/notika/js/sparkline/jquery.sparkline.min.js"></script>
    <script src="/notika/js/sparkline/sparkline-active.js"></script> --}}
    <!-- flot JS
		============================================ -->
    {{-- <script src="/notika/js/flot/jquery.flot.js"></script>
    <script src="/notika/js/flot/jquery.flot.resize.js"></script>
    <script src="/notika/js/flot/flot-active.js"></script> --}}
    <!-- knob JS
		============================================ -->
    {{-- <script src="/notika/js/knob/jquery.knob.js"></script>
    <script src="/notika/js/knob/jquery.appear.js"></script>
    <script src="/notika/js/knob/knob-active.js"></script> --}}
    <!-- summernote JS
		============================================ -->
    {{-- <script src="/notika/js/summernote/summernote-updated.min.js"></script>
    <script src="/notika/js/summernote/summernote-active.js"></script>
    <!-- dropzone JS --}}
		============================================ -->
    {{-- <script src="/notika/js/dropzone/dropzone.js"></script> --}}
    <!--  wave JS
		============================================ -->
    {{-- <script src="/notika/js/wave/waves.min.js"></script>
    <script src="/notika/js/wave/wave-active.js"></script> --}}
    <!-- icheck JS
		============================================ -->
    {{-- <script src="/notika/js/icheck/icheck.min.js"></script>
    <script src="/notika/js/icheck/icheck-active.js"></script>
    <!--  Chat JS --}}
		============================================ -->
    {{-- <script src="/notika/js/chat/jquery.chat.js"></script> --}}
    <!--  todo JS
		============================================ -->
    {{-- <script src="/notika/js/todo/jquery.todo.js"></script> --}}
    <!-- plugins JS
		============================================ -->
    {{-- <script src="/notika/js/plugins.js"></script> --}}
    <!-- main JS
		============================================ -->
    <script src="/notika/js/main.js"></script>
</body>

</html>
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
    {{-- <link rel="stylesheet" href="/notika/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="/front/css/bootstrap.min.css">
    <!-- font awesome CSS
		============================================ -->
    {{-- <link rel="stylesheet" href="/notika/css/font-awesome.min.css"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css'>
    <!-- owl.carousel CSS
		============================================ -->
    {{-- <link rel="stylesheet" href="/notika/css/owl.carousel.css">
    <link rel="stylesheet" href="/notika/css/owl.theme.css">
    <link rel="stylesheet" href="/notika/css/owl.transitions.css"> --}}
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href="/notika/css/meanmenu/meanmenu.min.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="/notika/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="/notika/css/normalize.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="/notika/css/scrollbar/jquery.mCustomScrollbar.min.css">
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
    {{-- <link rel="stylesheet" href="/notika/css/wave/waves.min.css"> --}}
    <link rel="stylesheet" href="/notika/css/wave/button.css">
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
    <script src="/notika/js/vendor/modernizr-2.8.3.min.js"></script>

    @stack('css_khusus')
</head>

<body>
    @include('user.partials.header')
    
    @yield('content')

    <!-- Start Footer area-->
    @include('partials.floating')
    <footer class="footer-copyright-area fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © {{ date('Y') }} .</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
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
    {{-- <script src="/notika/js/counterup/jquery.counterup.min.js"></script> --}}
    {{-- <script src="/notika/js/counterup/waypoints.min.js"></script> --}}
    {{-- <script src="/notika/js/counterup/counterup-active.js"></script> --}}
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="/notika/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
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
    <script src="/notika/js/summernote/summernote-active.js"></script> --}}
    <!-- dropzone JS
		============================================ -->
    {{-- <script src="/notika/js/dropzone/dropzone.js"></script> --}}
    <!--  wave JS
		============================================ -->
    {{-- <script src="/notika/js/wave/waves.min.js"></script>
    <script src="/notika/js/wave/wave-active.js"></script> --}}
    <!-- icheck JS
		============================================ -->
    {{-- <script src="/notika/js/icheck/icheck.min.js"></script>
    <script src="/notika/js/icheck/icheck-active.js"></script> --}}
    <!--  Chat JS
		============================================ -->
    {{-- <script src="/notika/js/chat/jquery.chat.js"></script> --}}
    <!--  todo JS
		============================================ -->
    {{-- <script src="/notika/js/todo/jquery.todo.js"></script> --}}
    <!-- plugins JS
		============================================ -->
    <script src="/notika/js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="/notika/js/main.js"></script>
    @stack('jawa')
</body>

</html>
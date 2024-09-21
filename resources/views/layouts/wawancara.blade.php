<!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard Wawancara - PPDB SIT Nurul Fikri</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="/front/css/bootstrap.min.css">

    <!-- font awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css'>
    <link rel="stylesheet" href="/notika/css/main.css">
    <link rel="stylesheet" href="/notika/style.css">
    <link rel="stylesheet" href="/notika/css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    {{-- <script src="/notika/js/vendor/modernizr-2.8.3.min.js"></script> --}}

    @stack('css_khusus')
</head>

<body>
    <!-- Start Header Top Area -->
{{-- <div class="header-top-area">
  <div class="container">
      <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="logo-area">
                  <a href="/wawancara"><img style="max-width: 50px" src="/img/logo.png" alt="" /> PPDB SIT Nurul Fikri - Depok</a>
              </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="logo-area mt-1 text-end">
                  <a class="btn btn-secondary text-white" href="{{ route('logout')}}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      <i class="fa-solid fa-power-off"></i> &nbsp; {{ __('Logout') }} </b>
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>     --}}
    @yield('content')
    <!-- Start Footer area-->
    {{-- <footer class="footer-copyright-area fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © {{ date('Y') }} .</p>
                    </div>
                </div>
            </div>
        </div>
    </footer> --}}
    <!-- End Footer area-->

		<!-- ============================================ -->
    <script src="/notika/js/vendor/jquery-1.12.4.min.js"></script>
    {{-- <script src="/notika/js/bootstrap.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @stack('jawa')
</body>

</html>
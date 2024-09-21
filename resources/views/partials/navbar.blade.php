<div class="container-xxl position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        @if(Request::path() <>  'tesPPDB')
        <a href="/" class="navbar-brand p-0">
            <h2 class="m-0"><img src="/img/logo.png" alt="Logo"> PPDB SIT Nurul Fikri</h2>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="index.html" class="nav-item nav-link active">{{ __('Home') }}</a>
                {{-- <a href="about.html" class="nav-item nav-link">About</a> --}}
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ __('Registration') }}</a>
                    <div class="dropdown-menu m-0">
                        <a href="/login" class="dropdown-item">{{ __('Registration Link') }}</a>
                        <a href="/alur" class="dropdown-item">{{ __('Registration Flow') }}</a>
                        <a href="/jadwal" class="dropdown-item">{{ __('Test Schedule') }}</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ __("Education Fees") }}</a>
                    <div class="dropdown-menu m-0">
                        <a href="/biaya" class="dropdown-item">{{ __("Education Fees") }}</a>
                        <a href="/tata_cara_bayar_pendaftaran" class="dropdown-item">{{ __('Register Payment Methods') }}</a>
                        <a href="/tata_cara_bayar_spp" class="dropdown-item">{{ __('SPP Payment Methods') }}</a>
                    </div>
                </div>
                <a href="/syarat" class="nav-item nav-link">{{ __("Term and condition") }}</a>
                <a href="/qna" class="nav-item nav-link">FAQ</a>
                <a href="/download" class="nav-item nav-link">Download</a>
                <div class="nav-item dropdown">
                    @php $locale = session()->get('locale'); @endphp
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        @switch($locale)
                            @case('id')
                            <img src="{{asset('images/flag/id.png')}}" width="15px"> &nbsp;Bahasa
                            @break
                            @case('en')
                            <img src="{{asset('images/flag/en.png')}}" width="15px"> &nbsp;English
                            @break
                            @default
                            <img src="{{asset('images/flag/en.png')}}" width="15px"> &nbsp;English
                        @endswitch
                    </a>
                    <div class="dropdown-menu m-0">
                        <a href="/lang/id" class="dropdown-item"><img src="{{asset('images/flag/id.png')}}" width="20px"> &nbsp; Bahasa</a>
                        <a href="/lang/en" class="dropdown-item"><img src="{{asset('images/flag/en.png')}}" width="20px"> &nbsp; English</a>
                    </div>
                </div>
            </div>
            {{-- <a href="" class="btn btn-secondary py-2 px-4 ms-3">{{ __('Register') }}</a> --}}
        </div>
        @endif
    </nav>

    @if(Request::path() ==  '/')
    <div class="container-xxl py-5 bg-primary hero-header mb-5">
        <div class="container my-5 py-5 px-lg-5">
            <div class="row g-5">
                <div class="col-lg-8 pt-5 text-center text-lg-start">
                    <h1 class="display-5 text-white mb-4 animated slideInLeft">{{ __('PPDB SIT Nurul Fikri') }}</h1>
                    <p class="text-white animated slideInLeft">{{ __('App Name') }}<br>{{ __('School Name') }} {{ $tp->name }}</p>
                    @auth
                        @if (auth()->user()->isAdmin() || auth()->user()->isAdminUnit())
                            <a href="{{ url('/home') }}" class="btn btn-secondary py-sm-3 px-sm-5 me-3 animated slideInTop">{{ __('Home') }}</a>
                        @endif
                        @if (auth()->user()->isUser())
                            <a href="{{ url('/ppdb') }}" class="btn btn-secondary py-sm-3 px-sm-5 me-3 animated slideInTop">{{ __('Home') }}</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-secondary py-sm-3 px-sm-5 me-3 animated slideInTop">{{ __('Register') }}</a>
					    <br>
						{{-- <a href="{{ route('waiting.create') }}" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn col-md-8 info circle mr-10 mb-10 wow fadeInDown" style="border: 1px solid white">WAITING LIST/INDENT</a> --}}
						{{-- <a href="{{ route('register') }}" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn col-md-4 success circle mr-10 mb-10 wow fadeInDown">Daftar Akun</a> --}}
					@endauth
                </div>
                <div class="col-lg-4 text-center text-lg-start">
                    {{-- @include('partials.countdown') --}}
                    {{-- <img class="img-fluid animated zoomIn" src="img/hero.png" alt=""> --}}
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(Request::path() !==  '/')
    @php
    $locale = session()->get('locale');
    $pilihanbahasa = $locale == 'id' ? 0 : 1;
    $arrayLabel = [
        'alur' => ['Alur Pendaftaran', 'Registration Flow'],
        'biaya' => ['Biaya PPDB SIT Nurul Fikri', 'Education Fees'],
        'tata_cara_bayar_pendaftaran' => ['Tata Cara Pembayaran Pendaftaran', 'Registration Payment Methods'],
        'tata_cara_bayar_spp' => ['Tata Cara Pembayaran SPP', 'SPP Payment Methods'],
        'syarat' => ['Syarat dan Ketentuan', 'Term and Conditions'],
        'jadwal' => ['Jadwal Tes', 'Test Schedule'],
        'download' => ['Download Berkas', 'Download'],
        'qna' => ['Question and Answer', 'Questions and Answer']
    ];

    $label = Request::path();
    @endphp
    <div class="container-xxl py-5 bg-primary hero-header mb-5">
        <div class="container my-5 py-5 px-lg-5">
            <div class="row g-5 pt-5">
                <div class="col-12 text-center text-lg-start">
                    @isset($arrayLabel[$label][$pilihanbahasa])
                        <h1 class="display-6 text-white animated slideInLeft">{{ $arrayLabel[$label][$pilihanbahasa] }}</h1>
                        @if(Request::path() !== 'qna')<h5 class="text-white animated slideInLeft mb-3">{{ __('Academic Year') }} {{ taAktif() }}</h5>@endif
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center justify-content-lg-start animated slideInLeft">
                                <li class="breadcrumb-item"><a class="text-white" href="/">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">{{ breadCrumb($arrayLabel[$label][$pilihanbahasa]) }}</li>
                            </ol>
                        </nav>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
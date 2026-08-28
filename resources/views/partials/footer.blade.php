        <!-- Footer Start -->
        <div class="container-fluid bg-primary text-white footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row gy-5 gx-4 pt-5">
                    @if(Request::path() <>  'tesPPDB')
                    <div class="col-lg-5 col-md-12">
                        <div class="row gy-5 g-4">
                            <table style="border: 0px !important">
                                <tr style="border: 0px !important">
                                    <td colspan="2" style="border: 0px !important"><h5 class="fw-bold text-white mb-4">Academic Programs</h5></td>
                                </tr>
                                <tr style="border: 0px !important">
                                    <td style="border: 0px !important"><a class="btn btn-link" href="https://nurulfikri.sch.id" target="_blank">NFIS</a></td>
                                    <td style="border: 0px !important"><a class="btn btn-link" href="https://smpit.nurulfikri.sch.id" target="_blank">Middle School</a></td>
                                </tr>
                                <tr style="border: 0px !important">
                                    <td style="border: 0px !important"><a class="btn btn-link" href="https://tkit.nurulfikri.sch.id" target="_blank">Kindergarten</a></td>
                                    <td style="border: 0px !important"><a class="btn btn-link" href="https://smait.nurulfikri.sch.id" target="_blank">High School</a></td>
                                </tr>
                                <tr style="border: 0px !important">
                                    <td style="border: 0px !important"><a class="btn btn-link" href="https://sdit.nurulfikri.sch.id" target="_blank">Elementary</a></td>
                                    <td style="border: 0px !important"><a class="btn btn-link" href="https://nfbs-bogor.sch.id" target="_blank">Boarding School</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="fw-bold text-white mb-4">{{ __('Get In Touch') }}</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-4"></i>Jl. Tugu Raya No.61</p>
                        <p class="mb-2">&nbsp; &nbsp; &nbsp; &nbsp; Tugu, Cimanggis</p>
                        <p class="mb-2">&nbsp; &nbsp; &nbsp; &nbsp; Depok - Jawa Barat</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+62 872 0645</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>psb@nurulfikri.sch.id</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href="https://twitter.com/nfislamicschool"><i class="fa-brands fa-x-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/nurulfikri.islamicschool"><i class="fa-brands fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.tiktok.com/@nurulfikri_islamicschool"><i class="fa-brands fa-tiktok"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.youtube.com/@NurulFikri_IslamicSchool"><i class="fa-brands fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/nurulfikri_islamicschool/"><i class="fa-brands fa-instagram"></i></a>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mt-lg-n5">
                        <img style="float: right !important; width: 60%" src="/img/smart.png">
                    </div>
                    @endif
                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        @if(Request::path() <>  'tesPPDB')
                        <div class="col-md-8 text-center text-md-start mb-3 mb-md-0">
                            &copy; 2026<a class="border-bottom" href="/">PPDB Nurul Fikri Islamic School </a>
                            {{-- , All Right Reserved. 
							Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                            </br>
                            Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a> --}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
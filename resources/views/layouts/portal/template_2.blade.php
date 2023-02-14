<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">

    <title>Al-azhar BSD</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('portal/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('portal/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/assets/css/templatemo-seo-dream.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/assets/css/owl.css') }}">
    <!--

TemplateMo 563 SEO Dream

https://templatemo.com/tm-563-seo-dream

-->

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <h4>Al-Azhar <img src="/portal/assets/images/al.png" alt=""></h4>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="scroll-to-section"><a href="#" class="active">Pendaftaran</a></li>
                            <li class="scroll-to-section">
                                {{-- <div class="main-blue-button"><a href="{{ route('welcome') }}">Kembali</a></div> --}}
                            </li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © 2021 SEO Dream Co., Ltd. All Rights Reserved.

                        <br>Web Designed by <a rel="nofollow" href="https://templatemo.com"
                            title="free CSS templates">TemplateMo</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    {{-- <script src="{{ asset('portal/vendor/jquery/jquery.min.js') }}"></script> --}}

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('portal/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('portal/assets/js/animation.js') }}"></script>
    <script src="{{ asset('portal/assets/js/imagesloaded.js') }}"></script>
    <script src="{{ asset('portal/assets/js/custom.js') }}"></script>

</body>

</html>

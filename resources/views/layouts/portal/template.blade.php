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
                            <li class="scroll-to-section"><a href="#top" class="active">Beranda</a></li>
                            <li class="scroll-to-section"><a href="#features">Jenjang</a></li>
                            <li class="scroll-to-section"><a href="#about">Abouts</a></li>
                            <li class="scroll-to-section"><a href="#services">Berita</a></li>
                            <li class="scroll-to-section"><a href="#kegiatan">Kegiatan</a></li>
                            <li class="scroll-to-section"><a href="{{ route('ppdb') }}" class="">Daftar</a></li>
                            <li class="scroll-to-section"><a href="{{ route('login') }}" class="">Login</a></li>
                            <li class="scroll-to-section">
                                {{-- <div class="main-blue-button"><a href="{{ route('ppdb') }}">Daftar</a></div> --}}
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
    <!-- ***** Header Area End ***** -->

    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s"
                                data-wow-delay="1s">
										<div class="row">
											<div class="col-lg-12">
												<h2>Selamat Datang Di Al-Azhar BSD</h2>
											</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="/portal/assets/images/banner-right-image.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="features" class="our-services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
                        <h6>Jenjang Pendidikan</h6>
                        <h1>Al-Azhar BSD</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="features-content">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="features-item first-feature wow fadeInUp" data-wow-duration="1s"
                                    data-wow-delay="0s">
                                    <div class="first-number number">
                                        <h6>01</h6>
                                    </div>
                                    <img src="{{ asset('portal/assets/images/tk.jpeg') }}" alt="">
                                    <div class="line-dec"></div>
                                    <p>Pendaftaran Siswa Jenjang TK</p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="features-item second-feature wow fadeInUp" data-wow-duration="1s"
                                    data-wow-delay="0.2s">
                                    <div class="second-number number">
                                        <h6>02</h6>
                                    </div>
                                    <img src="{{ asset('portal/assets/images/sd.jpeg') }}" alt="">
                                    <div class="line-dec"></div>
                                    <p>Pendaftaran Siswa Jenjang SD</p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="features-item first-feature wow fadeInUp" data-wow-duration="1s"
                                    data-wow-delay="0.4s">
                                    <div class="third-number number">
                                        <h6>03</h6>
                                    </div>
                                    <img src="{{ asset('portal/assets/images/smp.jpeg') }}" alt="">
                                    <div class="line-dec"></div>
                                    <p>Pendaftaran Siswa Jenjang SMP
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="features-item second-feature last-features-item wow fadeInUp"
                                    data-wow-duration="1s" data-wow-delay="0.6s">
                                    <div class="fourth-number number">
                                        <h6>04</h6>
                                    </div>
                                    <img src="{{ asset('portal/assets/images/sma.jpeg') }}" alt="">
                                    <div class="line-dec"></div>
                                    <p>Pendaftaran Siswa Jenjang SMA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-image wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                        <img src="/portal/assets/images/bapak.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 align-self-center wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="section-heading">
                        <h6>About Us</h6>
                        <h2>Biografi Al-Azhar BSD</h2>
                    </div>

                    <p>Dalam rangka mencerdaskan kehidupan bangsa seperi yang diamanatkan dalam pembukaan UUD 45, Dewan
                        Pendiri Yayasan Muslim Bumi Serpong Damai telah berinisiatif membangun Perguruan Islam Al-Azhar
                        Bumi Serpong Damai yang tercermin pada Akta Notaris pembangunan fisik sekolah TK, SD,SMP, dan
                        SMA Islam Al-Azhar Bumi Serpong Damai serta Masjid As-Syarif merupakan wujud nyata upaya
                        tersebut.

                        Penyelenggara pendidikan di Perguruan Islam Al-Azhar Bumi Serpong Damai diarahkan pada
                        terbentuknya kualitas generasi muda yang berilmu pengetahuan, berwawasan luas, memiiki
                        keperibadian dan mental spiritual yang tinggi. Untuk tujuan tersebut, secara teknis pada awal
                        penyelenggaraan sekolah, Yayasan Muslim Bumi Serpong Damai bekerja sama dengan Yayasan Syifa
                        Budi pengelola Perguruan Islam Al-Azhar Kemang Jakarta Pimpinan Bapak H. Maulwi Saelan. </p>
                    <div class="main-green-button"><a href="#">Discover company</a></div>
                </div>
            </div>
        </div>
    </div>

    <div id="services" class="our-services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
                        <h6>Berita</h6>
                        <h2>Jalani Pagimu dengan Semangat</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                @foreach ($berita as $p)
                    <div class="col-lg-4">
                        <div class="service-item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                            <div class="row">
                                <div class="col-lg-4">
                                    {{-- <div class="icon"></div> --}}
                                    <img src="{{ asset('berita/' . $p->image) }}" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="right-content">
                                        <h4>{{ Str::limit($p->judul, 20) }}</h4>
                                        <p>{{ Str::limit($p->isi, 20) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="kegiatan" class="our-services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
                        <h6>Kegiatan Sekolah</h6>
                        <h2>Al-Azhar BSD</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                @foreach ($kegiatan as $p)
                    <div class="col-lg-4">
                        <div class="service-item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                            <div class="row">
                                <div class="col-lg-4">
                                    {{-- <div class="icon"></div> --}}
                                    <img src="{{ asset('kegiatan/' . $p->foto) }}" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="right-content">
                                        <h4>{{ Str::limit($p->nama_kegiatan, 20) }}</h4>
                                        <p>{{ Str::limit($p->deskripsi, 20) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Al-Azhar BSD

                        <br>Semakin Baik dari hari ke hari</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    {{-- <script src="{{ asset('portal/vendor/jquery/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('portal/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('portal/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('portal/assets/js/animation.js') }}"></script>
    <script src="{{ asset('portal/assets/js/imagesloaded.js') }}"></script>
    <script src="{{ asset('portal/assets/js/custom.js') }}"></script>

</body>

</html>

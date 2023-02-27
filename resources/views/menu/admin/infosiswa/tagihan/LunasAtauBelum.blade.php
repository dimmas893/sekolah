@extends('layouts.template.template')
@section('content')
    @php
        $role = (int) Auth::user()->role;
    @endphp
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Menu</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('infosiswa') }}">Informasi siswa</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('viewTagihanmenu') }}">Tagihan</a></div>
                    <div class="breadcrumb-item">Tagihan siswa</div>
                </div>
            </div>
            <div class="section-body">
                @if ($role === 1)
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="{{ route('siswa_tagihan_pilih_jenjang') }}">
                                <div class="card shadow card-primary">
                                    <div class="card-body">
                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <img class="d-block" width="100px"
                                                                src="/icon/childrens-kids-icon.webp" alt="First slide">
                                                        </div>
                                                        <div class="col-6">
                                                            <img class="d-block" width="80px" src="/icon/buattagihan.png"
                                                                alt="First slide">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('viewTagihansiswasudahbayar') }}">
                                <div class="card shadow card-primary">
                                    <div class="card-body">
                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <img class="d-block" width="100px"
                                                                src="/icon/childrens-kids-icon.webp" alt="First slide">
                                                        </div>
                                                        <div class="col-6">
                                                            <img class="d-block" width="80px" src="/icon/sudahbayar.png"
                                                                alt="First slide">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('viewTagihansiswabelumdibayar') }}">
                                <div class="card shadow card-primary">
                                    <div class="card-body">
                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <img class="d-block" width="100px"
                                                                src="/icon/childrens-kids-icon.webp" alt="First slide">
                                                        </div>
                                                        <div class="col-6">
                                                            <img class="d-block" width="80px" src="/icon/belumbayar.png"
                                                                alt="First slide">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection

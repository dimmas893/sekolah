@extends('layouts.template.template')
@section('content')
    <form method="get" id="nilaitk_tk" action="{{ route('nilaitk') }}" style="display:none;">
        @csrf
        <input type="hidden" name="jenjang_pendidikan_id" value="4">
        <input type="submit" class="btn btn-primary" value="Masuk">
    </form>
    <form method="get" id="nilaitk_sd" action="{{ route('nilaisd') }}" style="display:none;">
        @csrf
        <input type="hidden" name="jenjang_pendidikan_id" value="1">
        <input type="submit" class="btn btn-primary" value="Masuk">
    </form>
    <form method="get" id="nilaitk_smp" action="{{ route('nilaismp') }}" style="display:none;">
        @csrf
        <input type="hidden" name="jenjang_pendidikan_id" value="2">
        <input type="submit" class="btn btn-primary" value="Masuk">
    </form>
    <form method="get" id="nilaitk_sma" action="{{ route('nilaisma') }}" style="display:none;">
        @csrf
        <input type="hidden" name="jenjang_pendidikan_id" value="3">
        <input type="submit" class="btn btn-primary" value="Masuk">
    </form>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Jenjang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('manage') }}">Manage</a></div>
                    <div class="breadcrumb-item">Semua kelas</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-3">
                        <a href="{{ route('nilaitk') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('nilaitk_tk').submit();">
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
                                                        <img class="d-block" width="80px" src="/icon/tk.png"
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
                        <a href="{{ route('nilaisd') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('nilaitk_sd').submit();">
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
                                                        <img class="d-block" width="80px" src="/icon/sd.png"
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
                        <a href="{{ route('nilaismp') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('nilaitk_smp').submit();">
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
                                                        <img class="d-block" width="80px" src="/icon/smp.png"
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
                        <a href="{{ route('nilaisma') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('nilaitk_sma').submit();">
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
                                                        <img class="d-block" width="80px" src="/icon/sma.png"
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
            </div>
        </section>
    </div>
@endsection

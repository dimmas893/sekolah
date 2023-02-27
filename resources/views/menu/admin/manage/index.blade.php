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
                    <div class="breadcrumb-item">Manage</div>
                </div>
            </div>
            <div class="section-body">
                @if ($role === 1)
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="{{ route('admin') }}">
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
                                                            <img class="d-block" width="100px" src="/icon/admin.png"
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
                            <a href="{{ route('tahun-ajaran') }}">
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
                                                            <img class="d-block" width="100px" src="/icon/tahunajaran.png"
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
                            <a href="{{ route('setting') }}">
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
                                                            <img class="d-block" width="100px" src="/icon/setting.png"
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
                        {{-- <div>soal</div>
                        <div class="col-lg-3">
                            <a href="{{ route('siswa') }}">
                                <div class="card">
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
                                                            <img class="d-block" width="80px" src="/icon/siswa.png"
                                                                alt="First slide">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> --}}
                        {{-- <div class="col-lg-3">
                            <a href="{{ route('pengaturan') }}">
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
                                                            <img class="d-block" width="90px" src="/icon/pengaturan.png"
                                                                alt="First slide">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> --}}
                        <div class="col-lg-3">
                            <a href="{{ route('manageNilai') }}">
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
                                                            <img class="d-block" width="100px" src="/icon/nilai.png"
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
                            <a href="{{ route('manageJadwal') }}">
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
                                                            <img class="d-block" width="90px" src="/icon/jadwal.png"
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
                            <a href="{{ route('guru') }}">
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
                                                            <img class="d-block" width="100px" src="/icon/guru.png"
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
                            <a href="{{ route('kelas') }}">
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
                                                            <img class="d-block" width="80px"
                                                                src="/icon/masterkelas.png" alt="First slide">
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
                            <a href="{{ route('datakelas') }}">
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
                                                            <img class="d-block" width="80px" src="/icon/kelas.png"
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
                            <a href="{{ route('mata_pelajaran') }}">
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
                                                            <img class="d-block" width="80px"
                                                                src="/icon/matapelajaran.png" alt="First slide">
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
                            <a href="{{ route('ruangan') }}">
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
                                                            <img class="d-block" width="80px" src="/icon/ruangan.png"
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
                            <a href="{{ route('manageTugas') }}">
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
                                                            <img class="d-block" width="80px" src="/icon/tugas.png"
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
                            <a href="{{ route('perpustakaan') }}">
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
                                                            <img class="d-block" width="80px"
                                                                src="/icon/perpustakaan.png" alt="First slide">
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
                            <a href="{{ route('berita') }}">
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
                                                            <img class="d-block" width="80px" src="/icon/berita.png"
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
                            <a href="{{ route('kegiatan_1') }}">
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
                                                            <img class="d-block" width="80px" src="/icon/kegiatan.png"
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
                            <a href="{{ route('perpustakaan_member') }}">
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
                                                            <img class="d-block" width="80px"
                                                                src="/icon/memberperpustakaan.png" alt="First slide">
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
                            <a href="{{ route('kurikulum') }}">
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
                                                            <img class="d-block" width="80px" src="/icon/kurikulum.png"
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

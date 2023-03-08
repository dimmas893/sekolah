@extends('layouts.template.template')
@section('content')
    @php
        $role = (int) Auth::user()->role;
    @endphp
    <form method="get" id="menutugas_id" action="{{ route('menutugas') }}" style="display:none;">
        @csrf
        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
        <input type="submit" class="btn btn-primary" value="Masuk">
    </form>
    <form method="get" id="menuabsenmassal_id" action="{{ route('menuabsenmassal') }}" style="display:none;">
        @csrf
        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
        <input type="submit" class="btn btn-primary" value="Masuk">
    </form>
    <form method="get" id="menuubahabsen_id" action="{{ route('menuubahabsen') }}" style="display:none;">
        @csrf
        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
        <input type="submit" class="btn btn-primary" value="Masuk">
    </form>
    <form method="get" id="menusiswa_id" action="{{ route('menusiswa') }}" style="display:none;">
        @csrf
        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
        <input type="submit" class="btn btn-primary" value="Masuk">
    </form>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $jadwal->kelasget->kelas->name }} / {{ $jadwal->ruangan->name }} /
                    {{ $jadwal->mata_pelajaran->name }} /
                    {{ $jadwal->jam_masuk }} - {{ $jadwal->jam_keluar }} / Total ({{ $count }}) Siswa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('jadwal_buat_guru') }}">Jadwal</a>
                    </div>
                    <div class="breadcrumb-item">Kelas</div>
                </div>
            </div>
            <div class="section-body">
                @if ($role === 3)
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="{{ route('menusiswa') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('menusiswa_id').submit();">
                                <div class="card shadow-success card-success">
                                    <div class="card-body">
                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <img class="d-block" width="90px"
                                                                src="/icon/dashboard-line-icon.png" alt="First slide">
                                                        </div>
                                                        <div class="col-6">
                                                            <img class="d-block" width="90px" src="/icon/siswa.png"
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
                            <a href="{{ route('menutugas') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('menutugas_id').submit();">
                                <div class="card shadow-success card-success">
                                    <div class="card-body">
                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <img class="d-block" width="90px"
                                                                src="/icon/dashboard-line-icon.png" alt="First slide">
                                                        </div>
                                                        <div class="col-6">
                                                            <img class="d-block" width="90px" src="/icon/tugas.png"
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
                            <a href="{{ route('menuabsenmassal') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('menuabsenmassal_id').submit();">
                                <div class="card shadow-success card-success">
                                    <div class="card-body">
                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class="row">
                                                        <div class="col-6 mt-2">
                                                            <img class="d-block" width="90px"
                                                                src="/icon/childrens-kids-icon.webp" alt="First slide">
                                                        </div>
                                                        <div class="col-6">
                                                            <img class="d-block" width="90px" src="/icon/absen.png"
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
                            <a href="{{ route('menuubahabsen') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('menuubahabsen_id').submit();">
                                <div class="card shadow-success card-success">
                                    <div class="card-body">
                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class="row">
                                                        <div class="col-6 mt-2">
                                                            <img class="d-block" width="90px"
                                                                src="/icon/childrens-kids-icon.webp" alt="First slide">
                                                        </div>
                                                        <div class="col-6">
                                                            <img class="d-block" width="90px" src="/icon/ubahabsen.png"
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

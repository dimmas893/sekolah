@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Kelas</h1>
                <div class="section-header-breadcrumb">
                    {{-- <div class="breadcrumb-item active"><a href="{{ route('jadwal') }}">Table Jadwal
                        </a></div> --}}
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    {{-- <div class="breadcrumb-item active"><a href="{{ route('manage') }}">Manage</a></div> --}}
                    <div class="breadcrumb-item">Semua kelas</div>
                </div>
            </div>
            <div class="section-body">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            Semua Kelas
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div
                                            class="card-header d-flex justify-content-between bg-secondary align-items-center">
                                            TK
                                            <div> <a href="{{ route('tk') }}" class="badge badge-primary">Jadwal</a>
                                                <a href="{{ route('nilaitk') }}" class="badge badge-success">Nilai</a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($tk as $item)
                                                    <div class="col-3">
                                                        <div class="card">
                                                            <div
                                                                class="card-header d-flex justify-content-between align-items-center">
                                                                {{ $item->kelas->name }}
                                                                <a href="{{ route('datakelasadmin', $item->id) }}"
                                                                    class="badge badge-primary">Masuk</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div
                                            class="card-header d-flex justify-content-between bg-secondary align-items-center">
                                            SD
                                            <div>
                                                <a href="{{ route('sd') }}" class="badge badge-primary">Jadwal</a>
                                                <a href="{{ route('nilaisd') }}" class="badge badge-success">Nilai</a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($sd as $item)
                                                    <div class="col-3">
                                                        <div class="card">
                                                            <div
                                                                class="card-header d-flex justify-content-between align-items-center">
                                                                {{ $item->kelas->name }}
                                                                <a href="{{ route('datakelasadmin', $item->id) }}"
                                                                    class="badge badge-primary">Masuk</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div
                                            class="card-header d-flex justify-content-between bg-secondary align-items-center">
                                            SMP
                                            <div>

                                                <a href="{{ route('smp') }}" class="badge badge-primary">Jadwal</a>
                                                <a href="{{ route('nilaismp') }}" class="badge badge-success">Nilai</a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($smp as $item)
                                                    <div class="col-3">
                                                        <div class="card">
                                                            <div
                                                                class="card-header d-flex justify-content-between align-items-center">
                                                                {{ $item->kelas->name }}
                                                                <a href="{{ route('datakelasadmin', $item->id) }}"
                                                                    class="badge badge-primary">Masuk</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div
                                            class="card-header d-flex justify-content-between bg-secondary align-items-center">
                                            SMA
                                            <div>
                                                <a href="{{ route('sma') }}" class="badge badge-primary">Jadwal</a>
                                                <a href="{{ route('nilaisma') }}" class="badge badge-success">Nilai</a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($sma as $item)
                                                    <div class="col-3">
                                                        <div class="card">
                                                            <div
                                                                class="card-header d-flex justify-content-between align-items-center">
                                                                {{ $item->kelas->name }}
                                                                <a href="{{ route('datakelasadmin', $item->id) }}"
                                                                    class="badge badge-primary">Masuk</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

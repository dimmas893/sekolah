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
                    <div class="breadcrumb-item active"><a href="{{ route('manage') }}">Manage</a></div>
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
                                            <div>
                                                <form action="{{ route('manageTugasMataPelajaran') }}" method="get">
                                                    @csrf
                                                    <input type="hidden" name="jenjang_pendidikan_id" value="4">
                                                    <input type="submit" class="btn btn-primary" value="Masuk">
                                                </form>
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
                                                <form action="{{ route('manageTugasMataPelajaran') }}" method="get">
                                                    @csrf
                                                    <input type="hidden" name="jenjang_pendidikan_id" value="1">
                                                    <input type="submit" class="btn btn-primary" value="Masuk">
                                                </form>
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
                                                <form action="{{ route('manageTugasMataPelajaran') }}" method="get">
                                                    @csrf
                                                    <input type="hidden" name="jenjang_pendidikan_id" value="2">
                                                    <input type="submit" class="btn btn-primary" value="Masuk">
                                                </form>
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
                                                <form action="{{ route('manageTugasMataPelajaran') }}" method="get">
                                                    @csrf
                                                    <input type="hidden" name="jenjang_pendidikan_id" value="3">
                                                    <input type="submit" class="btn btn-primary" value="Masuk">
                                                </form>
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

@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Kelas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('infosiswa') }}">Informasi siswa</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('viewTagihanmenu') }}">Tagihan</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('viewTagihansiswa') }}">Tagihan siswa</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('viewTagihansiswabelumdibayar') }}">Tagihan siswa
                            belum bayar</a></div>
                    <div class="breadcrumb-item">Pilih kelas</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header d-flex justify-content-between bg-secondary align-items-center">
                                {{ $jenjang->nama }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($kelas as $item)
                                        <div class="col-3">
                                            <div class="card card-primary shadow">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    {{ $item->kelas->kelas->name }}
                                                    <form action="{{ route('viewTagihansiswabelumdibayarPilihtagihan') }}"
                                                        method="get">
                                                        @csrf
                                                        <input type="hidden" name="kelas_id" value="{{ $item->kelas_id }}">
                                                        <input type="hidden" name="jenjang_pendidikan_id"
                                                            value="{{ $jenjang->id }}">
                                                        <button class="btn btn-primary">Masuk</button>
                                                    </form>
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
        </section>
    </div>
@endsection

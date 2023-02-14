@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                @if ($cek === 5)
                    <h1>Riwayat Pembayaran</h1>
                @endif
                @if ($cek === 4)
                    <h1>Riwayat Pembayaran</h1>
                @endif
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Riwayat Pembayaran</div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        @if ($cek === 5)
                            <h4>Riwayat Pembayaran</h4>
                        @endif
                        @if ($cek === 4)
                            <h4>Riwayat Pembayaran</h4>
                        @endif
                    </div>
                    <form action="{{ route('postPembayaranSiswa') }}" method="post">
                        @csrf
                        <div class="row mt-2 ml-2 mr-2">
                            <div class="col-12 col-lg-4 col-md-12 col-xl-4 col-xxl-12 col-sm-12">
                                <label for="">Tahun Pembayaran</label>
                                <select name="id_tahun_ajaran" class="form-control">
                                    <option value=""disabled selected>---Pilih Tahun---</option>
                                    <option value="">Semua tahun</option>
                                    @foreach ($tahun_ajaran as $p)
                                        <option value="{{ $p->year }}">{{ $p->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-lg-4 col-md-12 col-xl-4 col-xxl-12 col-sm-12">
                                <label for="">Semester</label>
                                <select name="semester" class="form-control">
                                    <option value="" disabled selected>---Pilih Semester---</option>
                                    <option value="">Semua Semester</option>
                                    @foreach ($semester as $p)
                                        <option value="{{ $p->relasiSemester->id }}">{{ $p->relasiSemester->semester }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-lg-4 col-md-12 col-xl-4 col-xxl-12 col-sm-12 mt-4">
                                <label for=""></label>
                                <input type="submit" class="btn btn-primary" value="Filter" />
                            </div>
                        </div>
                    </form>

                    <div class="row mt-4">
                        @foreach ($pembayaran as $p)
                            <div class="col-12 col-lg-3 col-md-12 col-xl-3 col-xxl-12 col-sm-12">
                                @if ($cek === 5)
                                    <div class="card ml-2 mr-2">
                                        <div
                                            class="card-header bg-secondary d-flex justify-content-between align-items-center">
                                            <h4>{{ $p->id_pembayaran }}</h4>
                                            <a href="{{ route('PembayaranSiswaDetail', $p->id_pembayaran) }}"
                                                class="text-info"><i class="ion-eye h3"></i></a>
                                        </div>
                                @endif
                                @if ($cek === 4)
                                    <div class="card ml-2 mr-2">
                                        <div
                                            class="card-header bg-secondary d-flex justify-content-between align-items-center">
                                            <h4>{{ $p->id_pembayaran }}</h4>
                                            <a href="{{ route('PembayaranSiswaDetail', $p->id_pembayaran) }}"
                                                class="text-info"><i class="ion-eye h3"></i></a>
                                        </div>
                                @endif
                                <div class="">
                                    <div class="card-body">
                                        <p><b>{{ $p->tanggal_pembayaran }} - Rp
                                                {{ number_format($p->total_pembayaran, 2, ',', '.') }}</b></p>
                                        <p><b></b></p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection

@section('js')
@endsection

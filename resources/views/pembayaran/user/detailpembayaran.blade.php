@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Rincian Riwayat Pembayaran Siswa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('PembayaranSiswa') }}">Riwayat Pembayaran</a></div>
                    <div class="breadcrumb-item">Rincian Riwayat Pembayaran</div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Rincian Pembayaran</h4>
                    </div>
                    <div class="row">
                        @foreach ($PembayaranDetail as $p)
                            <div class="col-12 col-lg-3 col-md-12 col-xl-3 col-xxl-12 col-md-sm">
                                <div class="card ml-2 mr-2">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        @if ($p->id_invoice == 1)
                                            <h4>Fee</h4>
                                        @else
                                            <h4>{{ $p->invoice->kategori_tagihan->kategori_tagihan->nama_kategori }}</h4>
                                        @endif

                                        <i class="text-success ion-checkmark-round h4"></i>
                                    </div>
                                    <div class="">
                                        <div class="card-body">
                                            <p><b>{{ $p->tanggal_pembayaran }} - Rp
                                                    {{ number_format($p->nominal_pembayaran, 2, ',', '.') }}</b></p>
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

@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Data Pembayaran {{ $pembayaran->siswa->nama_siswa }}</h1>
            </div>

            <div class="row">
                @foreach ($rincian_pembayaran as $item)
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <div class="">
                                    {{ $item->invoice->kategori_tagihan->nama_kategori }}
                                </div>
                                <div class="text-right"><i class="ion-checkmark-round text-success h4"></i></div>
                            </div>
                            <div class="card-body">
                                <p>{{ $item->invoice->kategori_tagihan->deskripsi }}</p>
                                <p>Rp {{ $item->invoice->kategori_tagihan->nominal }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-3">
                    <a href="{{ route('pembayaran') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </section>
    </div>
@endsection

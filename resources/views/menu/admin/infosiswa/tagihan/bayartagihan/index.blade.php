@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Menu</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('infosiswa') }}">Informasi siswa</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('viewTagihanmenu') }}">Tagihan</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('searchbayartagihan') }}">Pencarian</a></div>
                    <div class="breadcrumb-item">Pencarian berdasarkan invoice</div>
                </div>
            </div>
            <div class="section-body">
                <form action="{{ route('bayartagihan-id-invoice') }}" method="get">
                    <div class="row">
                        @csrf
                        <div class="col-8">
                            <input type="text" class="form-control shadow" name="id_invoice"
                                placeholder="masukan id invoice">
                        </div>
                        <div class="col-4">
                            <input type="submit" class="btn btn-primary shadow" value="cari">
                        </div>
                    </div>
                </form>
                {{-- <select class="form-control" id="js-example-basic-single">
                    @foreach ($siswa as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_siswa }}</option>
                    @endforeach
                </select> --}}
                @if ($invoice === 0)
                @else
                    {{-- {{ $invoice }} --}}
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 col-xxl-3 ">
                            <div class="card shadow-primary card-primary">
                                <div class="card-header">
                                    {{ $invoice->id_invoice }}
                                </div>
                                <div class="card-body">
                                    <div>{{ $invoice->dataSiswa->nama_siswa }}</div>
                                    <div>
                                        {{ $invoice->kategori_tagihan->kategori_tagihan->nama_kategori }} - Rp
                                        {{ $invoice->nominal }}
                                    </div>
                                    <div>
                                        <p style="color:red">{{ $invoice->status }}</p>
                                    </div>
                                    <div>
                                        <form action="{{ route('simpanpembayaranadmin') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id_invoice" value="{{ $invoice->id_invoice }}">
                                            <input type="submit" class="btn btn-primary" value="bayar">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script>
        $(document).ready(function() {

            $('#js-example-basic-single').select2();
        });
    </script>
@endsection

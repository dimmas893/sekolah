@extends('layouts.template.template')
@section('content')
    <form method="get" id="viewTagihansiswabelumdibayarPilihKelas_id"
        action="{{ route('viewTagihansiswabelumdibayarPilihKelas') }}" style="display:none;">
        @csrf
        <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang->id }}">
    </form>
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
                    <div class="breadcrumb-item active"><a href="{{ route('viewTagihansiswabelumdibayarPilihKelas') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('viewTagihansiswabelumdibayarPilihKelas_id').submit();">
                            Pilih kelas
                        </a></div>
                    <div class="breadcrumb-item">Pilih Siswa</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between bg-secondary align-items-center">
                                {{ $jenjang->nama }} -
                                {{ \App\Models\Kelas::with('kelas')->where('id', $kelas)->first()->kelas->name }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($invoice as $item)
                                        <div class="col-3">
                                            <div class="card shadow card-primary">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    {{ $item->dataSiswa->nama_siswa }}
                                                    <form action="{{ route('viewTagihansiswabelumdibayarsemuatagihan') }}"
                                                        method="get">
                                                        @csrf
                                                        <input type="hidden" name="id_siswa"
                                                            value="{{ $item->id_siswa }}">
                                                        <input type="hidden" name="kelas_id" value="{{ $kelas }}">
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

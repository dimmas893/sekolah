@extends('layouts.template.template')
@section('content')
    <form method="get" id="viewTagihansiswasudahbayarPilihKelas_id"
        action="{{ route('viewTagihansiswasudahbayarPilihKelas') }}" style="display:none;">
        @csrf
        <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang->id }}">
        {{-- <input type="hidden" name="kelas_id" value="{{ $kelas }}"> --}}
    </form>

    <form method="get" id="viewTagihansiswasudahbayarPilihtagihan_id"
        action="{{ route('viewTagihansiswasudahbayarPilihtagihan') }}" style="display:none;">
        @csrf
        <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang->id }}">
        <input type="hidden" name="kelas_id" value="{{ $kelas }}">
        {{-- <input type="hidden" name="id_siswa" value="{{ $siswa }}"> --}}
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
                    <div class="breadcrumb-item active"><a href="{{ route('viewTagihansiswasudahbayar') }}">Tagihan siswa
                            sudah bayar</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('viewTagihansiswasudahbayarPilihKelas') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('viewTagihansiswasudahbayarPilihKelas_id').submit();">
                            Pilih kelas
                        </a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('viewTagihansiswasudahbayarPilihtagihan') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('viewTagihansiswasudahbayarPilihtagihan_id').submit();">
                            Pilih Siswa
                        </a></div>
                    <div class="breadcrumb-item">Semua tagihan</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between bg-secondary align-items-center">
                                {{ $jenjang->nama }} -
                                {{ \App\Models\Kelas::with('kelas')->where('id', $kelas)->first()->kelas->name }} -
                                {{ \App\Models\Siswa::where('id', $siswa)->first()->nama_siswa }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($invoice as $item)
                                        <div class="col-3">
                                            <div class="card shadow card-primary">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    {{ $item->id_invoice }} -
                                                    {{ $item->kategori_tagihan->kategori_tagihan->nama_kategori }} -
                                                    Rp {{ $item->nominal }}
                                                    {{-- <form action="{{ route('viewTagihansiswasudahbayarPilihKelas') }}"
                                                        method="get">
                                                        @csrf
                                                        <input type="hidden" name="kelas_id" value="{{ $item->id }}">
                                                        <input type="hidden" name="jenjang_pendidikan_id"
                                                            value="{{ $jenjang->id }}">
                                                        <button class="btn btn-primary">Masuk</button>
                                                    </form> --}}
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

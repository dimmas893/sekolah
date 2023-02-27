@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Laporan Siswa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('infosiswa') }}">Informasi siswa</a>
                    </div>
                    <div class="breadcrumb-item">Pencaarian kelas</div>
                </div>
            </div>

            <div class="">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('laporan_absen_admin') }}" method="get">
                            @csrf
                            <div class="">
                                <select name="kelas_id" class="form-control">
                                    <option value="">---Pilih Kelas---</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}">{{ $item->kelas->name }} /
                                            {{ $item->tahun_ajaran->tahun_ajaran }}
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center mt-2">
                                <input type="submit" class="btn btn-primary" value="cari">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

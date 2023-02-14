@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Jadwals {{ Auth::user()->name }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Daftar Jadwal</div>
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-12">
                @foreach ($mata_pelajaran as $pu)
                    <div class="card">
                        <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                            <h4>{{ $pu->name }}</h4>

                            <a href="" class="btn btn-primary">Nilai</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($jadwal->where('mata_pelajaran_id', $pu->id) as $kel)
                                    <div class="col-md-12 col-lg-12 col-xl-3 col-xxl-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h4>{{ $kel->kelasget->kelas->name }} /
                                                    {{ $kel->ruangan->name }} -
                                                    {{ $kel->mata_pelajaran->name }}
                                                    ({{ \App\Models\Siswa::where('kelas', $kel->kelas_id)->count() }}
                                                    Siswa)
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <p>{{ $kel->hari->name }}</p>
                                                <p>{{ $kel->jam_masuk }} - {{ $kel->jam_keluar }}</p>
                                                <a href="{{ route('jadwal-semua-siswa', $kel->id) }}"
                                                    class="btn btn-primary">Masuk</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

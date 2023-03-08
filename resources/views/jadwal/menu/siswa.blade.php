@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <div>
            <section class="section">
                <div class="section-header">
                    <h1>{{ $jadwal->kelasget->kelas->name }} / {{ $jadwal->ruangan->name }} /
                        {{ $jadwal->mata_pelajaran->name }} /
                        {{ $jadwal->jam_masuk }} - {{ $jadwal->jam_keluar }}</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                        <div class="breadcrumb-item active"><a href="{{ route('jadwal_buat_guru') }}">Jadwal</a></div>
                        <div class="breadcrumb-item active"><a href="{{ route('jadwal-semua-siswa', $jadwal->id) }}">Kelas</a>
                        </div>
                        <div class="breadcrumb-item">Siswa</div>
                    </div>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-primary card-primary">
                                <div class="row mt-3 ml-3 mr-3">
                                    @foreach ($rincian_siswa as $item)
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="card shadow-success card-success">
                                                <div
                                                    class="card-header bg-light d-flex justify-content-between align-items-center">
                                                    <div class="">
                                                        <i class="ion-android-person h3"></i>
                                                        {{ $item->nama_siswa }}
                                                    </div>
                                                    <div class="text-right">{{ $item->jenis_kelamin }}</div>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ $item->email }}</p>
                                                    <p>{{ $item->alamat }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row mb-3 ml-3 mr-3">
                                    <div class="col-md-2 col-12">
                                        {{-- <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#siswa"
                                    aria-expanded="false" aria-controls="siswa">
                                    Tutup
                                </button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
@endsection

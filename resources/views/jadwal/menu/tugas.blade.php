@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <div id="tabs">
            <section class="section">
                <div class="section-header">
                    <h1>{{ $jadwal->kelasget->kelas->name }} / {{ $jadwal->ruangan->name }} /
                        {{ $jadwal->mata_pelajaran->name }} /
                        {{ $jadwal->jam_masuk }} - {{ $jadwal->jam_keluar }}</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                        <div class="breadcrumb-item active"><a href="{{ route('jadwal_buat_guru') }}">Jadwal</a></div>
                        <div class="breadcrumb-item active"><a
                                href="{{ route('jadwal-semua-siswa', $jadwal->id) }}">Kelas</a>
                        </div>
                        <div class="breadcrumb-item">Tugas</div>
                    </div>
                </div>
                <div id="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-primary card-primary">
                                <div class="card-header">
                                    <h4>Buat Tugas</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('tugas-store-biasa') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label for="">Tanggal Tugas</label>
                                                <input type="date" name="tanggal_tugas" class="form-control"
                                                    placeholder="Masukan Tanggal Tugas" required>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label for="">Tanggal Pengumpulan</label>
                                                <input type="date" name="tanggal_pengumpulan" class="form-control"
                                                    placeholder="Masukan Tanggal Pengumpulan" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label for="">Tanggal Evaluasi</label>
                                                <input type="date" name="tanggal_evaluasi" class="form-control"
                                                    placeholder="Masukan Tanggal Evaluasi" required>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label for="">File Tugas</label>
                                                <input type="file" name="file_tugas" class="form-control"
                                                    placeholder="Masukan File Tugas" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-12 col-12">
                                                <label for="">Judul Tugas</label>
                                                <input type="text" name="nama" class="form-control"
                                                    placeholder="Masukan Judul Tugas" required>
                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label for="">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" placeholder="Masukan Deskripsi" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <input type="submit" class="btn btn-primary" value="Buat">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection

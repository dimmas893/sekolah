@extends('layouts.template.template')
@section('content')
    <form method="get" id="manageTugasMataPelajaran_id" action="{{ route('manageTugasMataPelajaran') }}"
        style="display:none;">
        @csrf
        <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jadwal->jenjang_pendidikan_id }}">
    </form>
    <form method="get" id="manageTugasMataPelajaranguru_id" action="{{ route('manageTugasMataPelajaranguru') }}"
        style="display:none;">
        @csrf
        <input type="hidden" name="mata_pelajaran_id" value="{{ $jadwal->mata_pelajaran_id }}">
        <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jadwal->jenjang_pendidikan_id }}">
    </form>

    <form method="get" id="manageTugasMataPelajarangurujadwal_id"
        action="{{ route('manageTugasMataPelajarangurujadwal') }}">
        @csrf
        <input type="hidden" name="mata_pelajaran_id" value="{{ $jadwal->mata_pelajaran_id }}">
        <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jadwal->jenjang_pendidikan_id }}">
        <input type="hidden" name="guru_id" value="{{ $jadwal->guru_id }}">
    </form>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tugas</h1>
                <div class="section-header-breadcrumb">
                    {{-- <div class="breadcrumb-item active"><a href="{{ route('jadwal') }}">Table Jadwal
                        </a></div> --}}
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('manage') }}">Manage</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('manageTugas') }}">Semua kelas</a></div>
                    <div class="breadcrumb-item active"> <a class="" href="{{ route('manageTugasMataPelajaran') }}"
                            onclick="event.preventDefault();document.getElementById('manageTugasMataPelajaran_id').submit();">Mata
                            Pelajaran
                        </a></div>
                    <div class="breadcrumb-item active"> <a class="" href="{{ route('manageTugasMataPelajaran') }}"
                            onclick="event.preventDefault();document.getElementById('manageTugasMataPelajaranguru_id').submit();">Guru
                        </a></div>
                    <div class="breadcrumb-item active"> <a class=""
                            href="{{ route('manageTugasMataPelajarangurujadwal') }}"
                            onclick="event.preventDefault();document.getElementById('manageTugasMataPelajarangurujadwal_id').submit();">Jadwal
                        </a></div>
                    <div class="breadcrumb-item">Tugas</div>
                </div>
            </div>
            <div class="section-body">
                <div class="">
                    <div class="row">
                        <div class="col-6">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between bg-secondary align-items-center">
                                {{ \App\Models\JenjangPendidikan::where('id', $jadwal->jenjang_pendidikan_id)->first()->nama }}
                                -
                                {{ \App\Models\Mata_Pelajaran::where('id', $jadwal->mata_pelajaran_id)->first()->name }} -
                                {{ \App\Models\Guru::where('id', $jadwal->guru_id)->first()->name }} -
                                {{ \App\Models\Kelas::with('kelas')->where('id', $jadwal->kelas_id)->first()->kelas->name }}
                                -
                                {{ \App\Models\Ruangan::where('id', $jadwal->ruangan_id)->first()->name }} -
                                {{ \App\Models\Hari::where('id', $jadwal->hari_id)->first()->name }} -
                                {{ $jadwal->jam_masuk }} -
                                {{ $jadwal->jam_keluar }}
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
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
                                                        <input type="date" name="tanggal_pengumpulan"
                                                            class="form-control" placeholder="Masukan Tanggal Pengumpulan"
                                                            required>
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
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
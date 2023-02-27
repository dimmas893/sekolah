@extends('layouts.template.template')
@section('content')
    <form method="get" id="manageTugasMataPelajaran_id" action="{{ route('manageTugasMataPelajaran') }}"
        style="display:none;">
        @csrf
        <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang_pendidikan_id }}">
    </form>
    <form method="get" id="manageTugasMataPelajaranguru_id" action="{{ route('manageTugasMataPelajaranguru') }}"
        style="display:none;">
        @csrf
        <input type="hidden" name="mata_pelajaran_id" value="{{ $mata_pelajaran_id }}">
        <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang_pendidikan_id }}">
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
                    <div class="breadcrumb-item">Jadwal</div>
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
                                {{ \App\Models\JenjangPendidikan::where('id', $jenjang_pendidikan_id)->first()->nama }} -
                                {{ \App\Models\Mata_Pelajaran::where('id', $mata_pelajaran_id)->first()->name }} -
                                {{ \App\Models\Guru::where('id', $guru_id)->first()->name }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($jadwal as $item)
                                        <div class="col-md-12 col-lg-12 col-xl-3 col-xxl-12 col-sm-12">
                                            <div class="card card-primary">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    <h4>{{ \App\Models\Jadwal::with('kelasget')->where('id', $item->id)->first()->kelasget->kelas->name }}
                                                        /
                                                        {{ \App\Models\Jadwal::with('ruangan')->where('mata_pelajaran_id', $mata_pelajaran_id)->where('id', $item->id)->first()->ruangan->name }}
                                                        {{ \App\Models\Jadwal::with('mata_pelajaran')->where('mata_pelajaran_id', $mata_pelajaran_id)->where('id', $item->id)->first()->mata_pelajaran->name }}
                                                        -{{ \App\Models\Siswa::where('kelas',\App\Models\Jadwal::with('ruangan')->where('id', $item->id)->first()->kelas_id)->count() }}
                                                        (Siswa)
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ \App\Models\Jadwal::with('hari')->where('id', $item->id)->first()->hari->name }}
                                                    </p>
                                                    <p>{{ \App\Models\Jadwal::with('kelasget')->where('id', $item->id)->first()->jam_masuk }}
                                                        -
                                                        {{ \App\Models\Jadwal::with('kelasget')->where('id', $item->id)->first()->jam_keluar }}
                                                    </p>
                                                    <form
                                                        action="{{ route('manageTugasMataPelajarangurujadwalbuattugas') }}"
                                                        method="get">
                                                        @csrf
                                                        <input type="hidden" name="jadwal_id" value="{{ $item->id }}">
                                                        <input type="submit" class="btn btn-primary" value="Masuk">
                                                    </form>
                                                    {{-- <a href="" class="btn btn-primary">Masuk</a> --}}
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

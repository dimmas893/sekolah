@extends('layouts.template.template')
@section('content')
    <form method="get" id="pilihmatapelajaran_id" action="{{ route('pilihmatapelajaran') }}" style="display:none;">
        @csrf
        <input type="hidden" name="guru_id" value="{{ $guru->id }}">
    </form>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tugas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"> <a href="{{ route('pilihmatapelajaran') }}"
                            onclick="event.preventDefault();document.getElementById('pilihmatapelajaran_id').submit();">Mata
                            Pelajaran
                        </a></div>
                    <div class="breadcrumb-item">Kelas</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <div class="">
                                <div class="row">
                                    @foreach ($tingkatan as $item)
                                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-3 col-xxl-3">
                                            <div class="card shadow card-primary">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    {{-- {{ \App\Models\Tingkatan::where('tingkat', $item->tingkatan_id)->first()->tingkat }} --}}
                                                    {{ $item->kelasget->kelas->name }}
                                                    <form
                                                        action="{{ route('manageTugasMataPelajarangurujadwalbuattugas') }}"
                                                        method="get">
                                                        @csrf
                                                        <input type="hidden" name="mata_pelajaran_id"
                                                            value="{{ $mataPelajaran }}">
                                                        <input type="hidden" name="kelas_id" value="{{ $item->kelas_id }}">
                                                        <input type="hidden" name="jenjang_pendidikan_id"
                                                            value="{{ $item->jenjang_pendidikan_id }}">
                                                        <input type="hidden" name="guru_id" value="{{ $guru->id }}">
                                                        <input type="submit" class="btn btn-primary" value="Masuk">
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

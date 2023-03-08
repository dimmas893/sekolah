@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ujian</h1>
                <div class="section-header-breadcrumb">
                    {{-- <div class="breadcrumb-item active"><a href="{{ route('jadwal') }}">Table Jadwal
                        </a></div> --}}
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('manage') }}">Manage</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('pilihjenjangujian') }}">Jenjang</a></div>
                    <div class="breadcrumb-item">Tingkatan</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow card-success">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                {{ \App\Models\JenjangPendidikan::where('id', $jenjang_pendidikan_id)->first()->nama }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($tingkatan as $item)
                                        <div class="col-3">
                                            <div class="card shadow card-primary">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    {{-- {{ $item->tingkatan->name }} --}}
                                                    {{ \App\Models\Master_Kelas::where('id', $item->id_master_kelas)->first()->tingkatan_id }}
                                                    <form action="{{ route('pilihmatapelajaranujian') }}" method="get">
                                                        @csrf
                                                        <input type="hidden" name="tingkatan_id"
                                                            value="{{ $item->kelas->tingkatan_id }}">
                                                        <input type="hidden" name="jenjang_pendidikan_id"
                                                            value="{{ $jenjang_pendidikan_id }}">
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

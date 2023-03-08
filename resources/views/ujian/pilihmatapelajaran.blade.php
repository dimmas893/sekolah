@extends('layouts.template.template')
@section('content')
    <form method="get" id="pilihtingkatanujian_id" action="{{ route('pilihtingkatanujian') }}" style="display:none;">
        @csrf
        <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang_pendidikan_id }}">
        <input type="submit" class="btn btn-primary" value="Masuk">
    </form>
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
                    <div class="breadcrumb-item active"><a href="{{ route('pilihtingkatanujian') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('pilihtingkatanujian_id').submit();">Tingkatan</a>
                    </div>
                    <div class="breadcrumb-item">Mata Pelajaran</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow card-success">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                {{ \App\Models\JenjangPendidikan::where('id', $jenjang_pendidikan_id)->first()->nama }}
                                -
                                {{ \App\Models\Tingkatan::where('id', $tingkatan_id)->first()->name }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($mata_pelajaran as $item)
                                        {{-- {{ $item }} --}}
                                        <div class="col-3">
                                            <div class="card shadow card-primary">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    {{ $item->name }} @if ($item->jurusan != null)
                                                        - {{ $item->jurusan }}
                                                    @endif
                                                    <a
                                                        href="/tabel-ujian/{{ $item->id }}/{{ $tingkatan_id }}/{{ $jenjang_pendidikan_id }}"class="btn btn-primary">Masuk
                                                    </a>
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

@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <div id="tabs">
            <section class="section">
                <div class="section-header">
                    <h1> Pembagian Kelas </h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('siswatokelas') }}">Pilih tingkat</a></div>
                        <div class="breadcrumb-item">Halaman Pembagian Kelas</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-10 col-12">
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" style="list-style: none;"
                                                aria-labelledby="dropdownMenuButton">
                                                <ul style="list-style:none;">
                                                    <li><a class="dropdown-item" href="#tabs-1">Lihat Siswa</a></li>
                                                    <li><a class="dropdown-item" href="#tabs-3">Lihat Kelas</a></li>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $p = 0;
                @endphp
                <div id="tabs-1">
                    <form action="{{ route('bagi-kelas') }}" method="post">
                        @csrf

                        <div class="card">
                            <div class="row mt-3 ml-3 mr-3">
                                @foreach ($siswa as $item)
                                    @if (count($siswa) > 0)
                                        <input type="hidden" value="{{ $item->id }}"
                                            name="siswa_id[]{{ $p++ }}">
                                        <input type="hidden" value="{{ $item->tingkat }}" name="tingkatan_id">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="card">
                                                <div
                                                    class="card-header bg-light d-flex justify-content-between align-items-center">
                                                    <div class="">
                                                        <i class="ion-android-person h3"></i>
                                                        {{ $item->nama_siswa }}
                                                    </div>
                                                    <div class="text-right">{{ $item->jenis_kelamin }}</div>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ $item->asal_sekolah }}</p>
                                                    <p>{{ $item->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        kosong
                                    @endif
                                @endforeach
                            </div>
                            <div class="row mb-3 ml-3 mr-3">
                                <div class="col-md-2 col-12">
                                    <input type="submit" value="Bagi Kelas" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="tabs-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <div class="">
                                    <div class="row">
                                        @foreach ($tampungsisa as $p)
                                            <div class="form-group col-md-3 col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>{{ $p['name'] }} / sisa {{ $p['sisa'] }} slot
                                                    </div>
                                                    {{-- <div class="card-body"> --}}
                                                    {{-- <p>{{ $p->hari->name }}</p>
                                                        <p>{{ $p->jam_masuk }} - {{ $p->jam_keluar }}</p>
                                                        <a href="{{ route('jadwal-semua-siswa', $p->id) }}"
                                                            class="btn btn-primary">Masuk</a> --}}
                                                    {{-- </div> --}}
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

    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#tabs").tabs();
        });
    </script>
@endsection

@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <div id="tabs">
            <section class="section">
                <div class="section-header">
                    <h1></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('jadwal_buat_guru') }}">Kembali</a></div>
                        <div class="breadcrumb-item">Halaman Detail Kelas</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">Tombol</div> --}}
                            <div class="card-body">
                                <div class="row text-center">
                                    {{-- <div class="col-md-3">

                                    </div> --}}
                                    {{-- <div class="col-md-3"> --}}
                                    {{-- <a href="{{ route('jadwal_buat_guru') }}" class="btn btn-primary">Kembali</a> --}}
                                    {{-- </div> --}}
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
                                                    <li><a class="dropdown-item" href="#tabs-3">Jadwal</a></li>
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

                <div id="tabs-1">
                    <div class="card">
                        <div class="row mt-3 ml-3 mr-3">
                            @foreach ($siswa as $item)
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
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
                <div id="tabs-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <div class="">
                                    <div class="row">
                                        @foreach ($jadwal as $p)
                                            <div class="form-group col-md-3 col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>{{ $p->kelasget->kelas->name }} / {{ $p->ruangan->name }} -
                                                            {{ $p->mata_pelajaran->name }}</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <p>{{ $p->hari->name }}</p>
                                                        <p>{{ $p->jam_masuk }} - {{ $p->jam_keluar }}</p>
                                                        {{-- <a href="{{ route('jadwal-semua-siswa', $p->id) }}"
                                                            class="btn btn-primary">Masuk</a> --}}
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

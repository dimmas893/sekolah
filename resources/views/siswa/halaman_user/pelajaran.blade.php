@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Jadwal Siswa</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Jadwal</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($jadwal as $p)
                                    <div class="form-group col-md-3 col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>{{ $p->kelasget->kelas->name }} /
                                                    {{ $p->ruangan->name }} -
                                                    {{ $p->mata_pelajaran->name }}</h4>
                                            </div>
                                            <div class="card-body">
                                                <p>{{ $p->hari->name }}</p>
                                                <p>{{ $p->jam_masuk }} - {{ $p->jam_keluar }}</p>
                                                <a href="" class="btn btn-primary">Masuk</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

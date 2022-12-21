@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $jadwal->kelas->name }} / {{ $jadwal->ruangan->name }} / {{ $jadwal->mata_pelajaran->name }} /
                    {{ $jadwal->jam_masuk }} - {{ $jadwal->jam_keluar }} / Total ({{ $count }}) Siswa</h1>
            </div>

            <div class="row">
                @foreach ($rincian_siswa as $item)
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <div class="">
                                    <i class="ion-android-person h3"></i>
                                    {{ $item->siswa->nama_siswa }}
                                </div>
                                <div class="text-right">{{ $item->siswa->jenis_kelamin }}</div>
                            </div>
                            <div class="card-body">
                                <p>{{ $item->siswa->email }}</p>
                                <p>{{ $item->siswa->alamat }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-3">
                    <a href="{{ route('jadwal') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </section>
    </div>
@endsection

@extends('layouts.template.template')
@section('content')
    <div class="main-content">

        <section class="section">
            <div class="section-header">
                <h1> Laporan Absensi</h1>
            </div>
            <div class="mb-3">
                <form method="get" action="{{ route('filter_absensi_siswa') }}">
                    @csrf
                    <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <input type="date" name="awal" class="form-control">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <input type="date" name="akhir" class="form-control">
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                            <input type="submit" class="btn btn-primary" value="cari">
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <div class="card">
                    <div class="row mt-3 ml-3 mr-3">
                        @foreach ($absen1 as $ja)
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                                <div>
                                    <div>
                                        <h4>{{ $ja->jadwal->mata_pelajaran->name }}</h4>
                                    </div>
                                </div>
                            </div>

                            @php
                                $dataSiswa = \App\Models\Jadwal::where('id', $ja->jadwal_id)->first();

                            @endphp

                            @foreach ($dataSiswa->kelasget->rincianSiswa as $item)
                                @php
                                    $hadir = \App\Models\Absen::where('kelas_id', $item->kelas)
                                        ->where('siswa_id', $item->id)
                                        ->where('jadwal_id', $ja->jadwal_id)
                                        ->where('tipe_kehadiran', '0')
                                        ->count();
                                    $sakit = \App\Models\Absen::where('kelas_id', $item->kelas)
                                        ->where('siswa_id', $item->id)
                                        ->where('jadwal_id', $ja->jadwal_id)
                                        ->where('tipe_kehadiran', '1')
                                        ->count();
                                    $izin = \App\Models\Absen::where('kelas_id', $item->kelas)
                                        ->where('siswa_id', $item->id)
                                        ->where('jadwal_id', $ja->jadwal_id)
                                        ->where('tipe_kehadiran', '2')
                                        ->count();
                                    $alpha = \App\Models\Absen::where('kelas_id', $item->kelas)
                                        ->where('siswa_id', $item->id)
                                        ->where('jadwal_id', $ja->jadwal_id)
                                        ->where('tipe_kehadiran', '3')
                                        ->count();
                                    $terlambat = \App\Models\Absen::where('kelas_id', $item->kelas)
                                        ->where('siswa_id', $item->id)
                                        ->where('jadwal_id', $ja->jadwal_id)
                                        ->where('tipe_kehadiran', '4')
                                        ->count();
                                @endphp

                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                                    <div class="card">
                                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="ion-android-person h3"></i>
                                                {{ $item->nama_siswa }}
                                            </div>
                                            {{-- <div class="text-right">{{ $item->jadwal->id }}</div> --}}
                                        </div>
                                        <div class="card-body">
                                            <div class="">
                                                <label for="">Total Pertemuan:
                                                    {{ $hadir + $sakit + $alpha + $terlambat }}
                                                    {{-- {{ $absen->whereIn('tipe_kehadiran', [0, 1, 2, 3, 4])->count() }} --}}
                                                </label>
                                            </div>
                                            <div class="">
                                                <label for="">Hadir :
                                                    {{ $hadir }}</label>
                                            </div>
                                            <div class="">
                                                <label for="">Sakit :
                                                    {{ $sakit }}</label>
                                            </div>
                                            <div class="">
                                                <label for="">Izin :
                                                    {{ $izin }}</label>
                                            </div>
                                            <div class="">
                                                <label for="">Alpha :
                                                    {{ $alpha }}</label>
                                            </div>
                                            <div class="">
                                                <label for="">Terlambat :
                                                    {{ $terlambat }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

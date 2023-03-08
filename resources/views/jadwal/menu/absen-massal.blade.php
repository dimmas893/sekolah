@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <div id="tabs">
            <section class="section">
                <div class="section-header">
                    <h1>{{ $jadwal->kelasget->kelas->name }} / {{ $jadwal->ruangan->name }} /
                        {{ $jadwal->mata_pelajaran->name }} /
                        {{ $jadwal->jam_masuk }} - {{ $jadwal->jam_keluar }}</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                        <div class="breadcrumb-item active"><a href="{{ route('jadwal_buat_guru') }}">Jadwal</a></div>
                        <div class="breadcrumb-item active"><a
                                href="{{ route('jadwal-semua-siswa', $jadwal->id) }}">Kelas</a>
                        </div>
                        <div class="breadcrumb-item">Absen</div>
                    </div>
                </div>
                <div class="section-body">
                    @if ($cekabsen === 0)
                        <form name="form1" action="{{ route('absen-masal') }}" method="post">
                            @csrf
                            <input type="hidden" name="semester" value="{{ $setting->semester }}">
                            <input type="hidden" name="tahun_ajaran" value="{{ $setting->id_tahun_ajaran }}">
                            <input type="hidden" name="dibuat_oleh" value="{{ $jadwal->guru_id }}">
                            <input type="hidden" name="kelas_id" value="{{ $jadwal->kelas_id }}">
                            <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                            <div class="card">
                                <div class="row mt-3 ml-3 mr-3">
                                    @foreach ($rincian_siswa as $p => $item)
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="card shadow card-primary">
                                                <div
                                                    class="card-header bg-light d-flex justify-content-between align-items-center">
                                                    <div class="">
                                                        <i class="ion-android-person h3"></i>
                                                        {{ $item->nama_siswa }}
                                                    </div>
                                                    <div class="text-right">{{ $item->jenis_kelamin }}</div>
                                                </div>
                                                <div class="card-body">
                                                    <input type="hidden" name="siswa_id[]{{ $p }}"
                                                        value="{{ $item->id }}">
                                                    <input type="radio" name="group[]{{ $p }}" value="0"
                                                        checked="checked">Hadir<br />
                                                    <input type="radio" name="group[]{{ $p }}"
                                                        value="1">Sakit<br />
                                                    <input type="radio" name="group[]{{ $p }}"
                                                        value="2">Izin<br />
                                                    <input type="radio" name="group[]{{ $p }}"
                                                        value="3">Alpha<br />
                                                    <input type="radio" name="group[]{{ $p }}"
                                                        value="4">Terlambat<br />
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row mb-3 ml-3 mr-3">
                                    <div class="col-2">
                                        <div class="my-2">
                                            <input type="submit" class="btn btn-primary" value="Absen">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="card">
                            <div class="row mt-3 ml-3 mr-3">
                                @foreach ($laporan as $item)
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="card shadow card-primary">
                                            <div
                                                class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <div class="">
                                                    <i class="ion-android-person h3"></i>
                                                    {{ $item['siswa'] }}
                                                </div>
                                                {{-- <div class="text-right">{{ $item->jadwal->id }}</div> --}}
                                            </div>
                                            <div class="card-body">
                                                <div class="">
                                                    <label for="">Total Pertemuan:
                                                        {{ $item['pertemuan'] }}</label>
                                                </div>
                                                <div class="">
                                                    <label for="">Hadir : {{ $item['hadir'] }}</label>
                                                </div>
                                                <div class="">
                                                    <label for="">Sakit : {{ $item['sakit'] }}</label>
                                                </div>
                                                <div class="">
                                                    <label for="">Izin : {{ $item['izin'] }}</label>
                                                </div>
                                                <div class="">
                                                    <label for="">Alpha : {{ $item['alpha'] }}</label>
                                                </div>
                                                <div class="">
                                                    <label for="">Terlambat : {{ $item['terlambat'] }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

            </section>
        </div>

    </div>
@endsection

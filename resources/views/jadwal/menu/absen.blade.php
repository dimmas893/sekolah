@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <div>
            <section class="section">
                <div class="section-header">
                    <h1>{{ $jadwal->kelasget->kelas->name }} / {{ $jadwal->ruangan->name }} /
                        {{ $jadwal->mata_pelajaran->name }} /
                        {{ $jadwal->jam_masuk }} - {{ $jadwal->jam_keluar }}</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                        <div class="breadcrumb-item active"><a href="{{ route('jadwal_buat_guru') }}">Jadwal</a></div>
                        <div class="breadcrumb-item active"><a href="{{ route('jadwal-semua-siswa', $jadwal->id) }}">Kelas</a>
                        </div>
                        <div class="breadcrumb-item">Ubah absen</div>
                    </div>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-primary card-primary">
                                <div class="card-header">
                                    <h4>Absen Mandiri</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('absen_satuan') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="semester" value="{{ $setting->semester }}">
                                        <input type="hidden" name="tahun_ajaran" value="{{ $setting->id_tahun_ajaran }}">
                                        <input type="hidden" name="dibuat_oleh" value="{{ $jadwal->guru_id }}">
                                        <input type="hidden" name="kelas_id" value="{{ $jadwal->kelas_id }}">
                                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label for="">Nama Siswa</label>
                                                <select name="siswa_id" class="form-control select2">
                                                    <option value="">---Pilih Siswa---</option>
                                                    @foreach ($rincian_siswa as $p => $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nama_siswa }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label for="">Status Kehadiran</label>
                                                <select name="tipe_kehadiran" class="form-control">
                                                    <option value="">---Pilih Status Kehadiran---</option>
                                                    <option value="0">Hadir</option>
                                                    <option value="1">Sakit</option>
                                                    <option value="2">Izin</option>
                                                    <option value="3">Alpha</option>
                                                    <option value="4">Terlambat</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="my-2 mt-4">
                                            {{-- <button class="btn btn-info" type="button" data-toggle="collapse"
                                                data-target="#absenmandiri" aria-expanded="false"
                                                aria-controls="absenmandiri">
                                                Tutup
                                            </button> --}}
                                            <input type="submit" value="Absen" class="btn btn-primary">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
@endsection

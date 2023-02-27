@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Nilai jenjang smp</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('manage') }}">Manage</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('manageNilai') }}">Semua kelas</a></div>
                    <div class="breadcrumb-item">Nilai semua jenjang smp</div>
                </div>
            </div>
            <div class="section-body">
                {{-- <div class="mb-3">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('jadwalilport') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" class="form-control" />
                                <input type="submit" value="import" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                </div> --}}

                @foreach ($mata_pelajaran as $item)
                    @php
                        $guru = \App\Models\Jadwal::where('jenjang_pendidikan_id', 2)
                            ->whereHas('kelasget', function ($q) use ($tahun) {
                                $q->where('id_tahun_ajaran', $tahun);
                            })
                            ->where('mata_pelajaran_id', $item->mata_pelajaran_id)
                            ->select('guru_id')
                            ->groupBy('guru_id')
                            ->get();
                    @endphp
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h4>{{ \App\Models\Mata_Pelajaran::where('id', $item->mata_pelajaran_id)->first()->name }}</h4>
                        </div>
                        @foreach ($guru as $gur)
                            @php
                                $kelas = \App\Models\Jadwal::where('jenjang_pendidikan_id', 2)
                                    ->whereHas('kelasget', function ($q) use ($tahun) {
                                        $q->where('id_tahun_ajaran', $tahun);
                                    })
                                    ->where('mata_pelajaran_id', $item->mata_pelajaran_id)
                                    ->where('guru_id', $gur->guru_id)
                                    ->select('kelas_id')
                                    ->groupBy('kelas_id')
                                    ->get();
                            @endphp
                            <div class="card-header">
                                {{ \App\Models\Guru::where('id', $gur->guru_id)->first()->name }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($kelas as $kel)
                                        <div class="col-lg-3">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                {{ \App\Models\Kelas::with('kelas')->where('id', $kel->kelas_id)->first()->kelas->name }}
                                                <form action="{{ route('penilaian') }}" method="get">
                                                    <input type="hidden" name="cek" value="1">
                                                    <input type="hidden" name="kelas_id" value="{{ $kel->kelas_id }}">
                                                    <input type="hidden" name="guru_id" value="{{ $gur->guru_id }}">
                                                    <input type="hidden" name="mata_pelajaran_id"
                                                        value="{{ $item->mata_pelajaran_id }}">
                                                    <input type="submit" class="btn btn-info" value="masuk">
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection

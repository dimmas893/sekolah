@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Penilaian</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item">Penilaian</div>
                </div>
            </div>
            <div class="section-body">
                <div class="">
                    <div class="row">
                        <div class="col-6">
                        </div>
                    </div>
                </div>

                @foreach ($mata_pelajaran as $item)
                    @php
                        $kelas = \App\Models\Jadwal::where('tingkatan_id', 14)
                            ->whereHas('kelasget', function ($q) use ($tahun) {
                                $q->where('id_tahun_ajaran', $tahun);
                            })
                            ->where('mata_pelajaran_id', $item->mata_pelajaran_id)
                            ->where('guru_id', $guru->id)
                            ->select('kelas_id')
                            ->groupBy('kelas_id')
                            ->get();
                    @endphp
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h4>{{ \App\Models\Mata_Pelajaran::where('id', $item->mata_pelajaran_id)->first()->name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($kelas as $kel)
                                    <div class="col-lg-3">
                                        <div class="card card-primary">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                {{ \App\Models\Kelas::with('kelas')->where('id', $kel->kelas_id)->first()->kelas->name }}
                                                <form action="{{ route('penilaian') }}" method="get">
                                                    <input type="hidden" name="cek" value="1">
                                                    <input type="hidden" name="kelas_id" value="{{ $kel->kelas_id }}">
                                                    <input type="hidden" name="guru_id"
                                                        value="{{ \App\Models\Guru::where('id_user', Auth::user()->id)->first()->id }}">
                                                    <input type="hidden" name="mata_pelajaran_id"
                                                        value="{{ $item->mata_pelajaran_id }}">
                                                    <input type="submit" class="btn btn-info" value="masuk">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection

    @extends('layouts.template.template')
    @section('content')
        {{-- <form method="get" id="manageTugasMataPelajaran_id" action="{{ route('pilihmatapelajaran') }}" style="display:none;">
            @csrf
            <input type="hidden" name="mata_pelajaran_id" value="{{ $jadwal->mata_pelajaran_id }}">
        </form> --}}

        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Tugas</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                        <div class="breadcrumb-item"> Mata Pelajaran</div>
                    </div>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <div class="">
                                    <div class="row">
                                        @foreach ($mataPelajaran as $item)
                                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-3 col-xxl-3">
                                                <div class="card shadow card-primary">
                                                    <div
                                                        class="card-header d-flex justify-content-between align-items-center">
                                                        {{ $item->mata_pelajaran->name }}
                                                        <form action="{{ route('pilihtingkatan') }}" method="get">
                                                            @csrf
                                                            <input type="hidden" name="mata_pelajaran_id"
                                                                value="{{ $item->mata_pelajaran_id }}">
                                                            <input type="submit" class="btn btn-primary" value="Masuk">
                                                        </form>
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

@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tugas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <div class="">
                                <div class="row">
                                    @foreach ($kelas as $item)
                                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-3 col-xxl-3">
                                            <div class="card shadow-primary card-primary">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    {{-- {{ \App\Models\Tingkatan::where('tingkat', $item->tingkatan_id)->first()->tingkat }} --}}
                                                    {{ $item->kelasget->kelas->name }}
                                                    <form action="{{ route('pilihkelastugas') }}" method="get">
                                                        @csrf
                                                        <input type="hidden" name="kelas_id" value="{{ $item->kelas_id }}">
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

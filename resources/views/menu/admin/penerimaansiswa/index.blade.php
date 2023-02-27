@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Jenjang</h1>
                <div class="section-header-breadcrumb">
                    {{-- <div class="breadcrumb-item active"><a href="{{ route('jadwal') }}">Table Jadwal
                        </a></div> --}}
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item">Semua Jenjang</div>
                </div>
            </div>
            <div class="section-body">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            Pilih jenjang
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="">
                                        <div class="row">
                                            @foreach ($pendaftaran as $item)
                                                <div class="col-3">
                                                    <div class="card shadow card-primary">
                                                        <div
                                                            class="card-header d-flex justify-content-between align-items-center">
                                                            {{ \App\Models\JenjangPendidikan::where('id', $item->jenjang)->first()->nama }}
                                                            <form action="{{ route('tbl_pendaftaran') }}" method="get">
                                                                @csrf
                                                                <input type="hidden" name="jenjang_pendidikan_id"
                                                                    value="{{ $item->jenjang }}">
                                                                <input type="submit" class="btn btn-primary"
                                                                    value="masuk">
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
                </div>
            </div>
        </section>
    </div>
@endsection

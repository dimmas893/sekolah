@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Pembagian Kelas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item">Pilih Tingkatan</div>
                </div>
            </div>

            <div class="">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('siswatokelas_get') }}" method="get">
                            @csrf
                            {{-- <input type="text"> --}}
                            <div class="">
                                <select name="tingkatan_id" class="form-control">
                                    <option value="">---Pilih Tingkatan---</option>
                                    @foreach ($tingkatan as $item)
                                        @if ($item->tingkat < 13)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-2 text-center">
                                <input type="submit" class="btn btn-primary" value="cari">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

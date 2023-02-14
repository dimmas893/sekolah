@extends('layouts.template.template')
@section('content')
    <div id="tabs">
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Tugas</h1>
                </div>
                <div class="mb-3">
                    <form method="get" action="{{ route('filter_absensi_siswa') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-3">
                                <input type="date" name="awal" class="form-control">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-3">
                                <input type="date" name="akhir" class="form-control">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-3">
                                <input type="submit" class="btn btn-primary" value="cari">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-10 col-12">
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" style="list-style: none;"
                                                aria-labelledby="dropdownMenuButton">
                                                <ul style="list-style:none;">
                                                    <li><a class="dropdown-item" href="#tabs-2">Semua</a></li>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#tabs-5">tugas</a></li>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#tabs-1">Dedline</a></li>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#tabs-3">Tidak mengerjakan</a></li>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#tabs-4">Mengerjakan</a></li>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tabs-1">
                    <div class="card">
                        <div class="card-header">
                            <label for="">
                                <h4>Dedline</h4>
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($dedline as $item => $value)
                                    @if (count($value['mendekati']) > 0)
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-12 col-xxl-12">
                                            <div class="card">
                                                <div
                                                    class="card-header bg-light d-flex justify-content-between align-items-center">
                                                    <div class=""> <i class="ion-ios-paper h5"></i>
                                                        {{ $value['jadwal'] }}
                                                    </div>
                                                    {{-- <div class="text-right">{{ $item->jadwal->id }}</div> --}}
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($value['mendekati'] as $kum => $val)
                                                        <div class="">
                                                            <label for="">Tugas : {{ $val['tugas']['nama'] }} /
                                                                {{ $val['tugas']['tanggal_pengumpulan'] }} / <a
                                                                    href=""><i class="ion-eye h4"></i></a></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabs-2">
                    <div class="card">
                        <div class="card-header">
                            <label for="">
                                <h4>Tugas</h4>
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($tampungtugas as $item => $value)
                                    @if (count($value['tugas']) > 0)
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-3 col-xxl-12">
                                            <div class="card">
                                                <div
                                                    class="card-header bg-light d-flex justify-content-between align-items-center">
                                                    <div class=""> <i class="ion-ios-paper h5"></i>
                                                        {{ $value['jadwal'] }}
                                                    </div>
                                                    {{-- <div class="text-right">{{ $item->jadwal->id }}</div> --}}
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($value['tugas'] as $kum => $val)
                                                        <div class="">
                                                            <label for="">Tugas : {{ $val['tugas']['nama'] }} /
                                                                {{ $val['tugas']['tanggal_pengumpulan'] }} / <a
                                                                    href=""><i class="ion-eye h4"></i></a></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <label for="">
                                <h4>Dedline</h4>
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($dedline as $item => $value)
                                    @if (count($value['mendekati']) > 0)
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-3 col-xxl-12">
                                            <div class="card">
                                                <div
                                                    class="card-header bg-light d-flex justify-content-between align-items-center">
                                                    <div class=""> <i class="ion-ios-paper h5"></i>
                                                        {{ $value['jadwal'] }}
                                                    </div>
                                                    {{-- <div class="text-right">{{ $item->jadwal->id }}</div> --}}
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($value['mendekati'] as $kum => $val)
                                                        <div class="">
                                                            <label for="">Tugas : {{ $val['tugas']['nama'] }} /
                                                                {{ $val['tugas']['tanggal_pengumpulan'] }} / <a
                                                                    href=""><i class="ion-eye h4"></i></a></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <label for="">
                                <h4>Tidak Mengerjakan</h4>
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($batastampung as $item => $value)
                                    @if (count($value['batas']) > 0)
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-3 col-xxl-12">
                                            <div class="card">
                                                <div
                                                    class="card-header bg-light d-flex justify-content-between align-items-center">
                                                    <div class=""> <i class="ion-ios-paper h5"></i>
                                                        {{ $value['jadwal'] }}
                                                    </div>
                                                    {{-- <div class="text-right">{{ $item->jadwal->id }}</div> --}}
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($value['batas'] as $kum => $val)
                                                        <div class="">
                                                            <label for="">Tugas : {{ $val['tugas']['nama'] }} /
                                                                {{ $val['tugas']['tanggal_pengumpulan'] }} / <a
                                                                    href=""><i class="ion-eye h4"></i></a></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <label for="">
                                <h4>Selesai</h4>
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($sudahdikumpulkan as $item => $value)
                                    @if (count($value['sudah']) > 0)
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-3 col-xxl-12">
                                            <div class="card">
                                                <div
                                                    class="card-header bg-light d-flex justify-content-between align-items-center">
                                                    <div class=""> <i class="ion-ios-paper h5"></i>
                                                        {{ $value['jadwal'] }}
                                                    </div>
                                                    {{-- <div class="text-right">{{ $item->jadwal->id }}</div> --}}
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($value['sudah'] as $kum => $val)
                                                        <div class="">
                                                            <label for="">Tugas : {{ $val['tugas']['nama'] }} /
                                                                {{ $val['tugas']['tanggal_pengumpulan'] }} / <a
                                                                    href=""><i class="ion-eye h4"></i></a></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabs-5">
                    <div class="card">
                        <div class="card-header">
                            <label for="">
                                <h4>Tugas</h4>
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($tampungtugas as $item => $value)
                                    @if (count($value['tugas']) > 0)
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-3 col-xxl-12">
                                            <div class="card">
                                                <div
                                                    class="card-header bg-light d-flex justify-content-between align-items-center">
                                                    <div class=""> <i class="ion-ios-paper h5"></i>
                                                        {{ $value['jadwal'] }}
                                                    </div>
                                                    {{-- <div class="text-right">{{ $item->jadwal->id }}</div> --}}
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($value['tugas'] as $kum => $val)
                                                        <div class="">
                                                            <label for="">Tugas : {{ $val['tugas']['nama'] }} /
                                                                {{ $val['tugas']['tanggal_pengumpulan'] }} / <a
                                                                    href=""><i class="ion-eye h4"></i></a></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabs-3">
                    <div class="card">
                        <div class="card-header">
                            <label for="">
                                <h4>Tidak Mengerjakan</h4>
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($batastampung as $item => $value)
                                    @if (count($value['batas']) > 0)
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-3 col-xxl-12">
                                            <div class="card">
                                                <div
                                                    class="card-header bg-light d-flex justify-content-between align-items-center">
                                                    <div class=""> <i class="ion-ios-paper h5"></i>
                                                        {{ $value['jadwal'] }}
                                                    </div>
                                                    {{-- <div class="text-right">{{ $item->jadwal->id }}</div> --}}
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($value['batas'] as $kum => $val)
                                                        <div class="">
                                                            <label for="">Tugas : {{ $val['tugas']['nama'] }} /
                                                                {{ $val['tugas']['tanggal_pengumpulan'] }} / <a
                                                                    href=""><i class="ion-eye h4"></i></a></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabs-4">
                    <div class="card">
                        <div class="card-header">
                            <label for="">
                                <h4>Selesai</h4>
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($sudahdikumpulkan as $item => $value)
                                    @if (count($value['sudah']) > 0)
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-3 col-xxl-12">
                                            <div class="card">
                                                <div
                                                    class="card-header bg-light d-flex justify-content-between align-items-center">
                                                    <div class=""> <i class="ion-ios-paper h5"></i>
                                                        {{ $value['jadwal'] }}
                                                    </div>
                                                    {{-- <div class="text-right">{{ $item->jadwal->id }}</div> --}}
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($value['sudah'] as $kum => $val)
                                                        <div class="">
                                                            <label for="">Tugas : {{ $val['tugas']['nama'] }} /
                                                                {{ $val['tugas']['tanggal_pengumpulan'] }} / <a
                                                                    href=""><i class="ion-eye h4"></i></a></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>
@endsection
@section('js')
    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#tabs").tabs();
        });

        // function selectAll(form1) {

        //     var check = document.getElementsByName("group4"),
        //         radios = document.form1.elements;

        //     //If the first radio is checked
        //     if (check[0].checked) {

        //         for (i = 0; i < radios.length; i++) {

        //             //And the elements are radios
        //             if (radios[i].type == "radio") {

        //                 //And the radio elements's value are 1
        //                 if (radios[i].value == "0") {
        //                     //Check all radio elements with value = 1
        //                     radios[i].checked = true;
        //                 }

        //             } //if

        //         } //for

        //         //If the second radio is checked
        //     };

        //     return null;
        // }
    </script>
@endsection

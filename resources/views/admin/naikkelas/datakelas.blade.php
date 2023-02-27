@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Tambah Jadwal Siswa</h1>
                <div class="section-header-breadcrumb">
                    {{-- <div class="breadcrumb-item active"><a href="{{ route('jadwal') }}">Table Jadwal
                        </a></div> --}}
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('semuakelas') }}">Semua kelas</a></div>
                    <div class="breadcrumb-item">Kelas {{ $kelas->kelas->name }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Siswa Didik</h3>
                                <form action="{{ route('NaikKelas') }}" method="post">
                                    <input type="hidden" name="id" value="{{ $kelas->id_guru }}">
                                    @csrf
                                    <input type="submit" class="btn btn-light" value="Naik kelas">
                                </form>
                                {{-- <button class="btn btn-light"><i class="bi-plus-circle me-2"></i>Naik kelas</button> --}}
                            </div>
                            <div>
                                <div class="card-body" id="TU_all">
                                    <h1 class="text-secondary my-5 text-center">
                                        <div class="load-3">
                                            <div class="line"></div>
                                            <div class="line"></div>
                                            <div class="line"></div>
                                        </div>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">

                            <div>
                                <div class="card-body" id="siswa">
                                    <h1 class="text-secondary my-5 text-center">
                                        <div class="load-3">
                                            <div class="line"></div>
                                            <div class="line"></div>
                                            <div class="line"></div>
                                        </div>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            TU_all();

            function TU_all() {
                $.ajax({
                    url: '{{ route('WaliKelasGet', $kelas->id) }}',
                    method: 'get',
                    success: function(response) {
                        $("#TU_all").html(response);
                        $("table").DataTable({
                            destroy: true,
                            responsive: true
                        });
                    }
                });
            }
            siswa();

            function siswa() {
                $.ajax({
                    url: '{{ route('siswadidikajax', $kelas->id) }}',
                    method: 'get',
                    success: function(response) {
                        $("#siswa").html(response);
                    }
                });
            }
        });
    </script>
@endsection

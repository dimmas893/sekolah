@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Kelas</h1>
                <div class="section-header-breadcrumb">
                    {{-- <div class="breadcrumb-item active"><a href="{{ route('jadwal') }}">Table Jadwal
                        </a></div> --}}
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('menukenaikankelas') }}">Semua kelas</a></div>
                    <div class="breadcrumb-item">
                        Jenjang {{ \App\Models\JenjangPendidikan::where('id', $jenjang)->first()->nama }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            Pilih kelas
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="">
                                        <div class="row">
                                            @foreach ($kelas as $item)
                                                <div class="col-3">
                                                    <div class="card shadow card-primary">
                                                        <div
                                                            class="card-header d-flex justify-content-between align-items-center">
                                                            {{-- {{ $item->kelas->name }} --}}
                                                            {{ \App\Models\Master_Kelas::where('id', $item->id_master_kelas)->first()->name }}
                                                            -
                                                            {{ \App\Models\Guru::where('id', $item->id_guru)->first()->name }}
                                                            <form action="{{ route('menukenaikankelaspilihkelasakses') }}"
                                                                method="get">
                                                                @csrf
                                                                <input type="hidden" name="jenjang_pendidikan_id"
                                                                    value="{{ $jenjang }}">
                                                                <input type="hidden" name="kelas_id"
                                                                    value="{{ $item->id }}">
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

{{-- @section('js')
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
@endsection --}}

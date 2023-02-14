@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Nilai kelas {{ \App\Models\Kelas::with('kelas')->where('id', $kelas_id)->first()->kelas->name }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('semuakelas') }}">Semua kelas</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('nilaitk') }}">Nilai semua jenjang tk</a>
                    </div>
                    <div class="breadcrumb-item">
                        Nilai kelas {{ \App\Models\Kelas::with('kelas')->where('id', $kelas_id)->first()->kelas->name }}
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Tabel Nilai</h4>
                    </div>
                    <div id="TU_all">
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
        </section>
    </div>
@endsection


@section('js')
    <script>
        $('.isMember').on('change', function(e) {
            const selectedPackage = $('#package').val();
            e.preventDefault();
            $.ajax({
                url: '{{ route('nilaitkajax') }}',
                method: 'get',
                data: {
                    mata_pelajaran_id: selectedPackage
                },
                success: function(response) {
                    console.log(response)
                    if (response) {
                        $("#sma").html(response);
                        $("table").DataTable({
                            destroy: true,
                            responsive: true
                        });
                    }
                }
            });
        });
        TU_all();

        function TU_all() {
            $.ajax({
                url: '/lihatnilaiajax/{{ $mata_pelajaran_id }}/{{ $kelas_id }}',
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
    </script>
@endsection

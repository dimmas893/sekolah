@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Nilai jenjang tk</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('semuakelas') }}">Semua kelas</a></div>
                    <div class="breadcrumb-item">Nilai semua jenjang tk</div>
                </div>
            </div>
            <div class="section-body">
                <div class="">
                    <div class="row">
                        <div class="col-6">
                            <form action="{{ route('pilihkelas') }}" method="get">
                                @csrf
                                <div class="isMember my-2">
                                    <label for="name">Mata Pelajaran</label>
                                    <select name="mata_pelajaran_id" id="package" class="form-control">
                                        <option value="" selected disabled>--- Pilih Kelas ---</option>
                                        <option value="">Pilih Semua</option>
                                        @foreach ($mata_pelajaran as $value)
                                            <option value="{{ $value->id }}">
                                                {{ $value->name }}
                                                {{-- {{ $value->id }} --}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="sma">
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
                url: '{{ route('nilaitkajax') }}',
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

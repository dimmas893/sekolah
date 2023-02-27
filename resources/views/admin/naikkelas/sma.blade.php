@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Jadwal jenjang sma</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('manage') }}">Manage</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('manageJadwal') }}">Semua kelas</a></div>
                    <div class="breadcrumb-item">Jadwal jenjang sma</div>
                </div>
            </div>
            <div class="section-body">
                <div class="">
                    <div class="row">
                        <div class="col-6">
                            <form action="{{ route('pilihkelas') }}" method="get">
                                @csrf
                                <div class="isMember my-2">
                                    <label for="name">Kelas</label>
                                    <select name="kelas_id" id="package" class="form-control">
                                        <option value="" selected disabled>--- Pilih Kelas ---</option>
                                        <option value="">Pilih Semua</option>
                                        @foreach ($sma as $value)
                                            <option value="{{ $value->id }}">
                                                {{ \App\Models\Master_Kelas::where('id', $value->id_master_kelas)->first()->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <div class="">
                                <div class="">
                                    <div class="" id="sma">
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
        $('.isMember').on('change', function(e) {
            const selectedPackage = $('#package').val();
            e.preventDefault();
            $.ajax({
                url: '{{ route('AjaxSma') }}',
                method: 'get',
                data: {
                    id: selectedPackage
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
                url: '{{ route('AjaxSma') }}',
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

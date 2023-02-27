@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Jadwal jenjang smp</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('manage') }}">Manage</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('manageJadwal') }}">Semua kelas</a></div>
                    <div class="breadcrumb-item">Jadwal jenjang smp</div>
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
                                        @foreach ($smp as $value)
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
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12" id="sma">
                                        <div id="TU_all"></div>
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
                url: '{{ route('AjaxSmp') }}',
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
                url: '{{ route('AjaxSmp') }}',
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

@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profil Siswa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('WaliKelas') }}">Kembali</a></div>
                    <div class="breadcrumb-item">Profil siswa</div>
                </div>
            </div>
            <div class="" id="TU_all">
                <h1 class="text-secondary my-5 text-center">
                    <div class="load-3">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </h1>
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
                    url: '{{ route('profilsiwaget', $id) }}',
                    method: 'get',
                    success: function(response) {
                        $("#TU_all").html(response);
                    }
                });
            }
        });
    </script>
@endsection

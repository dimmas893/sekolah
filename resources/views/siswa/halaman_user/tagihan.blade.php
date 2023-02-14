@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Tagihan Siswa</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Tagihan siswa</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12 col-xxl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tagihan Siswa
                            </h4>
                        </div>
                        <form action="#" id="aku" method="post">
                            @csrf
                            <div id="haha">

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 col-xl-12 col-xxl-12 col-lg-12">
                    <form action="#" id="hapus" method="post">
                        @csrf
                        <div class="my-2">
                            <div id="TU_all">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('#aku').change(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                // $("#add_TU_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('cektotal') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            TU_all();
                            viewtampil();
                        }
                    }
                });
            });


            // delete employee ajax request

            // $('#hapus').change(function(e) {
            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                $.ajax({
                    url: '{{ route('hapus') }}',
                    method: 'post',
                    data: {
                        id: id,
                        _token: csrf
                    },
                    success: function(response) {
                        TU_all();
                        viewtampil()
                    }
                });
            });

            $(document).on('click', '.deleteaku', function(e) {
                e.preventDefault();
                let csrf = '{{ csrf_token() }}';
                $.ajax({
                    url: '{{ route('CekTotalViewDelete') }}',
                    method: 'post',
                    data: {
                        _token: csrf
                    },
                    success: function(response) {
                        TU_all();
                        viewtampil()
                    }
                });
            });


            TU_all()

            function TU_all() {
                $.ajax({
                    url: '{{ route('cek') }}',
                    method: 'get',
                    success: function(response) {
                        $("#TU_all").html(response);
                    }
                });
            }

            viewtampil()

            function viewtampil() {
                $.ajax({
                    url: '{{ route('viewtampil') }}',
                    method: 'get',
                    success: function(response) {
                        $("#haha").html(response);
                    }
                });
            }

        });
    </script>
@endsection

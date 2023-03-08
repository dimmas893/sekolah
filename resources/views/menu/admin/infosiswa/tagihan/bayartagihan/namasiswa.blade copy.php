@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Menu</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('infosiswa') }}">Informasi siswa</a></div>
                    <div class="breadcrumb-item">Tagihan</div>
                </div>
            </div>
            <div class="section-body">

                <div class="row">
                    <div class="col-6">
                        <div class="isMember my-2">
                            <label for="name">Jenjang</label>
                            <select id="package" class="form-control">
                                <option value="null">--- Pilih Jenjang ---</option>
                                @foreach ($jenjang_pendidikan as $item => $value)
                                    <option value="{{ $value->id }}">{{ $value->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="my-2">
                            <div id="sma">
                                <label for="name">Kelas</label>
                                <select class="form-control">
                                    <option disabled selected>Mohon Untuk Memilih Jenjang Pendidikan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="my-2 mt-3">
                            <div id="siswa">
                                <label for="name">Siswa</label>
                                <select class="form-control">
                                    <option disabled selected>Mohon Untuk Memilih Kelas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-12 col-xxl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tagihan Siswa
                                </h4>
                            </div>
                            <form action="#" id="aku" method="post">
                                @csrf
                                <div id="hasil">
                                    <div id="tagih"></div>
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
                    {{-- <div class="container mt-5" id="livesearch">
                            <select class="form-control" name="livesearch"></select>
                        </div> --}}
                </div>
            </div>
        </section>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
    <script></script>
    <script>
        $(function() {
            $(document).ready(function() {
                $(".select2").select2();
            });
            $('.isMember').on('change', function(e) {
                const selectedPackage = $('#package').val();
                const kelas = $('#kelas').val();
                e.preventDefault();
                $.ajax({
                    url: '{{ route('ajaxsearch-tagihansiswa') }}',
                    method: 'get',
                    data: {
                        id: selectedPackage,
                    },
                    success: function(response) {
                        $("#sma").html(response);
                        // $(".select2").select2();
                        $('.iskelas').on('change', function(e) {
                            const kelas = $('#kelas').val();
                            e.preventDefault();
                            $.ajax({
                                url: '{{ route('ajaxsearch-tagihansiswanamasiswa') }}',
                                method: 'get',
                                data: {
                                    id: kelas,
                                },
                                success: function(responsiswa) {
                                    $("#siswa").html(responsiswa);
                                    $(".select2").select2();
                                    // hasilakhir(kelas)

                                    hasilakhir(kelas)

                                }
                            });
                        });

                    }
                });
            });

            function hasilakhir(kelas) {
                $('.istagihan').on('change', function(
                    e) {
                    const tagihan = $(
                        '#tagihan').val();
                    e.preventDefault();
                    viewtampil(tagihan)
                    TU_all(tagihan)
                });
            }
            $(document).on('click', '.deleteaku', function(e) {

                let cektotal = $(this).attr('cektotal');
                e.preventDefault();
                let csrf = '{{ csrf_token() }}';
                $.ajax({
                    url: '{{ route('CekTotalViewDeleteadmin') }}',
                    method: 'post',
                    data: {
                        id: cektotal,
                        _token: csrf
                    },
                    success: function(response) {
                        TU_all(cektotal);
                        viewtampil(cektotal)
                        console.log(cektotal)
                    }
                });
            });

            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let anying = $(this).attr('id_siswa');
                let csrf = '{{ csrf_token() }}';
                $.ajax({
                    url: '{{ route('hapusadmin') }}',
                    method: 'post',
                    data: {
                        id: id,
                        _token: csrf
                    },
                    success: function(response) {
                        console.log(anying);
                        TU_all(anying);
                        viewtampil(anying)
                        $.ajax({
                            url: '{{ route('ajaxsearch-tagihanAll') }}',
                            method: 'get',
                            data: {
                                id: anying,
                            },
                            success: function(
                                p) {
                                $("#hasil")
                                    .html(
                                        p
                                    );
                            }
                        });
                    }
                });
            });

            function TU_all(tagihan) {
                // const tagihan = $('#tagihan').val();
                $.ajax({
                    url: '{{ route('cekadmin') }}',
                    method: 'get',
                    data: {
                        id: tagihan
                    },
                    success: function(response) {
                        viewtampil(tagihan)
                        $("#TU_all").html(response);
                    }
                });
            }
            $('#aku').change(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                const id_siswa = fd.get('id_siswa');
                $.ajax({
                    url: '{{ route('cektotaladmin') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {

                        console.log(id_siswa);
                        if (response.status == 200) {
                            TU_all(id_siswa);
                            $.ajax({
                                url: '{{ route('ajaxsearch-tagihanAll') }}',
                                method: 'get',
                                data: {
                                    id: id_siswa,
                                },
                                success: function(
                                    p) {
                                    $("#hasil")
                                        .html(
                                            p
                                        );
                                }
                            });
                            viewtampil(id_siswa);
                        }
                    }
                });
            });
            // viewtampil()

            function viewtampil(id_siswa) {
                // let id_siswa = $(this).attr('id_siswa');
                // e.preventDefault();
                $.ajax({
                    url: '{{ route('ajaxgettagihanview') }}',
                    method: 'get',
                    data: {
                        id_siswa: id_siswa,
                    },
                    success: function(response) {
                        TU_all(id_siswa)
                        $.ajax({
                            url: '{{ route('ajaxsearch-tagihanAll') }}',
                            method: 'get',
                            data: {
                                id: id_siswa,
                            },
                            success: function(
                                p) {
                                $("#hasil")
                                    .html(
                                        p
                                    );
                            }
                        });
                        $("#haha").html(response);
                        // tagihan()
                    }
                });
            }

        });
    </script>
@endsection

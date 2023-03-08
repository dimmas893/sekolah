@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Menu</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('infosiswa') }}">Informasi siswa</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('viewTagihanmenu') }}">Tagihan</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('searchbayartagihan') }}">Pencarian</a></div>
                    <div class="breadcrumb-item">Pencarian berdasarkan nama</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12 col-xl-12 col-xxl-12 col-lg-12">
                        <div class="card shadow-primary card-primary">
                            <div class="card-header">
                                <h4>pencarian</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="my-2">
                                            <div class="isMember">
                                                <label for="name">Jenjang</label>
                                                <select id="package" class="form-control">
                                                    <option value="" selected disabled>--- Pilih Jenjang ---</option>
                                                    @foreach ($jenjang_pendidikan as $item => $value)
                                                        <option value="{{ $value->id }}">{{ $value->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="my-2">
                                            <div id="sma">
                                                <label for="name">Kelas</label>
                                                <select class="form-control">
                                                    <option disabled selected>Mohon Untuk Memilih Jenjang Pendidikan
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-xl-12 col-xxl-12 col-lg-12">
                                        <div class="my-2">
                                            <div id="siswa">
                                                <label for="name">Siswa</label>
                                                <select class="form-control">
                                                    <option disabled selected>Mohon Untuk Memilih Kelas</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="tampil" class="col-md-12 col-xl-12 col-xxl-12 col-lg-12 mt-3">
                        <form action="#" id="aku" method="post">
                            @csrf
                            <div id="tagih"></div>
                        </form>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script></script>
    <script>
        $(function() {
            $("#tampil").hide();
            $('.isMember').on('change', function(e) {
                const selectedPackage = $('#package').val();
                const kelas = $('#kelas').val();
                const cek = 0;
                $("#loading").show();
                e.preventDefault();
                $("#tampil").hide();
                $("#siswa").html(
                    '<label for="name">Siswa</label><select class="form-control"><option disabled selected>Mohon Untuk Memilih Kelas</option></select>'
                );
                $.ajax({
                    url: '{{ route('ajaxsearch-tagihansiswa') }}',
                    method: 'get',
                    data: {
                        id: selectedPackage,
                    },
                    success: function(response) {
                        $("#sma").html(response);

                        getsiswa()
                        gettagihan(cek)
                        TU_all(cek)
                        $("#loading").hide();
                    }
                });

            });



            function getsiswa() {
                $('.iskelas').on('change', function(e) {
                    const cek = 0;
                    const kelas = $('#kelas').val();
                    $("#loading").show();
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
                            $("#TU_all").html('');
                            $("#tagih").html('');
                            $('.istagihan').on('change', function(
                                e) {
                                const tagihan = $(
                                    '#tagihan').val();

                                e.preventDefault();
                                gettagihan(tagihan)
                                $("#tampil").show();

                            });
                            $("#loading").hide();

                        }
                    });
                });
            }



            $('#aku').change(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                const id_siswa = fd.get('id_siswa');
                $("#loading").show();
                $.ajax({
                    url: '{{ route('cektotaladmin') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 200) {
                            gettagihan(id_siswa)
                        }
                        if (response.status === 400) {
                            Swal.fire(
                                'Info!',
                                'Ada yang salah harap ulangi lagi.',
                                'info'
                            )
                            gettagihan(id_siswa)
                        }

                    }
                });
            });



            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                $("#loading").show();
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
                        gettagihan(anying)
                    }
                });
            });


            $(document).on('click', '.deleteadmin', function(e) {
                let cektotal = $(this).attr('cektotal');
                // console.log(cektotal)
                e.preventDefault();
                $("#loading").show();
                let csrf = '{{ csrf_token() }}';
                $.ajax({
                    url: '{{ route('CekTotalViewDeleteadmin') }}',
                    method: 'post',
                    data: {
                        id: cektotal,
                        _token: csrf
                    },
                    success: function(response) {
                        gettagihan(cektotal)
                    }
                });
            });

            function gettagihan(tagihan) {
                $("#loading").show();
                const cek = 0;
                $.ajax({
                    url: '{{ route('ajaxsearch-tagihanAll') }}',
                    method: 'get',
                    data: {
                        id: tagihan,
                    },
                    success: function(p) {
                        $("#tagih").html(p);
                        // TU_all(tagihan);
                        // viewtampil(tagihan)
                        // getsiswa(cek)
                        TU_all(tagihan)

                    }
                });
            }

            // function viewtampil(id_siswa) {
            //     $.ajax({
            //         url: '{{ route('ajaxgettagihanview') }}',
            //         method: 'get',
            //         data: {
            //             id_siswa: id_siswa,
            //         },
            //         success: function(response) {
            //             // TU_all(id_siswa)
            //             $("#haha").html(response);
            //         }
            //     });
            // }

            function TU_all(tagihan) {
                $.ajax({
                    url: '{{ route('cekadmin') }}',
                    method: 'get',
                    data: {
                        id: tagihan
                    },
                    success: function(response) {
                        // viewtampil(tagihan)
                        $("#TU_all").html(response);
                        $("#loading").hide();
                    }
                });
            }

        });
    </script>
@endsection

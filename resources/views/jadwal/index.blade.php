@extends('layouts.template.template')
@section('content')
    <style>
        .tampil {
            display: none;
        }
    </style>

    <div id="app">
        <div class="main-content">
            <div class="modal fade" id="add_TU_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        </div>
                        <form action="#" method="POST" id="add_TU_form" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="isMember my-2">
                                    <label for="name">Jenjang</label>
                                    <select name="kelas_id" id="package" class="form-control">
                                        <option value="null">--- Pilih Jenjang ---</option>
                                        @foreach ($jenjangpenddian as $item => $value)
                                            <option value="{{ $value->id }}">{{ $value->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-2 mt-3">
                                    <label for="name">Kelas</label>
                                    <div id="sma">
                                        <select class="form-control">
                                            <option disabled selected>Mohon Untuk Memilih Jenjang Pendidikan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="my-2">
                                    <label for="name">Guru</label>
                                    <select name="guru_id" class="form-control">
                                        <option value="null">--- Pilih Guru ---</option>
                                        @foreach ($guru as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="my-2">
                                    <label for="name">Mata Pelajaran</label>
                                    <select name="mata_pelajaran_id" class="form-control">
                                        <option value="null">--- Pilih Mata Pelajaran ---</option>
                                        @foreach ($mata_pelajaran as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-2">
                                    <label for="name">Hari</label>
                                    <select name="hari_id" class="form-control">
                                        <option value="null">--- Pilih Hari ---</option>
                                        @foreach ($hari as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-2">
                                    <label for="name">Ruangan</label>
                                    <select name="ruangan_id" class="form-control">
                                        <option value="null">--- Pilih Ruangan ---</option>
                                        @foreach ($ruangan as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-2">
                                    <label for="jam_masuk">Jam Masuk</label>
                                    <input type="time" name="jam_masuk" class="form-control">
                                </div>
                                <div class="my-2">
                                    <label for="jam_keluar">Jam Keluar</label>
                                    <input type="time" name="jam_keluar" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="add_TU_btn" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- add new employee modal end --}}

            {{-- edit employee modal start --}}
            <div class="modal fade" id="editTUModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                data-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                            {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> --}}
                        </div>
                        <form action="#" method="POST" id="edit_TU_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="modal-body">
                                <div class="my-2">
                                    <label for="name">Guru</label>
                                    <select name="guru_id" id="guru_id" class="form-control">
                                        @foreach ($guru as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-2">
                                    <label for="name">Kelas</label>
                                    <div id="kelasMuncul">

                                    </div>
                                </div>

                                <div class="my-2">
                                    <label for="name">Mata Pelajaran</label>
                                    <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="form-control">
                                        @foreach ($mata_pelajaran as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="my-2">
                                    <label for="name">Ruangan</label>
                                    <select name="ruangan_id" id="ruangan_id" class="form-control">
                                        <option value="null">--- Pilih Ruangan ---</option>
                                        @foreach ($ruangan as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-2">
                                    <label for="name">Hari</label>
                                    <select name="hari_id" id="hari_id" class="form-control">
                                        <option value="null">--- Pilih Hari ---</option>
                                        @foreach ($hari as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-2">
                                    <label for="jam_masuk">Jam Masuk</label>
                                    <input type="time" name="jam_masuk" id="jam_masuk" class="form-control">
                                </div>
                                <div class="my-2">
                                    <label for="jam_keluar">Jam Keluar</label>
                                    <input type="time" name="jam_keluar" id="jam_keluar" class="form-control">
                                </div>
                            </div>
                            {{-- <input type="text" class="form-ccontrol" id="mata_pelajaran_id"> --}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="edit_TU_btn" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- edit employee modal end --}}

            <section class="section">
                <div class="section-header">
                    <h1>Halaman Data Jadwal </h1>
                </div>
                <div class="section-body">
                    <div class="row my-5">
                        <div class="col-lg-12">
                            <div class="card shadow">
                                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                    <h3 class="text-light">Tabel Jadwal</h3>
                                    <a href="{{ route('pilihjenjang') }}" class="btn btn-light"><i
                                            class="bi-plus-circle me-2"></i>Tambah Jadwal</a>
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
                </div>
            </section>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>

    <script>
        $('.isMember').on('change', function(e) {
            const selectedPackage = $('#package').val();
            e.preventDefault();
            $.ajax({
                url: '{{ route('jadwal-kelas') }}',
                method: 'get',
                data: {
                    id: selectedPackage
                },
                success: function(response) {
                    console.log(response)
                    $("#sma").html(response);
                }
            });
        });

        // $(function() {
        //     $('#.sMember').change(function() {
        //         $('.tampil').hide();
        //         $('#' + $(this).val()).show();
        //     });
        // });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                width: '100%'
            });
        });
    </script>
    <script>
        $(function() {
            $('#isMember').change(function() {
                $('.tampil').hide();
                $('#' + $(this).val()).show();
            });
        });
        $(function() {
            // add new employee ajax request
            $("#add_TU_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_TU_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('jadwal-store') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Added!',
                                'Added Successfully!',
                                'success'
                            )
                            TU_all();
                        }
                        $("#add_TU_btn").text('Save');
                        $("#add_TU_form")[0].reset();
                        $("#add_TU_modal").modal('hide');
                    }
                });
            });
            // edit employee ajax request
            $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let jenjang_id = $(this).attr('jenjang_id')

                $.ajax({
                    url: '{{ route('jadwal-edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        jenjang_id: jenjang_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        kelas(id);
                        $("#kelas_id").val(response.kelasget.id);
                        $("#guru_id").val(response.guru_id);
                        $("#mata_pelajaran_id").val(response.mata_pelajaran_id);
                        $("#ruangan_id").val(response.ruangan_id);
                        $("#hari_id").val(response.hari_id);
                        $("#jam_masuk").val(response.jam_masuk);
                        $("#jam_keluar").val(response.jam_keluar);
                        $("#id").val(response.id);
                    }
                });
            });
            // update employee ajax request
            $("#edit_TU_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_TU_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('jadwal-update') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Updated!',
                                'Updated Successfully!',
                                'success'
                            )
                            TU_all();
                        }
                        $("#edit_TU_btn").text('Update');
                        $("#edit_TU_form")[0].reset();
                        $("#editTUModal").modal('hide');
                    }
                });
            });
            // delete employee ajax request
            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('jadwal-delete') }}',
                            method: 'post',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                console.log(response);
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )

                                TU_all();
                            }
                        });
                    }
                })
            });
            // fetch all employees ajax request



            // kelas();

            function kelas(id) {
                $.ajax({
                    url: '{{ route('jadwal-kelasEdit') }}',
                    method: 'get',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $("#kelasMuncul").html(response);
                    }
                });
            }


            TU_all();

            function TU_all() {
                $.ajax({
                    url: '{{ route('jadwal-all') }}',
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
        });
    </script>
@endsection

@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <div class="modal fade" id="editTUModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                        {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <form action="#" method="POST" id="edit_TU_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        {{-- <input type="hidden" name="tingkatan" value="{{ $tingkatan }}" /> --}}
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

        <div class="modal fade" id="add_TU_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    </div>
                    <form action="#" method="POST" id="add_TU_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">

                        <input type="hidden" name="tingkatan" value="{{ $tingkatan }}">
                        <div class="modal-body">
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

        <section class="section">
            <div class="section-header">
                <h1>Halaman Tambah Jadwal Siswa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('jadwal') }}">Table Jadwal
                        </a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('pilihjenjang') }}">Pilih Jenjang</a></div>
                    <div class="breadcrumb-item">Buat Jadwal</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Jadwal Kelas {{ $kelas->kelas->name }}</h3>
                                <button class="btn btn-light" data-toggle="modal" data-target="#add_TU_modal"><i
                                        class="bi-plus-circle me-2"></i>Tambah Jadwal</button>
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
        </section>
    </div>
@endsection


@section('js')
    <script>
        $(function() {
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
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Jadwal di jam tersebut sudah ada!',
                                'info'
                            )
                            TU_all();
                        }
                        $("#add_TU_btn").text('Save');
                        $("#add_TU_form")[0].reset();
                        $("#add_TU_modal").modal('hide');
                    }
                });
            });

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
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Jadwal di jam tersebut sudah ada!',
                                'info'
                            )
                            TU_all();
                        }
                        $("#edit_TU_btn").text('Update');
                        $("#edit_TU_form")[0].reset();
                        $("#editTUModal").modal('hide');
                    }
                });
            });

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

            $('#isMember').change(function() {
                $('.tampil').hide();
                $('#' + $(this).val()).show();
            });

            TU_all()

            function TU_all() {
                $.ajax({
                    url: '{{ route('jadwal-datajadwalkelas') }}',
                    method: 'get',
                    data: {
                        id: {{ $kelas->id }}
                    },
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

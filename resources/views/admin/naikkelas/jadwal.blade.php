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
                            <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                            <input type="hidden" name="jenjang_pendidikan_id"
                                value="{{ \App\Models\Master_Kelas::where('id', $kelas->id_master_kelas)->first()->jenjang_pendidikan_id }}">
                            <input type="hidden" name="tingkatan_id" value="{{ $kelas->tingkatan_id }}">
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
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                        <div class="breadcrumb-item active"><a href="{{ route('manage') }}">Manage</a></div>
                        <div class="breadcrumb-item active"><a href="{{ route('semuakelas') }}">Semua kelas</a></div>
                        @php
                            $tk = 4;
                            $sd = 1;
                            $smp = 2;
                            $sma = 3;
                        @endphp
                        @if ($kelas->kelas->jenjang_pendidikan_id === 4)
                            <div class="breadcrumb-item active"><a href="{{ route('tk') }}">Jadwal jenjang tk</a></div>
                            <div class="breadcrumb-item">Jadwal kelas
                                {{ $kelas->kelas->name }}</div>
                        @elseif($kelas->kelas->jenjang_pendidikan_id === 1)
                            <div class="breadcrumb-item active"><a href="{{ route('sd') }}">Jadwal jenjang sd</a></div>
                            <div class="breadcrumb-item">Jadwal kelas
                                {{ $kelas->kelas->name }}</div>
                        @elseif($kelas->kelas->jenjang_pendidikan_id === 2)
                            <div class="breadcrumb-item active"><a href="{{ route('smp') }}">Jadwal jenjang smp</a>
                            </div>
                            <div class="breadcrumb-item">Jadwal kelas
                                {{ $kelas->kelas->name }}</div>
                        @elseif($kelas->kelas->jenjang_pendidikan_id === 3)
                            <div class="breadcrumb-item active"><a href="{{ route('sma') }}">Jadwal jenjang sma</a>
                            </div>
                            <div class="breadcrumb-item">Jadwal kelas
                                {{ $kelas->kelas->name }}</div>
                        @endif
                    </div>
                </div>
                <div class="section-body">
                    <div class="row my-5">
                        <div class="col-lg-12">
                            <div class="card shadow">
                                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                    <h3 class="text-light">Tabel Jadwal</h3>
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
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            // add new employee ajax request
            $("#add_TU_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_TU_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('jadwaladmin-store') }}',
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
                                'Ups!',
                                'Jadwal sudah ada!',
                                'info'
                            )
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
                    url: '{{ route('jadwaladmin-edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        jenjang_id: jenjang_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
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
                    url: '{{ route('jadwaladmin-update') }}',
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
                                'Ups!',
                                'Jadwal sudah ada!',
                                'info'
                            )
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
                            url: '{{ route('jadwaladmin-delete') }}',
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

            TU_all();

            function TU_all() {
                $.ajax({
                    url: '{{ route('jadwaladmin-all', $kelas->id) }}',
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

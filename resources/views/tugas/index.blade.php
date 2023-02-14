@extends('layouts.template.template')
@section('content')
    <div class="main-content">

        <div class="modal fade" id="add_TU_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tugas</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
                    </div>
                    <form action="#" method="POST" id="add_TU_form" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="">Judul Tugas</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukan Judul Tugas"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" placeholder="Masukan Deskripsi" required></textarea>
                            </div>
                            <div class="my-2">
                                <label for="">Tanggal Tugas</label>
                                <input type="date" name="tanggal_tugas" class="form-control"
                                    placeholder="Masukan Tanggal Tugas" required>
                            </div>
                            <div class="my-2">
                                <label for="">Tanggal Pengumpulan</label>
                                <input type="date" name="tanggal_pengumpulan" class="form-control"
                                    placeholder="Masukan Tanggal Pengumpulan" required>
                            </div>
                            <div class="my-2">
                                <label for="">Tanggal Evaluasi</label>
                                <input type="date" name="tanggal_evaluasi" class="form-control"
                                    placeholder="Masukan Tanggal Evaluasi" required>
                            </div>
                            <div class="my-2">
                                <label for="">File Tugas</label>
                                <input type="file" name="file_tugas" class="form-control"
                                    placeholder="Masukan File Tugas" required>
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
                        <input type="hidden" name="file_tugas" id="emp_image">
                        <input type="hidden" name="jadwal_id" id="jadwal_id">
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="">Judul Tugas</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    placeholder="Masukan Judul Tugas" required>
                            </div>
                            <div class="my-2">
                                <label for="">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukan Deskripsi" required></textarea>
                            </div>
                            <div class="my-2">
                                <label for="">Tanggal Tugas</label>
                                <input type="date" name="tanggal_tugas" id="tanggal_tugas" class="form-control"
                                    placeholder="Masukan Tanggal Tugas" required>
                            </div>
                            <div class="my-2">
                                <label for="">Tanggal Pengumpulan</label>
                                <input type="date" name="tanggal_pengumpulan" id="tanggal_pengumpulan"
                                    class="form-control" placeholder="Masukan Tanggal Pengumpulan" required>
                            </div>
                            <div class="my-2">
                                <label for="">Tanggal Evaluasi</label>
                                <input type="date" name="tanggal_evaluasi" id="tanggal_evaluasi" class="form-control"
                                    placeholder="Masukan Tanggal Evaluasi" required>
                            </div>
                            <div class="my-2">
                                <label for="">File Tugas</label>
                                <input type="file" name="file_tugas" id="emp_image" class="form-control"
                                    placeholder="Masukan File Tugas">
                            </div>
                        </div>
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
                <h1>Halaman Data Tugas</h1>
            </div>


            <div class="section-body">
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Tugas</h3>
                                <button class="btn btn-light" data-toggle="modal" data-target="#add_TU_modal"><i
                                        class="bi-plus-circle me-2"></i>Tambah Tugas</button>
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
                    url: '{{ route('tugas-store_ajax') }}',
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
                $.ajax({
                    url: '{{ route('tugas-edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#jadwal_id").val(response.jadwal_id);
                        $("#nama").val(response.nama);
                        $("#tanggal_tugas").val(response.tanggal_tugas);
                        $("#tanggal_pengumpulan").val(response.tanggal_pengumpulan);
                        $("#tanggal_evaluasi").val(response.tanggal_evaluasi);
                        $("#deskripsi").val(response.deskripsi);
                        $("#file_tugas").val(response.file_tugas);
                        $("#image").html(
                            `<img src="/file_tugas/${response.image}" width="100" class="img-fluid img-thumbnail">`
                        );
                        $("#emp_image").val(response.file_tugas);
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
                    url: '{{ route('tugas-update') }}',
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
                            url: '{{ route('tugas-delete') }}',
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
            TU_all();

            function TU_all() {
                $.ajax({
                    url: '{{ route('tugas-all') }}',
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

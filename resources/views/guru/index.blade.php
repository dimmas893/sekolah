@extends('layouts.template.template')
@section('content')
    <div class="main-content">

        <div class="modal fade" id="add_TU_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Guru</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
                    </div>
                    <form action="#" method="POST" id="add_TU_form" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="name">Nama Guru</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukan Nama"
                                    required>
                            </div>

                            <div class="my-2">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukan Email"
                                    required>
                            </div>

                            <div class="my-2">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" name="alamat" class="form-control" placeholder="Masukan alamat" required> </textarea>
                            </div>

                            <div class="my-2">
                                <label for="Telepon">Telepon</label>
                                <input type="number" name="telp" class="form-control"
                                    placeholder="Masukan Nomor Telepon" required>
                            </div>

                            <div class="my-2">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukan Password"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="image">Image</label>
                                <input type="file" name="avatar" class="form-control">
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
                        <input type="hidden" name="emp_image" id="emp_image">
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="name">Nama Guru</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Masukan Nama" required>
                            </div>
                            <div class="my-2">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Masukan Email" required>
                            </div>

                            <div class="my-2">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" class="form-control" placeholder="Masukan alamat"
                                    required> </textarea>
                            </div>

                            <div class="my-2">
                                <label for="Telepon">Telepon</label>
                                <input type="number" name="telp" id="telp" class="form-control"
                                    placeholder="Masukan Nomor Telepon" required>
                            </div>

                            <div class="my-2">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Masukan Password">
                            </div>
                            <div class="my-2">
                                <label for="image">Select image</label>
                                <input type="file" id="emp_image" name="avatar" class="form-control">
                            </div>
                            <div class="mt-2" id="image">

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
                <h1>Halaman Guru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('manage') }}">Manage</a>
                    </div>
                    <div class="breadcrumb-item">Tabel guru</div>
                </div>
            </div>


            <div class="section-body">
                {{-- <form action="{{ route('guru-excel') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-8 col-8">
                            <input type="file" name="file" class="form-control" />
                        </div>
                        <div class="form-group col-md-4 col-4">
                            <input type="submit" class="btn btn-success" value="Import">
                        </div>
                    </div>
                </form> --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Guru</h3>
                                <button class="btn btn-light" data-toggle="modal" data-target="#add_TU_modal"><i
                                        class="bi-plus-circle me-2"></i>Tambah Guru</button>
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
                    url: '{{ route('guru-store') }}',
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
                    url: '{{ route('guru-edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#name").val(response.name);
                        $("#email").val(response.email);
                        // $("#alamat").val(response.alamat);
                        $('#alamat').summernote('code', response.alamat);
                        $("#telp").val(response.telp);
                        $("#password").val(response.password);
                        $("#image").html(
                            `<img src="/guru/${response.avatar}" width="100" class="img-fluid img-thumbnail">`
                        );
                        $("#emp_image").val(response.avatar);
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
                    url: '{{ route('guru-update') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire({
                                title: 'Updated!',
                                text: 'Updated Successfully',
                                icon: "success",
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            })
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
                            url: '{{ route('guru-delete') }}',
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
                    url: '{{ route('guru-all') }}',
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

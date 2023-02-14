@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Data Siswa</h1>
            </div>
            <div class="section-body">
                <form action="{{ route('siswa-excel') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-8 col-6">
                            <input type="file" name="file" class="form-control" />
                        </div>
                        <div class="form-group col-md-4 col-3">
                            <input type="submit" class="btn btn-success" value="Import">
                        </div>

                        <div class="form-group col-md-8 col-3">
                            <a href="{{ route('siswa-export') }}" class="btn btn-success">Export</a>
                        </div>
                    </div>
                </form>
                <div class="section-body">
                    <div class="row my-5">
                        <div class="col-lg-12">
                            <div class="card shadow">
                                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                    <h3 class="text-light">Tabel Data Siswa</h3>
                                    <a href="{{ route('siswa-create') }}" class="btn btn-light"><i
                                            class="bi-plus-circle me-2"></i>Tambah Data
                                        Siswa</a>
                                </div>
                                <div>
                                    <div class="card-body">
                                        <table class="table-bordered table-md display nowrap table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NISN</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Telepon</th>
                                                    <th>Alamat</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($siswa as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $p->nomor_induk_siswa }}</td>
                                                        <td>{{ $p->nama_siswa }}</td>
                                                        <td>{{ $p->jenis_kelamin }}</td>
                                                        <td>{{ $p->telp }}</td>
                                                        <td>{{ $p->alamat }}</td>
                                                        <td>{{ $p->email }}</td>
                                                        <td> <a href="{{ route('siswa-edit-page', $p->id) }}"
                                                                class="btn btn-info">edit</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
        $(function() {
            // add new employee ajax request
            // $("#add_TU_form").submit(function(e) {
            //     e.preventDefault();
            //     const fd = new FormData(this);
            //     $("#add_TU_btn").text('Adding...');
            //     $.ajax({
            //         url: '{{ route('siswa-store') }}',
            //         method: 'post',
            //         data: fd,
            //         cache: false,
            //         contentType: false,
            //         processData: false,
            //         dataType: 'json',
            //         success: function(response) {
            //             if (response.status == 200) {
            //                 Swal.fire(
            //                     'Added!',
            //                     'Added Successfully!',
            //                     'success'
            //                 )
            //                 TU_all();
            //             }
            //             $("#add_TU_btn").text('Save');
            //             $("#add_TU_form")[0].reset();
            //             $("#add_TU_modal").modal('hide');
            //         }
            //     });
            // });
            // edit employee ajax request
            $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('siswa-edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#nomor_induk_siswa").val(response.nomor_induk_siswa);
                        $("#nama_siswa").val(response.nama_siswa);
                        $("#jenis_kelamin").val(response.jenis_kelamin);
                        $("#email").val(response.email);
                        $("#password").val(response.password);
                        $("#telp").val(response.telp);
                        $("#alamat").summernote('code', response.alamat);
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
                    url: '{{ route('siswa-update') }}',
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
                            url: '{{ route('siswa-delete') }}',
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
                    url: '{{ route('siswa-all') }}',
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

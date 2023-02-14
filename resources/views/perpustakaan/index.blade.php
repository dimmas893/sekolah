@extends('layouts.template.template')
@section('content')
    <div class="main-content">

        <div class="modal fade" id="add_TU_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data perpustakaan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="#" method="POST" id="add_TU_form" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="name">Judul Buku</label>
                                <input type="text" name="judul_buku" class="form-control"
                                    placeholder="Masukan Judul Buku" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Sampul</label>
                                <input type="file" name="sampul" class="form-control" placeholder="Masukan Sampul"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="name">Sinopsis</label>
                                <textarea name="sinopsis" class="form-control" placeholder="Masukan Sinopsis" required></textarea>
                            </div>
                            <div class="my-2">
                                <label for="name">Isbn No</label>
                                <input type="number" name="isbn_no" class="form-control" placeholder="Masukan Isbn No"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="name">Penerbit</label>
                                <input type="text" name="penerbit" class="form-control" placeholder="Masukan Penerbit"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="name">Penulis</label>
                                <input type="text" name="penulis" class="form-control" placeholder="Masukan Penulis"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="name">Rak</label>
                                <input type="text" name="rak" class="form-control" placeholder="Masukan No Rak"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="name">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" placeholder="Masukan Jumlah"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="name">Harga</label>
                                <input type="number" name="harga" class="form-control" placeholder="Masukan Harga"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="name">Kategori</label>
                                {{-- <input type="text" name="kategori_id" class="form-control"
                                    placeholder="Masukan Kategori" required> --}}
                                <select name="kategori_id" class="form-control">
                                    @foreach ($kategori_buku as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-2">
                                <label for="name">Bahasa</label>
                                <input type="text" name="bahasa" class="form-control" placeholder="Masukan Bahasa"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="name">Jumlah Halaman</label>
                                <input type="text" name="jumlah_halaman" class="form-control"
                                    placeholder="Masukan Jumlah Halaman" required>
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
                        <input type="hidden" name="emp_image" id="emp_image">
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="name">Judul Buku</label>
                                <input type="text" name="judul_buku" id="judul_buku" class="form-control"
                                    placeholder="Masukan Judul Buku" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Sampul</label>
                                <input type="file" name="sampul" id="image" class="form-control"
                                    placeholder="Masukan Sampul" required>
                            </div>

                            <div class="mt-2" id="image">

                            </div>
                            <div class="my-2">
                                <label for="name">Sinopsis</label>
                                <textarea name="sinopsis" class="form-control" id="sinopsis" placeholder="Masukan Sinopsis" required></textarea>
                            </div>
                            <div class="my-2">
                                <label for="name">Isbn No</label>
                                <input type="number" name="isbn_no" id="isbn_no" class="form-control"
                                    placeholder="Masukan Isbn No" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Penerbit</label>
                                <input type="text" name="penerbit" id="penerbit" class="form-control"
                                    placeholder="Masukan Penerbit" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Penulis</label>
                                <input type="text" name="penulis" id="penulis" class="form-control"
                                    placeholder="Masukan Penulis" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Rak</label>
                                <input type="number" name="rak" id="rak" class="form-control"
                                    placeholder="Masukan No Rak" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Jumlah</label>
                                <input type="number" id="jumlah" name="jumlah" class="form-control"
                                    placeholder="Masukan Jumlah" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Harga</label>
                                <input type="number" name="harga" id="harga" class="form-control"
                                    placeholder="Masukan Harga" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Kategori</label>
                                {{-- <input type="text" name="kategori_id" class="form-control"
                                    placeholder="Masukan Kategori" required> --}}
                                <select name="kategori_id" class="form-control" id="kategori_id">
                                    @foreach ($kategori_buku as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-2">
                                <label for="name">Bahasa</label>
                                <input type="text" name="bahasa" id="bahasa" class="form-control"
                                    placeholder="Masukan Bahasa" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Jumlah Halaman</label>
                                <input type="text" name="jumlah_halaman" id="jumlah_halaman" class="form-control"
                                    placeholder="Masukan Jumlah Halaman" required>
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
                <h1>Halaman Data perpustakaan</h1>
            </div>


            <div class="section-body">
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel perpustakaan</h3>
                                <button class="btn btn-light" data-toggle="modal" data-target="#add_TU_modal"><i
                                        class="bi-plus-circle me-2"></i>Tambah perpustakaan</button>
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
                    url: '{{ route('perpustakaan-store') }}',
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
                    url: '{{ route('perpustakaan-edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#judul_buku").val(response.judul);
                        $("#sinopsis").summernote('code', response.sinopsis);
                        $("#isbn_no").val(response.isbn_no);
                        $("#penerbit").val(response.penerbit);
                        $("#penulis").val(response.penulis);
                        $("#rak").val(response.rak);
                        $("#jumlah").val(response.jumlah);
                        $("#harga").val(response.harga);
                        $("#kategori_id").val(response.kategori_id);
                        $("#bahasa").val(response.bahasa);
                        $("#jumlah_halaman").val(response.jumlah_halaman);
                        $("#image").html(
                            `<img src="/sampul/${response.sampul}" width="100" class="img-fluid img-thumbnail">`
                        );
                        $("#emp_image").val(response.sampul);
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
                    url: '{{ route('perpustakaan-update') }}',
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
                            url: '{{ route('perpustakaan-delete') }}',
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
                    url: '{{ route('perpustakaan-all') }}',
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
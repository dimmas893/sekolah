@extends('layouts.template.template')
@section('content')
    <div class="main-content">

        <div class="modal fade" id="add_TU_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    </div>
                    <form action="#" method="POST" id="add_TU_form" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="name">Soal</label>
                                <textarea name="soal" class="form-control" placeholder="Masukan Soal" required></textarea>
                            </div>
                            <div class="my-2">
                                <label for="name">Jabawan A</label>
                                <textarea name="jawaban_a" class="form-control" placeholder="Masukan Jawaban A" required></textarea>
                            </div>
                            <div class="my-2">
                                <label for="name">Jabawan B</label>
                                <textarea name="jawaban_b" class="form-control" placeholder="Masukan Jawaban B" required></textarea>
                            </div>
                            <div class="my-2">
                                <label for="name">Jabawan C</label>
                                <textarea name="jawaban_c" class="form-control" placeholder="Masukan Jawaban C" required></textarea>
                            </div>
                            <div class="my-2">
                                <label for="name">Jabawan D</label>
                                <textarea name="jawaban_d" class="form-control" placeholder="Masukan Jawaban D" required></textarea>
                            </div>
                            <div class="my-2">
                                <label for="name">Kunci Jawaban</label>
                                <input type="text" name="kunci_jawaban" class="form-control"
                                    placeholder="Masukan Kunci Jawaban" required>
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
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="name">Soal</label>
                                <textarea name="soal" id="soal" class="form-control" placeholder="Masukan Soal" required></textarea>
                            </div>
                            <div class="my-2">
                                <label for="name">Jabawan A</label>
                                <textarea name="jawaban_a" id="jawaban_a" class="form-control" placeholder="Masukan Jawaban a" required></textarea>
                            </div>
                            <div class="my-2">
                                <label for="name">Jabawan B</label>
                                <textarea name="jawaban_b" id="jawaban_b" class="form-control" placeholder="Masukan Jawaban b" required></textarea>
                            </div>
                            <div class="my-2">
                                <label for="name">Jabawan C</label>
                                <textarea name="jawaban_c" id="jawaban_c" class="form-control" placeholder="Masukan Jawaban c" required></textarea>
                            </div>
                            <div class="my-2">
                                <label for="name">Jabawan D</label>
                                <textarea name="jawaban_d" id="jawaban_d" class="form-control" placeholder="Masukan Jawaban D" required></textarea>
                            </div>
                            <div class="my-2">
                                <label for="name">Kunci Jawaban</label>
                                <input type="text" name="kunci_jawaban" id="kunci_jawaban" class="form-control"
                                    placeholder="Masukan Kunci Jawaban" required>
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
        <div class="modal fade" id="halo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('SoalForm') }}" method="get">
                        <input type="hidden" name="id" value="{{ $id }}">
                        {{-- <input type="hidden" name="jadwal_id" value="{{ $jadwal_id }}"> --}}
                        <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang_pendidikan_id }}">
                        <input type="hidden" name="mata_pelajaran_id" value="{{ $mata_pelajaran }}">
                        <input type="hidden" name="tingkatan_id" value="{{ $tingkatan_id }}">
                        @csrf
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="name">Jumlah Soal</label>
                                <input type="number" name="form" placeholder="Masukan jumlah soal"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="add_TU_btn" class="btn btn-primary">Selanjutnya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <form method="get" id="pilihtingkatanujian_id" action="{{ route('pilihtingkatanujian') }}"
            style="display:none;">
            @csrf
            <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang_pendidikan_id }}">
            <input type="submit" class="btn btn-primary" value="Masuk">
        </form>

        <form method="get" id="pilihmatapelajaranujian_id" action="{{ route('pilihmatapelajaranujian') }}"
            style="display:none;">
            @csrf
            {{-- <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang_pendidikan_id }}"> --}}
            <input type="hidden" name="tingkatan_id" value="{{ $tingkatan_id }}">
            <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang_pendidikan_id }}">
            <input type="submit" class="btn btn-primary" value="Masuk">
        </form>
        {{-- <form method="get" id="ujian_id_nih" action="/tabel-ujian/{{ $mata_pelajaran }}/{{ $tingkatan_id }}"
            style="display:none;">
            @csrf
            <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang_pendidikan_id }}">
            <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang_pendidikan_id }}">
            <input type="hidden" name="mata_pelajaran_id" value="{{ $mata_pelajaran }}">
            <input type="hidden" name="tingkatan_id" value="{{ $tingkatan_id }}">
            <input type="submit" class="btn btn-primary" value="Masuk">
        </form> --}}
        <section class="section">
            <div class="section-header">
                <h1>Halaman Data Soal {{ $tingkatan_id }}
                    <b>{{ \App\Models\Ujian::where('id', $id)->first()->jenis_ujian }}</b>
                </h1>
                <div class="section-header-breadcrumb">
                    {{-- <div class="breadcrumb-item active"><a href="{{ route('jadwal') }}">Table Jadwal
                        </a></div> --}}
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('manage') }}">Manage</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('pilihjenjangujian') }}">Jenjang</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('pilihtingkatanujian') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('pilihtingkatanujian_id').submit();">Tingkatan</a>
                    </div>
                    <div class="breadcrumb-item active"><a href="{{ route('pilihmatapelajaranujian') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('pilihmatapelajaranujian_id').submit();">Mata
                            Pelajaran</a>
                    </div>
                    <div class="breadcrumb-item active"><a
                            href="/tabel-ujian/{{ $mata_pelajaran }}/{{ $tingkatan_id }}/{{ $jenjang_pendidikan_id }}">Ujian</a>
                    </div>
                    <div class="breadcrumb-item">Soal</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Soal</h3>
                                <button class="btn btn-light" data-toggle="modal" data-target="#halo"><i
                                        class="bi-plus-circle me-2"></i>Tentukan jumlah soal</button>
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
            @php
            $p = 0; @endphp
            {{-- <div class="card">
                <div class="card-header">
                    Form soal
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('soal-storemulti') }}">
                                @csrf
                                <div class="fieldGroup"></div>
                                <div class="form-group fieldGroupCopy" style="display: none;">
                                    <input type="hidden" name="ujian_id[]" value="{{ $id }}">
                                    <div>
                                        <label for=""><b class="badge badge-success">Soal</b></label>
                                        <textarea name="soal[]" class="form-control" placeholder="Masukan soal"></textarea>
                                    </div>
                                    <div>
                                        <label for="">Jawaban a</label>
                                        <textarea name="jawaban_a[]" class="form-control" placeholder="Masukan jawaban a"></textarea>
                                    </div>
                                    <div>
                                        <label for="">Jawaban b</label>
                                        <textarea name="jawaban_b[]" class="form-control" placeholder="Masukan jawaban b"></textarea>
                                    </div>
                                    <div>
                                        <label for="">Jawaban c</label>
                                        <textarea name="jawaban_c[]" class="form-control" placeholder="Masukan jawaban c"></textarea>
                                    </div>
                                    <div>
                                        <label for="">Jawaban d</label>
                                        <textarea name="jawaban_d[]" class="form-control" placeholder="Masukan jawaban d"></textarea>
                                    </div>
                                    <div>
                                        <label for="">Kunci jawaban</label>
                                        <input type="text" name="kunci_jawaban[]" class="form-control"
                                            placeholder="Masukan kunci jawaban">
                                    </div>

                                    <div class="input-group-addon mt-2">
                                        <a href="javascript:void(0)" class="btn btn-danger remove"><i
                                                class="fas fa-trash"></i></a>
                                    </div>
                                    <hr>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-xl-12 col-md-12 col-sm-12 col-lg-12 col-xxl-12">
                                        <a href="javascript:void(0)" class="btn btn-success addMore"><i
                                                class="fas fa-plus"></i> Tambah Soal</a>
                                        <hr>
                                    </div>

                                    <div class="col-12 col-xl-12 col-md-12 col-sm-12 col-lg-12 col-xxl-12">
                                        <input type="submit" class="btn btn-primary" value="Simpan">
                                        <hr>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-12 col-xl-12 col-md-12 col-sm-12 col-lg-12 col-xxl-12">
                                    <form action="{{ route('SoalForm') }}" method="get">
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <input type="hidden" name="jadwal_id" value="{{ $jadwal_id }}">
                                        <div class="row">
                                            <div class="col-6 mt-4">
                                                @csrf
                                                <input type="number" class="form-control"
                                                    placeholder="Masukan jumlah soal" name="form" required>
                                            </div>
                                            <div class="col-6 mt-4">
                                                <input type="submit" class="btn btn-info" value="Buat soal">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                    </div>
                </div>
            </div> --}}
        </section>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // membatasi jumlah inputan
            var maxGroup = 20;

            //melakukan proses multiple input
            $(".addMore").click(function() {
                if ($('body').find('.fieldGroup').length < maxGroup) {
                    var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() +
                        '</div>';
                    $('body').find('.fieldGroup:last').after(fieldHTML);
                } else {
                    alert('Maximum ' + maxGroup + ' groups are allowed.');
                }
            });

            //remove fields group
            $("body").on("click", ".remove", function() {
                $(this).parents(".fieldGroup").remove();
            });
        });
    </script>
    <script>
        $(function() {
            // add new employee ajax request
            $("#add_TU_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_TU_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('soal-store') }}',
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
                    url: '{{ route('soal-edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#soal").val(response.soal);
                        $("#jawaban_a").val(response.jawaban_a);
                        $("#jawaban_b").val(response.jawaban_b);
                        $("#jawaban_c").val(response.jawaban_c);
                        $("#jawaban_d").val(response.jawaban_d);
                        $("#kunci_jawaban").val(response.kunci_jawaban);
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
                    url: '{{ route('soal-update') }}',
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
                            url: '{{ route('soal-delete') }}',
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
                    url: '{{ route('soal-all', $id) }}',
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

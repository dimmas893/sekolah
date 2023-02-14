@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Data Soal <b>{{ \App\Models\Ujian::where('id', $id)->first()->jenis_ujian }}</b></h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('jadwal_buat_guru') }}">Daftar Jadwal</a>
                    </div>
                    <div class="breadcrumb-item active"><a href="{{ route('jadwal-semua-siswa', $jadwal_id) }}">Kelas</a>
                    </div>
                    <div class="breadcrumb-item active"><a href="{{ route('tabelujian', $jadwal_id) }}">Ujian</a>
                    </div>
                    <div class="breadcrumb-item active"><a href="{{ route('ujian-soal', $id) }}">Tabel Soal
                            {{ \App\Models\Ujian::where('id', $id)->first()->jenis_ujian }}</a>
                    </div>
                    <div class="breadcrumb-item">Form Soal</div>
                </div>
            </div>

            @php
            $p = 0; @endphp
            <div class="card">
                <div class="card-header">
                    Form soal
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('soal-store') }}">
                                @csrf
                                @for ($i = 0; $i < $form; $i++)
                                    <input type="hidden" name="ujian_id[]" value="{{ $id }}">
                                    <div>
                                        <label for=""><b class="badge badge-success">Soal
                                                {{ $i + 1 }}</b></label>
                                        <textarea name="soal[]" class="form-control" placeholder="Masukan soal" required></textarea>
                                    </div>
                                    <div>
                                        <label for="">Jawaban a</label>
                                        <textarea name="jawaban_a[]" class="form-control" placeholder="Masukan jawaban a" required></textarea>
                                    </div>
                                    <div>
                                        <label for="">Jawaban b</label>
                                        <textarea name="jawaban_b[]" class="form-control" placeholder="Masukan jawaban b" required></textarea>
                                    </div>
                                    <div>
                                        <label for="">Jawaban c</label>
                                        <textarea name="jawaban_c[]" class="form-control" placeholder="Masukan jawaban c" required></textarea>
                                    </div>
                                    <div>
                                        <label for="">Jawaban d</label>
                                        <textarea name="jawaban_d[]" class="form-control" placeholder="Masukan jawaban d" required></textarea>
                                    </div>
                                    <div>
                                        <label for="">Kunci jawaban</label>
                                        <input type="text" name="kunci_jawaban[]" class="form-control"
                                            placeholder="Masukan kunci jawaban" required>
                                    </div>
                                    <hr>
                                @endfor
                                <div class="row">
                                    <div class="col-12 mt-4">
                                        <input type="submit" class="btn btn-primary" value="Simpan">
                                    </div>
                                    <div class="col-12 mt-4">
                                        {{-- <form action="{{ route('ujian-soal', $id) }}" method="get">
                                            <input type="hidden" name="jadwal_id" value="{{ $jadwal_id }}">
                                            @csrf
                                            <input type="submit" class="btn btn-danger" value="Reset soal">
                                        </form> --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        var createClickHandler = function(arg) {
            return function() {
                alert(arg);
            };
        }

        for (var a = 0; a < 10; a++) {
            var b = document.createElement('b')
            b.onclick = createClickHandler(a);
            b.innerHTML = a
            document.body.appendChild(b)
        }
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

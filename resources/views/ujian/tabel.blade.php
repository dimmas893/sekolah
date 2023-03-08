@extends('layouts.template.template')
@section('content')
    <form method="get" id="pilihtingkatanujian_id" action="{{ route('pilihtingkatanujian') }}" style="display:none;">
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

    <div class="main-content">
        <div class="modal fade" id="add_TU_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    </div>
                    <form action="{{ route('ujian-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mata_pelajaran_id" value="{{ $mata_pelajaran }}">
                        <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang_pendidikan_id }}">
                        <input type="hidden" name="tingkatan" value="{{ $tingkatan_id }}">
                        <div class="modal-body">
                            <div class="my-2">
                                <label>Jenis Ujian</label>
                                <select name="jenis_ujian" class="form-control">
                                    <option value="" disabled selected>---Pilih Ujian---</option>
                                    <option value="uas">UAS</option>
                                </select>
                            </div>
                            <div class="my-2">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" placeholder="Masukan tanggal ujian"
                                    class="form-control">
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
                <h1>Tabel Ujian</h1>
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
                    <div class="breadcrumb-item">Ujian</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">

                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Ujian</h3>
                                <button class="btn btn-light" data-toggle="modal" data-target="#add_TU_modal"><i
                                        class="bi-plus-circle me-2"></i>Tambah Ujian</button>
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
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/page/components-table.js') }}"></script>
    <script>
        $(function() {

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
                            url: '{{ route('ujian-delete') }}',
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
                    url: '/ujian/all/{{ $mata_pelajaran }}/{{ $tingkatan_id }}/{{ $jenjang_pendidikan_id }}',
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

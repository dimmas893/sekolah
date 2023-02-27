@extends('layouts.template.template')
@section('content')
    <div class="main-content">


        <div class="modal fade" id="editTUModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    </div>
                    <form action="#" method="POST" id="edit_TU_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                        <div class="modal-body">
                            <div class="my-2">
                                <label>Jenis Ujian</label>
                                <select name="jenis_ujian" id="jenis_ujian" class="form-control">
                                    <option value="" disabled selected>---Pilih Ujian---</option>
                                    <option value="uas">UAS</option>
                                </select>
                            </div>
                            <div class="my-2">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" placeholder="Masukan tanggal ujian"
                                    class="form-control">
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
        <div id="tabs">
            <section class="section">
                <div class="section-header">
                    <h1>{{ $jadwal->kelasget->kelas->name }} / {{ $jadwal->ruangan->name }} /
                        {{ $jadwal->mata_pelajaran->name }} /
                        {{ $jadwal->jam_masuk }} - {{ $jadwal->jam_keluar }} / Total ({{ $count }}) Siswa</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                        <div class="breadcrumb-item active"><a href="{{ route('jadwal_buat_guru') }}">Jadwal</a>
                        </div>
                        <div class="breadcrumb-item">Kelas</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-10 col-12">
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" style="list-style: none;"
                                                aria-labelledby="dropdownMenuButton">
                                                <ul style="list-style:none;">
                                                    <li><a class="dropdown-item" href="#tabs-1">Lihat Siswa</a></li>
                                                    @if ($cekabsen === 0)
                                                        <li><a class="dropdown-item" href="#tabs-2">Absen Massal</a></li>
                                                    @else
                                                        <li><a class="dropdown-item" href="#tabs-5">Lihat Status Absen</a>
                                                        </li>
                                                    @endif
                                                    <li><a class="dropdown-item" href="#tabs-3">Absen Mandiri</a></li>
                                                    <li><a class="dropdown-item" href="#tabs-4">Tugas</a></li>

                                                    <form action="{{ route('tabelujian', $jadwal->id) }}" method="get">
                                                        @csrf
                                                        <input type="submit" class="btn btn-success" value="Ujian">
                                                    </form>
                                                    <hr>
                                                    <form action="{{ route('penilaian') }}" method="get">
                                                        @csrf
                                                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                                                        <input type="submit" class="btn btn-warning" value="Penilaian">
                                                    </form>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tabs-1">
                    <div class="card">
                        <div class="row mt-3 ml-3 mr-3">
                            @foreach ($rincian_siswa as $item)
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <div class="">
                                                <i class="ion-android-person h3"></i>
                                                {{ $item->nama_siswa }}
                                            </div>
                                            <div class="text-right">{{ $item->jenis_kelamin }}</div>
                                        </div>
                                        <div class="card-body">
                                            <p>{{ $item->email }}</p>
                                            <p>{{ $item->alamat }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mb-3 ml-3 mr-3">
                            <div class="col-md-2 col-12">
                                {{-- <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#siswa"
                                    aria-expanded="false" aria-controls="siswa">
                                    Tutup
                                </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabs-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Absen Mandiri</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('absen_satuan') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="semester" value="{{ $setting->semester }}">
                                        <input type="hidden" name="tahun_ajaran"
                                            value="{{ $setting->id_tahun_ajaran }}">
                                        <input type="hidden" name="dibuat_oleh" value="{{ $jadwal->guru_id }}">
                                        <input type="hidden" name="kelas_id" value="{{ $jadwal->kelas_id }}">
                                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label for="">Nama Siswa</label>
                                                <select name="siswa_id" class="form-control">
                                                    <option value="">---Pilih Siswa---</option>
                                                    @foreach ($rincian_siswa as $p => $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nama_siswa }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label for="">Status Kehadiran</label>
                                                <select name="tipe_kehadiran" class="form-control">
                                                    <option value="">---Pilih Status Kehadiran---</option>
                                                    <option value="0">Hadir</option>
                                                    <option value="1">Sakit</option>
                                                    <option value="2">Izin</option>
                                                    <option value="3">Alpha</option>
                                                    <option value="4">Terlambat</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="my-2 mt-4">
                                            {{-- <button class="btn btn-info" type="button" data-toggle="collapse"
                                                data-target="#absenmandiri" aria-expanded="false"
                                                aria-controls="absenmandiri">
                                                Tutup
                                            </button> --}}
                                            <input type="submit" value="Absen" class="btn btn-primary">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabs-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Buat Tugas</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('tugas-store-biasa') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label for="">Tanggal Tugas</label>
                                                <input type="date" name="tanggal_tugas" class="form-control"
                                                    placeholder="Masukan Tanggal Tugas" required>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label for="">Tanggal Pengumpulan</label>
                                                <input type="date" name="tanggal_pengumpulan" class="form-control"
                                                    placeholder="Masukan Tanggal Pengumpulan" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label for="">Tanggal Evaluasi</label>
                                                <input type="date" name="tanggal_evaluasi" class="form-control"
                                                    placeholder="Masukan Tanggal Evaluasi" required>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label for="">File Tugas</label>
                                                <input type="file" name="file_tugas" class="form-control"
                                                    placeholder="Masukan File Tugas" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-12 col-12">
                                                <label for="">Judul Tugas</label>
                                                <input type="text" name="nama" class="form-control"
                                                    placeholder="Masukan Judul Tugas" required>
                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label for="">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" placeholder="Masukan Deskripsi" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <input type="submit" class="btn btn-primary" value="Buat">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($cekabsen === 0)
                    <div id="tabs-2">
                        <form name="form1" action="{{ route('absen-masal') }}" method="post">
                            @csrf
                            <input type="hidden" name="semester" value="{{ $setting->semester }}">
                            <input type="hidden" name="tahun_ajaran" value="{{ $setting->id_tahun_ajaran }}">
                            <input type="hidden" name="dibuat_oleh" value="{{ $jadwal->guru_id }}">
                            <input type="hidden" name="kelas_id" value="{{ $jadwal->kelas_id }}">
                            <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                            <div class="card">
                                <div class="row mt-3 ml-3 mr-3">
                                    @foreach ($rincian_siswa as $p => $item)
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="card">
                                                <div
                                                    class="card-header bg-light d-flex justify-content-between align-items-center">
                                                    <div class="">
                                                        <i class="ion-android-person h3"></i>
                                                        {{ $item->nama_siswa }}
                                                    </div>
                                                    <div class="text-right">{{ $item->jenis_kelamin }}</div>
                                                </div>
                                                <div class="card-body">
                                                    <input type="hidden" name="siswa_id[]{{ $p }}"
                                                        value="{{ $item->id }}">
                                                    <input type="radio" name="group[]{{ $p }}"
                                                        value="0" checked="checked">Hadir<br />
                                                    <input type="radio" name="group[]{{ $p }}"
                                                        value="1">Sakit<br />
                                                    <input type="radio" name="group[]{{ $p }}"
                                                        value="2">Izin<br />
                                                    <input type="radio" name="group[]{{ $p }}"
                                                        value="3">Alpha<br />
                                                    <input type="radio" name="group[]{{ $p }}"
                                                        value="4">Terlambat<br />
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row mb-3 ml-3 mr-3">
                                    <div class="col-2">
                                        {{-- <input type="radio" name="group4" value="0"
                                        onclick="selectAll(form1)">Hadir<br /> --}}

                                        <div class="my-2">
                                            <input type="submit" class="btn btn-primary" value="Absen">
                                            {{-- <button class="btn btn-info" type="button" data-toggle="collapse"
                                            data-target="#absenmasal" aria-expanded="false" aria-controls="absenmasal">
                                            Tutup
                                        </button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <div id="tabs-5">
                        <div class="card">
                            <div class="row mt-3 ml-3 mr-3">
                                @foreach ($laporan as $item)
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div
                                                class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <div class="">
                                                    <i class="ion-android-person h3"></i>
                                                    {{ $item['siswa'] }}
                                                </div>
                                                {{-- <div class="text-right">{{ $item->jadwal->id }}</div> --}}
                                            </div>
                                            <div class="card-body">
                                                <div class="">
                                                    <label for="">Total Pertemuan:
                                                        {{ $item['pertemuan'] }}</label>
                                                </div>
                                                <div class="">
                                                    <label for="">Hadir : {{ $item['hadir'] }}</label>
                                                </div>
                                                <div class="">
                                                    <label for="">Sakit : {{ $item['sakit'] }}</label>
                                                </div>
                                                <div class="">
                                                    <label for="">Izin : {{ $item['izin'] }}</label>
                                                </div>
                                                <div class="">
                                                    <label for="">Alpha : {{ $item['alpha'] }}</label>
                                                </div>
                                                <div class="">
                                                    <label for="">Terlambat : {{ $item['terlambat'] }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

            </section>
        </div>

    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/page/components-table.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $("#tabs").tabs();
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
                    url: '{{ route('ujian-store') }}',
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
                    url: '{{ route('ujian-edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#jenis_ujian").val(response.jenis_ujian);
                        $("#tanggal").val(response.tanggal);
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
                    url: '{{ route('ujian-update') }}',
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
            // fetch all employees ajax request
            TU_all();

            function TU_all() {
                $.ajax({
                    url: '{{ route('ujian-all', $jadwal->id) }}',
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

@extends('layouts.template.template')
@section('content')
    <div class="main-content">

        {{-- <div class="modal fade" id="add_TU_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kategori Tagihan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="#" method="POST" id="add_TU_form" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 my-2">
                            <label for="">Tagihan</label>
                            <select name="id_kategori_tagihan" id="tagihan_id" class="form-control js-example-basic-single">
                                <option value="">--Pilih Kategori--</option>
                                @foreach ($Kategori_tagihan as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 my-2">
                            <label for="">Nominal</label>
                            <input type="number" name="nominal" v-model="infotagihan.nominal" class="form-control" />
                        </div>
                        <div class="col-12 my-2">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" v-model="infotagihan.deskripsi" class="form-control"></textarea>
                        </div>
                        <div class="col-12 my-2">
                            <input type="submit" class="btn btn-primary" value="kirim" />
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        {{-- add new employee modal end --}}

        {{-- edit employee modal start --}}
        <div class="modal fade" id="editTUModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Tagihan Siswa</h5>
                        {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <form action="#" method="POST" id="edit_TU_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="id_kategori_tagihan">Nama Kategori Tagihan</label>
                                <input type="text" disabled id="id_kategori_tagihan" name="id_kategori_tagihan"
                                    class="form-control" placeholder="Masukan Nomor Induk Pegawai" required>
                            </div>
                            <div class="my-2">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi" class="form-control" placeholder="Masukan Nomor Induk Pegawai" required></textarea>
                            </div>

                            <div class="my-2">
                                <label for="">Tanggal</label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control">
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
                <h1>Data Kelas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('infosiswa') }}">Informasi siswa</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('viewTagihanmenu') }}">Tagihan</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('viewTagihansiswa') }}">Tagihan siswa</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('siswa_tagihan_pilih_jenjang') }}">Pilih
                            jenjang</a></div>
                    <div class="breadcrumb-item">Kelas jenjang
                        {{ \App\Models\JenjangPendidikan::where('id', $jenjang)->first()->nama }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                        Semua Kelas Jenjang {{ \App\Models\JenjangPendidikan::where('id', $jenjang)->first()->nama }}
                        <form action="{{ route('siswa_tagihan_create') }}" method="get">
                            @csrf
                            <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang }}">
                            <input type="submit" class="btn btn-primary" value="Masuk">
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($kelas as $item)
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            {{ $item->kelas->name }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
@endsection

@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Penerimaan Siswa Baru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('tbl_pendaftaran') }}">Kembali</a></div>
                    <div class="breadcrumb-item">Penerimaan Siswa Baru Detail</div>
                </div>
            </div>
            <form action="{{ route('siswa_lulus') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $pendaftaran->jenjang }}" name="jenjang" />
                <div class="section-body">
                    <div class="row mt-sm-4">
                        <div class="col-12 col-md-12 col-lg-7">
                            <div class="card">
                                <form method="post" class="needs-validation" novalidate="">
                                    <div class="card-header">
                                        <h4>Konfirmasi Pendaftaran</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-12 col-12">
                                                <label>Nama</label>
                                                <input type="text" name="name" value="{{ $pendaftaran->nama_siswa }}"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4 col-12">
                                                <label>Email</label>
                                                <input type="email" name="email" placeholder="Masukan Email"
                                                    value="{{ $pendaftaran->email }}" class="form-control" />
                                            </div>
                                            <div class="form-group col-md-4 col-12">
                                                <label>Telepon Bapak</label>
                                                <input type="text" name="no_telp_bapak" placeholder="Masukan No Telepon"
                                                    value="{{ $pendaftaran->no_telp_bapak }}" class="form-control" />
                                            </div>
                                            <div class="form-group col-md-4 col-12">
                                                <label>Telepon Ibu</label>
                                                <input type="text" name="no_telp_ibu" placeholder="Masukan No Telepon"
                                                    value="{{ $pendaftaran->no_telp_ibu }}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>Jenis Kelamin</label>
                                                <input type="text" name="jenis_kelamin"
                                                    value="{{ $pendaftaran->jenis_kelamin ?: '' }}"
                                                    placeholder="Masukan Jenis Kelamin" class="form-control" />
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir"
                                                    value="{{ $pendaftaran->tempat_lahir }}"
                                                    placeholder="Masukan Tempat Lahir" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>Tanggal Lahir</label>
                                                <input type="date" name="tgl_lahir" placeholder="Masukan Tgl Lahir"
                                                    value="{{ $pendaftaran->tgl_lahir }}" class="form-control" />
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Asal Sekolah</label>
                                                <input type="asal_sekolah" name="asal_sekolah"
                                                    value="{{ $pendaftaran->asal_sekolah }}"
                                                    placeholder="Masukan Asal Sekolah" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label>Alamat</label>
                                                <textarea type="text" name="alamat" placeholder="Masukan Alamat" value="{{ $pendaftaran->alamat ?: '' }}"
                                                    class="form-control">{{ $pendaftaran->alamat ?: 'dsds' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $pendaftaran->id }}">

                                        <div class="mb-2">
                                            <select name="cekstatus" class="form-control">
                                                <option value="LULUS">LULUS</option>
                                                <option value="tidaklulus">Tidak Lulus</option>
                                            </select>
                                        </div>
                                        <input type="submit" value="submit" class="btn btn-primary">
                                        {{-- <button class="btn btn-primary">Save Changes</button> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection

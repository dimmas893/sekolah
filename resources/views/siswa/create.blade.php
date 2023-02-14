@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Siswa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('siswa') }}">Tabel Siswa</a></div>
                    <div class="breadcrumb-item">Tambah Siswa</div>
                </div>
            </div>
            <form action="{{ route('siswa-store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="section-body">
                    <div class="row mt-sm-4">

                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Biodata Siswa</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4 col-12">
                                            <label>Nis</label>
                                            <input type="number" name="nomor_induk_siswa" placeholder="Masukan Nisn"
                                                class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4 col-12">
                                            <label>Nisn</label>
                                            <input type="number" name="nisn" placeholder="Masukan Nisn"
                                                class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4 col-12">
                                            <label>Image</label>
                                            <input type="file" name="avatar" placeholder="Upload Image"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nama Siswa</label>
                                            <input type="text" name="nama_siswa" placeholder="Masukan Nama"
                                                class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" placeholder="Masukan Tempat Lahir"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" placeholder="Masukan Tanggal Lahir"
                                                class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control">
                                                <option value="">---Pilih Jenis Kelamin---</option>
                                                <option value="L">Laki - Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Agama</label>
                                            <select name="agama" class="form-control">
                                                <option value="">---Pilih Agama---</option>
                                                <option value="islam">Islam</option>
                                                <option value="kristen">kristen</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>email</label>
                                            <input type="email" name="email" placeholder="Masukan email"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>No Telepon</label>
                                            <input type="number" name="no_telp" placeholder="Masukan No Telepon"
                                                class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Asal Sekoah</label>
                                            <input type="text" name="asal_sekolah" placeholder="Masukan Asal Sekolah"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="form-group col-md-6 col-12">
                                            <label>Alamat</label>
                                            <textarea name="alamat" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h4>Biodata Orang Tua</h4>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nama Bapak</label>
                                            <input type="text" name="nama_bapak" placeholder="Masukan Nama"
                                                class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Pekerjaan Bapak</label>
                                            <input type="text" name="pekerjaan_bapak" placeholder="Masukan Pekerjaan"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Penghasilan Bapak /bulan</label>
                                            <input type="number" name="penghasilan_bapak"
                                                placeholder="Masukan Penghasilan" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Agama</label>
                                            <select name="agama_bapak" class="form-control">
                                                <option value="">---Pilih Agama---</option>
                                                <option value="islam">Islam</option>
                                                <option value="kristen">kristen</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>No Telepon</label>
                                            <input type="number" name="no_telp_bapak" placeholder="Masukan Penghasilan"
                                                class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Email</label>
                                            <input type="email" name="email_bapak" placeholder="Masukan email"
                                                class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nama Ibu</label>
                                            <input type="text" name="nama_ibu" placeholder="Masukan Nama"
                                                class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Pekerjaan Ibu</label>
                                            <input type="text" name="pekerjaan_ibu" placeholder="Masukan Pekerjaan"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Penghasilan Ibu /bulan</label>
                                            <input type="number" name="penghasilan_ibu"
                                                placeholder="Masukan Penghasilan" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Agama</label>
                                            <select name="agama_ibu" class="form-control">
                                                <option value="">---Pilih Agama---</option>
                                                <option value="islam">Islam</option>
                                                <option value="kristen">kristen</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>No Telepon</label>
                                            <input type="number" name="no_telp_ibu" placeholder="Masukan Penghasilan"
                                                class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>email</label>
                                            <input type="email" name="email_ibu" placeholder="Masukan email"
                                                class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection

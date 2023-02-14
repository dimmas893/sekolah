@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Edit siswa</h1>
                <div class="section-header-breadcrumb">
                    @if ($siswa->id_user == Auth::user()->id)
                        <div class="breadcrumb-item active"><a href="{{ route('profil') }}">Profil</a></div>
                        <div class="breadcrumb-item">Edit Profil Siswa</div>
                    @else
                        <div class="breadcrumb-item active"><a href="{{ route('siswa') }}">Tabel Siswa</a></div>
                        <div class="breadcrumb-item">Edit siswa</div>
                    @endif
                </div>
            </div>
            <form action="{{ route('siswa-update-page', $siswa->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="section-body">
                    <div class="row mt-sm-4">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                {{-- <div class="card-header"> --}}
                                {{-- <h4>Biodata Siswa</h4> --}}
                                {{-- </div> --}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4"></div>
                                        <div class="col-xs-12 col-md-4 col-lg-4">
                                            <div class="d-flex justify-content-center">
                                                <div class="card profile-widget">
                                                    <div class="">
                                                        @if ($siswa->avatar)
                                                            <img alt="image"
                                                                src="{{ asset('avatar/' . $siswa->avatar) }}" heigt="auto"
                                                                width="100%" class="profile-widget-picture mb-3">
                                                        @else
                                                            <img alt="image" src="{{ asset('/defaut3.jpg') }}"
                                                                heigt="auto" width="100%"
                                                                class="profile-widget-picture mb-3">
                                                        @endif
                                                        {{-- <div class="profile-widget-items">
                                                            <div class="profile-widget-item">
                                                                <div class="profile-widget-item-label">Posts</div>
                                                                <div class="profile-widget-item-value">187</div>
                                                            </div>
                                                            <div class="profile-widget-item">
                                                                <div class="profile-widget-item-label">Followers</div>
                                                                <div class="profile-widget-item-value">6,8K</div>
                                                            </div>
                                                            <div class="profile-widget-item">
                                                                <div class="profile-widget-item-label">Following</div>
                                                                <div class="profile-widget-item-value">2,1K</div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="my-2 ml-2 mr-2">
                                                            {{-- <label class="">Ganti Foto</label> --}}
                                                            <input type="file" name="avatar" value="{{ $siswa->image }}"
                                                                class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4"></div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nis</label>
                                            <input type="number" value="{{ $siswa->nomor_induk_siswa }}"
                                                name="nomor_induk_siswa" placeholder="Masukan Nisn" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nisn</label>
                                            <input type="number" name="nisn" value="{{ $siswa->nisn }}"
                                                placeholder="Masukan Nisn" class="form-control" />
                                        </div>
                                        {{-- <div class="form-group col-md-4 col-12">
                                            <label>Image</label>
                                            <img src="{{ asset('avatar/' . $siswa->avatar) }}" alt="" width="100"
                                                class="img-thumbnail">
                                            <input type="file" name="avatar" placeholder="Upload Image"
                                                class="form-control" />
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nama Siswa</label>
                                            <input type="text" name="nama_siswa" value="{{ $siswa->nama_siswa }}"
                                                placeholder="Masukan Nama" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" value="{{ $siswa->tempat_lahir }}"
                                                placeholder="Masukan Tempat Lahir" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" value="{{ $siswa->tgl_lahir }}"
                                                placeholder="Masukan Tanggal Lahir" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control">
                                                {{-- <option value="">---Pilih Jenis Kelamin---</option> --}}
                                                @if ($siswa->jenis_kelamin == 'L')
                                                    <option value="L" selected>Laki - Laki</option>
                                                    <option value="P">Perempuan</option>
                                                @else
                                                    <option value="L">Laki - Laki</option>
                                                    <option value="P" selected>Perempuan</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Agama</label>
                                            <select name="agama" class="form-control">
                                                <option value="">---Pilih Agama---</option>
                                                @if ($siswa->agama == 'Islam')
                                                    <option value="Islam" selected>Islam</option>
                                                    <option value="Kristen">Kristen</option>
                                                @else
                                                    <option value="Islam">Islam</option>
                                                    <option value="Kristen" selected>Kristen</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>email</label>
                                            <input type="email" value="{{ $siswa->email }}" name="email"
                                                placeholder="Masukan email" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>No Telepon</label>
                                            <input type="number" value="{{ $siswa->telp }}" name="no_telp"
                                                placeholder="Masukan No Telepon" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Asal Sekolah</label>
                                            <input type="text" value="{{ $siswa->asal_sekolah }}" name="asal_sekolah"
                                                placeholder="Masukan Asal Sekolah" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="form-group col-md-6 col-12">
                                            <label>Alamat</label>
                                            <textarea name="alamat" class="form-control">{{ $siswa->alamat }}</textarea>
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label>Password</label>
                                            <input type="password" name="password_siswa" class="form-control"
                                                placeholder="Kosongkan Jika Tidak Ingin Mengganti">
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h4>Biodata Orang Tua</h4>
                                    </div>
                                    @if ($siswa->id_orang_tua)
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>Nama Bapak</label>
                                                <input type="text" value="{{ $wali->nama_bapak }}" name="nama_bapak"
                                                    placeholder="Masukan Nama" class="form-control" />
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Pekerjaan Bapak</label>
                                                <input type="text" value="{{ $wali->pekerjaan_bapak }}"
                                                    name="pekerjaan_bapak" placeholder="Masukan Pekerjaan"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>Penghasilan Bapak /bulan</label>
                                                <input type="number" value="{{ $wali->penghasilan_bapak }}"
                                                    name="penghasilan_bapak" placeholder="Masukan Penghasilan"
                                                    class="form-control" />
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Agama</label>
                                                <select name="agama_bapak" class="form-control">
                                                    <option value="">---Pilih Agama---</option>
                                                    @if ($wali->agama_bapak == 'Islam')
                                                        <option value="Islam" selected>Islam</option>
                                                        <option value="Kristen">Kristen</option>
                                                    @else
                                                        <option value="Islam">Islam</option>
                                                        <option value="Kristen" selected>Kristen</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>No Telepon</label>
                                                <input type="number" value="{{ $wali->no_telp_bapak }}"
                                                    name="no_telp_bapak" placeholder="Masukan Penghasilan"
                                                    class="form-control" />
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Email</label>
                                                <input type="email" value="{{ $wali->email_bapak }}"
                                                    name="email_bapak" placeholder="Masukan email"
                                                    class="form-control" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>Nama Ibu</label>
                                                <input type="text" value="{{ $wali->nama_ibu }}" name="nama_ibu"
                                                    placeholder="Masukan Nama" class="form-control" />
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Pekerjaan Ibu</label>
                                                <input type="text" value="{{ $wali->pekerjaan_ibu }}"
                                                    name="pekerjaan_ibu" placeholder="Masukan Pekerjaan"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>Penghasilan Ibu /bulan</label>
                                                <input type="number" value="{{ $wali->penghasilan_ibu }}"
                                                    name="penghasilan_ibu" placeholder="Masukan Penghasilan"
                                                    class="form-control" />
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Agama</label>
                                                <select name="agama_ibu" class="form-control">
                                                    <option value="">---Pilih Agama---</option>
                                                    @if ($wali->agama_ibu == 'Islam')
                                                        <option value="Islam" selected>Islam</option>
                                                        <option value="Kristen">Kristen</option>
                                                    @else
                                                        <option value="Islam">Islam</option>
                                                        <option value="Kristen" selected>Kristen</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>No Telepon</label>
                                                <input type="number" value="{{ $wali->no_telp_ibu }}"
                                                    name="no_telp_ibu" placeholder="Masukan Penghasilan"
                                                    class="form-control" />
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>email</label>
                                                <input type="email" value="{{ $wali->email_ibu }}" name="email_ibu"
                                                    placeholder="Masukan email" class="form-control" />
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>Nama Bapak</label>
                                                <input type="text" name="nama_bapak" placeholder="Masukan Nama"
                                                    class="form-control" />
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Pekerjaan Bapak</label>
                                                <input type="text" name="pekerjaan_bapak"
                                                    placeholder="Masukan Pekerjaan" class="form-control" />
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
                                                    <option value="Islam">Islam</option>
                                                    <option value="Kristen">Kristen</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>No Telepon</label>
                                                <input type="number" name="no_telp_bapak"
                                                    placeholder="Masukan Penghasilan" class="form-control" />
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
                                                <input type="text" name="pekerjaan_ibu"
                                                    placeholder="Masukan Pekerjaan" class="form-control" />
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
                                                    <option value="Islam">Islam</option>
                                                    <option value="Kristen">Kristen</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>No Telepon</label>
                                                <input type="number" name="no_telp_ibu"
                                                    placeholder="Masukan Penghasilan" class="form-control" />
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>email</label>
                                                <input type="email"name="email_ibu" placeholder="Masukan email"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection

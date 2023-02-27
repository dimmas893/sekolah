@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item">Profil</div>
                </div>
            </div>
            <form action="{{ route('guru-update-profile', $pendaftaran->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-5">
                            <div class="card profile-widget">
                                <div class="profile-widget-header">
                                    @if ($pendaftaran->avatar)
                                        <img alt="image" src="{{ asset('guru/' . $pendaftaran->avatar) }}"
                                            class="rounded-circle profile-widget-picture">
                                    @else
                                        <img alt="image" src="{{ asset('defaut2.png') }}"
                                            class="rounded-circle profile-widget-picture">
                                    @endif
                                    <div class="my-2 ml-2 mr-2">
                                        <input type="file" name="avatar" value="{{ $pendaftaran->image }}"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-7">
                            <div class="card">
                                <form method="post" class="needs-validation" novalidate="">
                                    <div class="card-header">
                                        <h4>Edit Profile</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-12 col-12">
                                                <label>Nama</label>
                                                <input type="text" name="name" value="{{ $pendaftaran->name }}"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-7 col-12">
                                                <label>Email</label>
                                                <input type="email" name="email" placeholder="Masukan Email"
                                                    value="{{ $pendaftaran->email }}" class="form-control" />
                                            </div>
                                            <div class="form-group col-md-5 col-12">
                                                <label>Phone</label>
                                                <input type="text" name="telp" placeholder="Masukan No Telepon"
                                                    value="{{ $pendaftaran->telp }}" class="form-control" />
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
                                                <label>Password</label>
                                                <input type="password" name="password"
                                                    placeholder="Kosongkan jika tidak ingin mengganti"
                                                    class="form-control" />
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
                                        <button class="btn btn-primary">Save Changes</button>
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

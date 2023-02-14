@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Profile Admin</h1>
            </div>
            <form action="{{ route('admin-update-profile', $pendaftaran->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="card ml-2">
                                <div class="card-header bg-light mb-2">
                                    <b>
                                        <h5>Data Admin</h5>
                                    </b>
                                </div>
                                <div class="card-body">
                                    <div class="ml-2 mb-2">
                                    </div>
                                    <div class="row ml-2 mt-">
                                        <div class="col-3">Nomor Induk Admin
                                        </div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">
                                            <input type="text" name="nomor_induk_pegawai"
                                                value="{{ $pendaftaran->nomor_induk_pegawai }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row ml-2 mt-3">
                                        <div class="col-3">Nama Admin
                                        </div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">
                                            <input type="text" name="name" value="{{ $pendaftaran->nama_admin }}"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row ml-2 mt-3">
                                        <div class="col-3">Email
                                        </div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">
                                            <input type="email" name="email" placeholder="Masukan Email"
                                                value="{{ Auth::user()->email }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row ml-2 mt-3">
                                        <div class="col-3">Ganti Password
                                        </div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">
                                            <input type="password" name="password" placeholder="Masukan Password"
                                                class="form-control" />
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <a href="{{ route('dashboard') }}" class="btn btn-info">Kembali</a>
                                        <input type="submit" class="btn btn-primary" value="Simpan">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </section>
    </div>
@endsection

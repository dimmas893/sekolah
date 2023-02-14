@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Detail Data Pendaftaran Siswa {{ $pendaftaran->tingkat }}</h1>
            </div>
            <form action="{{ route('pendaftaran-update', $pendaftaran->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <b>
                            <h5>Data Calon Siswa Jenjang {{ $pendaftaran->tingkat }}</h5>
                        </b>
                        <a href="{{ route('tbl_pendaftaran') }}" class="btn btn-primary">Kembali</a>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="card ml-2">
                                    <div class="card-header bg-light mb-2">
                                        <h5>Biodata Siswa</h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="ml-2 mb-2">
                                            {{-- <label for="">Prestasi 1</label> --}}
                                            <div class="">

                                                <div class="row">
                                                    <div class="col-3">
                                                        <img src="{{ asset('foto/' . $pendaftaran->foto) }}" width="100"
                                                            class="img-thumbnail">
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mt-2">
                                                            <label class="mt-2">Ganti Foto</label>
                                                            <input type="file" name="foto"
                                                                value="{{ $pendaftaran->foto ?: '' }}"
                                                                class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ml-2 mt-">
                                            <div class="col-3">Nama Siswa
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="nama_siswa"
                                                    value="{{ $pendaftaran->nama_siswa }}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Nis
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="nis" value="{{ $pendaftaran->nis }}"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Nisn
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="nisn" value="{{ $pendaftaran->nisn }}"
                                                    class="form-control" />
                                            </div>
                                        </div>

                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Tempat Lahir
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="tempat_lahir"
                                                    value="{{ $pendaftaran->tempat_lahir }}" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Tanggal Lahir
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="date" name="tgl_lahir"
                                                    value="{{ $pendaftaran->tgl_lahir }}" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Jenis Kelamin
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="jenis_kelamin"
                                                    value="{{ $pendaftaran->jenis_kelamin ?: '' }}" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Agama
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="agama" value="{{ $pendaftaran->agama }}"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Email
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="email" name="email" value="{{ $pendaftaran->email }}"
                                                    class="form-control" />
                                            </div>
                                        </div>

                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Asal Sekolah
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="asal_sekolah"
                                                    value="{{ $pendaftaran->asal_sekolah ?: '' }}"
                                                    class="form-control" />
                                            </div>
                                        </div>

                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Alamat
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <textarea type="text" name="alamat" value="{{ $pendaftaran->alamat ?: '' }}" class="form-control">{{ $pendaftaran->alamat ?: 'dsds' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">No Telepon
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="no_telp" value="{{ $pendaftaran->no_telp }}"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="ml-2 card">
                                    <div class="card-header bg-light">
                                        <h5>Biodata Bapak</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row ml-2 mt-2">
                                            <div class="col-3">Nama Bapak
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="nama_bapak"
                                                    value="{{ $pendaftaran->nama_bapak }}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Pekerjaan Bapak
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="pekerjaan_bapak"
                                                    value="{{ $pendaftaran->pekerjaan_bapak }}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Penghasilan Bapak /bulan
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="penghasilan_bapak"
                                                    value="{{ $pendaftaran->penghasilan_bapak }}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Agama
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="agama_bapak"
                                                    value="{{ $pendaftaran->agama_bapak }}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row ml-2 mt-3 mb-5">
                                            <div class="col-3">No Telepon
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="no_telp_bapak"
                                                    value="{{ $pendaftaran->no_telp_bapak }}" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-2 card">
                                    <div class="card-header bg-light">
                                        <h5>Biodata Ibu</h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="row ml-2 mt-2">
                                            <div class="col-3">Nama Ibu
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="nama_ibu"
                                                    value="{{ $pendaftaran->nama_ibu }}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Pekerjaan Ibu
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="pekerjaan_ibu"
                                                    value="{{ $pendaftaran->pekerjaan_ibu }}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Penghailan Ibu /bulan
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="penghasilan_ibu"
                                                    value="{{ $pendaftaran->penghasilan_ibu }}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row ml-2 mt-3">
                                            <div class="col-3">Agama
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="agama_ibu"
                                                    value="{{ $pendaftaran->agama_ibu }}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row ml-2 mt-3 mb-5">
                                            <div class="col-3">No Telepon
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" name="no_telp_ibu"
                                                    value="{{ $pendaftaran->no_telp_ibu }}" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>

                <div class="card">
                    <div class="card-header bg-light">
                        <h5>Data Lainnya</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="ml-2">
                                    <h5>Prestasi 1</h5>
                                </div>
                                <div class="ml-1">
                                    <div class="">
                                        <img src="{{ asset('prestasi_1/' . $pendaftaran->prestasi_1) }}" width="200"
                                            class="img-thumbnail">
                                        <input type="file" name="prestasi_1" value="{{ $pendaftaran->prestasi_1 }}"
                                            class="form_control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="ml-2">
                                    <h5>Prestasi 2</h5>
                                </div>
                                <div class="ml-1">
                                    <div class="">
                                        <img src="{{ asset('prestasi_2/' . $pendaftaran->prestasi_2) }}" width="200"
                                            class="img-thumbnail">

                                    </div>
                                    <div class="">
                                        {{-- <label for="">Ganti Foto</label> --}}
                                        <input type="file" name="prestasi_2" value="{{ $pendaftaran->prestasi_2 }}"
                                            class="form_control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="ml-2">
                                    <h5>Ijasah</h5>
                                </div>
                                <div class="ml-1">
                                    <div class="">
                                        <img src="{{ asset('ijasah/' . $pendaftaran->ijasah) }}" width="200"
                                            class="img-thumbnail">
                                        <input type="file" name="ijasah" value="{{ $pendaftaran->ijasah }}"
                                            class="form_control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <input type="submit" class="btn btn-primary" value="Simpan">

            </form>
        </section>
    </div>
@endsection

@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Detail Data Pendaftaran Siswa</h1>
            </div>

            <div class="card">
                <div class="card-header bg-light">
                    <b>
                        <h3>Status Pendaftaran</h3>
                    </b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <h5>
                                @if ($pendaftaran->status == 2)
                                    <p style="color: rgb(62, 255, 75)">
                                        Lulus
                                    </p>
                                @endif
                                @if ($pendaftaran->status == 1)
                                    <p style="color: red">
                                        Tidak Lulus
                                    </p>
                                @endif
                                @if ($pendaftaran->status == 0)
                                    <p style="color: red">
                                        Belum Ditinjau
                                    </p>
                                @endif
                            </h5>
                        </div>
                        <div class="col-1">
                            |
                        </div>

                        @if ($pendaftaran->status != 1 || $pendaftaran->status != 1)
                            <div class="col-6">
                                <form action="{{ route('siswa_lulus') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="nomor_induk_siswa" value="{{ $pendaftaran->nis }}">
                                    <input type="hidden" name="nisn" value="{{ $pendaftaran->nisn }}">
                                    <input type="hidden" name="nama_siswa" value="{{ $pendaftaran->nama_siswa }}">
                                    <input type="hidden" name="jenis_kelamin" value="{{ $pendaftaran->jenis_kelamin }}">
                                    <input type="hidden" name="email" value="{{ $pendaftaran->email }}">
                                    <input type="hidden" name="telp" value="{{ $pendaftaran->no_telp }}">
                                    <input type="hidden" name="alamat" value="{{ $pendaftaran->alamat }}">


                                    <input type="hidden" name="nama_wali" value="{{ $pendaftaran->nama_bapak }}">
                                    <input type="hidden" name="alamat_wali" value="{{ $pendaftaran->alamat }}">
                                    <input type="hidden" name="email_wali" value="{{ $pendaftaran->email_bapak }}">


                                    <input type="hidden" name="id_pendaftaran" value="{{ $pendaftaran->id }}">

                                    <div class="mb-2">
                                        <select name="cekstatus" class="form-control">
                                            <option value="LULUS">LULUS</option>
                                            <option value="tidaklulus">Tidak Lulus</option>
                                        </select>
                                    </div>
                                    <input type="submit" value="submit" class="btn btn-primary">
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

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
                            <div class="ml-2">
                                <h5>Biodata Siswas</h5>
                            </div>
                            <div class="card">
                                <div class="ml-2 mb-2">
                                    {{-- <label for="">Prestasi 1</label> --}}
                                    <div class="">
                                        <img src="/storage/foto/{{ $pendaftaran->foto }}" width="100"
                                            class="img-thumbnail">
                                    </div>
                                </div>
                                <div class="row ml-2 mb-5">
                                    <div class="col-6">Nama Siswa</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->nama_siswa }}</div>

                                    <div class="col-6">Nis</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->nis }}</div>

                                    <div class="col-6">Nisn</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->nisn }}</div>

                                    <div class="col-6">Tempat, Tanggal Lahir</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->tempat_lahir }},
                                        {{ $pendaftaran->tgl_lahir }}
                                    </div>

                                    <div class="col-6">Jenis Kelamin</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->jenis_kelamin }}</div>

                                    <div class="col-6">Agama</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->agama }}</div>

                                    <div class="col-6">Email</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->email }}</div>

                                    <div class="col-6">Asal Sekolah</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->asal_sekolah }}</div>

                                    <div class="col-6">Alamat</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->alamat }}</div>

                                    <div class="col-6">No Telp</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->no_telp }}</div>
                                </div>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="ml-2">
                                <h5>Biodata Bapak</h5>
                            </div>
                            <div class="card">
                                <div class="row ml-2 mb-5">
                                    <div class="col-6">Nama Bapak</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->nama_bapak }}</div>

                                    <div class="col-6">Pekerjaan Bapak</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->pekerjaan_bapak }}</div>

                                    <div class="col-6">Penghasilan Bapak</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->penghasilan_bapak }}</div>

                                    <div class="col-6">Agama Bapak</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->agama_bapak }}
                                    </div>

                                    <div class="col-6">No Telepon Bapak</div>
                                    <div class="col-6"> : &nbsp; {{ $pendaftaran->no_telp_bapak }}</div>
                                </div>
                                <hr>
                                <div class="ml-2">
                                    <h5>Biodata Ibu</h5>
                                </div>
                                <div class="card">
                                    <div class="row ml-2 mb-5">
                                        <div class="col-6">Nama Ibu</div>
                                        <div class="col-6"> : &nbsp; {{ $pendaftaran->nama_ibu }}</div>

                                        <div class="col-6">Pekerjaan Ibu</div>
                                        <div class="col-6"> : &nbsp; {{ $pendaftaran->pekerjaan_ibu }}</div>

                                        <div class="col-6">Penghasilan Ibu</div>
                                        <div class="col-6"> : &nbsp; {{ $pendaftaran->penghasilan_ibu }}</div>

                                        <div class="col-6">Agama Ibu</div>
                                        <div class="col-6"> : &nbsp; {{ $pendaftaran->agama_ibu }}</div>

                                        <div class="col-6">No Telepon Ibu</div>
                                        <div class="col-6"> : &nbsp; {{ $pendaftaran->no_telp_ibu }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                </div>

            </div>

            <div class="card">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <b>
                        <h5>Data Lainnya</h5>
                    </b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="ml-2">
                                <h5>Prestasi 1</h5>
                            </div>
                            <div class="ml-1">
                                <div class="">
                                    <img src="/storage/prestasi_1/{{ $pendaftaran->prestasi_1 }}" width="200"
                                        class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <hr>


                        <div class="col-4">
                            <div class="ml-1">
                                <h5>Prestasi 2</h5>
                            </div>
                            <div class="">
                                <div class="">
                                    <img src="/storage/prestasi_2/{{ $pendaftaran->prestasi_2 }}" width="200"
                                        class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="ml-1">
                                <h5>Ijasah</h5>
                            </div>
                            <div class="">
                                <div class="">
                                    <img src="/storage/ijasah/{{ $pendaftaran->ijasah }}" width="200"
                                        class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                </div>

            </div>
            {{--
            <div class="row">
                <div class="mt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                Data Lainnya
                            </div>
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-header">
                                        Prestasi
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="">
                                                    <label for="">Prestasi 1</label>
                                                    <div class="">
                                                        <img src="/storage/prestasi_1/{{ $pendaftaran->prestasi_1 }}"
                                                            width="50" class="img-thumbnail">
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <label for="">Prestasi 2</label>
                                                    <div class="">
                                                        <img src="/storage/prestasi_2/{{ $pendaftaran->prestasi_2 }}"
                                                            width="50" class="img-thumbnail">
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <label for="">Ijasah</label>
                                                    <div class="">
                                                        <img src="/storage/ijasah/{{ $pendaftaran->ijasah }}"
                                                            width="50" class="img-thumbnail">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

    </div>
    </section>
    </div>
@endsection

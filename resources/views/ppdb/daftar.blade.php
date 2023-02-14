@extends('layouts.portal.template_2')
{{-- @extends('layouts.dashboard.template') --}}
@section('content')
    <style>
        .tampil {
            display: none;
        }

        .hehe {
            display: none;
        }
		        .haha {
            display: none;
        }
    </style>


    <div id="contact" class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <form id="contact" action="{{ route('pendaftaran-store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                <div class="section-heading">
                                    <h6>Form Pendaftaran</h6>
                                    <h2>Harap isi data dengan benar</h2>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Pilih Jenjang</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">
                                                <fieldset>
                                                    <select name="ceksekolah" id="isMember" class="form-control">
                                                        <option selected disabled>---Pilih Jenjang Pendidikan---</option>
                                                        @foreach ($jenjang as $item)
                                                            <option value="{{ $item->id }}"> {{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                        {{-- <option value="SMA">SMP</option> --}}
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 tampil mt-3" id="1">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Asal Sekolah</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">
                                                <fieldset>
                                                    <select class="form-control" id="sekolahasal">
                                                        <option value="" selected disabled>---Pilih Sekolah Asal---
                                                        </option>
                                                        <option value="tkislamalazharbsd">TK Islam AL-Azhar BSD</option>
                                                        <option value="non">Non AL-Azhar BSD</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 tampil mt-3" id="3">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Asal Sekolah</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">
                                                <fieldset>
                                                    <select class="form-control" id="smaya">
                                                        <option value="" selected disabled>---Pilih Sekolah Asal---
                                                        </option>
                                                        <option value="sma">SMP Islam AL-Azhar BSD</option>
                                                        <option value="non">Non AL-Azhar BSD</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 tampil mt-3" id="2">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Asal Sekolah</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">
                                                <fieldset>
                                                    <select class="form-control" id="smpya">
                                                        <option value="" selected disabled>---Pilih Sekolah Asal---
                                                        </option>
                                                        <option value="yaha">SD Islam AL-Azhar BSD</option>
                                                        <option value="non">Non AL-Azhar BSD</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-lg-12 hehe mt-3" id="sma">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Nama Sekolah</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">
                                                <fieldset>
                                                    <input type="text" class="form-control" name="asal_sekolah"
                                                        value="SMP Islam AL-Azhar BSD">
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-lg-12 hehe mt-3" id="yaha">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Nama Sekolah</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">
                                                <fieldset>
                                                    <input type="text" class="form-control" name="asal_sekolah"
                                                        value="SD Islam AL-Azhar BSD">
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 hehe mt-3" id="tkislamalazharbsd">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Nama Sekolah</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">
                                                <fieldset>
                                                    <input type="text" class="form-control" name="asal_sekolah"
                                                        value="TK Islam AL-Azhar BSD">
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 hehe mt-3" id="non">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Nama Sekolah</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">

                                                <fieldset>
                                                    <input type="text" class="form-control" name="asal_sekolah"
                                                        placeholder="Masukan Asal Sekolah">
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Nama Peserta</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">
                                                <fieldset>
                                                    <input type="text" class="form-control" name="nama_siswa"
                                                        placeholder="Nama Peserta Didik">
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Jenis Kelamin</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">
                                                <fieldset>
                                                    <select class="form-control" name="jenis_kelamin">
                                                        <option value="" selected disabled>---Pilih Jenis Kelamin---
                                                        </option>
                                                        <option value="L">Laki - Laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Tempat Lahir</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">
                                                <fieldset>
                                                    <input type="text" class="form-control" name="tempat_lahir"
                                                        placeholder="Tempat Lahir Siswa">
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Tanggal Lahir</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">
                                                <fieldset>
                                                    <input type="date" class="form-control" name="tgl_lahir"
                                                        placeholder="Tanggal Lahir Siswa">
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Nomor Telepon Bapak</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">
                                                <fieldset>
                                                    <input type="number" class="form-control" name="no_telp_bapak"
                                                        placeholder="Nomor Telepon Bapak (wajib)">
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Nomor Telepon Ibu</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">
                                                <fieldset>
                                                    <input type="number" class="form-control" name="no_telp_ibu"
                                                        placeholder="Nomor Telepon Ibu (optional)">
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Email Peserta</label>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-7">
                                                <fieldset>
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="Email Siswa">
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="main-button ">Daftar</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script>
    $(function() {
        $('#isMember').change(function() {
            $('.tampil').hide();
            $('#' + $(this).val()).show();
        });
    });

    $(function() {
        $('#sekolahasal').change(function() {
            $('.hehe').hide();
            $('#' + $(this).val()).show();
        });
    });

    $(function() {
        $('#smpya').change(function() {
            $('.hehe').hide();
            $('#' + $(this).val()).show();
        });
    });

    $(function() {
        $('#smaya').change(function() {
            $('.hehe').hide();
            $('#' + $(this).val()).show();
        });
    });
</script>

@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Pendaftaran Siswa Jenjang SMP</h1>
            </div>

            <div class="card">
                <div class="card-header bg-light">
                    <b>
                        <h3>Isi Form Dengan Benar</h3>
                    </b>
                </div>
                <div class="card-body">
                    <form action="{{ route('pendaftaran-store_smp') }}" method="post" enctype="multipart/form-data">
                        <div class="fom fom-steps">
                            <ul class="nav nav-tabs" style="display:none;">
                                <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                                <li><a href="#step1" data-toggle="tab">step1</a></li>
                                <li><a href="#step2" data-toggle="tab">step2</a></li>
                                <li><a href="#step3" data-toggle="tab">step3</a></li>
                            </ul>
                            @csrf
                            {{-- <input type="hidden" name="tingkat" value="sma"> --}}
                            <div class="tab-content">
                                <div class="tab-pane active" id="home">
                                    <div class="row">
                                        <div class="col-6 my-2">
                                            <label for="">Nama Siswa</label>
                                            <input type="text" name="nama_siswa" placeholder="Masukan Nama"
                                                class="form-control" />
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" placeholder="Masukan Tempat Lahir"
                                                class="form-control" />
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" class="form-control" />
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control">
                                                <option value="">---Pilih Jenis Kelamin---</option>
                                                <option value="L">Laki - Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">Agama</label>
                                            <select name="agama" class="form-control">
                                                <option value="">---Pilih Agama---</option>
                                                <option value="islam">Islam</option>
                                                <option value="kristen">Kristen</option>
                                            </select>
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">Alamat</label>
                                            <textarea type="text" name="alamat" placeholder="Masukan Alamat" class="form-control"></textarea>
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">Email</label>
                                            <input type="email" name="email" placeholder="Masukan email"
                                                class="form-control" />
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">Nomor Telepon</label>
                                            <input type="number" name="no_telp" placeholder="Masukan Nomor Telepon"
                                                class="form-control" />
                                        </div>

                                        <div class="col-6 my-2">
                                            <label for="">NIS</label>
                                            <input type="number" name="nis" placeholder="Masukan Nis"
                                                class="form-control" />
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">NISN</label>
                                            <input type="number" name="nisn" placeholder="Masukan Nisn"
                                                class="form-control" />
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">Asal Sekolah</label>
                                            <input type="text" name="asal_sekolah" placeholder="Masukan Asal Sekolah"
                                                class="form-control" />
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">Foto</label>
                                            <input type="file" name="foto" class="form-control" />
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-step mt-4" href="#step1" data-toggle="tab">
                                        Selanjutnya
                                    </button>
                                </div>
                                <div class="tab-pane" id="step1">
                                    <div class="row">
                                        <div class="col-6 my-2">
                                            <label for="">Nama Bapak</label>
                                            <input type="text" name="nama_bapak" placeholder="Masukan Nama Bapak"
                                                class="form-control" />
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">Pekerjaan Bapak</label>
                                            <input type="text" name="pekerjaan_bapak"
                                                placeholder="Masukan Pekerjaan_bapak" class="form-control" />
                                        </div>

                                        <div class="col-6 my-2">
                                            <label for="">Penghasilan Bapak</label>
                                            <input type="text" name="penghasilan_bapak"
                                                placeholder="Masukan Penghasilan Bapak" class="form-control" />
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">Agama Bapak</label>
                                            <input type="text" name="agama_bapak" placeholder="Masukan Agama Bapak"
                                                class="form-control" />
                                        </div>

                                        <div class="col-6 my-2">
                                            <label for="">Nomor Telepon Bapak</label>
                                            <input type="number" name="no_telp_bapak" placeholder="Masukan Nomor"
                                                class="form-control" />
                                        </div>

                                        <div class="col-6 my-2">
                                            <label for="">Email</label>
                                            <input type="email" name="email_bapak" placeholder="Masukan email"
                                                class="form-control" />
                                        </div>

                                        <div class="col-6 my-2">
                                            <label for="">Nama Ibu</label>
                                            <input type="text" name="nama_ibu" placeholder="Masukan Nama ibu"
                                                class="form-control" />
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">Pekerjaan Ibu</label>
                                            <input type="text" name="pekerjaan_ibu"
                                                placeholder="Masukan Pekerjaan_ibu" class="form-control" />
                                        </div>

                                        <div class="col-6 my-2">
                                            <label for="">Penghasilan Ibu</label>
                                            <input type="text" name="penghasilan_ibu"
                                                placeholder="Masukan Penghasilan Ibu" class="form-control" />
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">Agama Ibu</label>
                                            <input type="text" name="agama_ibu" placeholder="Masukan Agama Ibu"
                                                class="form-control" />
                                        </div>

                                        <div class="col-6 my-2">
                                            <label for="">Nomor Telepon Ibu</label>
                                            <input type="number" name="no_telp_ibu" placeholder="Masukan Nomor"
                                                class="form-control" />
                                        </div>

                                        <div class="col-6 my-2">
                                            <label for="">Email</label>
                                            <input type="email" name="email_ibu" placeholder="Masukan email"
                                                class="form-control" />
                                        </div>

                                        <button class="btn btn-info btn-step ml-3 mt-3" href="#home" data-toggle="tab">
                                            Kembali
                                        </button>
                                        <button class="btn btn-primary btn-step ml-3 mt-3" href="#step2"
                                            data-toggle="tab">
                                            Selanjutnya
                                        </button>
                                    </div>
                                </div>
                                <div class="tab-pane" id="step2">
                                    <div class="row">
                                        {{-- <div class="col-6 my-2">
                                    <label for="">Jurusan Utama</label>
                                    <input type="text" name="jurusan_1" placeholder="Masukan Jurusan Pertama"
                                        class="form-control" />
                                </div>
                                <div class="col-6 my-2">
                                    <label for="">Jurusan Cabang</label>
                                    <input type="text" name="jurusan_2" placeholder="Masukan Jurusan Pertama"
                                        class="form-control" />
                                </div> --}}
                                        <div class="col-6 my-2">
                                            <label for="">prestasi 1</label>
                                            <input type="file" name="prestasi_1" class="form-control" />
                                        </div>
                                        <div class="col-6 my-2">
                                            <label for="">prestasi 2</label>
                                            <input type="file" name="prestasi_2" class="form-control" />
                                        </div>

                                        <div class="col-6 my-2">
                                            <label for="">ijasah</label>
                                            <input type="file" name="ijasah" class="form-control" />
                                        </div>
                                    </div>
                                    <button class="btn btn-info btn-step mt-3" href="#step1" data-toggle="tab">
                                        Kembali
                                    </button>

                                    <input type="submit" class="btn btn-primary mt-3" value="Daftar">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </section>
    </div>
@endsection

@section('js')
    <script>
        /**Conditional**/
        jQuery(".fom-steps .btn-step").click(function(e) {
            e.preventDefault();
            var targetTab = jQuery(this).attr("href");
            jQuery('.fom-steps a[href="' + targetTab + '"]').tab("show");
        });




        /**Unconditional**/
        $('.fom-steps .btn-next').click(function() {
            $('.fom-steps .nav-tabs > .active').next('li').find('a').trigger('click');
        });

        $('.fom-steps .btn-prev').click(function() {
            $('.fom-steps .nav-tabs > .active').prev('li').find('a').trigger('click');
        });
    </script>
@endsection

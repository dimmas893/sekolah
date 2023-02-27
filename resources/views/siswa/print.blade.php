@extends('layouts.portal.template_2')
@section('content')
    <div id="contact" class="our-services section">
        <div class="container">
            <div class="main-content">
                <section class="section">
                    <div class="text-center wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">

                        @if ($sudah === 'sudah')
                            <h1><b>{{ $pendaftaran->nama_siswa }}</b> Anda Sudah Mendaftar </h1>
                        @else
                            <h1>Calon Peserta Didik dengan nama <b>{{ $pendaftaran->nama_siswa }}</b> telah teregistrasi di
                                Sekolah
                                Al-Azhar
                                BSD</h1>
                        @endif
                    </div>

                    <div class="mt-2 wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-4 text-right">
                                        <label for="">Virtual Account</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" value="8000102324010216" disabled>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4 text-right">
                                        <label for="">Uang Pendaftaran PPDB</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" value="Rp. 300.000" disabled>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <!--<form action="{{ route('print_view', $pendaftaran->id) }}" method="get">-->
                                    <!--    @csrf-->
                                    <!--    <input type="submit" class="btn btn-primary" value="Print" />-->
                                    <!--</form>-->
                                    <a href="{{ route('welcome') }}" class="btn btn-primary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
                        <div class="card">
                            <div class="card-body">
                                <label>Lakukan Pembayaran untuk uang pendaftaran (PPDB) di teller atau di ATM Bank Muamalat
                                    atau
                                    transfer melalui ATM Bersama atau Prima dengan tujuan bank-nya adalah Bank Muamalat
                                    (kode:147)
                                    diikuti dengan nomor Virtual Account Anda
                                </label>
                                <br>
                                <label>
                                    untuk pengisian formulir lebih lanjut Pastikan anda telah membayar uang pendaftaran
                                    (PPDB)
                                    agar
                                    dapat login ke halaman user di
                                    <p style="color: red">http://ppdb.alazhar-bsd.sch.id/ppdb/login</p>
                                </label>
                                <br>
                                <label for="">
                                    *Notifikasi ini dikirimkan juga melalui:
                                </label>
                                <label for="">
                                    - SMS Gateway Al-Azhar BSD dengan nomor: 081311646660, (Hati-hati penipuan yang
                                    mengatasnamakan
                                    Al-Azhar BSD, pastikan anda menerima SMS dari nomor tersebut)
                                </label>
                                <label for="">
                                    - Email Panitia PPDB Al-Azhar : ppdb.alazhar.bsd@gmail.com, jika email tidak ada pada
                                    inbox,
                                    silahkan cek di folder junk email anda.
                                </label>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
@endsection

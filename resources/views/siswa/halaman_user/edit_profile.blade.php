@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Profile siswa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('siswa') }}">Tabel Siswa</a></div>
                    <div class="breadcrumb-item">Halaman Profile siswa</div>
                </div>
            </div>
            {{-- <form action="{{ route('siswa-update-page', $siswa->id) }}" method="post" enctype="multipart/form-data"> --}}
            @csrf
            <div class="">
                <div class="card">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="profile-widget">
                                <div class="profile-widget-header">
                                    <img alt="image" src="{{ asset('avatar/' . $siswa->avatar) }}" class="img-fluid">
                                    {{-- <input type="file" name="avatar" value="{{ $siswa->image }}" class="form-control" /> --}}
                                    <div class="profile-widget-items">
                                        <div class="profile-widget-item">
                                            <div class="profile-widget-item-label">kelas</div>
                                            <div class="profile-widget-item-value">
                                                @if ($siswa->kelas !== null)
                                                    {{ $siswa->kelas_siswa->kelas->name }}
                                                @else
                                                    Belum Dapat Kelas
                                                @endif
                                            </div>
                                        </div>
                                        <div class="profile-widget-item">
                                            <div class="profile-widget-item-label">Nama</div>
                                            <div class="profile-widget-item-value">{{ $siswa->nama_siswa }}</div>
                                        </div>
                                        {{-- <div class="profile-widget-item">
                                                <div class="profile-widget-item-label">Following</div>
                                                <div class="profile-widget-item-value">2,1K</div>
                                            </div> --}}
                                    </div>
                                </div>
                                {{-- <div class="profile-widget-description">
                                    <div class="profile-widget-name">{{ $siswa->nama_siswa }} <div
                                            class="text-muted d-inline font-weight-normal">/
                                            {{ $siswa->kelas_siswa->kelas->name }}
                                        </div>
                                    </div>
                                </div> --}}
                            </div>

                        </div>
                        <div class="col-12 col-md-12 col-lg-8">
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2"
                                                role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2"
                                                role="tab" aria-controls="profile" aria-selected="false">Orang
                                                Tua</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#contact2"
                                                role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                                        </li> --}}
                                    </ul>
                                    <div class="tab-content tab-bordered" id="myTab3Content">
                                        <div class="tab-pane fade show active" id="home2" role="tabpanel"
                                            aria-labelledby="home-tab2">

                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p class="profile-widget-item-value">Nis :
                                                        <b>{{ $siswa->nomor_induk_siswa }}</b>
                                                    </p>
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Nisn : <b>{{ $siswa->nisn }}</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Nama Siswa : <b>{{ $siswa->nama_siswa }}</b></p>
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Tempat Lahir : <b>{{ $siswa->tempat_lahir }}</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Tanggal Lahir : <b>{{ $siswa->tgl_lahir }}</b></p>
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Jenis Kelamin : <b>{{ $siswa->jenis_kelamin }}</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Agama : <b>{{ $siswa->agama }}</b></p>
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Email : <b>{{ $siswa->email }}</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p>No Telepon : <b>{{ $siswa->telp }}</b></p>
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Asal Sekolah : <b>{{ $siswa->asal_sekolah }}</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12 col-12">
                                                    <p>Alamat : <b>{{ $siswa->alamat }}</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile2" role="tabpanel"
                                            aria-labelledby="profile-tab2">
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    @if ($wali->nama_bapak == null)
                                                        <p>Nama Bapak : <b>{{ $wali->nama_bapak }}</b></p>
                                                    @else
                                                        <p>Nama Bapak : </p>
                                                    @endif
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Pekerjaan Bapak : <b>{{ $wali->pekerjaan_bapak }}</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Penghasilan Bapak /bulan :
                                                        <b>{{ $wali->penghasilan_bapak }}</b>
                                                        <hr>
                                                    </p>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Agama : <b>{{ $wali->agama_bapak }}</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p>No Telepon : <b>{{ $wali->no_telp_bapak }}</b></p>
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Email : <b>{{ $wali->email_bapak }}</b></p>
                                                    <hr>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Nama Ibu : <b>{{ $wali->nama_ibu }}</b></p>
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Pekerjaan Ibu : <b>{{ $wali->pekerjaan_ibu }}</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Penghasilan Ibu /bulan :
                                                        <b>{{ $wali->penghasilan_ibu }}</b>
                                                    </p>
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Agama : <b>{{ $wali->agama_ibu }}</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p>No Telepon : <b>{{ $wali->no_telp_ibu }}</b></p>
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>email : <b>{{ $wali->email_ibu }}</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="tab-pane fade" id="contact2" role="tabpanel"
                                            aria-labelledby="contact-tab2">
                                            Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi
                                            maximus. Proin ligula massa, gravida in lacinia efficitur,
                                            hendrerit eget mauris. Pellentesque fermentum, sem interdum
                                            molestie finibus, nulla diam varius leo, nec varius lectus
                                            elit id dolor. Nam malesuada orci non ornare vulputate. Ut
                                            ut sollicitudin magna. Vestibulum eget ligula ut ipsum
                                            venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <a href="{{ route('siswa-edit-page', $siswa->id) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
            {{-- </form> --}}
        </section>
    </div>
@endsection

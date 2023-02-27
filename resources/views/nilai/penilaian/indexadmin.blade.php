 @extends('layouts.template.template')
 @section('content')
     <div class="main-content">
         <section class="section">
             <div class="section-header">
                 <h1></h1>
                 <div class="section-header-breadcrumb">
                     <div class="breadcrumb-item active"><a href="{{ route('jadwal_buat_guru') }}">Daftar
                             Jadwal</a></div>
                     <div class="breadcrumb-item active"><a href="">Jadwal</a>
                     </div>
                     <div class="breadcrumb-item">Halaman Penilaian</div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <h4>Tabel Penilaian</h4>
                             {{-- <div class="card-header-form">
                                    <form>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div> --}}
                         </div>
                         <div class="card-body p-0">
                             <div class="table-responsive">
                                 <form action="{{ route('SimpanNilai') }}" method="post">
                                     @csrf
                                     <input type="hidden" name="tahun_ajaran" value="{{ $setting->id_tahun_ajaran }}">
                                     {{-- <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}"> --}}
                                     <input type="hidden" name="mata_pelajaran_id" value="{{ $mata_pelajaran_id }}">
                                     {{-- <input type="hidden" name="guru_id" value="{{ $jadwal->guru_id }}"> --}}
                                     <table class="table-striped table">
                                         <thead>
                                             <tr>
                                                 <th>Foto Siswa</th>
                                                 <th>Nama Peserta</th>
                                                 <th>Nilai Kehadiran</th>
                                                 <th>Nilai Sikap</th>
                                                 <th>Nilai Tugas</th>
                                                 <th>Nilai UTS</th>
                                                 <th>Nilai UAS</th>
                                                 <th>Nilai Akhir</th>
                                                 <th>Predikat</th>
                                                 <th>Status</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             @foreach ($arrayNilaiSiswa as $item)
                                                 <input type="hidden" name="siswa_id[]" value="{{ $item['siswa_id'] }}">
                                                 <tr>
                                                     <td>
                                                         @if ($item['avatar'] != null)
                                                             <img alt="image" src="{{ $item['avatar'] }}"
                                                                 class="rounded-circle" width="35" data-toggle="tooltip"
                                                                 title="Foto Siswa">
                                                         @else
                                                             <img alt="image" src="/assets/img/avatar/avatar-5.png"
                                                                 class="rounded-circle" width="35" data-toggle="tooltip"
                                                                 title="Foto Siswa">
                                                         @endif
                                                     </td>
                                                     <td>{{ $item['nama_siswa'] }}</td>
                                                     <td class="p-0 text-center">
                                                         <input type="text" name="nilai_kehadiran[]" class="form-control"
                                                             value="{{ $item['nilai_kehadiran'] }}">
                                                     </td>
                                                     <td>
                                                         <input type="text" name="nilai_sikap[]" class="form-control"
                                                             value="{{ $item['nilai_sikap'] }}">
                                                     </td>
                                                     <td>
                                                         <input type="text" name="nilai_tugas[]" class="form-control"
                                                             value="{{ $item['nilai_tugas'] }}">
                                                     </td>
                                                     <td>
                                                         <input type="text" name="nilai_uts[]" class="form-control"
                                                             value="{{ $item['nilai_uts'] }}">
                                                     </td>
                                                     <td>
                                                         <input type="text" name="nilai_uas[]" class="form-control"
                                                             value="{{ $item['nilai_uas'] }}">
                                                     </td>
                                                     <td>
                                                         @if ($item['nilai_akhir'] != null)
                                                             <div class="badge badge-success">{{ $item['nilai_akhir'] }}
                                                             </div>
                                                         @else
                                                             -
                                                         @endif
                                                     </td>
                                                     <td>
                                                         @if ($item['predikat'] != null)
                                                             <div class="badge badge-success">{{ $item['predikat'] }}</div>
                                                         @else
                                                             -
                                                         @endif
                                                     </td>
                                                     <td>
                                                         @if ($item['status'] != null)
                                                             <div class="badge badge-success">{{ $item['status'] }}</div>
                                                         @else
                                                             -
                                                         @endif
                                                     </td>
                                                 </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                     <div class="row mb-3 ml-3 mr-3">
                                         <div class="col-2">
                                             <div class="my-2">
                                                 <input type="submit" class="btn btn-primary" value="Simpan ">
                                             </div>
                                         </div>
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </section>
     </div>
 @endsection
 @section('js')
     {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> --}}
     {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
     <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
     <script src="{{ asset('assets/js/page/components-table.js') }}"></script>
 @endsection

 @extends('layouts.template.template')
 @section('content')
     <div class="main-content">
         <section class="section">
             <div class="section-header">
                 <h1>Edit nilai kelas {{ \App\Models\Kelas::with('kelas')->where('id', $kelas_id)->first()->kelas->name }}
                 </h1>
                 <div class="section-header-breadcrumb">
                     <div class="breadcrumb-item active"><a href="{{ route('semuakelas') }}">Semua kelas</a></div>
                     <div class="breadcrumb-item active"><a href="{{ route('nilaitk') }}">Nilai semua jenjang tk</a>
                     </div>
                     <div class="breadcrumb-item"><a href="/lihatnilai/{{ $mata_pelajaran_id }}/{{ $kelas_id }}"> Nilai
                             kelas
                             {{ \App\Models\Kelas::with('kelas')->where('id', $kelas_id)->first()->kelas->name }}</a>

                     </div>
                     <div class="breadcrumb-item">Daftar jadwal kelas
                         {{ \App\Models\Kelas::with('kelas')->where('id', $kelas_id)->first()->kelas->name }}
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <h4>Tabel Penilaian</h4>
                         </div>
                         <div class="card-body">
                             <div class="row">
                                 @foreach ($jadwal as $item)
                                     <div class="col-lg-12 col-xl-3 col-xxl-12 col-sm-12 col-md-12">
                                         <div class="card">
                                             <div class="card-header d-flex justify-content-between align-items-center">
                                                 <h4> {{ $item->guru->name }}</h4>
                                                 <form action="{{ route('penilaian') }}" method="get">
                                                     @csrf
                                                     <input type="hidden" name="cek" value="1">
                                                     <input type="hidden" name="jadwal_id" value="{{ $item->id }}">
                                                     <input type="submit" class="btn btn-success" value="edit">
                                                 </form>
                                             </div>
                                             <div class="card-body">
                                                 <div>{{ $item->mata_pelajaran->name }}</div>
                                                 <div>{{ $item->hari->name }}</div>
                                                 <div>{{ $item->jam_masuk }} - {{ $item->jam_keluar }}</div>
                                             </div>
                                         </div>
                                     </div>
                                 @endforeach
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

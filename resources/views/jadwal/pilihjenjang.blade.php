@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Tambah Jadwal Siswa Pilih Kelas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('jadwal') }}">Table Jadwal</a></div>
                    <div class="breadcrumb-item">Pilih Jenjang</div>
                </div>
            </div>
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('pilihkelas') }}" method="get">
                            @csrf
                            <div class="isMember my-2">
                                <label for="name">Jenjang</label>
                                <select name="kelas_id" id="package" class="form-control">
                                    <option value="null">--- Pilih Jenjang ---</option>
                                    @foreach ($jenjangpenddian as $item => $value)
                                        <option value="{{ $value->id }}">{{ $value->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-2 mt-3">
                                <label for="name">Kelas</label>
                                <div id="sma">
                                    <select class="form-control">
                                        <option disabled selected>Mohon Untuk Memilih Jenjang Pendidikan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2 text-center">
                                <input type="submit" class="btn btn-primary" value="cari">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@section('js')
    <script>
        $('.isMember').on('change', function(e) {
            const selectedPackage = $('#package').val();
            e.preventDefault();
            $.ajax({
                url: '{{ route('jadwal-kelas') }}',
                method: 'get',
                data: {
                    id: selectedPackage
                },
                success: function(response) {
                    console.log(response)
                    $("#sma").html(response);
                }
            });
        });
    </script>
@endsection

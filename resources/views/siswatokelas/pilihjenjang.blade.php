@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Pembagian Kelas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item">Pilih Jenjang</div>
                </div>
            </div>

            <div class="">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('siswatokelas_get') }}" method="get">
                            @csrf
                            <div class="">
                                <select name="tingkatan_id" class="form-control">
                                    <option value="">---Pilih Jenjang---</option>
                                    @foreach ($tingkatan as $item)
                                        @if ($item->tingkat === '1')
                                            <option value="{{ $item->id }}">SD
                                            @elseif ($item->tingkat === '7')
                                            <option value="{{ $item->id }}">SMP
                                            @elseif ($item->tingkat === '10')
                                            <option value="{{ $item->id }}">SMA
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-2 text-center">
                                <input type="submit" class="btn btn-primary" value="Masuk">
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
                url: '{{ route('ajaxkelas') }}',
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

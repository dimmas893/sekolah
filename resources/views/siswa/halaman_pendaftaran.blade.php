@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Pendaftaran Siswa</h1>
            </div>

            <form action="{{ route('step_1') }}" method="get">
                @csrf
                <select name="tingkat" class="form-control">
                    <option value="">---Silahkan Pilih Jenjang---</option>
                    <option value="sd">SD</option>
                    <option value="smp">SMP</option>
                    <option value="sma">SMA</option>
                </select>
                <div class="text-center mt-2">
                    <input type="submit" class="btn btn-primary" value="Pilih">
                </div>
            </form>
        </section>
    </div>
@endsection

@extends('layouts.template.template')
@section('content')
    <form method="get" id="siswa_tagihan_id" action="{{ route('siswa_tagihan') }}" style="display:none;">
        @csrf
        <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang }}">
    </form>
    <div class="main-content" id="app">
        <section class="section">
            <div class="section-header">
                <h1>Tagihan Siswa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('infosiswa') }}">Informasi siswa</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('viewTagihanmenu') }}">Tagihan</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('viewTagihansiswa') }}">Tagihan siswa</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('siswa_tagihan_pilih_jenjang') }}">Pilih
                            jenjang</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('siswa_tagihan') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('siswa_tagihan_id').submit();">
                            Kelas jenjang
                            {{ \App\Models\JenjangPendidikan::where('id', $jenjang)->first()->nama }}
                        </a></div>

                    <div class="breadcrumb-item">Buat tagihan</div>
                </div>
            </div>

            <form action="{{ route('siswa_tagihan-store') }}" method="post">
                <input type="hidden" name="jenjang_pendidikan_id" value="{{ $jenjang }}">
                <div class="card">
                    <div class="card-header bg-secondary">Form Tagihan Siswa</div>
                    <div class="card-body">
                        <div class="row">
                            @csrf
                            <div class="col-12 my-2">
                                <label for="">Tagihan</label>
                                <select name="id_kategori_tagihan" id="tagihan_id"
                                    class="form-control js-example-basic-single">
                                    <option value="">--Pilih Kategori--</option>
                                    @foreach ($Kategori_tagihan as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="" v-model="infotagihan.id">
                            <div class="col-12 my-2">
                                <label for="">Nominal</label>
                                <input type="number" name="nominal" v-model="infotagihan.nominal" class="form-control" />
                            </div>
                            <div class="col-12 form-group my-2">
                                <label for="">Deskripsi</label>
                                <textarea name="deskripsi" v-model="infotagihan.deskripsi" id="exampleFormControlTextarea1" class="form-control"></textarea>
                            </div>

                            <div class="col-12 form-group my-2">
                                <label for="">Tanggal di bagikan</label>
                                <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="form-control">
                            </div>
                            <div class="col-12 my-2">
                                <label for="">Batas Bayar</label>
                                <input type="date" name="batas_bayar" v-model="infotagihan.batas_bayar"
                                    class="form-control" />
                            </div>
                            <div class="col-12 my-2">
                                <label for="">Kategori Cicilan</label>
                                <input type="number" name="kategori_cicilan" v-model="infotagihan.kategori_cicilan"
                                    class="form-control" />
                                <p style="color:red">* 1 = bisa dicicil / 0 = bayar lunas</p>
                            </div>
                            <div class="col-12 my-2">
                                <label for="">Minimum Bayar</label>
                                <input type="number" name="minimum_bayar" v-model="infotagihan.minimum_bayar"
                                    class="form-control" />
                            </div>
                            <div class="col-12 my-2">
                                <input type="submit" class="btn btn-primary" value="kirim" />
                                <a href="{{ route('siswa_tagihan') }}" class="btn btn-info">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </section>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
    <script>
        // $(document).ready(function() {
        //     $('.js-example-basic-multiple').select2();
        // });

        // $(document).ready(function() {
        //     $('.js-example-basic-single').select2({
        //         width: '100%'
        //     });
        // });

        (function($) {
            var _token = '<?php echo csrf_token(); ?>';
            $(document).ready(function() {
                var app = new Vue({
                    el: '#app',
                    data: {
                        isinik: '',
                        infotagihan: {
                            id: '',
                            nominal: '',
                            deskripsi: '',
                            kategori_cicilan: '',
                            batas_bayar: '',
                            minimum_bayar: '',
                        }
                    },
                    watch: {
                        'infotagihan.id': function() {
                            if (this.infotagihan) {
                                this.getinfotagihan()
                            }
                        },

                    },


                    // awal mounted
                    mounted: function() {
                        $('#tagihan_id').select({
                            witdh: '100%'
                        }).on('change', () => {
                            this.infotagihan.id = $('#tagihan_id').val();
                        });
                    },
                    // akhir mounted

                    //awal method
                    methods: {
                        getinfotagihan() {
                            this.$http.get(`/infotagihan/${this.infotagihan.id}`)
                                .then((response) => {
                                    this.infotagihan = response.data
                                })
                        },
                    },
                    //akhir method

                });
            });
        })(jQuery);
    </script>
@endsection

@extends('layouts.template.template')
@section('content')
    <div id="app">
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Halaman Tagihan Siswa</h1>
                    {{-- <form action="{{ route('') }}" method="post">
                    @csrf
                    <input type="submit" class="btn btn-info" value="tes">
                </form> --}}
                </div>

                <form action="{{ route('siswa_tagihan-store') }}" method="post">
                    <div class="card">
                        <div class="card-header">Form Tagihan Siswa</div>
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
                                <input type="hidden" name="id_tagihan" v-model="infotagihan.id">
                                <div class="col-12 my-2">
                                    <label for="">Nominal</label>
                                    <input type="number" name="nominal" v-model="infotagihan.nominal"
                                        class="form-control" />
                                </div>
                                <div class="col-12 my-2">
                                    <label for="">Deskripsi</label>
                                    <textarea name="deskripsi" v-model="infotagihan.deskripsi" class="form-control"></textarea>
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
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>

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
                            status: '',
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

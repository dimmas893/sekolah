<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Ujian Online</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css'>
<link href="{{ asset('lembar_soal/style.css')}}" rel="stylesheet">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
	<div class="col-sm-12">
		<hr>
		<h3 class="title">Ujian </h3>
		{{-- <h2 class="title">Ujian </h2> --}}
		<hr>
          @if (Session::has('success'))
               <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
               </div>
               <div class="result alert alert-info">{{ Session::get('success') }}</div>
          @else
               <div>
                    {{$dataPeraturan->peraturan_ujian}} <div id='timer'></div>
               </div>
               <form method="POST" action="/simpan-jawaban" id ="myquiz">
                    @csrf

                    @foreach ($soal as $item)
                         <input type="hidden" name="id[]" value="{{$item->id}}">
                         <input type="hidden" name="jumlah" value="{{$item->count()}}">
                         <div class="form-group">
                              <h4>{{$item->soal}}</h4>
                              <hr>
                              <div class="form-radio">
                                   <input type="radio" class="form-radio-input " id="n1" name="pilihan[{{$item->id}}]" value="a">
                                   <label class="form-radio-label" for="n1">{{$item->jawaban_a}}</label>
                              </div>
                              <div class="form-radio">
                                   <input type="radio" class="form-radio-input" id="n2" name="pilihan[{{$item->id}}]" value="b">
                                   <label class="form-radio-label" for="n2">{{$item->jawaban_b}}</label>
                              </div>
                              <div class="form-radio">
                                   <input type="radio" class="form-radio-input" id="n3" name="pilihan[{{$item->id}}]" value="c">
                                   <label class="form-radio-label" for="n3">{{$item->jawaban_c}}</label>
                              </div>
                              <div class="form-radio">
                                   <input type="radio" class="form-radio-input" id="n4" name="pilihan[{{$item->id}}]" value="d">
                                   <label class="form-radio-label" for="n4">{{$item->jawaban_d}}</label>
                              </div>
     
                         </div>
                    @endforeach                    
                    <input type="submit" class="btn btn-primary" name="selesai" value="Submit" onclick="return confirm('Apakah Anda yakin dengan jawaban Anda?')">
                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}} <br> <br>
               </form>
               
          @endif
		
	</div>
     
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'>
</script>
{{-- <script  src="{{ asset('ujian/assets/lembar_soal/script.js')}}"></script> --}}

{{-- <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script> --}}
 
          <script>
               function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };
                    $(document).on("keydown", disableF5);

                    // simply visual, let's you know when the correct iframe is selected
                    $(window).on("focus", function(e) {
                    $("html, body").css({ background: "#FFF", color: "#000" })
                    .find("h2").html("THIS BOX NOW HAS FOCUS<br />F5 should not work.");
                    })
                    .on("blur", function(e) {
                    $("html, body").css({ background: "", color: "" })
                    .find("h2").html("CLICK HERE TO GIVE THIS BOX FOCUS BEFORE PRESSING F5");
                    });
          </script>
          <!-- Script Timer -->

     @php
          $waktu = $dataWaktu;
          if ($waktu < 1) {
               $dataDetik = 0;
               $dataMenit = 0;
               $dataJam = 0;
          } else {
               $dataDetik = 0;
               $dataMenit = ($waktu % 60);
               $dataJam = floor($waktu / 60);
          }
     
     @endphp
     <script type="text/javascript">
        $(document).ready(function() {
              /** Membuat Waktu Mulai Hitung Mundur Dengan 
                * var detik = 0,
                * var menit = 1,
                * var jam = 1
              */
              var detik = {{$dataDetik}};
              var menit = {{$dataMenit}};
              var jam   = {{$dataJam}};
              
             /**
               * Membuat function hitung() sebagai Penghitungan Waktu
             */
            function hitung() {
                /** setTimout(hitung, 1000) digunakan untuk 
                    * mengulang atau merefresh halaman selama 1000 (1 detik) 
                */
                setTimeout(hitung,1000);
  
               /** Jika waktu kurang dari 10 menit maka Timer akan berubah menjadi warna merah */
               if(menit < 10 && jam == 0){
                     var peringatan = 'style="color:red"';
               };
 
               /** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
               $('#timer').html(
                      '<h1 align="center"'+peringatan+'>Sisa waktu anda <br />' + jam + ' jam : ' + menit + ' menit : ' + detik + ' detik</h1><hr>'
                );
  
                /** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
                detik --;
 
                /** Jika var detik < 0
                    * var detik akan dikembalikan ke 59
                    * Menit akan Berkurang 1
                */
                if(detik < 0) {
                    detik = 59;
                    menit --;
 
                    /** Jika menit < 0
                        * Maka menit akan dikembali ke 59
                        * Jam akan Berkurang 1
                    */
                    if(menit < 0) {
                        menit = 59;
                        jam --;
 
                        /** Jika var jam < 0
                            * clearInterval() Memberhentikan Interval dan submit secara otomatis
                        */
                        if(jam < 0) {                                                                 
                            clearInterval();  
                            document.forms['myquiz'].submit();
                        } 
                    } 
                } 
            }           
            /** Menjalankan Function Hitung Waktu Mundur */
            hitung();
      }); 
      // ]]>
    </script>

</body>
</html>

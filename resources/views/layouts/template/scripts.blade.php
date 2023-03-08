  <!-- General JS Scripts -->
  {{-- <script src="{{ asset('assets/modules/jquery.min.js') }}"></script> --}}
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  @yield('js')

  {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script> --}}
  <script src="{{ asset('assets/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>

  {{-- <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script> --}}
  <!-- include summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  {{-- <script src="javascript/common.js" type="text/javascript"></script> --}}

  <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js">
  </script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap4.min.js">
  </script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="{{ asset('/dist/vendor/chart.js/Chart.min.js') }}"></script>
  <script type="text/javascript" src="/js/jquery.toast.js"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}


  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>

  @if (session('errorjenjang'))
      <script type="text/javascript">
          Swal.fire(
              'Ada Sesuatu Yang Salah',
              'Anda Belum Memilih Jenjang!',
              'error'
          )
      </script>
  @endif

  @if (session('pembayaranberhasiladmin'))
      <script type="text/javascript">
          Swal.fire(
              'Selamat',
              'Pembayaran Berhasil!',
              'success'
          )
      </script>
  @endif

  @if (session('pembayarangagaladmin'))
      <script type="text/javascript">
          Swal.fire(
              'Info',
              'Tagihan sudah di bayar sebelumnya!',
              'info'
          )
      </script>
  @endif

  @if (session('berhasilabsen'))
      <script type="text/javascript">
          Swal.fire(
              'Selamat',
              'Semua siswa telah di absen!',
              'success'
          )
      </script>
  @endif

  @if (session('gagalpembayaran'))
      <script type="text/javascript">
          Swal.fire(
              'Gagal',
              'Anda tidak punya akses!',
              'info'
          )
      </script>
  @endif

  @if (session('kelaspenuh'))
      <script type="text/javascript">
          Swal.fire(
              'Gagal',
              'Maaf kelas sudah penuh!',
              'info'
          )
      </script>
  @endif

  @if (session('kelastidakada'))
      <script type="text/javascript">
          Swal.fire(
              'Info',
              'Maaf kelas tidak ada!',
              'info'
          )
      </script>
  @endif

  @if (session('siswatidakada'))
      <script type="text/javascript">
          Swal.fire(
              'Info',
              'Maaf siswa tidak ada!!',
              'info'
          )
      </script>
  @endif
  @if (session('sudahabsen'))
      <script type="text/javascript">
          Swal.fire(
              'Gagal',
              'Siswa Sudah Absen!',
              'error'
          )
      </script>
  @endif


  @if (session('guruerror'))
      <script type="text/javascript">
          Swal.fire(
              'Peringatan',
              'Maaf Guru Tidak Boleh Masuk Jadwal Siswa!',
              'info'
          )
      </script>
  @endif
  @if (session('datatidakada'))
      <script type="text/javascript">
          Swal.fire(
              'Gagal!',
              'Data Tidak ada!',
              'error'
          )
      </script>
  @endif


  @if (session('gagalmasuk'))
      <script type="text/javascript">
          Swal.fire(
              'Maaf',
              'Anda Tidak Punya Akses Ke Halaman Ini!',
              'info'
          )
      </script>
  @endif

  @if (session('lulus'))
      <script type="text/javascript">
          Swal.fire(
              'Selamat',
              'Siswa Lulus!',
              'success'
          )
      </script>
  @endif

  @if (session('tidaklulus'))
      <script type="text/javascript">
          Swal.fire(
              'Pemberitahuan',
              'Siswa Tidak Lulus!',
              'success'
          )
      </script>
  @endif

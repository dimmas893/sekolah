<div class="main-sidebar sidebar-style-2">
    @php
        $menuAkses = (int) Auth::user()->role;
        
    @endphp
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Sekolah</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">SH</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fire h4 mt-2"></i>Dashboard
                </a>
            </li>

            <li class="nav-item {{ request()->is('semuakelas') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('semuakelas') }}">
                    <i class="fas fa-fire h4 mt-2"></i>semuakelas
                </a>
            </li>

            @if ($menuAkses === 5)
                {{-- akses siswa --}}
                <li class="nav-item {{ request()->is('profil') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('profil') }}"> <i
                            class="ion-document-text h4 mt-2"data-pack="default"></i>Profil Saya</a>
                </li>
                <li class="nav-item {{ request()->is('PembayaranSiswa') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('PembayaranSiswa') }}"> <i
                            class="ion-document-text h4 mt-2"data-pack="default"></i>Riwayat Pembayaran</a>
                </li>
                <li class="nav-item {{ request()->is('jadwal-siswa') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jadwal-siswa') }}">
                        <i class="ion-document-text h4 mt-2"data-pack="default"></i>Kelas Rutin</a>
                </li>
                <li class="nav-item {{ request()->is('SiswaTampilTugas') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('SiswaTampilTugas') }}">
                        <i class="ion-document-text h4 mt-2"data-pack="default"></i>Tugas Sekolah</a>
                </li>
                <li class="nav-item {{ request()->is('laporan_absen') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('laporan_absen') }}">
                        <i class="ion-document-text h4 mt-2"data-pack="default"></i>Kehadiran</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="ion-ios-copy h4 mt-2"data-pack="default"></i><span>Ujian Siswa</span></a>
                    <ul class="dropdown-menu">
                        <li class="nav-item {{ request()->is('siswa') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('siswa') }}">Hasil
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('laporan_absen_admin_view') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('laporan_absen_admin_view') }}">
                                Jadwal Ujian
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="ion-ios-copy h4 mt-2"data-pack="default"></i><span>Ujian Online</span></a>
                    <ul class="dropdown-menu">
                        <li class="nav-item {{ request()->is('siswa') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('siswa') }}">Ujian Aktif
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('laporan_absen_admin_view') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('laporan_absen_admin_view') }}">
                                Hasil Ujian Online
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('jadwal_buat_guru') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jadwal_buat_guru') }}">
                        <i class="ion-document-text h4 mt-2"data-pack="default"></i>Pemberitahuan</a>
                </li>

                <li class="nav-item {{ request()->is('tagihan_siswa_web') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('tagihan_siswa_web') }}">
                        <i class="ion-document-text h4 mt-2"data-pack="default"></i>Tagihan Siswa</a>
                </li>
            @elseif ($menuAkses === 4)
                {{-- akses wali siswa --}}
            @elseif ($menuAkses === 3)
                {{-- akses guru --}}
                <li class="nav-item {{ request()->is('jadwal_buat_guru') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jadwal_buat_guru') }}">
                        <i class="ion-document-text h4 mt-2"data-pack="default"></i>Jadwal</a>
                </li>

                @php
                    $guru = \App\Models\Guru::where('id_user', Auth::user()->id)->first();
                @endphp
                @if (\App\Models\Kelas::where('id_guru', $guru->id)->first())
                    <li class="nav-item {{ request()->is('WaliKelas') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('WaliKelas') }}">
                            <i class="ion-document-text h4 mt-2"data-pack="default"></i>Wali Kelas</a>
                    </li>
                @endif
            @elseif ($menuAkses === 1)
                {{-- akses admin start --}}
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="ion-ios-copy h4 mt-2"data-pack="default"></i><span>Info Siswa</span></a>
                    <ul class="dropdown-menu">
                        <li class="nav-item {{ request()->is('siswa') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('siswa') }}">Siswa
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('laporan_absen_admin_view') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('laporan_absen_admin_view') }}">
                                Laporan Absen
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="ion-ios-copy h4 mt-2"data-pack="default"></i><span>Akademik</span></a>
                    <ul class="dropdown-menu">
                        <li class="nav-item {{ request()->is('jadwal') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('jadwal') }}">Jadwal</a>
                        </li>


                        <li class="nav-item {{ request()->is('tingkatan') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('tingkatan') }}">Tingkatan
                            </a>
                        </li>

                        <li class="nav-item {{ request()->is('jenjang') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('jenjang') }}"> Jenjang</a>
                        </li>
                        <li class="nav-item {{ request()->is('kelas-guru') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('kelas-guru') }}">Wali Kelas </a>
                        </li>

                        <li class="nav-item {{ request()->is('tahun-ajaran') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('tahun-ajaran') }}">Tahun Ajaran</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="ion-ios-copy h4 mt-2"data-pack="default"></i><span>Manage</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin') }}">Admin
                            </a>
                        </li>


                        <li class="nav-item {{ request()->is('soal') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('soal') }}">Soal
                            </a>
                        </li>

                        <li class="nav-item {{ request()->is('pengaturan') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pengaturan') }}">Pengaturan
                            </a>
                        </li>


                        <li class="nav-item {{ request()->is('nilai') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('nilai') }}">Nilai
                            </a>
                        </li>


                        <li class="nav-item {{ request()->is('guru') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('guru') }}">Guru
                            </a>
                        </li>

                        <li class="nav-item {{ request()->is('kelas') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('kelas') }}">Master Kelas
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('datakelas') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('datakelas') }}">Data Kelas
                            </a>
                        </li>

                        <li class="nav-item {{ request()->is('mata_pelajaran') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('mata_pelajaran') }}">Mata Pelajaran</a>
                        </li>
                        <li class="nav-item {{ request()->is('ruangan') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('ruangan') }}">Ruangan</a>
                        </li>

                        <li class="nav-item {{ request()->is('tugas') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('tugas') }}">Tugas</a>
                        </li>

                        {{-- <li class="nav-item {{ request()->is('rincian_siswa') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rincian_siswa') }}">Rincian Siswa</a>
                    </li> --}}
                        <li class="nav-item {{ request()->is('perpustakaan') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('perpustakaan') }}">Perpustakaan</a>
                        </li>

                        <li class="nav-item {{ request()->is('berita') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('berita') }}">Berita</a>
                        </li>

                        <li class="nav-item {{ request()->is('kegiatan_1') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('kegiatan_1') }}">Kegiatan</a>
                        </li>

                        <li class="nav-item {{ request()->is('perpustakaan_member') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('perpustakaan_member') }}">Member Perpustakaan</a>
                        </li>

                        <li class="nav-item {{ request()->is('kurikulum') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('kurikulum') }}">Kurikulum</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="ion-ios-paper h4 mt-2"data-pack="default"></i><span>Tagihan</span></a>
                    <ul class="dropdown-menu">
                        <li class="nav-item {{ request()->is('kategori_tagihan') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('kategori_tagihan') }}">Kategori Tagihan</a>
                        </li>
                        <li class="nav-item {{ request()->is('siswa_tagihan') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('siswa_tagihan') }}">Tagihan Siswa</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="ion-ios-paper h4 mt-2"data-pack="default"></i><span>Bagi Kelas</span></a>
                    <ul class="dropdown-menu">
                        <li class="nav-item {{ request()->is('siswatokelas') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('siswatokelas') }}">Pilih Jenjang</a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="dropdown {{ $jumlahDaftar != 0 ? 'beep' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="ion-ios-paper h4 mt-2"data-pack="default"></i><span>Pendaftaran </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item {{ request()->is('tbl_pendaftaran') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('tbl_pendaftaran') }}">Belum Di Tinjau</a>
                        </li>
                    </ul>
                </li> --}}
                <li class="dropdown beep">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="ion-ios-paper h4 mt-2"data-pack="default"></i><span>Pendaftaran </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item {{ request()->is('tbl_pendaftaran') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('tbl_pendaftaran') }}">Belum Di Tinjau</a>
                        </li>
                    </ul>
                </li>
                {{-- akses admin end --}}
            @endif
        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout_id').submit();"
                class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
        <form method="POST" id="logout_id" action="{{ route('logout') }}" style="display:none;">
            @csrf
        </form>
    </aside>
</div>

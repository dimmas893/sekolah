<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Sekolah</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SH</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            {{-- <li class="dropdown">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
            <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
          </ul>
        </li> --}}
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fire h4 mt-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item {{ request()->is('guru_kelas') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('guru_kelas') }}"><i
                        class="ion-android-person h4 mt-2"data-pack="default"></i> Wali Kelas
                </a>

            </li>
            <li class="nav-item {{ request()->is('jadwal') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('jadwal') }}">
                    <i class="ion-document-text h4 mt-2"data-pack="default"></i>Jadwal</a>
            </li>


            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i
                        class="ion-ios-copy h4 mt-2"data-pack="default"></i><span>Manage</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin') }}">Admin
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('siswa') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('siswa') }}">Siswa
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('guru') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('guru') }}">Guru
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('kelas') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('kelas') }}">Kelas
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('mata_pelajaran') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('mata_pelajaran') }}">Mata Pelajaran</a>
                    </li>
                    <li class="nav-item {{ request()->is('ruangan') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('ruangan') }}">Ruangan</a>
                    </li>
                    <li class="nav-item {{ request()->is('rincian_siswa') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rincian_siswa') }}">Rincian Siswa</a>
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
                        class="ion-ios-paper h4 mt-2"data-pack="default"></i><span>Pendaftaran</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item {{ request()->is('tbl_pendaftaran') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('tbl_pendaftaran') }}">Belum Di Tinjau</a>
                    </li>
                    <li class="nav-item {{ request()->is('halaman_step_1') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('halaman_step_1') }}">Pendaftaran Siswa</a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                    document.getElementById('logout_id').submit();"
                class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
        <form method="POST" id="logout_id" action="{{ route('logout') }}" style="display:none;">
            @csrf

        </form>
    </aside>
</div>

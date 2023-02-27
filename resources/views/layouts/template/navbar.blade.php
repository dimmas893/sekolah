<div class="d-none d-xl-block d-lg-block d-md-block">
    <style>
        .navbar-bg-web {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 74px;
            background-color: #6777ef;
            z-index: -1;
        }
    </style>
    <div class="navbar-bg-web"></div>
</div>
<div class="d-sm-none">
    <style>
        .navbar-bg {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 115px;
            background-color: #6777ef;
            z-index: -1;
        }
    </style>
    <div class="navbar-bg"></div>
</div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto" style="">
        <ul class="navbar-nav mr-3">
            {{-- <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li> --}}
        </ul>
    </form>
    @if (Auth::user())
        @php
            $gambar = \App\Models\Siswa::where('id_user', Auth::user()->id)->first();
            $gambarguru = \App\Models\Guru::where('id_user', Auth::user()->id)->first();
            $admin = \App\Models\Admin::where('id_user', Auth::user()->id)->first();
        @endphp
        <ul class="navbar-nav navbar-right">
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    @if (Auth::user()->role == 5)
                        @if ($gambar->avatar)
                            <img alt="image" src="{{ asset('avatar/' . $gambar->avatar) }}"
                                class="rounded-circle mr-1">
                        @elseif(asset('avatar/' . $gambar->avatar) == false)
                            <img alt="image" src="{{ asset('defaut3.jpg') }}" class="rounded-circle mr-1">
                        @else
                            <img alt="image" src="{{ asset('defaut3.jpg') }}" class="rounded-circle mr-1">
                        @endif
                    @endif
                    @if (Auth::user()->role == 3)
                        @if ($gambarguru->avatar)
                            <img alt="image" src="{{ asset('guru/' . $gambarguru->avatar) }}"
                                class="rounded-circle mr-1">
                        @elseif(asset('guru/' . $gambarguru->avatar) == false)
                            <img alt="image" src="{{ asset('defaut3.jpg') }}" class="rounded-circle mr-1">
                        @else
                            <img alt="image" src="{{ asset('defaut3.jpg') }}" class="rounded-circle mr-1">
                        @endif
                    @endif

                    @if (Auth::user()->role == 1)
                        @if ($admin->avatar != null)
                            <img alt="image" src="{{ asset('avatar/' . $admin->avatar) }}"
                                class="rounded-circle mr-1">
                        @elseif(asset('guru/' . $admin->avatar) == false)
                            <img alt="image" src="{{ asset('defaut3.jpg') }}" class="rounded-circle mr-1">
                        @else
                            <img alt="image" src="{{ asset('defaut3.jpg') }}" class="rounded-circle mr-1">
                        @endif
                    @endif
                    <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">Setting</div>
                    <a href="{{ route('profil') }}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profil
                    </a>
                    <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout_id').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                    <form method="POST" id="logout_id" action="{{ route('logout') }}" style="display:none;">
                        @csrf

                    </form>
                </div>
            </li>
        </ul>
    @endif
</nav>

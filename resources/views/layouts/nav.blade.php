<div class="navbar-wrapper  ">
    <div class="navbar-content scroll-div ">

        <div class="">
            <div class="main-menu-header">
                <img class="img-radius" src="{{ asset('foto/dm/pengguna/' . Auth::user()->foto) }}"
                    style="height:75px;width:75px;" alt="User-Profile-Image">
                <div class="user-details">
                    @php
                        $kata = explode(' ', Auth::user()->name);
                        $hasil = $kata[0];
                    @endphp
                    <div id="more-details">
                        {{ $hasil }}
                        <i class="fa fa-caret-down"></i>
                    </div>
                </div>
            </div>
            <div class="collapse" id="nav-user-link">
                <ul class="list-unstyled">
                    <li class="list-group-item"><a href="{{ route('profil.admin') }}"><i
                                class="feather icon-user m-r-5"></i>Edit Profil</a></li>
                    @if (Auth::user()->sebagai == 'Staff Umum' or Auth::user()->sebagai == 'Admin')
                        <li class="list-group-item"><a href="{{ route('pengaturan.index') }}"><i class="bi bi-gear"></i>
                                Pengaturan</a></li>
                    @endif
                    <li class="list-group-item">
                        <a href="{{ route('user.logout') }}"
                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            <i class="feather icon-log-out m-r-5"></i>{{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <ul class="nav pcoded-inner-navbar ">
            {{-- <li class="nav-item pcoded-menu-caption">
                <label>Navigation</label>
            </li> --}}
            <li class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link "><span class="pcoded-micon"><i
                            class="feather icon-home"></i></span><span class="pcoded-mtext">Beranda</span></a>
            </li>
            @if (Auth::user()->sebagai == 'Staff Umum')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#" class="nav-link "><span class="pcoded-micon"><i
                                class="fa fa-cube"></i></span><span class="pcoded-mtext">Data Master</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('dm.barang.index') }}">Barang</a></li>
                        <li><a href="{{ route('dm.ruangan.index') }}">Ruangan</a></li>
                        <li><a href="{{ route('dm.kendaraan.index') }}">Kendaraan</a></li>
                        <li><a href="{{ route('dm.pengguna.index') }}">Pengguna</a></li>
                        <li><a href="{{ route('dm.unit.index') }}">Unit</a></li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->sebagai == 'Staff Umum' or
                    Auth::user()->sebagai == 'Kepala Bagian' or
                    Auth::user()->sebagai == 'Wakil Direktur 1' or
                    Auth::user()->sebagai == 'Wakil Direktur 2')
                <li class="nav-item">
                    <a href="{{ route('peminjaman.pengajuan.index') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="bi bi-file-earmark-arrow-down"></i></span><span class="pcoded-mtext">Kelola
                            Peminjaman</span></a>
                </li>
                {{-- <li class="nav-item pcoded-hasmenu">
                <a href="#" class="nav-link "><span class="pcoded-micon"><i class="fa fa-cube"></i></span><span class="pcoded-mtext">Kelola Peminjaman</span></a>
                <ul class="pcoded-submenu">
                    <li><a href="{{route('peminjaman.pengajuan.index')}}">Pengajuan Peminjaman</a></li>
                </ul>
            </li> --}}
            @endif



            @if (Auth::user()->sebagai == 'Staff Umum')
                <li class="nav-item">
                    <a href="{{ route('pengembalian.index') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="fa fa-folder-closed"></i></span><span
                            class="pcoded-mtext">Pengembalian</span></a>
                </li>
            @endif
            @if (Auth::user()->sebagai == 'Staff Umum' or Auth::user()->sebagai == 'Kepala Bagian')
                <li class="nav-item">
                    <a href="{{ route('laporan.index') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="fa fa-file"></i></span><span class="pcoded-mtext">Laporan</span></a>
                </li>
            @endif

            @if (Auth::user()->sebagai == 'Pengelola Supir')
                <li class="nav-item">
                    <a href="{{ route('supir.kelola.index') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="bi bi-person-badge"></i></span><span class="pcoded-mtext">Kelola Supir</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('supir.aktivitas.index') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="bi bi-car-front-fill"></i></span><span class="pcoded-mtext">Kelola Aktivitas
                            Supir</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('peminjaman.pengajuan.index') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="bi bi-file-earmark-arrow-down"></i></span><span class="pcoded-mtext">Peminjaman
                            Supir</span></a>
                </li>
            @endif

            @if (Auth::user()->sebagai == 'Staff Umum')
                <li class="nav-item">
                    <a href="{{ route('info.index') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="bi bi-calendar-week"></i></span><span class="pcoded-mtext">Informasi
                            BMN</span></a>
                </li>
            @endif

            @if (Auth::user()->sebagai == 'Admin')
                <li class="nav-item">
                    <a href="{{ route('dm.pengguna.index') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="bi bi-calendar-week"></i></span><span class="pcoded-mtext">Kelola User</span></a>
                </li>
            @endif
            @if (Auth::user()->sebagai != 'Admin')
                <li class="nav-item">
                    <a href="{{ route('dm.peminjaman.index') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="bi bi-cart-plus"></i></span><span class="pcoded-mtext">Mode Peminjam</span></a>
                </li>
            @endif
        </ul>
    </div>
</div>

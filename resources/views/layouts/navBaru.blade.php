<div class="navbar-wrapper container">
    <div class="navbar-content sidenav-horizontal" id="layout-sidenav">
        <ul class="nav pcoded-inner-navbar sidenav-inner">
            <li class="nav-item pcoded-menu-caption">
                <label>Navigation</label>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">
                    @if(Auth::user()->sebagai == "Staff Umum" OR Auth::user()->sebagai == "Kepala Bagian" OR Auth::user()->sebagai == "Wakil Direktur 1" OR Auth::user()->sebagai == "Wakil Direktur 2" OR Auth::user()->sebagai == "Pengelola Supir"  )
                    Beranda
                    @else
                    Beranda
                    @endif
                </span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('dm.peminjaman.index')}}" class="nav-link "><span class="pcoded-micon"><i class="bi bi-send-plus"></i></span><span class="pcoded-mtext">Peminjaman</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('pengembalian.lapor.index')}}" class="nav-link "><span class="pcoded-micon"><i class="bi bi-file-earmark-check-fill"></i></span><span class="pcoded-mtext">Pengembalian</span></a>
            </li>
            {{-- <li class="nav-item pcoded-hasmenu">
                <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-lock"></i></span><span class="pcoded-mtext">Authentication</span></a>
                <ul class="pcoded-submenu">
                    <li><a href="auth-signup.html" target="_blank">Sign up</a></li>
                    <li><a href="auth-signin.html" target="_blank">Sign in</a></li>
                </ul>
            </li> --}}
        </ul>
    </div>
</div>
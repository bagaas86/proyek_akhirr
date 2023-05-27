<ul>
 @guest
 <li><a class="getstarted scrollto" href="{{url('/auth')}}">Masuk</a></li>
 @endguest
  @auth
  <li><a class="nav-link scrollto " href="{{url('dashboard')}}">Beranda</a></li>
  <li><a class="nav-link scrollto" href="{{route('dm.peminjaman.index')}}">Peminjaman</a></li>
  <li><a class="nav-link scrollto" href="#services">Pengembalian</a></li>
  <li class="dropdown"><a class="getstarted scrollto" href="#"><img src="{{asset('foto/dm/pengguna/'. Auth::user()->foto)}}" style="width:15%;float:right">{{Auth::user()->username}}<i class="bi bi-chevron-down"></i></a>
    <ul>
      <li><a href="#"></a></li>
      <li><a href="#">Profil</a></li>
      <li><a href="{{route('history.index')}}">Riwayat Peminjaman </a></li>
      <li>
        <a class="dropdown-item" href="{{ route('user.logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
       {{ __('Keluar') }}
       </a>
      <form id="logout-form" action="{{route('user.logout')}}" method="POST">
        @csrf
      </form>
        
    </ul>
  </li>
  @endauth
</ul>
<i class="bi bi-list mobile-nav-toggle"></i>
@extends('layouts.template')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Beranda</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="card" style="height:75px">
    <h2 class="text-muted m-b-0" style="margin-left:20px;margin-top:15px;">Selamat Datang, {{Auth::user()->name}}</h2>
</div>
@if(Auth::user()->sebagai == "Staff Umum")
<div class="row">
    <div class="col-lg-7 col-md-12">
        <!-- support-section start -->
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$total_barang}}</h4>
                                <h6 class="text-muted m-b-0">Total Barang</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="bi bi-speaker f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue btn">
                        <a href="{{route('dm.barang.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$total_ruangan}}</h4>
                                <h6 class="text-muted m-b-0">Total Ruangan</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="bi bi-building f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue btn">
                        <a href="{{route('dm.ruangan.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$total_kendaraan}}</h4>
                                <h6 class="text-muted m-b-0">Total Kendaraan</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="bi bi-car-front-fill f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue btn">
                        <a href="{{route('dm.kendaraan.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$total_pengguna}}</h4>
                                <h6 class="text-muted m-b-0">Total Pengguna</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="bi bi-people f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue btn">
                        <a href="{{route('dm.pengguna.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- support-section end -->
     </div>
     <div class="col col-lg-5 col-md-12">
          <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-green">{{$total_pengajuan_peminjaman}}</h4>
                                <h6 class="text-muted m-b-0">Total Pengajuan Peminjaman</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="feather icon-bar-chart-2 f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-green btn">
                        <a href="{{route('peminjaman.pengajuan.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-green">{{$total_pengembalian}}</h4>
                                <h6 class="text-muted m-b-0">Total Pelaporan Pengembalian</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="feather icon-bar-chart-2 f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-green btn">
                        <a href="{{route('pengembalian.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
     </div>
    <!-- [ Main Content ] end -->
</div>
@endif

@if(Auth::user()->sebagai == "Kepala Bagian")
<div class="row">
    <div class="col col-md-12">
        <div class="row">
            <div class="col col-md-4 col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$total_pengajuan_kabag}}</h4>
                                <h6 class="text-muted m-b-0">Total Pengajuan Peminjaman</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="bi bi-speaker f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue btn">
                        <a href="{{route('peminjaman.pengajuan.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col col-md-4 col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$total_pengajuan_kabag_disetujui}}</h4>
                                <h6 class="text-muted m-b-0">Pengajuan Peminjaman Disetujui</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="bi bi-check f-36"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue btn">
                        <a href="{{route('peminjaman.pengajuan.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col col-md-4 col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$total_pengajuan_kabag_ditolak}}</h4>
                                <h6 class="text-muted m-b-0">Pengajuan Peminjaman Ditolak</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="bi bi-x f-36"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue btn">
                        <a href="{{route('peminjaman.pengajuan.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>
@endif


@if(Auth::user()->sebagai == "Wakil Direktur 2")
<div class="row">
    <div class="col col-md-12">
        <div class="row">
            <div class="col col-md-4 col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$total_pengajuan_wadir2}}</h4>
                                <h6 class="text-muted m-b-0">Total Pengajuan Peminjaman</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="bi bi-speaker f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue btn">
                        <a href="{{route('peminjaman.pengajuan.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col col-md-4 col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$total_pengajuan_wadir2_disetujui}}</h4>
                                <h6 class="text-muted m-b-0">Pengajuan Peminjaman Disetujui</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="bi bi-check f-36"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue btn">
                        <a href="{{route('peminjaman.pengajuan.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col col-md-4 col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$total_pengajuan_wadir2_ditolak}}</h4>
                                <h6 class="text-muted m-b-0">Pengajuan Peminjaman Ditolak</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="bi bi-x f-36"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue btn">
                        <a href="{{route('peminjaman.pengajuan.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>
@endif

@if(Auth::user()->sebagai == "Pengelola Supir")
<div class="row">
    <div class="col col-md-12">
        <div class="row">
            <div class="col col-md-4 col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$total_pengajuan_supir}}</h4>
                                <h6 class="text-muted m-b-0">Total Pengajuan Peminjaman</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="bi bi-speaker f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue btn">
                        <a href="{{route('peminjaman.pengajuan.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col col-md-4 col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$total_pengajuan_supir_disetujui}}</h4>
                                <h6 class="text-muted m-b-0">Pengajuan Peminjaman Disetujui</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="bi bi-check f-36"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue btn">
                        <a href="{{route('peminjaman.pengajuan.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col col-md-4 col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$total_pengajuan_supir_ditolak}}</h4>
                                <h6 class="text-muted m-b-0">Pengajuan Peminjaman Ditolak</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="bi bi-x f-36"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue btn">
                        <a href="{{route('peminjaman.pengajuan.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col col-md-4 col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$total_supir}}</h4>
                                <h6 class="text-muted m-b-0">Total Supir Aktif</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="bi bi-people f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue btn">
                        <a href="{{route('supir.kelola.index')}}">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0">Lihat</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>
@endif



@endsection
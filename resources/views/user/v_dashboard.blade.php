@extends('layouts.templateBaru')
@section('navigasi')

@endsection 
@section('content')
    <div class="row">
        <div class="col col-12 col-md-12">
            <div class="container text-center mb-4" data-aos="fade-up">
                <h4>Selamat Datang, {{Auth::user()->name}}</h4>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col col-md-4 col-6">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-c-yellow">{{$total_peminjaman_saya}}</h4>
                        <h6 class="text-muted m-b-0">Peminjaman Saya</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="feather icon-bar-chart-2 f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-yellow">
                <a href="{{route('history.index')}}">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0">Lihat</p>
                        </div>
                        <div class="col-3 text-right">
                            <i class="feather icon-trending-up text-white f-16"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
@endsection


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
@endsection


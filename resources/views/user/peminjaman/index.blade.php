@extends('layouts.templateBaru')
@section('navigasi')
  <div class="page-block">
    <div class="row align-items-center">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#!">Peminjaman</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection 
@section('content')
<div class="container">
    <div class="row">
        <div class="col col-12 col-md-12">
            <div class="container text-center" data-aos="fade-up">
                <h4>Sistem Informasi Peminjaman Barang Milik Negara</h4>
            </div>
            <div id="read">
              
            </div>
        </div>

    </div>
</div>


<script>
     $(document).ready(function() {
            read()
        });
        function read() {
            $.get("{{ url('read') }}", {}, function(data, status) {
                $("#read").html(data);
            });
        }



    
</script>
@endsection


@extends('layouts.templateBaru')
@section('navigasi')
  <div class="page-block">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="page-header-title">
                <h5 class="m-b-10">Horizontal Layout 2</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#!">Page Layout</a></li>
                <li class="breadcrumb-item"><a href="#!">Horizontal Layout 2</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection 
@section('content')
<div class="container">
    <div class="row">
        <div id="history" class="col col-12 col-md-12">
        
        </div>

        <div id="detail">

        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
           read()
       });
       function read() {
           $.get("{{ url('jshistory') }}", {}, function(data, status) {
               $("#history").html(data);
               document.getElementById("history").style.display="block";
               document.getElementById("detail").style.display="none";
           });
       }

       function detail(id_peminjaman) {
           $.get("{{ url('detailhistory') }}/" +id_peminjaman, {}, function(data, status) {
               $("#detail").html(data);
               document.getElementById("history").style.display="none";
               document.getElementById("detail").style.display="block";
           });
       }



   
</script>
@endsection


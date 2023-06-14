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
        <div id="pengembalian" class="col col-12 col-md-12">
        
        </div>

        <div id="detail" class="col col-12 col-md-12">

        </div>

        
        <div id="lapor" class="col col-12 col-md-12">

        </div>
        <div id="relapor" class="col col-12 col-md-12">

        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
           read()
       });
       function read() {
           $.get("{{ url('jspengembalian') }}", {}, function(data, status) {
               $("#pengembalian").html(data);
               document.getElementById("pengembalian").style.display="block";
               document.getElementById("detail").style.display="none";
               document.getElementById("lapor").style.display="none";
               document.getElementById("relapor").style.display="none";
           });
       }

       function detail(id_peminjaman) {
           $.get("{{ url('detailpengembalian') }}/" +id_peminjaman, {}, function(data, status) {
               $("#detail").html(data);
               document.getElementById("pengembalian").style.display="none";
               document.getElementById("lapor").style.display="none";
               document.getElementById("detail").style.display="block";
               document.getElementById("relapor").style.display="none";
           });
       }

       function lapor(id_peminjaman) {
           $.get("{{ url('laporpengembalian') }}/" +id_peminjaman, {}, function(data, status) {
               $("#lapor").html(data);
               document.getElementById("pengembalian").style.display="none";
               document.getElementById("lapor").style.display="block";
               document.getElementById("detail").style.display="none";
               document.getElementById("relapor").style.display="none";
           });
       }

       function laporUlang(id_peminjaman) {
           $.get("{{ url('laporpengembalianulang') }}/" +id_peminjaman, {}, function(data, status) {
               $("#relapor").html(data);
               document.getElementById("pengembalian").style.display="none";
               document.getElementById("lapor").style.display="none";
               document.getElementById("detail").style.display="none";
               document.getElementById("relapor").style.display="block";
           });
       }



   
</script>
@endsection


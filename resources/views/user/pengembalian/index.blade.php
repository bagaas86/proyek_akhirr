@extends('layouts.templateBaru')

@section('content')
<div class="container">
    <div class="row">
        <div id="pengembalian" class="col col-12 col-md-12">
        
        </div>

        <div id="detail" class="col col-12 col-md-12">

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
               document.getElementById("relapor").style.display="none";
           });
       }

       function detail(id_peminjaman) {
           $.get("{{ url('detailpengembalian') }}/" +id_peminjaman, {}, function(data, status) {
               $("#detail").html(data);
               document.getElementById("pengembalian").style.display="none";
               document.getElementById("detail").style.display="block";
               document.getElementById("relapor").style.display="none";
           });
       }

       function laporUlang(id_peminjaman) {
           $.get("{{ url('laporpengembalianulang') }}/" +id_peminjaman, {}, function(data, status) {
               $("#relapor").html(data);
               document.getElementById("pengembalian").style.display="none";
               document.getElementById("detail").style.display="none";
               document.getElementById("relapor").style.display="block";
           });
       }



   
</script>
@endsection


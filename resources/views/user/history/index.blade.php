@extends('layouts.templateBaru')
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


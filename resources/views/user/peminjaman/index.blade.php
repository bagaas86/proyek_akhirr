@extends('layouts.templateBaru')
@section('content')
<div class="container">
    <div class="row">
        <div class="col col-12 col-md-12">
            <div class="container d-flex flex-column align-items-center justify-content-center" data-aos="fade-up">
                <h1>Sistem Informasi Peminjaman Barang Milik Negara</h1>
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


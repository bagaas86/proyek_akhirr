@extends('layouts.templateBaru')
{{-- @section('navigasi')
<div class="page-block">
    <div class="row align-items-center">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#!">Profil Saya</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection --}}
@section('content')
<div class="container text-center mb-4" data-aos="fade-up">
    <h4>Profil Saya</h4>
</div>
<form method="POST" action="{{route('profil.user.edit')}}" enctype="multipart/form-data">
@csrf
<input name="id_user" value="{{Auth::user()->id}}" hidden>
<div class="row">
     <div class="col col-md-4 col-12 mt-4">
        <center>
            <img id="imageResult" src="{{asset('foto/dm/pengguna/'. $pengguna->foto)}}" style="width:250px;height:250px" class="rounded-circle shadow-4-strong" alt="">
            <a class="btn btn-secondary mt-2" style="color:white" onclick="gantifoto()"><i class="fa fa-edit"></i>Ubah</a>
            <input onchange="readURL(this);" type="file" id="filefotopengguna" name="foto" hidden>
        </center>
    </div>
    <div class="col col-md-8 col-12 mt-4">
        <div class="form-group">
            <label for="Nama Pengguna">Nama Pengguna</label>
            <input type="text" value="{{$pengguna->name}}" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="Nama Pengguna">Username</label>
            <input type="text" value="{{$pengguna->username}}" name="username" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="Nama Pengguna">Password</label><small style="font-size:10px">Masukkan Password Baru Jika Ingin Mengubah</small>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label for="Nama Pengguna">Unit/Organisasi</label>
            <input type="text" value="{{$pengguna->sebagai}}" name="sebagai" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="Nama Pengguna">Keterangan</label>
            <input type="text" value="{{$pengguna->keterangan}}" name="keterangan" class="form-control">
        </div>
        <div class="form-group">
            <label for="Nama Pengguna">Nomor Identitas</label>
            <input type="text" value="{{$pengguna->no_identitas}}" name="no_identitas" class="form-control">
        </div>
        <div class="form-group">
            <label for="Nama Pengguna">Nomor Whatsapp</label>
            <input type="text" value="{{$pengguna->no_telepon}}" name="no_telepon" class="form-control">
        </div>
    </div>
    <div class="container text-center mt-4" data-aos="fade-up">
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
   
</div>
</form>
@endsection
<script>
    function gantifoto(){
   $("#filefotopengguna").click();
    }
 function readURL(input) {
     if (input.files && input.files[0]) {
         var reader = new FileReader();
 
         reader.onload = function (e) {
             $('#imageResult')
                 .attr('src', e.target.result);
         };
         reader.readAsDataURL(input.files[0]);
     }
 }
</script>
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
        <div class="col col-12 col-md-12">
            <img id="imageResult" src="{{asset('foto/dm/pengguna/'. $pengguna->foto)}}" style="width:250px;height:250px" class="rounded-circle shadow-4-strong" alt="">
        </div>
        <div class="col col-12 col-md-12">
            <a class="btn btn-warning mt-2" style="color:white" onclick="gantifoto()"><i class="fa fa-edit"></i>Ubah</a>
            <input onchange="readURL(this);" type="file" id="filefotopengguna" class="form-control @error('foto') is-invalid @enderror" name="foto" hidden>
            @error('foto')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </center>
    </div>
    <div class="col col-md-8 col-12 mt-4">
        <div class="form-group">
            <label for="Nama Pengguna">Nama Pengguna</label>
            <input type="text" value="{{$pengguna->name}}" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
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
            <label for="Jenis Identitas">Jenis Identitas</label>
            <select name="jenis_identitas" class="form-control">
                <option value="" selected disabled>-- Pilih Jenis Identitas --</option>
                <option value="NIP" @if($pengguna->jenis_identitas == "NIP") selected @endif>NIP</option>
                <option value="NIS" @if($pengguna->jenis_identitas == "NIS") selected @endif>NIS</option>
                <option value="NIM" @if($pengguna->jenis_identitas == "NIM") selected @endif>NIM</option>
            </select>
        </div>
        <div class="form-group">
            <label for="Nama Pengguna">Nomor Identitas</label>
            <input type="text" value="{{$pengguna->no_identitas}}" name="no_identitas" class="form-control">
        </div>
        <div class="form-group">
            <label for="Nama Pengguna">Nomor Whatsapp</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" zoomAndPan="magnify" viewBox="0 0 30 30.000001" height="20" preserveAspectRatio="xMidYMid meet" version="1.0" id="IconChangeColor"><defs><clipPath id="id1"><path d="M 2.128906 5.222656 L 27.53125 5.222656 L 27.53125 15 L 2.128906 15 Z M 2.128906 5.222656 " clip-rule="nonzero" id="mainIconPathAttribute"></path></clipPath><clipPath id="id2"><path d="M 2.128906 14 L 27.53125 14 L 27.53125 23.371094 L 2.128906 23.371094 Z M 2.128906 14 " clip-rule="nonzero" id="mainIconPathAttribute"></path></clipPath></defs><g clip-path="url(#id1)"><path fill="rgb(86.268616%, 12.159729%, 14.898682%)" d="M 24.703125 5.222656 L 4.957031 5.222656 C 3.398438 5.222656 2.132812 6.472656 2.132812 8.015625 L 2.132812 14.296875 L 27.523438 14.296875 L 27.523438 8.015625 C 27.523438 6.472656 26.261719 5.222656 24.703125 5.222656 Z M 24.703125 5.222656 " fill-opacity="1" fill-rule="nonzero" id="mainIconPathAttribute"></path></g><g clip-path="url(#id2)"><path fill="rgb(93.328857%, 93.328857%, 93.328857%)" d="M 27.523438 20.578125 C 27.523438 22.121094 26.261719 23.371094 24.703125 23.371094 L 4.957031 23.371094 C 3.398438 23.371094 2.132812 22.121094 2.132812 20.578125 L 2.132812 14.296875 L 27.523438 14.296875 Z M 27.523438 20.578125 " fill-opacity="1" fill-rule="nonzero" id="mainIconPathAttribute"></path></g></svg> +62</span>
                </div>
                <input type="text" class="form-control  @error('no_telepon') is-invalid @enderror" value="{{$pengguna->no_telepon}}" name="no_telepon" placeholder=" 822490254..." aria-label="Username" aria-describedby="basic-addon1">
                @error('no_telepon')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="container text-center mt-4">
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
   
</div>
</form>

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
@endsection
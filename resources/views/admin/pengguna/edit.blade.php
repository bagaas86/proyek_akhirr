@extends('layouts.template')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Edit Data Master Pengguna</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{URL::previous()}}">Data Master Pengguna</a></li>
                    <li class="breadcrumb-item"><a href="#!">Edit Data Master pengguna</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session()->get('error')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
@endif
<div class="card">
    <div class="xformdm">
        <center>
            <h5>Edit Data Master Pengguna</h5>
        </center>
        <div class="form mt-4">
            <form enctype="multipart/form-data" action="{{route('dm.pengguna.update', $pengguna->id)}}" method="POST" >
                @csrf
                <div class="row">
                    <div class="col col-md-12 col-12">
                        <div class="form-group">
                            <label for="nama_barang">Nama Pengguna</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukkan Nama Pengguna" value="{{$pengguna->name}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                    </div>

                    <div class="col col-md-7 col-12">
                        <div class="form-group">
                            <label for="nama_barang">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Masukkan Username" value="{{$pengguna->username}}">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                    </div>
                    
                    <div class="col col-md-5 col-12">
                        <div class="form-group">
                            <label for="password">Password <small style="color:red;font-size:10px;">Masukkan Password Baru Jika Ingin Mengubah</small> </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan Password" value="">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                    </div>
                    <div class="col col-md-6 col-12">
                        <div class="form-group">
                            <label for="level">Bagian/Unit</label>
                            <select name="id_unit" class="form-control @error('id_unit') is-invalid @enderror">
                                <option value="" selected disabled>-- Pilih Bagian/Unit --</option>
                                @foreach($unit as $data)
                                <option value="{{old('id_unit', $data->id_unit)}}" @if($pengguna->id_unit == $data->id_unit) selected @endif>{{$data->nama_unit}}</option>
                                @endforeach
                            </select>
                            @error('id_unit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col col-md-3 col-12">
                        <div class="form-group">
                            <label for="level">Level Akun</label>
                            <select name="level" class="form-control @error('level') is-invalid @enderror"  id="sebagai" onchange="jabatan()" >
                                {{-- <option value="" selected disabled>-- Pilih Level Akun --</option> --}}
                                {{-- <option value="Wadir 1" @if(old('level')== "Wadir 1") selected @endif>Wakil Direktur 1</option>
                                <option value="Wadir 2" @if(old('level')== "Wadir 2") selected @endif>Wakil Direktur 2</option>
                                <option value="Kabag" @if(old('level')== "Kabag") selected @endif>Kepala Bagian</option> --}}
                                <option value="Normal" @if($pengguna->level == "Normal") selected @endif>Normal</option>
                                <option value="Dosen" @if($pengguna->level == "Dosen") selected @endif>Dosen/Staff</option>
                                <option value="Ormawa" @if($pengguna->level == "Ormawa") selected @endif>Ormawa</option>
                                
                            </select>
                            @error('level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    


                    <div class="col col-md-3 col-12">
                        <div class="form-group">
                            <label for="level">Sebagai</label>
                            <select  style="display:none" id="unitOrmawa" name="sebagai" class="form-control @error('sebagai') is-invalid @enderror">
                                <option value="" selected disabled>-- Pilih Jabatan --</option>
                                <option value="Ketua" @if($pengguna->sebagai == "Ketua") selected @endif >Ketua</option>
                                <option value="Pengurus" @if($pengguna->sebagai == "Pengurus") selected @endif>Pengurus</option>
                                <option value="Anggota" @if($pengguna->sebagai == "Anggota") selected @endif>Anggota</option>
                            </select>
                            <select  style="display:none" id="unitDosen" name="sebagai" class="form-control @error('sebagai') is-invalid @enderror">
                                <option value="" selected disabled>-- Pilih Jabatan --</option>
                                <option value="Ketua" @if($pengguna->sebagai == "Ketua") selected @endif >Ketua</option>
                                <option value="Dosen" @if($pengguna->sebagai == "Dosen") selected @endif>Dosen</option>
                                <option value="Staff" @if($pengguna->sebagai == "Staff") selected @endif>Staff</option>
                            </select>
                            <select  style="display:none" id="unitNormal" name="sebagai" class="form-control @error('sebagai') is-invalid @enderror">
                                <option value="" selected disabled>-- Pilih Jabatan --</option>
                                <option value="Wadir 1" @if($pengguna->sebagai == "Wadir 1") selected @endif>Wakil Direktur 1</option>
                                <option value="Wadir 2" @if($pengguna->sebagai == "Wadir 2") selected @endif>Wakil Direktur 2</option>
                                <option value="Kabag" @if($pengguna->sebagai == "Kabag") selected @endif>Kabag</option>
                                <option value="Staff Umum" @if($pengguna->sebagai == "Staff Umum") selected @endif>Staff</option>
                            </select>
                            @error('sebagai')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                  
                    <div class="col col-md-12 col-12">
                        <div class="form-group">
                            <label for="foto">Foto Profil</label>
                           <input type="file" class="form-control" name="foto" value="{{old('foto')}}">
                        </div>
                    </div>
                </div>
              
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
            </form>
        </div>
      
    </div>
</div>


<script>
      $(document).ready(function () {
        function jabatan()
    {
        var sebagai = $("#sebagai").val();
        if(sebagai == "Ormawa"){
            document.getElementById("unitDosen").style.display="none";
             document.getElementById("unitOrmawa").style.display="block";
             document.getElementById("unitNormal").style.display="none";

        }
        if(sebagai == "Dosen")
        {
            document.getElementById("unitOrmawa").style.display="none";
            document.getElementById("unitDosen").style.display="block";
            document.getElementById("unitNormal").style.display="none";
        }

        if(sebagai == "Normal")
        {
            document.getElementById("unitOrmawa").style.display="none";
            document.getElementById("unitDosen").style.display="none";
            document.getElementById("unitNormal").style.display="block";
        }
     
    }
});
</script>

@endsection



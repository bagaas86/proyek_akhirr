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
                    {{-- <div class="col col-md-6 col-12">
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
                    </div> --}}

                    <div class="col col-md-3 col-12">
                        <div class="form-group">
                            <label for="level">Level Akun</label>
                            <select name="sebagai" id="select2" class="form-control @error('sebagai') is-invalid @enderror" >
                                @foreach($sebagai as $data)
                                <option value="{{$data->sebagai}}" @if($data->sebagai == $pengguna->sebagai) selected @endif>{{$data->sebagai}}</option>
                                @endforeach
                                
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
    $(document).ready(function() {
    $('#select2').select2();
});
  
</script>
@endsection



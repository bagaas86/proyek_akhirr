@extends('layouts.template')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Create Data Master Kendaraan</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{URL::previous()}}">Data Master Kendaraan</a></li>
                    <li class="breadcrumb-item"><a href="#!">Create Data Master Kendaraan</a></li>
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
            <h5>Tambah Data Master Kendaraan</h5>
        </center>
        <div class="form mt-4">
            <form enctype="multipart/form-data" action="{{route('dm.kendaraan.store')}}" method="POST" >
                @csrf
                <input type="text" value="{{$id_item}}" name="id_item" hidden>
                <div class="row">
                    <div class="col col-md-7 col-12">
                        <div class="form-group">
                            <label for="nama_barang">Merk Kendaraan</label>
                            <input type="text" class="form-control @error('nama_item') is-invalid @enderror" id="nama_item" name="nama_item" placeholder="Masukkan Merk Kendaraan" value="{{old('nama_item')}}">
                            @error('nama_item')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col col-md-5 col-12">
                        <div class="form-group">
                            <label for="level">Tipe Kendaraan</label>
                            <select name="tipe_kendaraan" class="form-control @error('tipe_kendaraan') is-invalid @enderror">
                                <option value="" selected disabled>-- Pilih Tipe Kendaraan --</option>
                                <option value="Kendaraan Bermotor Roda 4" @if(old('tipe_kendaraan')== "Kendaraan Bermotor Roda 4") selected @endif>Kendaraan Bermotor Roda 4</option>
                                <option value="Kendaraan Bermotor Roda 2" @if(old('tipe_kendaraan')== "Kendaraan Bermotor Roda 2") selected @endif>Kendaraan Bermotor Roda 2</option>
                                
                            </select>
                            @error('tipe_kendaraan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col col-md-7 col-12">
                        <div class="form-group">
                            <label for="nama_barang">Warna Kendaraan</label>
                            <input type="text" class="form-control @error('warna_kendaraan') is-invalid @enderror" id="warna_kendaraan" name="warna_kendaraan" placeholder="Masukkan Warna Kendaraan" value="{{old('warna_kendaraan')}}">
                            @error('warna_kendaraan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                    </div>
                    <div class="col col-md-2 col-12">
                        <div class="form-group">
                            <label for="password">Plat Nomor</label>
                            <input type="text" class="form-control @error('plat_kendaraan') is-invalid @enderror" id="plat_kendaraan" name="plat_kendaraan" placeholder="Masukkan Plat Nomor Kendaraan" value="{{old('plat_kendaraan')}}">
                            @error('plat_kendaraan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                    </div>
                    <div class="col col-md-3 col-12">
                        <div class="form-group">
                            <label for="level">Kondisi Kendaraan</label>
                            <select name="kondisi_item" class="form-control @error('kondisi_item') is-invalid @enderror">
                                <option value="" selected disabled>-- Pilih Kondisi Kendaraan --</option>
                                <option value="Ready" @if(old('kondisi_item')== "Ready") selected @endif>Siap Digunakan</option>
                                <option value="Rusak" @if(old('kondisi_item')== "Rusak") selected @endif>Rusak</option>
                            </select>
                            @error('kondisi_item')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col col-md-12 col-12">
                        <div class="form-group">
                            <label for="password">Informasi Tambahan</label>
                            <input type="text" class="form-control @error('deskripsi_item') is-invalid @enderror" id="deskripsi_item" name="deskripsi_item" placeholder="Masukkan Informasi Tambahan" value="{{old('deskripsi_item')}}">
                            @error('deskripsi_item')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                    </div>
                    <div class="col col-md-12 col-12">
                        <div class="form-group">
                            <label for="foto">Foto Kendaraan</label>
                           <input type="file" class="form-control" name="foto_item" value="{{old('foto_item')}}">
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
@endsection



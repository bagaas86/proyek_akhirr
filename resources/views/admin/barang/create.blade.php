@extends('layouts.template')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Create Data Master Barang</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{URL::previous()}}">Data Master Barang</a></li>
                    <li class="breadcrumb-item"><a href="#!">Create Data Master Barang</a></li>
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
            <h5>Tambah Data Master Barang</h5>
        </center>
        <div class="form mt-4">
            <form enctype="multipart/form-data" action="{{route('dm.barang.store')}}" method="POST" >
                @csrf
                <input type="text" name="id_item" value="{{$id_item}}" hidden>
                <div class="row">
                    <div class="col col-md-6 col-12">
                        <div class="form-group">
                            <label for="nama_item">Nama Barang</label><small style="color:red;font-size:12px">*</small>
                            <input type="text" class="form-control @error('nama_item') is-invalid @enderror" id="nama_item" name="nama_item" placeholder="Masukkan Nama Barang" value="{{old('nama_item')}}">
                            @error('nama_item')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                    </div>
                    <div class="col col-md-4 col-12">
                        <div class="form-group">
                            <label for="jumlah_barang">Lokasi Barang</label><small style="color:red;font-size:12px">*</small>
                            <select name="lokasi_item" class="form-control @error('lokasi_item') is-invalid @enderror">
                                <option value="" selected disabled>-- Pilih Lokasi Barang --</option>
                                <option value="Kampus 1" @if(old('lokasi_item')== "Kampus 1") selected @endif>Kampus 1</option>
                                <option value="Kampus 2" @if(old('lokasi_item')== "Kampus 2") selected @endif>Kampus 2</option>
                                <option value="Kampus 1 & 2" @if(old('lokasi_item') == "Kampus 1 & 2") selected @endif>Kampus 1 & 2</option>
                            </select>
                            @error('lokasi_item')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col col-md-2 col-12">
                        <div class="form-group">
                            <label for="jumlah_item">Jumlah Barang</label><small style="color:red;font-size:12px">*</small>
                            <input type="number" class="form-control @error('jumlah_item') is-invalid @enderror" id="jumlah_item" name="jumlah_item" placeholder="Jumlah Barang" value="{{old('jumlah_item')}}">
                            @error('jumlah_item')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                     
                    </div>
                    <div class="col col-md-8 col-12">
                        <div class="form-group">
                            <label for="deskripsi_item">Deskripsi Barang</label><small style="color:red;font-size:12px">*</small>
                            <textarea type="number" class="form-control @error('deskripsi_item') is-invalid @enderror" id="deskripsi_item" name="deskripsi_item" placeholder="Deskripsi Barang...">{{old('deskripsi_item')}}</textarea>
                            @error('deskripsi_item')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col col-md-4 col-12">
                        <div class="form-group">
                            <label for="deskripsi_barang">Kondisi Barang</label><small style="color:red;font-size:12px">*</small>
                            <select name="kondisi_item" class="form-control @error('kondisi_item') is-invalid @enderror">
                                <option value="" selected disabled>-- Pilih Kondisi Barang --</option>
                                <option value="Ready" @if(old('kondisi_item') == "Ready") selected @endif>Baik</option>
                                <option value="Rusak" @if(old('kondisi_item') == "Rusak") selected @endif>Rusak</option>
                            </select>
                            @error('kondisi_item')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col col-md-6 col-12">
                        <div class="form-group">
                            <label for="deskripsi_barang">Foto Barang</label>
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



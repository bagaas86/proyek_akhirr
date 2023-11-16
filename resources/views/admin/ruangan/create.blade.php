@extends('layouts.template')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Create Data Master Ruangan</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::previous() }}">Data Master Ruangan</a></li>
                        <li class="breadcrumb-item"><a href="#!">Create Data Master Ruangan</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session()->get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
    @endif
    <div class="card">
        <div class="xformdm">
            <center>
                <h5>Tambah Data Master Ruangan</h5>
            </center>
            <div class="form mt-4">
                <form enctype="multipart/form-data" action="{{ route('dm.ruangan.store') }}" method="POST">
                    @csrf
                    <input type="text" name="id_item" value="{{ $id_item }}" hidden>
                    <div class="row">
                        <div class="col col-md-6 col-12">
                            <div class="form-group">
                                <label for="nama_item">Nama Ruangan</label><small style="color:red;font-size:12px">*</small>
                                <input type="text" class="form-control @error('nama_item') is-invalid @enderror"
                                    id="nama_item" name="nama_item" placeholder="Masukkan Nama Ruangan"
                                    value="{{ old('nama_item') }}">
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
                                <label for="jumlah_barang">Lokasi Ruangan</label><small
                                    style="color:red;font-size:12px">*</small>
                                <select name="lokasi_item" class="form-control @error('lokasi_item') is-invalid @enderror">
                                    <option value="" selected disabled>-- Pilih Lokasi Ruangan --</option>
                                    <option value="Kampus 1" @if (old('lokasi_item') == 'Kampus 1') selected @endif>Kampus 1
                                    </option>
                                    <option value="Kampus 2" @if (old('lokasi_item') == 'Kampus 2') selected @endif>Kampus 2
                                    </option>
                                    {{-- <option value="Kampus 1 & 2" @if (old('lokasi_item') == 'Kampus 1 & 2') selected @endif>Kampus 1 & 2</option> --}}
                                </select>
                                @error('lokasi_item')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col col-md-8 col-12">
                            <div class="form-group">
                                <label for="deskripsi_item">Deskripsi Ruangan</label><small
                                    style="color:red;font-size:12px">*</small>
                                <textarea type="number" class="form-control @error('deskripsi_item') is-invalid @enderror" id="deskripsi_item"
                                    name="deskripsi_item" placeholder="Deskripsi Ruangan...">{{ old('deskripsi_item') }}</textarea>
                                @error('deskripsi_item')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="col col-md-4 col-12">
                            <div class="form-group">
                                <label for="deskripsi_barang">Kondisi Ruangan</label><small
                                    style="color:red;font-size:12px">*</small>
                                <select name="kondisi_item"
                                    class="form-control @error('kondisi_item') is-invalid @enderror">
                                    <option value="" selected disabled>-- Pilih Kondisi Ruangan --</option>
                                    <option value="Ready" @if (old('kondisi_item') == 'Ready') selected @endif>Siap Digunakan
                                    </option>
                                    <option value="Renovasi" @if (old('kondisi_item') == 'Renovasi') selected @endif>Renovasi
                                    </option>
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
                                <label for="deskripsi_barang">Foto Ruangan</label>
                                <input type="file" class="form-control @error('foto_item') is-invalid @enderror"
                                    name="foto_item" value="{{ old('foto_item') }}">
                                @error('foto_item')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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

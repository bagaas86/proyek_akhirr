@extends('layouts.template')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Pengaturan</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Pengaturan</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session()->get('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
@endif
<div class="row">
    <div class="col col-md-12 col-12">
        <div class="card">
            <div class="xformdm">
                <center>
                    <h5>Pengaturan</h5>
                </center>

                <form enctype="multipart/form-data" action="{{route('pengaturan.simpan')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="form mt-4">
                    <h5>Wakil Direktur 2</h5>
                    <div class="row">
                        <div class="col col-md-12">
                            <div class="col col-md-12 col-12">
                                <div class="form-group">
                                    <label for="nama_item">Nama </label>
                                    <select name="id_wadir2"  class="form-control @error('id_wadir2') is-invalid @enderror">
                                        <option value="" selected disabled>Pilih Wakil Direktur 2</option>
                                    @foreach($wadir2 as $jabatan)
                                    <option value="{{$jabatan->id}}" @if($index->id_wadir2 == $jabatan->id) selected @endif >{{$jabatan->name}}</option>
                                    @endforeach
                                    </select>
                                    @error('id_wadir2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                   
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col col-md-4 col-12">
                            <div class="col col-md-12 col-12">
                                <div class="form-group">
                                    <a class="btn btn-warning" style="color: white" onclick="gantifoto4()"><i class="fa fa-edit"></i>Ubah Tanda Tangan</a>
                                </div>
                                <input onchange="readURL4(this);" type="file" class="form-control" name="ttd_wadir2" id="ttd_wadir2" hidden>
                               
                                <img id="imageResult4" style="width:40%;height:40%;"  class="img-thumbnail btn" src="{{asset('foto/dm/barang/nbarang.png')}}">
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="form mt-4">
                        <h5>Kepala Bagian</h5>
                        <div class="row">
                            <div class="col col-md-8">
                                <div class="col col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="nama_item">Nama </label>
                                        <select name="id_kepala_bagian"  class="form-control @error('id_kepala_bagian') is-invalid @enderror">
                                            <option value="" selected disabled>Pilih Kepala Bagian</option>
                                        @foreach($kepala_bagian as $kabag)
                                        <option value="{{$kabag->id}}" @if($index->id_kepala_bagian == $kabag->id) selected @endif>{{$kabag->name}}</option>
                                        @endforeach
                                        </select>
                                        @error('id_kepala_bagian')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                       
                                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-4 col-12">
                                <div class="col col-md-12 col-12">
                                    <center>
                                        <div class="form-group">
                                            <a class="btn btn-warning" style="color: white" onclick="gantifoto2()"><i class="fa fa-edit"></i>Ubah Tanda Tangan</a>
                                        </div>
                                    </center>
                                    <input onchange="readURL2(this);" type="file" class="form-control @error('ttd_kabag') is-invalid @enderror" name="ttd_kabag" id="ttd_kabag" hidden>
                                    @error('ttd_kabag')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    @if($index->ttd_kabag <> null)
                                    <img id="imageResult2" style="width:250px;height:200px;"  class="img-thumbnail" src="{{asset('foto/ttd/'. $index->ttd_kabag)}}">
                                    @else
                                    <img id="imageResult2" style="width:250px;height:200px;"  class="img-thumbnail" src="{{asset('foto/ttd/default.png')}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>

                <div class="form mt-4">
                    <h5>Staff Umum</h5>
                    <div class="row">
                        <div class="col col-md-8">
                            <div class="col col-md-12 col-12">
                                <div class="form-group">
                                    <label for="nama_item">Nama </label>
                                    <select name="id_bagian_umum"  class="form-control @error('id_bagian_umum') is-invalid @enderror">
                                        <option value="" selected disabled>Pilih Staff Umum</option>
                                    @foreach($bagian_umum as $umum)
                                    <option value="{{$umum->id}}" @if($index->id_bagian_umum == $umum->id) selected @endif>{{$umum->name}}</option>
                                    @endforeach
                                    </select>
                                    @error('id_bagian_umum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                   
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-4 col-12">
                            <div class="col col-md-12 col-12">
                                <center>
                                    <div class="form-group">
                                        <a class="btn btn-warning" style="color: white" onclick="gantifoto()"><i class="fa fa-edit"></i>Ubah Tanda Tangan</a>
                                    </div>
                                </center>
                                <input onchange="readURL(this);" type="file" class="form-control @error('ttd_bagian_umum') is-invalid @enderror" name="ttd_bagian_umum" id="ttd_bagian_umum" hidden>
                                @error('ttd_bagian_umum')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @if($index->ttd_bagian_umum <> null)
                                <img id="imageResult" style="width:250px;height:200px;"  class="img-thumbnail" src="{{asset('foto/ttd/'. $index->ttd_bagian_umum)}}">
                                @else
                                <img id="imageResult" style="width:250px;height:200px;"  class="img-thumbnail" src="{{asset('foto/ttd/default.png')}}">
                                @endif

                            </div>
                        </div>
                    </div>
            </div>


                <div class="form mt-4">
                    <h5>Pengelola Supir</h5>
                    <div class="row">
                        <div class="col col-md-8">
                            <div class="col col-md-12 col-12">
                                <div class="form-group">
                                    <label for="nama_item">Nama</label>
                                    <select name="id_pengelola_supir"  class="form-control @error('id_pengelola_supir') is-invalid @enderror">
                                        <option value="" selected disabled>Pilih Pengelola Supir</option>
                                    @foreach($supir as $jabatan)
                                    <option value="{{$jabatan->id}}" @if($index->id_pengelola_supir == $jabatan->id) selected @endif>{{$jabatan->name}}</option>
                                    @endforeach
                                    </select>
                                    @error('id_pengelola_supir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                   
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-4 col-12">
                            <div class="col col-md-12 col-12">
                                <center>
                                    <div class="form-group">
                                        <a class="btn btn-warning" style="color: white" onclick="gantifoto5()"><i class="fa fa-edit"></i>Ubah Tanda Tangan</a>
                                    </div>
                                </center>
                                <input onchange="readURL5(this);" type="file" class="form-control @error('ttd_pengelola_supir') is-invalid @enderror" name="ttd_pengelola_supir" id="ttd_pengelola_supir" hidden>
                                @error('ttd_pengelola_supir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @if($index->ttd_pengelola_supir <> null)
                                <img id="imageResult5" style="width:250px;height:200px;"  class="img-thumbnail" src="{{asset('foto/ttd/'. $index->ttd_pengelola_supir)}}">
                                @else
                                <img id="imageResult5" style="width:250px;height:200px;"  class="img-thumbnail" src="{{asset('foto/ttd/default.png')}}">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
  
</div>

@endsection

<script>

function gantifoto(){
   $("#ttd_bagian_umum").click();
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


    function gantifoto2(){
   $("#ttd_kabag").click();
    }
 function readURL2(input) {
     if (input.files && input.files[0]) {
         var reader = new FileReader();
 
         reader.onload = function (e) {
             $('#imageResult2')
                 .attr('src', e.target.result);
         };
         reader.readAsDataURL(input.files[0]);
     }
 }

 function gantifoto5(){
   $("#ttd_pengelola_supir").click();
    }
 function readURL5(input) {
     if (input.files && input.files[0]) {
         var reader = new FileReader();
 
         reader.onload = function (e) {
             $('#imageResult5')
                 .attr('src', e.target.result);
         };
         reader.readAsDataURL(input.files[0]);
     }
 }
</script>



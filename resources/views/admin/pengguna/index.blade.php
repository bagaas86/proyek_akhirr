@extends('layouts.template')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">List Data Master Pengguna Sistem</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Data Master Pengguna</a></li>
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
@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session()->get('error')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  @foreach($errors->all() as $error)
  {{$error}}
  @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
@endif



<div class="card">
    <div class="xtabledm">
        <a href="{{route('dm.pengguna.create')}}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-plus"></i>Tambah Pengguna</a>
        <a href="#" class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#import1"><i class="fa fa-plus"></i>Import Pengguna</a>
        <table id="myTable2" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Foto</th>
                    <th>Username</th>
                    <th>Sebagai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengguna as $data)
                <tr>
                    <td></td>
                    <td id="name">{{$data->name}}</td>
                    <td style="width:10%"><img src="{{asset('foto/dm/pengguna/'. $data->foto)}}" class="img-radius" style="width:50px;height:50px;" alt=""></td>
                    <td>{{$data->username}}</td>
                    <td>
                        <i class="badge bg-success">{{$data->sebagai}}</i>
                    </td>
                    <td>
                        <a href="{{route('dm.pengguna.edit', $data->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="#"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$data->id}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- Modal Delete--}}
@foreach($pengguna as $data)
<div id="delete{{$data->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <center>
                    <img src="{{asset('foto/dm/pengguna/'. $data->foto)}}" style="width:25%" alt="">
                </center>
                <hr>
                <p class="mb-0" id="page">Apakah Anda Yakin Menghapus Pengguna <b>{{$data->name}}</b>?</p>
            </div>
            <div id="modalFooter" class="modal-footer">
                <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>
                <a style="color:white" href="{{route('dm.pengguna.destroy', $data->id)}}" class="btn  btn-primary">Hapus</a>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- endModal Delete --}}




<div id="import1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Import Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('dm.pengguna.import1')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
               <input type="file" name="excel" id="excel" class="form-control">
               <span id="errorExcel" style="color: red;display:none;">Bidang ini harap diisi</span>
            </div>
            <div id="modalFooter" class="modal-footer">
                <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>
                <button id="send" type="submit" class="btn  btn-success" hidden>Import</button>
            </form>
                <a style="color:white" onclick="confirm()" class="btn  btn-success">Import</a>
            </div>
           
        </div>
    </div>
</div>

{{-- endModal Delete --}}
@endsection
@section('script')
<script>
    $(document).ready(function () {
     var t = $('#myTable2').DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        stateSave: true,
        columnDefs: [
             {
                 searchable: false,
                 orderable: false,
                 targets: 0,
             },
         ],
         order: [[1, 'asc']],

    });

    t.on('order.dt search.dt', function () {
         let i = 1;
  
         t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
             this.data(i++);
         });
     }).draw();
 });

 </script>

 <script>
     function confirm()
    {
        var excel = $("#excel").val()
        if(excel == "")
        {
          document.getElementById('errorExcel').style.display="block";
        }else{
            document.getElementById("send").click()
        }
    }
 </script>

 
@endsection

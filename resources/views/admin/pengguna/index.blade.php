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
<div class="card">
    <div class="xtabledm">
        <a href="{{route('dm.pengguna.create')}}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-plus"></i>Tambah Pengguna</a>
        <table id="myTable2" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Foto</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengguna as $data)
                <tr>
                    <td></td>
                    <td id="name">{{$data->name}}</td>
                    <td style="width:10%"><img src="{{asset('foto/dm/pengguna/'. $data->foto)}}" class="img-rounded" style="width:50%" alt=""></td>
                    <td>{{$data->username}}</td>
                    <td style="color:white">
                        @if($data->level == "Dosen")
                        <i class="badge bg-warning">Dosen</i>
                        @elseif($data->level == "Ormawa")
                        <i class="badge bg-primary">Ormawa</i>
                        @elseif($data->level == "Wadir 1")
                        <i class="badge bg-success">Wakil Direktur 1</i>
                        @elseif($data->level == "Wadir 2")
                        <i class="badge bg-success">Wakil Direktur 2</i>
                        @elseif($data->level == "Kabag")
                        <i class="badge bg-secondary">Kepala Bagian</i>
                        @endif
                    </td>
                    <td>
                        <a href="" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
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
@endsection

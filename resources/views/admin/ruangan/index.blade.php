@extends('layouts.template')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">List Data Master Ruangan</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Data Master Ruangan</a></li>
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
        <a href="{{route('dm.ruangan.create')}}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-plus"></i>Tambah Ruangan</a>
        <table id="ruangan" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Ruangan</th>
                    <th>Foto Ruangan</th>
                    <th>Kondisi Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($item as $data)
                <tr>
                    <td style="width:5%"></td>
                    <td id="name">{{$data->nama_item}}</td>
                    <td style="width:10%"><img src="{{asset('foto/dm/ruangan/'. $data->foto_item)}}" class="img-rounded" style="width:50%" alt=""></td>
                    <td>  
                        @if($data->kondisi_item == "Ready")
                        <i class="badge bg-success">Siap Digunakan</i>
                        @elseif($data->kondisi_item == "Renovasi")
                        <i class="badge bg-danger">Renovasi</i>
                        @endif
                    </td>
                    <td>
                        <a href="" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="{{route('dm.ruangan.edit', $data->id_item)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="#"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$data->id_item}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- Modal Delete--}}
@foreach($item as $data)
<div id="delete{{$data->id_item}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Ruangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <center>
                    <img src="{{asset('foto/dm/ruangan/'. $data->foto_item)}}" style="width:25%" alt="">
                </center>
                <hr>
                <p class="mb-0" id="page">Apakah Anda Yakin Menghapus Ruangan <b>{{$data->nama_item}}</b>?</p>
            </div>
            <div id="modalFooter" class="modal-footer">
                <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>
                <a style="color:white" href="{{route('dm.ruangan.destroy', $data->id_item)}}" class="btn  btn-primary">Hapus</a>
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
     var t = $('#ruangan').DataTable({
         columnDefs: [
             {
                 searchable: false,
                 orderable: false,
                 targets: 0,
             },
         ],
         order: [[1, 'asc']],
         stateSave:true,
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

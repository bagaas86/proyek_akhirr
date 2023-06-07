@extends('layouts.template')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">List Data Master Unit Politeknik Negeri Subang</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Data Master Unit</a></li>
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
        <a href="#" onclick="modalCreate()" class="btn btn-primary btn-sm mb-2"><i class="fa fa-plus"></i>Tambah Unit</a>
        <table id="unit" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Unit</th>
                    <th>Jenis Unit</th>
                    <th>Status Unit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($unit as $data)
                <tr>
                    <td></td>
                    <td id="name">{{$data->nama_unit}}</td>
                    <td>{{$data->jenis_unit}}</td>
                    <td style="color:white">
                        @if($data->status_unit == "Aktif")
                        <i class="badge bg-success">Aktif</i>
                        @elseif($data->status_unit == "Tidak Aktif")
                        <i class="badge bg-danger">Tidak Aktif</i>
                        @endif
                    </td>
                    <td>
                        <a href="#" onclick="modalEdit({{$data->id_unit}})" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="#"  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- Modal --}}
<div id="exampleModalCenter2" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle2">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="mb-0" id="page2"></p>
            </div>
            <div id="modalFooter2" class="modal-footer">
             
            </div>
        </div>
    </div>
</div>
{{-- endModal --}}
@endsection

@section('script')
<script>
    $(document).ready(function () {
     var t = $('#unit').DataTable({
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
     function modalCreate() 
    {
             $.get("{{ url('dm/unit/create') }}", {}, function(data, status){
            $("#exampleModalCenterTitle2").html(`Detail Unit`)
            $("#page2").html(data);
            $("#modalFooter2").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>)`)
            $("#exampleModalCenter2").modal('show');
        })
    }

    function modalEdit(id_unit) 
    {
        $.get("{{ url('dm/unit/edit') }}/" + id_unit, {}, function(data, status){
            $("#exampleModalCenterTitle2").html(`Detail Unit`)
            $("#page2").html(data);
            $("#modalFooter2").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>)`)
            $("#exampleModalCenter2").modal('show');
        })
    }
 </script>
@endsection

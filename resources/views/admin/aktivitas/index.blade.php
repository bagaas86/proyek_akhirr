@extends('layouts.template')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Aktivitas Supir Politeknik Negeri Subang</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Data Aktivitas Supir</a></li>
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
        <a href="#" onclick="modalCreate()" class="btn btn-primary btn-sm mb-2"><i class="fa fa-plus"></i>Tambah Aktivitas</a>
        <table id="aktivitas" class="display" style="width:100%">
            <thead>
                <tr>
                 <th style="text-align:center; vertical-align:middle"  rowspan="2">No</th>
                  <th style="text-align:center; vertical-align:middle"  rowspan="2">Nama Supir</th>
                   <th style="text-align:center; vertical-align:middle"  rowspan="2">Nama Aktivitas</th>
                 <th style="text-align:center; vertical-align:middle" colspan="2">Aktivitas</th>
                </tr>
                  <tr>
                    <th>Mulai Aktivitas</th>
                     <th>Selesai Aktivitas</th>
                  </tr>
            </thead>
            <tbody>
                @foreach($aktivitas as $data)
                @php
                $mulai_aktivitas = date('d M Y H:i', strtotime($data->mulai_aktivitas));
                $selesai_aktivitas = date('d M Y H:i', strtotime($data->selesai_aktivitas));
                @endphp
                <tr>
                	<td></td>
                    <td style="width:20%">{{$data->nama_supir}}</td>
                    <td style="width:30%">{{$data->nama_aktivitas}}</td>
                    <td style="width:20%">{{$mulai_aktivitas}}</td>
                    <td style="width:20%">{{$selesai_aktivitas}}</td>
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
     var t = $('#aktivitas').DataTable({
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
             $.get("{{ url('supir/aktivitas/create') }}", {}, function(data, status){
            $("#exampleModalCenterTitle2").html(`Tambah Aktivitas Supir`)
            $("#page2").html(data);
            $("#modalFooter2").html(``)
            $("#exampleModalCenter2").modal('show');
        })
    }

    function modalEdit(id_unit) 
    {
        $.get("{{ url('supir/aktivitas/edit') }}/" + id_unit, {}, function(data, status){
            $("#exampleModalCenterTitle2").html(`Edit Aktivitas Supir`)
            $("#page2").html(data);
            $("#modalFooter2").html(``)
            $("#exampleModalCenter2").modal('show');
        })
    }

    function ubahStatus_Supir(id_supir) { 
        var status = $("#status"+id_supir).data("custom-value");
            $.ajax({
                type: "get",
                url: "{{ url('ubahstatussupir') }}/" + id_supir,
                data :{
                    'status' : status,
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
 </script>
@endsection

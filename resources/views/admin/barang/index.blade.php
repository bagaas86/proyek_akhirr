@extends('layouts.template')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">List Data Master Barang</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Data Master Barang</a></li>
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
        <a href="{{route('dm.barang.create')}}" class="btn btn-primary mb-2"><i class="fa fa-plus"></i>Tambah</a>
        <table id="myTable" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Foto Barang</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
        
                </tr>
            </thead>
            <tbody>
                @php
                $i=0;
                @endphp
                @foreach($item as $data)
                @php
                $i=$i+1;
                @endphp
                <tr>
                    <td></td>
                    <td style="width:25%">{{$data->nama_item}}</td>
                    <td style="width:10%"><img src="{{asset('foto/dm/barang/'. $data->foto_item)}}" class="img-rounded" style="width:50%" alt=""></td>
                    <td>{{$data->jumlah_item}}</td>
                    <td>
                        @if($data->kondisi_item == "Ready")
                        <i class="badge bg-success">Baik</i>
                        @elseif($data->kondisi_item == "Rusak")
                        <i class="badge bg-danger">Rusak</i>
                        @endif
                    </td>
                    <td style="width:20%">{{$data->lokasi_item}}</td>
                    <td>
                        <a href="{{route('dm.barang.detail', $data->id_item)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                        <a href="{{route('dm.barang.edit', $data->id_item)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <a href="#" onclick="modalDelete({{$data->id_item}})" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal --}}
<div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="mb-0" id="page"></p>
            </div>
            <div id="modalFooter" class="modal-footer">
             
            </div>
        </div>
    </div>
</div>
{{-- endModal --}}
@endsection

@section('script')
<script>
   $(document).ready(function () {
    var t = $('#myTable').DataTable({
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


<script>
    
        function modalDelete(id_item) {
            var url = "{{route('dm.barang.destroy', '')}}"+"/"+id_item;
                $("#exampleModalCenterTitle").html(`Hapus Barang?`)
                $("#page").html('Apakah Anda yakin Ingin Menghapus Barang?');
                $("#modalFooter").html(`
                <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>
                <a style="color:white" href="`+url+`"class="btn  btn-primary">Hapus</a>)`)
                $("#exampleModalCenter").modal('show');
        }
</script>
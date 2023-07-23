@extends('layouts.template')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Informasi BMN</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Informasi BMN</a></li>
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
        <table id="barang" class="display" style="width:100%;font-size:14px;">
            <thead>
                <tr>
                    <th style="width:5%">No</th>
                    <th style="width:30%">Nama Barang</th>
                    <th style="width:25%">Foto Barang</th>
                    <th style="width:40%">Aksi</th>
        
                </tr>
            </thead>
            <tbody>
                @foreach($item as $data)
                <tr>
                    <td></td>
                    <td id="name">{{$data->nama_item}}</td>
                    <td style="width:10%">
                        @if($data->kategori_item == "Barang")
                        <img src="{{asset('foto/dm/barang/'. $data->foto_item)}}" class="img-rounded" style="width:50px;height:50px" alt="">
                        @elseif($data->kategori_item == "Ruangan")
                        <img src="{{asset('foto/dm/ruangan/'. $data->foto_item)}}" class="img-rounded" style="width:50px;height:50px" alt="">
                        @elseif($data->kategori_item == "Kendaraan")
                        <img src="{{asset('foto/dm/kendaraan/'. $data->foto_item)}}" class="img-rounded" style="width:50px;height:50px" alt="">
                        @endif
                    </td>
                    <td>
                        <a href="{{route('info.detail', $data->id_item)}}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i>Lihat Info</a>
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
    var t = $('#barang').DataTable({
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
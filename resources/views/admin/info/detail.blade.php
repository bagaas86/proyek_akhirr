@extends('layouts.template')
@section('content')
<div class="page-header">
    <a class="btn btn-light btn-sm" href="{{URL::previous()}}"><i class="bi bi-arrow-90deg-left"></i></a>
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                 <h5 class="m-b-10">Detail Informasi BMN</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{URL::previous()}}">Informasi BMN</a></li>
                    <li class="breadcrumb-item"><a href="#!">Detail Informasi BMN</a></li>
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
            <h5>Informasi Peminjaman {{$identitas->nama_item}}</h5>
        </center>
        <div class="form mt-4">
           <div class="row">
                <div class="col col-md-12 col-12">
                    <table id="detail" class="display" style="width:100%;font-size:14px;">
                        <thead>
                            <tr style="vertical-align:top">
                                <th></th>
                                <th style="width:25%">Nama Barang</th>
                                <th style="width:30%">Nama Kegiatan</th>
                                <th>Jumlah</th>
                                <th>Awal Peminjaman</th>
                                <th>Selesai Peminjaman</th>
                              </tr>
                        </thead>
                      <tbody>
                        @foreach($keranjang as $item)
                        @php
                           $waktu_awal = date('d M Y H:i ', strtotime($item->waktu_awal));
                            $waktu_akhir = date('d M Y H:i', strtotime($item->waktu_akhir));
                        @endphp
                        <tr>
                            <td></td>
                            <td>{{$item->nama_item}}</td>
                            <td>{{$item->nama_kegiatan}}</td>
                            <td>{{$item->jumlah}}</td>
                            <td>{{$waktu_awal}} WIB</td>
                            <td>{{$waktu_akhir}} WIB</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
           </div>
        </div>
      
    </div>
</div>
@section('script')
<script>
   $(document).ready(function () {
    var t = $('#detail').DataTable({
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
@endsection



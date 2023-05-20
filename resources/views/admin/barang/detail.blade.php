@extends('layouts.template')
@section('content')
<div class="page-header">
    <a class="btn btn-light btn-sm" href="{{URL::previous()}}"><i class="bi bi-arrow-90deg-left"></i></a>
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                 <h5 class="m-b-10">Detail Data Master Barang</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{URL::previous()}}">Data Master Barang</a></li>
                    <li class="breadcrumb-item"><a href="#!">Detail Data Master Barang</a></li>
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
            <h5>Detail Data Master Barang</h5>
        </center>
        <div class="form mt-4">
           <div class="row">
                <div class="col col-md-8">
                    <table style="width:80%">
                        <tr style="vertical-align:top">
                            <td style="width:40%"><h6>Nama Barang</h6></td>
                            <td><h6>:</h6></td>
                            <td><h6 class="detailItem">{{$item->nama_item}}</h6></td>
                        </tr>
                        <tr style="vertical-align:top">
                            <td><h6>Lokasi Barang</h6></td>
                            <td><h6>:</h6></td>
                            <td><h6 class="detailItem">{{$item->lokasi_item}}</h6></td>
                        </tr>
                        <tr style="vertical-align:top">
                            <td><h6>Jumlah Barang</h6></td>
                            <td><h6>:</h6></td>
                            <td><h6 class="detailItem">{{$item->jumlah_item}} Unit</h6></td>
                        </tr>
                        <tr style="vertical-align:top">
                            <td><h6>Deskripsi Barang</h6></td>
                            <td><h6>:</h6></td>
                            <td><h6 class="detailItem">{{$item->deskripsi_item}}</h6></td>
                        </tr>
                        <tr style="vertical-align:top">
                            <td><h6>Kondisi Barang</h6></td>
                            <td><h6>:</h6></td>
                            <td>
                                @if($item->kondisi_item == "Ready")
                                <h5 style="color:green;font-weight:bold"><i class="bi bi-check"></i>Ready</h5>
                                @elseif($item->kondisi_item == "Rusak")
                                <h5 style="color:red;font-weight:bold"><i class="bi bi-x"></i>Rusak</h5>
                                @endif
                            </td>
                        </tr>
                      
                    </table>
                 
                </div>
                <div class="col col-md-4">
                    <img src="{{asset('foto/dm/barang/'. $item->foto_item)}}" class="img-rounded" style="width:50%" alt="">
                </div>
           </div>
        </div>
      
    </div>
</div>
@endsection



@extends('layouts.templateBaru')
@section('content')
@php
$waktu_pengajuan = date('d-m-Y h:i', strtotime($peminjaman->waktu_pengajuan));
$waktu_awal = date('d-m-Y h:i', strtotime($peminjaman->waktu_awal));
$waktu_akhir = date('d-m-Y h:i', strtotime($peminjaman->waktu_akhir));
$diff = Carbon\Carbon::parse($waktu_awal)->diffInDays(Carbon\Carbon::parse($waktu_akhir))                      
@endphp
<div class="container" style="color:black">
    <a style="margin-left:1em" href="{{route('history.index')}}" class="btn btn-primary btn-sm"><i class="bi bi-arrow-left-square"></i></a>
        <div class="col col-12 col-md-12">
            <div class="text-center title">
                <h3>Detail History Peminjaman Saya</h3>
            </div>
            <div class="row">
                <div class="col col-12 col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="header" style="text-align: center">
                                <h4>Detail Pengajuan</h4>
                            </div>
                            <div class="1">
                                <table>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:40%;font-weight:bold">Nama PJ</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:50%">{{$peminjaman->nama_pj}}</td>  
                                    </tr>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:40%;font-weight:bold">No. Identitas</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:50%">{{$peminjaman->no_identitas}}</td>  
                                    </tr>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:40%;font-weight:bold">Waktu Pengajuan</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:50%">{{$waktu_pengajuan}}</td>  
                                    </tr>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:40%;font-weight:bold">Waktu Peminjaman</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:50%">{{$waktu_awal}} s/d {{$waktu_akhir}}</td>  
                                    </tr>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:40%;font-weight:bold">Lama Peminjaman</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:50%">
                                            @if ($diff == 0)
                                            1 Hari
                                            @else
                                            {{$diff = Carbon\Carbon::parse($waktu_awal)->diffInDays(Carbon\Carbon::parse($waktu_akhir))}} Hari
                                             @endif
                                        </td>  
                                    </tr>
                                </table> 
                            </div>  
                        </div>
                    </div>
                </div>
            <div class="col col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="header" style="text-align: center">
                            <h4>List Pengajuan Peminjaman</h4>
                        </div>
                        <div class="table">
                            <table>
                                <tr style="border-bottom:1pt solid rgb(205, 205, 205);">
                                    <th style="width:70%">Nama Item</th>
                                    <th style="width:10%">Kategori</th>
                                    <th style="width:15%">Jumlah</th>  
                                </tr>
                                @foreach($keranjang as $data)
                                <tr style="height:30px">
                                    <td style="width:70%">{{$data->nama_item}}</td>
                                    <td style="width:70%">{{$data->kategori_item}}</td>
                                    <td style="width:15%">{{$data->jumlah}}</td>
                                </tr>
                                @endforeach
                            </table> 
                        </div>  
                    </div>
                </div>
            </div>
            
        </div>

    </div>
</div>
@endsection


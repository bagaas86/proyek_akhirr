@php
$waktu_pengajuan = date('d-m-Y H:i', strtotime($peminjaman->waktu_pengajuan));
$waktu_awal = date('d-m-Y H:i', strtotime($peminjaman->waktu_awal));
$waktu_akhir = date('d-m-Y H:i', strtotime($peminjaman->waktu_akhir));
$diff = Carbon\Carbon::parse($waktu_awal)->diffInDays(Carbon\Carbon::parse($waktu_akhir));
$lama = $diff+1;                      
@endphp
<div class="container" style="color:black">
        <div class="col col-12 col-md-12 mt-4">
            <div style="color:white" class="text-center title">
              <h3>Detail Peminjaman</h3>
            </div>
            <div class="row">
                <div class="col col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="header" style="text-align: center">
                                <h5>Detail Pengajuan</h5>
                            </div>
                            <div class="1">
                                <table>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:40%;font-weight:bold">Nama PJ</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:50%">{{$peminjaman->nama_pj}}</td>  
                                    </tr>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:40%;font-weight:bold">Unit/Organisasi</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:50%">{{$peminjaman->sebagai}}</td>  
                                    </tr>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:40%;font-weight:bold">No. Identitas</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:50%">{{$peminjaman->no_identitas}}</td>  
                                    </tr>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:40%;font-weight:bold">Nama Kegiatan</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:50%">{{$peminjaman->nama_kegiatan}}</td>  
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
                                            {{$lama}} Hari
                                             @endif
                                        </td>  
                                    </tr>
                                </table> 
                            </div>  
                        </div>
                    </div>
                </div>
            <div class="col col-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header" style="text-align: center">
                            <h5>List Pengajuan Peminjaman</h5>
                        </div>
                        <div class="table">
                            <table>
                                <tr style="border-bottom:1px solid rgb(0, 0, 0);font-size:14px">
                                    <th style="width:70%">Nama BMN</th>
                                    <th style="width:10%">Kategori</th>
                                    <th style="width:15%">Jumlah</th>  
                                </tr>
                                @foreach($keranjang as $data)
                                <tr style="font-size:14px">
                                    <td style="width:70%">{{$data->nama_item}}</td>
                                    <td style="width:70%">{{$data->kategori_item}}</td>
                                    <td style="width:15%">{{$data->jumlah}}</td>
                                </tr>
                                @endforeach
                            </table> 
                        </div>
                        @if($peminjaman->jenis_peminjaman == "Barang,Ruangan,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Barang,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Ruangan,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Kendaraan,Supir")
                        <div class="table mt-4">
                            <table style="width:100%">
                                <tr style="border-bottom:1px solid rgb(0, 0, 0);font-size:14px">
                                    <th style="width:70%">Nama Supir</th>
                                    <th style="width:30%">Umur</th> 
                                </tr>
                                @foreach($supir as $data)
                                <tr style="font-size:14px">
                                    <td style="width:70%">{{$data->nama_supir}}</td>
                                    <td style="width:30%">{{$data->umur_supir}} Tahun</td>
                                </tr>
                                @endforeach
                            </table>
                        </div> 
                        @endif 
                    </div>
                </div>
            </div>
            
        </div>

    </div>
</div>



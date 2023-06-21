@php
$waktu_pengajuan = date('d-m-Y h:i', strtotime($peminjaman->waktu_pengajuan));
$waktu_awal = date('d-m-Y h:i', strtotime($peminjaman->waktu_awal));
$waktu_akhir = date('d-m-Y h:i', strtotime($peminjaman->waktu_akhir));
$diff = Carbon\Carbon::parse($waktu_awal)->diffInDays(Carbon\Carbon::parse($waktu_akhir))                      
@endphp

    <a style="margin-left:1em" href="#" onclick="read()" class="btn btn-primary btn-sm"><i class="bi bi-arrow-left-square"></i></a>
        <div class="col col-12 col-md-12">
            <div class="text-center title">
                <h3><b>DETAIL HISTORY PEMINJAMAN SAYA</b></h3>
            </div>
            <div class="row">
                <div class="col col-12 col-md-8">
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="header" style="text-align: center">
                                <h4>Detail Pengajuan</h4>
                            </div>
                            <div class="1">
                                <table style="text-align:left">
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
                                            {{$diff = Carbon\Carbon::parse($waktu_awal)->diffInDays(Carbon\Carbon::parse($waktu_akhir))}} Hari
                                             @endif
                                        </td>  
                                    </tr>
                                </table> 
                            </div>  
                        </div>
                    </div>

                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="header" style="text-align: center">
                                <h4>Persetujuan Peminjaman</h4>
                            </div>
                            <center>
                            <div class="table">
                                <div class="row">
                                    @if($peminjaman->jenis_peminjaman == "Kendaraan" OR $peminjaman->jenis_peminjaman == "Barang,Kendaraan" OR $peminjaman->jenis_peminjaman == "Ruangan,Kendaraan" OR $peminjaman->jenis_peminjaman == "Barang,Ruangan,Kendaraan" OR $peminjaman->jenis_peminjaman == "Barang,Ruangan,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Barang,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Ruangan,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Kendaraan,Supir")
                                    <div class="col col-md-6">
                                        <div class="card-header h-50">
                                            <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:15%">
                                            <h6>Wakil Direktur I</h6>
                                        </div>
                                        <div class="card-body">
                                            @if($approval->wakil_direktur_1 == "Proses" )
                                            <i class="bi bi-hourglass-top" style="font-size:36px;color:yellow"></i>
                                            @elseif($approval->wakil_direktur_1 == "Ditolak")
                                            <i class="bi bi-x" style="font-size:36px;color:red"></i>
                                            @elseif($approval->wakil_direktur_1 == "Disetujui")
                                            <i class="bi bi-check" style="font-size:36px;color:green"></i>
                                            @endif
                                        </div>
                                     
                                    </div>
                            
                                    <div class="col col-md-6">
                                        <div class="card-header h-50">
                                            <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:15%">
                                            <h6>Wakil Direktur II</h6>
                                        </div>
                                        <div class="card-body">
                                            @if($approval->wakil_direktur_2 == "Proses" )
                                            <i class="bi bi-hourglass-top" style="font-size:36px;color:yellow"></i>
                                            @elseif($approval->wakil_direktur_2 == "Ditolak")
                                            <i class="bi bi-x" style="font-size:36px;color:red"></i>
                                            @elseif($approval->wakil_direktur_2 == "Disetujui")
                                            <i class="bi bi-check" style="font-size:36px;color:green"></i>
                                            @endif
                                        </div>
                                     
                                    </div>
                                
                                    @endif
                                    <div class="col col-md-4">
                                        <div class="card-header h-50">
                                            <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:25%">
                                            <h6>Kepala Bagian</h6>
                                        </div>
                                        <div class="card-body">
                                            @if($approval->kepala_bagian == "Proses" )
                                            <i class="bi bi-hourglass-top" style="font-size:36px;color:yellow"></i>
                                            @elseif($approval->kepala_bagian == "Ditolak")
                                            <i class="bi bi-x" style="font-size:36px;color:red"></i>
                                            @elseif($approval->kepala_bagian == "Disetujui")
                                            <i class="bi bi-check" style="font-size:36px;color:green"></i>
                                            @endif
                                        </div>
                                     
                                    </div>
                                    <div class="col col-md-4">
                                        <div class="card-header h-50">
                                            <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:25%">
                                            <h6>Staff Umum</h6>
                                        </div>
                                        <div class="card-body">
                                            @if($approval->staff_umum == "Proses" )
                                            <i class="bi bi-hourglass-top" style="font-size:36px;color:yellow"></i>
                                            @elseif($approval->staff_umum == "Ditolak")
                                            <i class="bi bi-x" style="font-size:36px;color:red"></i>
                                            @elseif($approval->staff_umum == "Disetujui")
                                            <i class="bi bi-check" style="font-size:36px;color:green"></i>
                                            @endif
                                        </div>
                                     
                                    </div>
                                
                                    @if($peminjaman->jenis_peminjaman == "Barang,Ruangan,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Barang,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Ruangan,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Kendaraan,Supir")
                                    <div class="col col-md-4">
                                        <div class="card-header h-50">
                                            <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:25%">
                                            <h6>Pengelola Supir</h6>
                                        </div>
                                        <div class="card-body">
                                            @if($approval->pengelola_supir == "Proses" )
                                            <i class="bi bi-hourglass-top" style="font-size:36px;color:yellow"></i>
                                            @elseif($approval->pengelola_supir == "Ditolak")
                                            <i class="bi bi-x" style="font-size:36px;color:red"></i>
                                            @elseif($approval->pengelola_supir == "Disetujui")
                                            <i class="bi bi-check" style="font-size:36px;color:green"></i>
                                            @endif
                                        </div>
                                     
                                    </div>
                                    @endif
                                  
                                  
                                   
                                </div>
                            </div>  
                        </center>
                        </div>
                    </div>
                </div>

                <div class="col col-12 col-md-4">
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="header" style="text-align: center">
                                <h4>List Pengajuan Peminjaman</h4>
                            </div>
                            <div  style="text-align:left" class="table">
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
                            @if($peminjaman->jenis_peminjaman == "Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Barang,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Ruangan,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Barang,Ruangan,Kendaraan,Supir") 
                            <div  style="text-align:left" class="table">
                                <table>
                                    <tr style="border-bottom:1pt solid rgb(205, 205, 205);">
                                        <th style="width:70%">Nama Supir</th>
                                    </tr>
                                    @foreach($supir as $data)
                                    <tr style="height:30px">
                                        <td style="width:70%">{{$data->nama_supir}}</td>
                                    </tr>
                                    @endforeach
                                </table> 
                            </div> 
                            @endif 
                        </div>
                    </div>
                    {{-- <div class="card mt-2">
                        <div class="card-body">
                            <div class="header" style="text-align: center">
                                <h4>Berita Acara</h4>
                            </div>
                            <div  style="text-align:left" class="card">
                              <div class="card-body">
                                berita_acara barang.pdf
                              </div>
                            </div>  
                            <div  style="text-align:left" class="card">
                                <div class="card-body">
                                  berita_acara barang.pdf
                                </div>
                              </div>  
                        </div>
                    </div> --}}
                </div>

            
        </div>

    </div>




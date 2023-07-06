{{-- <style>
    .confirmation-slider {
  padding:10px;
  margin-top:20px;
  /* border-top:1px solid rgba(0,0,0,0.1);
 	background:#ebebeb; */
  text-align:center;
}

#status {
  background:#fff;
  border:1px solid #ccc;
  border-radius:26px;
  height:52px;
}

@keyframes fadein {
 	from{ opacity:0; }
  to{ opacity:1; }
}

.delete-notice { display:none; user-select:none; font-size:20px; line-height:50px; color:#ED4545; animation:fadein 4s ease; }

#confirm {
  appearance:none!important;
  background:transparent;
  height:50px;
  padding:0 5px;
  width:100%;
}

#confirm::-webkit-slider-thumb {
  appearance:none!important;
  height:40px;
  width:160px;
  border:1px solid #3079ED;
  border-radius:20px;
  cursor:e-resize;
  background:no-repeat center center;
  background-image:url(data:image/gif;base64,R0lGODlhIAAXAJEDAD1740KC7Ttx0////yH5BAEAAAMALAAAAAAgABcAAAJInI9poO0/hAiwOjmtPliwbXUeWIkSRTam9CHrC7NJTK9oVOfYp/ejDwzWAkKaofhqIU2tFG7lnDGj0k6T+pRgFbstd+SdXR0FADs=), linear-gradient(top,#4D90FE,#4787ED);
 }

#confirm:hover::-webkit-slider-thumb {
 border-color:#2f5bb7;
 
 }
</style> --}}
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
              <h3>Detail Pelaporan Pengembalian</h3>
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

            <div class="col col-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header" style="text-align: center">
                            <h5>Pelaporan Pengembalian</h5>
                        </div>
                        <div class="col col-12 col-md-12 mt-4">
                            <label for="">Deskripsi Pengembalian<small style="color:red">*</small></label>
                            <textarea style="height:100px;background-color:white;border:1px solid grey" type="text" class="form-control" placeholder="Masukkan" readonly>{{$peminjaman->deskripsi_pengembalian}}</textarea>
                        </div>
                        <div class="col col-12 col-md-12 mt-4">
                            <label for="">Bukti Pengembalian<small style="color:red">*</small></label>
                            <center>
                                <div>
                                    <img src="{{asset('foto/pengembalian/'. $peminjaman->bukti_pengembalian)}}" alt="">
                                </div>
                              
                            </center>
                          
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
        {{-- <div class="confirmation-slider">
            <div id="status">
                  <input id="confirm" type="range" value="0" min="0" max="100" />
              <span class="delete-notice">File deleted.</span>
            </div>
          </div> --}}

    </div>
</div>

{{-- <script>
    $("#confirm").on('change',function() {
  var slidepos = $(this).val();
  if(slidepos > 99){

   	// User slided the slider
    $("#confirm").fadeOut();
    $(".delete-notice").fadeIn();
  }
});

</script> --}}





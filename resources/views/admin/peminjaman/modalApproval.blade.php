<center>
    <div style="text-align: center" class="row">
    
        @if($approval->jenis_peminjaman == "Kendaraan" OR $approval->jenis_peminjaman == "Barang,Kendaraan" OR $approval->jenis_peminjaman == "Ruangan,Kendaraan" OR $approval->jenis_peminjaman == "Barang,Ruangan,Kendaraan" OR $approval->jenis_peminjaman == "Barang,Ruangan,Kendaraan,Supir" OR $approval->jenis_peminjaman == "Barang,Kendaraan,Supir" OR $approval->jenis_peminjaman == "Ruangan,Kendaraan,Supir" OR $approval->jenis_peminjaman == "Kendaraan,Supir" )
        <div class="col col-md-6 col-6">
            <div class="card-header h-50">
                <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:30%">
                <h6>Wakil Direktur I</h6>
                @if($approval->wakil_direktur_2 <> "Proses" AND $approval->wakil_direktur_2 <> "Disetujui")
                <label for="">Alasan Penolakan</label>
                <textarea type="text" class="form-control" readonly>{{$approval->wakil_direktur_2}}</textarea>
                @endif
            </div>
            <div class="card-body">
                @if($approval->wakil_direktur_1 == "Proses" )
                <i class="bi bi-hourglass-top" style="font-size:72px;color:yellow"></i>
                @elseif($approval->wakil_direktur_1 == "Ditolak")
                <i class="bi bi-x" style="font-size:72px;color:red"></i>
                @elseif($approval->wakil_direktur_1 == "Disetujui")
                <i class="bi bi-check" style="font-size:72px;color:green"></i>
                @endif
            </div>
         
        </div>

        <div class="col col-md-6 col-6">
            <div class="card-header h-50">
                <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:30%">
                <h6>Wakil Direktur II</h6>
                @if($approval->wakil_direktur_2 <> "Proses" AND $approval->wakil_direktur_2 <> "Disetujui")
                <label for="">Alasan Penolakan</label>
                <textarea type="text" class="form-control" readonly>{{$approval->wakil_direktur_2}}</textarea>
                @endif
            </div>
            <div class="card-body">
                @if($approval->wakil_direktur_2 == "Proses" )
                <i class="bi bi-hourglass-top" style="font-size:72px;color:yellow"></i>
                @elseif($approval->wakil_direktur_2 == "Ditolak")
                <i class="bi bi-x" style="font-size:72px;color:red"></i>
                @elseif($approval->wakil_direktur_2 == "Disetujui")
                <i class="bi bi-check" style="font-size:72px;color:green"></i>
                @endif
            </div>
         
        </div>
        @endif

        <div class="col col-md-4 col-6">
            <div class="card-header h-50">
                <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:50%">
                <h6>Kepala Bagian Umum</h6>
                @if($approval->kepala_bagian <> "Proses"  AND $approval->kepala_bagian <> "Disetujui")
                <label for="">Alasan Penolakan</label>
                <textarea type="text" class="form-control" readonly>{{$approval->kepala_bagian}}</textarea>
                @else
                @endif
            </div>
            <div class="card-body">
                @if($approval->kepala_bagian == "Proses" )
                <i class="bi bi-hourglass-top" style="font-size:72px;color:yellow"></i>
                @elseif($approval->kepala_bagian == "Disetujui")
                <i class="bi bi-check" style="font-size:72px;color:green"></i>
                @else
                <i class="bi bi-x" style="font-size:72px;color:red"></i><span style="font-size:12px"></span>
                @endif
            </div>
         
        </div>

        <div class="col col-md-4 col-6">
            <div class="card-header h-50">
                <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:50%">
                <h6>Staff Umum</h6>
                @if($approval->staff_umum <> "Proses" AND $approval->staff_umum <> "Disetujui")
                <label for="">Alasan Penolakan</label>
                <textarea type="text" class="form-control" readonly>{{$approval->staff_umum}}</textarea>
                @endif
            </div>
            <div class="card-body">
                @if($approval->staff_umum == "Proses")
                <i class="bi bi-hourglass-top" style="font-size:72px;color:yellow"></i>
                @elseif($approval->staff_umum == "Disetujui")
                <i class="bi bi-check" style="font-size:72px;color:green"></i>
                @else
                <i class="bi bi-x" style="font-size:72px;color:red"></i>
                @endif
            </div>
            
           
        </div>

        @if($approval->jenis_peminjaman == "Barang,Ruangan,Kendaraan,Supir" OR $approval->jenis_peminjaman == "Barang,Kendaraan,Supir" OR $approval->jenis_peminjaman == "Ruangan,Kendaraan,Supir" OR $approval->jenis_peminjaman == "Kendaraan,Supir")
        <div class="col col-md-4 col-6">
            <div class="card-header h-50">
                <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:50%">
                <h6>Pengelola Supir</h6>
                @if($approval->pengelola_supir <> "Proses" AND $approval->pengelola_supir <> "Disetujui")
                <label for="">Alasan Penolakan</label>
                <textarea type="text" class="form-control" readonly>{{$approval->pengelola_supir}}</textarea>
                @endif
            </div>
            <div class="card-body">
                @if($approval->pengelola_supir == "Proses" )
                <i class="bi bi-hourglass-top" style="font-size:72px;color:yellow"></i>
                @elseif($approval->pengelola_supir == "Ditolak")
                <i class="bi bi-x" style="font-size:72px;color:red"></i>
                @elseif($approval->pengelola_supir == "Disetujui")
                <i class="bi bi-check" style="font-size:72px;color:green"></i>
                @endif
            </div>
         
        </div>
        @endif
   
      
       
    </div>
</center>
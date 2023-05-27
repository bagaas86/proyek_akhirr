<center>
    <div class="row">
       
        <div class="col col-md-3 col-6">
            <div class="card-header h-50">
                <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:50%">
                <h6>Wakil Direktur I</h6>
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

        <div class="col col-md-3 col-6">
            <div class="card-header h-50">
                <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:50%">
                <h6>Wakil Direktur II</h6>
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

        <div class="col col-md-3 col-6">
            <div class="card-header h-50">
                <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:50%">
                <h6>Kepala Bagian Umum</h6>
            </div>
            <div class="card-body">
                @if($approval->kepala_bagian == "Proses" )
                <i class="bi bi-hourglass-top" style="font-size:72px;color:yellow"></i>
                @elseif($approval->kepala_bagian == "Ditolak")
                <i class="bi bi-x" style="font-size:72px;color:red"></i>
                @elseif($approval->kepala_bagian == "Disetujui")
                <i class="bi bi-check" style="font-size:72px;color:green"></i>
                @endif
            </div>
         
        </div>

        <div class="col col-md-3 col-6">
            <div class="card-header h-50">
                <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:50%">
                <h6>Staff Umum</h6>
            </div>
            <div class="card-body">
                @if($approval->staff_umum == "Proses" )
                <i class="bi bi-hourglass-top" style="font-size:72px;color:yellow"></i>
                @elseif($approval->staff_umum == "Ditolak")
                <i class="bi bi-x" style="font-size:72px;color:red"></i>
                @elseif($approval->staff_umum == "Disetujui")
                <i class="bi bi-check" style="font-size:72px;color:green"></i>
                @endif
            </div>
         
        </div>
   
      
       
    </div>
</center>
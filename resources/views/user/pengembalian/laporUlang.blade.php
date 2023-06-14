<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<div class="container">
    <div class="text-center title">
        <h3>Pelaporan Ulang Pengembalian Peminjaman</h3>
    </div>
    
    <div class="row">
        <div class="col col-12 col-md-12">
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
                </div>
            </div>
        </div>
    </div>
   

    <div class="form">
        <form action="{{route('pengembalian.laporulang.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="text" name="id_peminjaman" value="{{$peminjaman->id_peminjaman}}" hidden>
                <div class="col col-12 col-md-12 mt-2">
                    <label for=""><b>Deskripsi Pengembalian</b><small style="color:red">*</small></label>
                    <input type="text" class="form-control" placeholder="Deskripsi Pengembalian" id="deskripsi_pengembalian" name="deskripsi_pengembalian" value="{{old('deskripsi_pengembalian')}}" required>
                </div>
                <div class="col col-12 col-md-12 mt-2">
                        <a href="#" class="btn btn-block btn-warning" onclick="fotokegiatan()">
                          <i class="bi bi-camera"></i> Bukti</a>
                </div>
                <div class="col col-12 col-md-12 mt-2">
                <div id="hasil_buktiPengembalian" class="overflow-hidden d-flex justify-content-center mt-3"></div>
                <input type="text" id="bukti_pengembalian" name="bukti_pengembalian" hidden>
                </div>
            <div style="text-align: center">
                <button class="btn btn-block btn-primary mt-4">Kirim Pelaporan Pengembalian</button>
            </div>
        </form>
    </div>


</div>

   {{-- Modal --}}
<div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div id="ambilgambar"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="vidOff()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <center>
                    <div id="container" class="overflow-hidden d-flex justify-content-center">
                    <video autoplay="true" id="videoElement">
                    </video>
                    </div>
                  </center>   
            </div>
            <div id="modalFooter" class="modal-footer">
             
            </div>
        </div>
    </div>
</div>
{{-- endModal --}}

<script>
      var video = document.querySelector("#videoElement");
     function fotokegiatan()
      {
        let front = true;
      
      if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: { facingMode: front ? "user" : "environment" } })
        .then(function (stream) {
        video.srcObject = stream;
        })
        .catch(function (err0r) {
        console.log("Something went wrong!");
        });
    }
         var data = `<a href="#" onclick="snapkegiatan()" class="btn btn-primary">Ambil Gambar Kegiatan</a>`;
        $("#exampleModalCenter").modal('show');
         $("#ambilgambar").html(data);
      }

      function snapkegiatan() {
        var data = `<center>
          <canvas id="canvas1" width="425" height="300"></canvas>
          </center>`;
         $("#hasil_buktiPengembalian").html(data);
        var canvas1 = document.getElementById('canvas1');
        var context1 = canvas1.getContext('2d');
        context1.drawImage(video, 0, 0, 425, 300);
        var dataURL = canvas1.toDataURL(dataURL);
        $("#bukti_pengembalian").val(dataURL);
        //'<img src="'+dataURL+'"/>'
        $(".close").click();
      }

      function vidOff() {
      var mediaStream = video.srcObject;
      var tracks = mediaStream.getTracks();
      tracks[0].stop();
      }
</script>





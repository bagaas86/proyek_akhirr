<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<div class="container">
    <a style="margin-left:1em" href="#" onclick="detail({{ $peminjaman->id_peminjaman }})"
        class="btn btn-primary btn-sm"><i class="bi bi-arrow-left-square"></i></a>
    <div class="text-center title">
        <h3>Pelaporan Pengembalian Peminjaman</h3>
    </div>
    <form action="{{ route('pengembalian.laporulang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col col-12 col-md-12">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="header" style="text-align: center">
                            <h4>List Pengembalian</h4>
                        </div>
                        <div style="text-align:left" class="table">
                            <table style="width:100%" class="table table-responsive">
                                <tr style="border-bottom:1pt solid rgb(205, 205, 205);">
                                    <th style="width:30%">Nama Item</th>
                                    <th style="width:20%">Jumlah BMN Rusak <a href="#" onclick="info()"><i
                                                class="bi bi-info-circle"></i></a></th>
                                    <th style="width:10%">Kategori</th>
                                    <th style="width:5%">Jumlah</th>
                                    {{-- <th style="width:5%">Harus Dikembalikan</th>   --}}
                                    <th style="width:30%">Bukti <small style="color:grey">PNG/JPG dan Maks.4
                                            Bukti</small></th>
                                </tr>

                                @foreach ($keranjang as $data)
                                    <tr style="height:10px">
                                        <td style="width:30%">{{ $data->nama_item }}</td>
                                        <td style="width:20%">
                                            @if ($data->selesai == null)
                                                <input min="0" type="number"
                                                    onchange="cek({{ $data->id_keranjang }})"
                                                    name="jumlah_rusak[{{ $data->id_keranjang }}]"
                                                    id="rusak{{ $data->id_keranjang }}" class="form-control"
                                                    placeholder="Masukkan Jumlah Rusak BMN"
                                                    value="{{ $data->jumlah_rusak }}">
                                            @else
                                                <span class="badge bg-primary" style="color:white">Tidak Ada</span>
                                                <span class="badge bg-success" style="color:white">Sudah Diterima</span>
                                            @endif
                                        </td>
                                        <td style="width:10%">{{ $data->kategori_item }}</td>
                                        <td style="width:5%">
                                            {{ $data->jumlah }}
                                            <input type="text" id="jumlah{{ $data->id_keranjang }}"
                                                value="{{ $data->jumlah }}" hidden>
                                        </td>
                                        {{-- <td style="width:10%">
                                    @if ($data->selesai == 'Terima')
                                    0
                                    @else
                                    {{$data->jumlah}}
                                    @endif
                                </td> --}}
                                        <td style="width:30%">
                                            @if ($data->selesai != 'Terima')
                                                {{-- <input style="width:90px" type="file" value="{{$data->bukti_selesai}}" name="bukti_selesai[{{$data->id_keranjang}}]" class="form-control"> --}}
                                                <input style="width:250px" type="file" accept="image/*"
                                                    onchange="cek({{ $data->id_keranjang }})"
                                                    name="foto_selesai[{{ $data->id_keranjang }}][]"
                                                    class="form-control" multiple>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="form">
            <input type="text" name="id_peminjaman" value="{{ $peminjaman->id_peminjaman }}" hidden>
            <div class="col col-12 col-md-12 mt-2">
                <label for=""><b>Deskripsi Pengembalian</b><small style="color:red">*</small></label>
                <input type="text" class="form-control" placeholder="Deskripsi Pengembalian" id="deskripsi"
                    name="deskripsi_pengembalian" value="" required>
            </div>
            <div class="col col-12 col-md-12 mt-2">
                <a href="#" id="klik" class="btn btn-block btn-warning" onclick="fotokegiatan()">
                    <i class="bi bi-camera"></i> Bukti</a>
                <span id="alertBukti" style="color:red;display:none;">Bukti Wajib Diisi</span>
            </div>
            <div class="col col-12 col-md-12 mt-2">
                <div id="hasil_buktiPengembalian" class="overflow-hidden d-flex justify-content-center mt-3"></div>
                <input type="text" id="bukti_pengembalian" name="bukti_pengembalian" value="" hidden>
            </div>
            <div class="col col-12 col-md-12 mt-2">
                <label for="">Bukti Video</label>
                <input type="file" name="bukti_video" accept="video/*" id="videoInput"
                    onchange="cek({{ $data->id_keranjang }})" class="form-control">
            </div>
            <input type="text" id="countError" value="" hidden>
            <div style="text-align: center">
                <button id="send" class="btn btn-block btn-primary mt-4" hidden>Kirim Pelaporan
                    Pengembalian</button>
            </div>

            <a href="#" class="btn btn-block btn-primary mt-4" id="buttonSend" onclick="send()">Kirim Pelaporan
                Pengembalian</a>
        </div>
</div>
</form>

{{-- Modal --}}
<div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div id="ambilgambar"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    onclick="vidOff()"><span aria-hidden="true">&times;</span></button>
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

<div id="exampleModalCenter2" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle2">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="mb-0" id="page2"></p>
            </div>
            <div id="modalFooter2" class="modal-footer">

            </div>
        </div>
    </div>
</div>


<script>
    var video = document.querySelector("#videoElement");

    function fotokegiatan() {
        let front = true;

        if (navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: front ? "user" : "environment"
                    }
                })
                .then(function(stream) {
                    video.srcObject = stream;
                })
                .catch(function(err0r) {
                    console.log("Something went wrong!");
                });
        }
        var data = `<a href="#" onclick="snapkegiatan()" class="btn btn-primary">Ambil Gambar</a>`;
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
        $('#klik').html('<i class="bi bi-check" aria-hidden="true"> Foto Berhasil Diunggah');
    }

    function vidOff() {
        var mediaStream = video.srcObject;
        var tracks = mediaStream.getTracks();
        tracks[0].stop();
    }
</script>

<script>
    function cek(id_keranjang) {
        var item = $('#rusak' + id_keranjang).val();
        var jumlah = $('#jumlah' + id_keranjang).val();
        var fileInputs = document.querySelectorAll('input[type="file"][multiple]');
        var inputVideo = document.getElementById('videoInput');
        var maxFileSizeInBytes = 10 * 1024 * 1024; // Change this to the maximum file size in bytes (e.g., 50 MB)

        for (var i = 0; i < fileInputs.length; i++) {
            var maxFiles = 4; // Change this to the maximum number of files allowed
            var input = fileInputs[i];
            var files = input.files;

            if (files.length > maxFiles) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Maaf, Jumlah foto maksimal 4. Silakan periksa kembali dan pastikan jumlah foto tidak melebihi ketentuan.'
                })
                input.value = null;
            }
        }

        if (item > jumlah || item < 0) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Maaf, Jumlah BMN yang rusak tidak boleh melebihi jumlah BMN yang Anda pinjam. Silakan periksa kembali dan pastikan jumlah yang rusak tidak melebihi jumlah peminjaman sebelumnya'
            })
            $('#rusak' + id_keranjang).val(0);
        }

        var files = $("#videoInput")[0].files;
        var size = files[0].size;
        if (size > 8000000) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Maaf, Ukuran video melebihi batas maksimum yaitu 8mb. Silakan periksa kembali dan pastikan video tidak melebihi ukuran maksimum.'
            })
            inputVideo.value = null;
            $('#countError').val(1);
        } else {
            $('#countError').val(0);
        }



    }

    function info() {
        $("#exampleModalCenterTitle2").html(`Informasi`)
        $("#page2").html(`
            Apabila tidak ada BMN yang rusak, inputkan angka 0
            `);
        $("#modalFooter2").html(`
            `)
        $("#exampleModalCenter2").modal('show');
    }

    function send() {
        var count = $("#countError").val();
        var bukti = $("#bukti_pengembalian").val();
        var deskripsi = $("#deskripsi").val();
        var deskripsi = $("#deskripsi").val();
        var inputVideo = $("#videoInput").val();
        if (count != 0) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Maaf, Silahkan periksa kembali mengenai inputan. Pastikan video memiliki ukuran kurang dari 8mb dan bukti foto tidak melebihi 4 foto.'
            })
        } else if (bukti == "") {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Maaf, Bukti Foto harus diinputkan.'
            })
        } else if (deskripsi == "") {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Maaf, Deskripsi pengembalian harus diinputkan.'
            })
        } else if (inputVideo == "") {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Maaf, Bukti video pengembalian harus diinputkan.'
            })
        } else {
            document.getElementById("send").click();
            document.getElementById("buttonSend").style.display = "none";
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Berhasil Mengirim Pengajuan Peminjaman!'
            })
        }
    }
</script>

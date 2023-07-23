<div class="row mt-2">
    <div class="col col-md-6 col-12">
        <div class="col col-md-12 col-12">
            @if($check1 <> null)
            <div class="card">
                <div class="card-body">
                    <div class="header" style="text-align: center">
                        <h4>Barang</h4>
                    </div>
                    <div class="1">
                        <table>
                            <tr style="border-bottom:1pt solid rgb(205, 205, 205);">
                                <th style="width:60%">Nama Barang</th>
                                <th style="width:30%">Jumlah</th> 
                                <th style="width:10%;padding-left:30px;">Aksi</th>   
                            </tr>
                            @foreach($keranjang as $data)
                            <tr style="height:50px;color:black">
                                <td style="width:60%">{{$data->nama_item}}</td>
                                <td style="width:30%"> <input class="form-control" type="number" value="{{old('jumlah',$data->jumlah)}}" id="jumlah{{$data->id_keranjang}}" name="jumlah" onchange="ubahJumlah({{$data->id_keranjang}})"></td>
                                <td style="width:10%;padding-left:30px;"><a href="#" class="btn btn-danger btn-sm" id="delete{{$data->id_keranjang}}" onclick="hapusBarang({{$data->id_keranjang}})"> <i class="bi bi-trash"></i> </a></td>
                            </tr>
                            @endforeach
                        </table> 
                    </div>  
                </div>
            </div>
            @endif
            @if($check2 <> null)
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="header" style="text-align: center">
                            <h4>Ruangan</h4>
                        </div>
                        <div class="2">
                            <table>
                                <tr style="border-bottom:1pt solid rgb(205, 205, 205);">
                                    <th style="width:85%">Nama Ruangan</th> 
                                    <th style="width:10%;padding-left:30px;">Aksi</th>   
                                </tr>
                                @foreach($ruangan as $datas)
                                <tr style="height:50px">
                                    <td style="width:85%">{{$datas->nama_item}}</td>
                                    <td style="width:10%;padding-left:30px;"><a href="#" class="btn btn-danger btn-sm" id="delete{{$datas->id_keranjang}}" onclick="hapusBarang({{$datas->id_keranjang}})"> <i class="bi bi-trash"></i> </a></td>
                                </tr>
                                @endforeach
                            </table> 
                        </div>
                          
                    </div>
                </div>
            @endif
           
            @if($check3 <> null)
            <div class="card mt-2">
                <div class="card-body">
                    <div class="header" style="text-align: center">
                        <h4>Kendaraan</h4>
                    </div>
                    <div class="2">
                        <table>
                            <tr style="border-bottom:1pt solid rgb(205, 205, 205);">
                                <th style="width:40%">Merk Kendaraan</th> 
                                <th style="width:40%">Plat Kendaraan</th> 
                                <th style="width:10%;padding-left:30px;">Aksi</th>   
                            </tr>
                            @foreach($kendaraan as $datas)
                            <tr style="height:50px">
                                <td style="width:40%">{{$datas->nama_item}}</td>
                                <td style="width:40%">{{$datas->plat_kendaraan}}</td>
                                <td style="width:10%;padding-left:30px;"><a href="#" class="btn btn-danger btn-sm" id="delete{{$datas->id_keranjang}}" onclick="hapusBarang({{$datas->id_keranjang}})"> <i class="bi bi-trash"></i> </a></td>
                            </tr>
                            @endforeach
                        </table> 
                    </div>
                      
                </div>
            </div>
            @endif

            @if($check4 <> null)
            <div class="card mt-2">
                <div class="card-body">
                    <div class="header" style="text-align: center">
                        <h4>Supir</h4>
                    </div>
                    <div class="2">
                        <table>
                            <tr style="border-bottom:1pt solid rgb(205, 205, 205);">
                                <th style="width:40%">Nama Supir</th> 
                                <th style="width:10%;padding-left:30px;">Aksi</th>   
                            </tr>
                            @foreach($supir as $data_supir)
                            <tr style="height:50px">
                                <td style="width:40%">{{$data_supir->nama_supir}}</td>
                                <td style="width:10%;padding-left:30px;"><a href="#" class="btn btn-danger btn-sm" id="delete{{$data_supir->id_keranjang}}" onclick="hapusBarang({{$data_supir->id_keranjang}})"> <i class="bi bi-trash"></i> </a></td>
                            </tr>
                            @endforeach
                        </table> 
                    </div>
                      
                </div>
            </div>
            @endif

            @if($check1 == null AND $check2 == null AND $check3 == null)
            <div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="alert alert-danger" role="alert">
							<h4 class="alert-heading">Harap Memasukkan BMN!</h4>
							<p>Pastikan Memasukkan BMN yang ingin dipinjam.</p>
							<hr>
						</div>
					</div>
				</div>
			</div>
            @endif
        </div>
    </div>

     <div class="col col-12 col-md-12 mt-2" style="display:none">
        <label for=""><b>Jenis Peminjaman</b><small style="color:red">*</small></label>
        @if($check1 <> null AND $check2 <> null AND $check3 <> null AND $check4 <> null)
        <input type="text" id="inputt" name="jenis_peminjaman" class="form-control" readonly value="Barang,Ruangan,Kendaraan,Supir">
        @elseif($check1 <> null AND $check3 <> null AND $check4 <> null)
        <input type="text" id="inputt" name="jenis_peminjaman" class="form-control" readonly value="Barang,Kendaraan,Supir">
        @elseif($check2 <> null AND $check3 <> null AND $check4 <> null)
        <input type="text" id="inputt" name="jenis_peminjaman" class="form-control" readonly value="Ruangan,Kendaraan,Supir">
        @elseif($check3 <> null AND $check4 <> null)
        <input type="text" id="inputt" name="jenis_peminjaman" class="form-control" readonly value="Kendaraan,Supir">
        @elseif($check1 <> null AND $check2 <> null AND $check3 <> null)
        <input type="text" id="inputt" name="jenis_peminjaman" class="form-control" readonly value="Barang,Ruangan,Kendaraan">
        @elseif($check1 <> null AND $check2 <> null)
        <input type="text" id="inputt" name="jenis_peminjaman" class="form-control" readonly value="Barang,Ruangan">
        @elseif($check1 <> null AND $check3 <> null)
        <input type="text" id="inputt" name="jenis_peminjaman" class="form-control" readonly value="Barang,Kendaraan">
        @elseif($check2 <> null AND $check3 <> null)
        <input type="text" id="inputt" name="jenis_peminjaman" class="form-control" readonly value="Ruangan,Kendaraan">
        @elseif($check1 <> null)
        <input type="text" id="inputt" name="jenis_peminjaman" class="form-control" readonly value="Barang">
        @elseif($check2 <> null)
        <input type="text" id="inputt" name="jenis_peminjaman" class="form-control" readonly value="Ruangan">
        @elseif($check3 <> null)
        <input type="text" id="inputt" name="jenis_peminjaman" class="form-control" readonly value="Kendaraan">
        @else
        <input type="text" id="inputt" name="jenis_peminjaman" class="form-control" readonly value="Masukkan Barang Terlebih Dahulu">
        @endif
    </div>
   


    <div class="col col-md-6 col-12">
            <div class="pengajuan" id="pengajuan" style="display:none">
                <div class="col col-md-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="header" style="text-align: center">
                                <h4>Form Pengajuan</h4>
                            </div>
                            <div class="form">
                                <form action="{{route('kirimpengajuan')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for=""><b>Tanggal Peminjaman</b><small style="color:red">*</small></label>
                                    <div class="row">
                                        <div class="col col-12 col-md-6">
                                            <label for="">Dari<small style="color:red">*</small></label>
                                            <input id="fromdate1" type="datetime-local" class="form-control" placeholder="Masukkan" name="fromdate" value="" readonly required>
                                        </div>
                                        <div class="col col-12 col-md-6">
                                            <label for="">Sampai<small style="color:red">*</small></label>
                                            <input id="todate1" type="datetime-local" class="form-control" placeholder="Masukkan" name="todate" value="" readonly required>
                                        </div>
                                         <div class="col col-12 col-md-12 mt-2">
                                            <label for=""><b>Jenis Peminjaman</b><small style="color:red">*</small></label>
                                         <input class="form-control" type="text" id="outputt" name="jenis_peminjaman" value=""  readonly>
                                        </div>
                                      
                                        <div id="ceksupir" class="col col-12 col-md-12 mt-2">
                                            <label for=""><b>Supir</b><small>abaikan jika tanpa supir</small></label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="id_supir" name="id_supir" placeholder="Nama Supir" aria-label="Recipient's username" aria-describedby="basic-addon2" value="" readonly>
                                                <div class="input-group-append">
                                                  <button class="btn btn-outline-primary" type="button" onclick="modalSupir()">Check</button>
                                                </div>
                                              </div>
                                        </div>
                                        <div class="col col-12 col-md-12 mt-2">
                                            <label for=""><b>Nama Penanggung Jawab</b><small style="color:red">*</small></label>
                                            <input type="text" class="form-control" placeholder="Nama Penanggung Jawab" id="nama_pj" name="nama_pj" value="{{Auth::user()->name}}" readonly required>
                                        </div>
                                        <div class="col col-12 col-md-12 mt-2">
                                            <label for=""><b>Nomor Identitas</b></label>
                                            <input type="number" class="form-control" placeholder="Nomor Identitas" id="no_identitas" name="no_identitas" value="{{Auth::user()->no_identitas}}" readonly>
                                        </div>
                                        <div class="col col-12 col-md-12 mt-2">
                                            <label for=""><b>Nomor HP</b></label>
                                            <input type="number" class="form-control" placeholder="Nomor HP" id="no_hp" name="no_hp" value="{{old('no_hp')}}"  required readonly>
                                        </div>
                                        <div class="col col-12 col-md-12 mt-2">
                                            <label for=""><b>Nama Kegiatan</b><small style="color:red">*</small></label>
                                            <input type="text" class="form-control" placeholder="Nama Kegiatan" id="nama_kegiatan" name="nama_kegiatan" value="{{old('nama_kegiatan')}}" required>
                                        </div>
                                        <div class="col col-12 col-md-12 mt-2">
                                            <label for=""><b>Upload Surat Pengajuan</b><small>Format : PDF</small></label>
                                            <input  onchange="ceksurat()" type="file" class="form-control" placeholder="Nama Kegiatan" id="bukti" name="surat_pengajuan">
                                            <div id="alert1"></div>
                                        </div>
                                        <input type="text" id="eror" value="0" hidden>
                                        {{-- <div class="col col-12 col-md-12 mt-2">
                                            <label for=""><b>Upload Kartu Identitas</b><small style="color:red">*</small></label>
                                            <input type="file" class="form-control" placeholder="Nama Kegiatan" id="tanda_pengenal" name="foto_identitas" required>
                                        </div> --}}
                                    </div>
                                    <div style="text-align: center">
                                        <button id="send" type="submit" class="btn btn-block btn-primary mt-4" hidden>Kirim Pengajuan</button>
                                    </div>
                                </form>
                                <div style="text-align: center">
                                    <a onclick="confirm()" id="buttonSend" style="color:white" class="btn btn-block btn-primary mt-4">Kirim Pengajuan</a>
                                </div>
                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<script>
    $( document ).ready(function() {
    jenisPeminjaman()
});
function ceksurat(){
    var files = $("#bukti")[0].files
    var type = files[0].type
    if (type != "application/pdf"){
            $("#alert1").html(`<span style="color: red">Jenis File Harus PDF</span>`);
            $("#eror").val(1);
     }else{
        $("#alert1").html('');
            $("#eror").val(0);
     }
}
function confirm()
    {
        var btn = document.getElementById("buttonSend")
        var jenis_peminjaman = $("#inputt").val()
        var nama_kegiatan = $("#nama_kegiatan").val()
        var fromdate1 = $("#fromdate1").val()
        var todate1 = $("#todate1").val()
        var surat = $("#bukti").val()
        var eror = $("#eror").val();
        
        if(jenis_peminjaman == "Masukkan Barang Terlebih Dahulu" || nama_kegiatan == "" || fromdate1 == "" || todate1 == "" )
        {
            Swal.fire(
                    {
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal Mengirim. Harap Perhatikan Inputan form!'
                        }
                    )
        }else if (eror == 1){
            Swal.fire(
                    {
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Surat Pengajuan Harus Berformat PDF!'
                        }
                    )
        }else if (eror == 0){
            document.getElementById("send").click();
            document.getElementById("buttonSend").style.display="none";
            Swal.fire(
                    {
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Berhasil Mengirim Pengajuan Peminjaman!'
                        }
                    )
        }
    }
    function jenisPeminjaman(){
       var x = $('#inputt').val();
       $('#outputt').val(x);
       if ( x == "Barang,Ruangan,Kendaraan" || x == "Barang,Ruangan,Kendaraan,Supir" || x == "Barang,Kendaraan,Supir" || x == "Ruangan,Kendaraan,Supir" || x == "Kendaraan,Supir" || x == "Barang,Kendaraan" || x == "Ruangan,Kendaraan" || x == "Kendaraan" )
       {
        document.getElementById("ceksupir").style.display="block";
       }
       else
       {
        document.getElementById("ceksupir").style.display="none";
       }
    }

    function ubah(){
       var x = $('#inputt').val();
       var z = x+",Supir";
       $('#outputt').val(z);
    }

    function modalSupir() {
        var fromdate = $("#fromdate1").val();
        var todate = $("#todate1").val();
      $.ajax({
             type: "get",
             url: "{{ url('modalsupir') }}",
             data: {
                "fromdate": fromdate,
                "todate": todate,
             },
         success: function(data, status) {
             $("#exampleModalCenterTitle").html(`Supir Tersedia`)
             $("#page").html(data);
             $("#exampleModalCenter").modal('show');
             }
         });
       
    }

    function pilihSupir(id_supir){
       var x = id_supir;
       $('#id_supir').val(x);
       $('#exampleModalCenter').modal('hide');
       ubah();
    }

 
</script>



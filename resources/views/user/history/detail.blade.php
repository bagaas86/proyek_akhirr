@php
$waktu_pengajuan = date('d-m-Y h:i', strtotime($peminjaman->waktu_pengajuan));
$waktu_awal = date('d-m-Y h:i', strtotime($peminjaman->waktu_awal));
$waktu_akhir = date('d-m-Y h:i', strtotime($peminjaman->waktu_akhir));
$diff = Carbon\Carbon::parse($waktu_awal)->diffInDays(Carbon\Carbon::parse($waktu_akhir))                      
@endphp

    <a style="margin-left:1em" href="#" onclick="read()" class="btn btn-primary btn-sm"><i class="bi bi-arrow-left-square"></i></a>
        <div class="col col-12 col-md-12">
            <div class="text-center title">
                <h4><b>DETAIL HISTORY PEMINJAMAN SAYA</b></h4>
            </div>
            <div class="row">
                <div class="col col-12 col-md-12">
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="header" style="text-align: center">
                                <h4>Detail Pengajuan</h4>
                            </div>
                            <div class="1">
                                <table class="table table-responsive" style="text-align:left">
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:30%;font-weight:bold">Nama PJ</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:60%">{{$peminjaman->nama_pj}}</td>  
                                    </tr>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:30%;font-weight:bold">No. Identitas</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:60%">{{$peminjaman->no_identitas}}</td>  
                                    </tr>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:30%;font-weight:bold">Unit/Jabatan</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:60%">{{$peminjaman->dari}}</td>  
                                    </tr>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:30%;font-weight:bold">Nama Kegiatan</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:60%">{{$peminjaman->nama_kegiatan}}</td>  
                                    </tr>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:30%;font-weight:bold">Waktu Pengajuan</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:60%">{{$waktu_pengajuan}}</td>  
                                    </tr>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:30%;font-weight:bold">Waktu Peminjaman</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:60%">{{$waktu_awal}} s/d {{$waktu_akhir}}</td>  
                                    </tr>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:30%;font-weight:bold">Lama Peminjaman</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:60%">
                                            @if ($diff == 0)
                                            1 Hari
                                            @else
                                            {{$diff = Carbon\Carbon::parse($waktu_awal)->diffInDays(Carbon\Carbon::parse($waktu_akhir))}} Hari
                                             @endif
                                        </td>  
                                    </tr>
                                    <tr style="vertical-align:top;font-size:12px">
                                        <td style="width:30%;font-weight:bold">Status Peminjaman</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:60%;color:white;">
                                        <span class="badge bg-@if($peminjaman->status_peminjaman == "Proses")primary @elseif($peminjaman->status_peminjaman == "Pengajuan Ditolak")danger @elseif($peminjaman->status_peminjaman == "Pengajuan Diterima")success @endif">{{$peminjaman->status_peminjaman}}</span> 
                                        @if($peminjaman->jenis_peminjaman == "Barang" OR $peminjaman->jenis_peminjaman == "Barang,Ruangan" OR $peminjaman->jenis_peminjaman == "Ruangan")
                                            @if($approval->staff_umum == "Proses")
                                            <span class="badge bg-warning">Menunggu Persetujuan Staff Umum</span>
                                            @endif
                                            @if($approval->kepala_bagian == "Proses")
                                            <span class="badge bg-warning">Menunggu Persetujuan Kepala Bagian</span>
                                            @endif
                                        @elseif(strpos($peminjaman->jenis_peminjaman, 'Kendaraan') !== false )
                                            @if($approval->staff_umum == "Proses")
                                            <span class="badge bg-warning">Menunggu Persetujuan Staff Umum</span>
                                            @endif
                                            @if($approval->kepala_bagian == "Proses")
                                            <span class="badge bg-warning">Menunggu Persetujuan Kepala Bagian</span>
                                            @endif
                                            @if($approval->wakil_direktur_2 == "Proses")
                                            <span class="badge bg-warning">Menunggu Persetujuan Wakil Direktur 2</span>
                                            @endif
                                        @endif
                                        
                                        @if($peminjaman->status_peminjaman == "Pengajuan Diterima")
                                        <span class="badge bg-secondary">Berita acara telah diterbitkan. Silahkan datang ke bagian umum.</span>
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
                                    {{-- <div class="col col-12 col-md-4">
                                        <div class="card-header h-50">
                                            <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:25%">
                                            @if($approval->wakil_direktur_1 == "Proses" )
                                            <i class="bi bi-hourglass-top" style="font-size:18px;color:yellow"></i>
                                            @elseif($approval->wakil_direktur_1 == "Disetujui")
                                            <i class="bi bi-check" style="font-size:28px;color:green"></i>
                                            @elseif($approval->wakil_direktur_1 <> "Proses" AND $approval->wakil_direktur_1 <> "Disetujui" )
                                            <i class="bi bi-x" style="font-size:28px;color:red"></i>
                                            @endif
                                            <h6 style="font-size:12px">Wakil Direktur 1</h6>
                                        
                                        </div>
                                        <div class="card-body">
                                           
                                            @if($approval->wakil_direktur_1 <> "Proses" AND $approval->wakil_direktur_1 <> "Disetujui" )
                                            <label for="">Alasan Penolakan</label>
                                            <textarea type="text" class="form-control" readonly>{{$approval->wakil_direktur_1}}</textarea>
                                            @endif
                                         
                                        </div>
                                     
                                    </div> --}}
                            
                                    <div class="col col-12 col-md-4">
                                        <div class="card-header h-60">
                                            <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:25%">
                                            @if($approval->wakil_direktur_2 == "Proses" )
                                            <i class="bi bi-hourglass-top" style="font-size:18px;color:yellow"></i>
                                            @elseif($approval->wakil_direktur_2 == "Disetujui")
                                            <i class="bi bi-check" style="font-size:28px;color:green"></i>
                                            @elseif($approval->wakil_direktur_2 <> "Proses" AND $approval->wakil_direktur_2 <> "Disetujui" )
                                            <i class="bi bi-x" style="font-size:28px;color:red"></i>
                                            @endif
                                            <h6>{{$approval->nama_wakil_direktur_2}}</h6>
                                            <h6 style="font-size:12px">Wakil Direktur 2</h6>
                                        
                                        </div>
                                        <div class="card-body">
                                           
                                            @if($approval->wakil_direktur_2 <> "Proses" AND $approval->wakil_direktur_2 <> "Disetujui" )
                                            <label for="">Alasan Penolakan</label>
                                            <textarea type="text" class="form-control" readonly>{{$approval->wakil_direktur_2}}</textarea>
                                            @endif
                                         
                                        </div>
                                     
                                    </div>
                                
                                    @endif
                                    <div class="col col-12 col-md-4">
                                        <div class="card-header h-60">
                                            <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:25%">
                                            @if($approval->kepala_bagian == "Proses" )
                                            <i class="bi bi-hourglass-top" style="font-size:18px;color:yellow"></i>
                                            @elseif($approval->kepala_bagian == "Disetujui")
                                            <i class="bi bi-check" style="font-size:28px;color:green"></i>
                                            @elseif($approval->kepala_bagian <> "Proses" AND $approval->kepala_bagian <> "Disetujui" )
                                            <i class="bi bi-x" style="font-size:28px;color:red"></i>
                                            @endif
                                            <h6>{{$approval->nama_kepala_bagian}}</h6>
                                            <h6 style="font-size:12px">Kepala Bagian</h6>
                                        
                                        </div>
                                        <div class="card-body">
                                           
                                            @if($approval->kepala_bagian <> "Proses" AND $approval->kepala_bagian <> "Disetujui" )
                                            <label for="">Alasan Penolakan</label>
                                            <textarea type="text" class="form-control" readonly>{{$approval->kepala_bagian}}</textarea>
                                            @endif
                                         
                                        </div>
                                     
                                    </div>
                                    <div class="col col-12 col-md-4">
                                        <div class="card-header h-60">
                                            <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:25%">
                                            @if($approval->staff_umum == "Proses" )
                                            <i class="bi bi-hourglass-top" style="font-size:18px;color:yellow"></i>
                                            @elseif($approval->staff_umum == "Disetujui")
                                            <i class="bi bi-check" style="font-size:28px;color:green"></i>
                                            @elseif($approval->staff_umum <> "Proses" AND $approval->staff_umum <> "Disetujui" )
                                            <i class="bi bi-x" style="font-size:28px;color:red"></i>
                                            @endif
                                            <h6>{{$approval->nama_staff_umum}}</h6>
                                            <h6 style="font-size:12px">Staff Umum</h6>
                                        
                                        </div>
                                        <div class="card-body">
                                           
                                            @if($approval->staff_umum <> "Proses" AND $approval->staff_umum <> "Disetujui" )
                                            <label for="">Alasan Penolakan</label>
                                            <textarea type="text" class="form-control" readonly>{{$approval->staff_umum}}</textarea>
                                            @endif
                                         
                                        </div>
                                     
                                    </div>
                                
                                    @if($peminjaman->jenis_peminjaman == "Barang,Ruangan,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Barang,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Ruangan,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Kendaraan,Supir")
                                    <div class="col col-12 col-md-4">
                                        <div class="card-header h-60">
                                            <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:25%">
                                            @if($approval->pengelola_supir == "Proses" )
                                            <i class="bi bi-hourglass-top" style="font-size:18px;color:yellow"></i>
                                            @elseif($approval->pengelola_supir == "Disetujui")
                                            <i class="bi bi-check" style="font-size:28px;color:green"></i>
                                            @elseif($approval->pengelola_supir <> "Proses" AND $approval->pengelola_supir <> "Disetujui" )
                                            <i class="bi bi-x" style="font-size:28px;color:red"></i>
                                            @endif
                                            <h6>{{$approval->nama_pengelola_supir}}</h6>
                                            <h6 style="font-size:12px">Pengelola Supir</h6>
                                        
                                        </div>
                                        <div class="card-body">
                                           
                                            @if($approval->pengelola_supir <> "Proses" AND $approval->pengelola_supir <> "Disetujui" )
                                            <label for="">Alasan Penolakan</label>
                                            <textarea type="text" class="form-control" readonly>{{$approval->pengelola_supir}}</textarea>
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

                <div class="col col-12 col-md-6">
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="header" style="text-align: center">
                                <h4>List Pengajuan Peminjaman   
                                </h4>
                                  {{-- <button  onclick="atur()" id="btnSimpan" style="display:none" class="btn btn-warning btn-sm"><i class="bi bi-save"></i></button>
                                    <button  onclick="atur()" id="btnEdit" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></button> --}}
                                    @if($peminjaman->status_peminjaman == "Pengajuan Diterima")
                                    <button href="#" onclick="toggleEditHeader()" class="btn btn-primary btn-sm">Simpan/Sunting</button>
                                    @endif
                              
                            </div>
                            <div class="table table-responsive">
                                <table style="width:100%">
                                    <tr style="border-bottom:1pt solid rgb(205, 205, 205);">
                                        <th style="width:50%;font-size:12px">Nama Item</th>
                                        <th style="width:10%;font-size:12px">Jumlah</th>  
                                        <th id="edit" style="width:10%;font-size:12px;display:none;">Kondisi Awal <small style="color:grey">JPG/PNG dan Maks. 4 Foto</small></th>
                                    </tr>
                                    @foreach($keranjang as $data)
                                    <tr style="height:30px">
                                        <td style="width:50%;font-size:12px">{{$data->nama_item}}</td>
                                        <td style="width:10%;font-size:12px">{{$data->jumlah}}</td>
                                        <td id="edit2{{$data->id_keranjang}}" style="display: none">
                                                <input type="file" accept="image/*" name="foto_awal[{{$data->id_keranjang}}][]" onchange="kirimBukti({{$data->id_keranjang}}, this)" multiple>
                                                {{-- <button id="simpan" hidden></button> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>  
                            </div> 
                            @if($peminjaman->jenis_peminjaman == "Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Barang,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Ruangan,Kendaraan,Supir" OR $peminjaman->jenis_peminjaman == "Barang,Ruangan,Kendaraan,Supir") 
                            <div  style="text-align:left" class="table">
                                <table>
                                    <tr style="border-bottom:1pt solid rgb(205, 205, 205);">
                                        <th style="width:50%;font-size:12px">Nama Supir</th>
                                        <th style="width:10%;font-size:12px"></th>
                                    </tr>
                                    @foreach($supir as $data)
                                    <tr style="height:30px">
                                        <td style="width:50%;font-size:12px">{{$data->nama_supir}}</td>
                                        <td style="width:10%;font-size:12px">
                                        @if($approval->pengelola_supir == "Proses")
                                        <span class="badge bg-primary" style="color: white">Menunggu</span>
                                        @elseif($approval->pengelola_supir == "Disetujui")
                                        <span class="badge bg-success" style="color: white">Disetujui</span>
                                        @else
                                        <span class="badge bg-danger" style="color: white">Ditolak</span>
                                        @endif
                                        </td>
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


    <script>
        // function atur()
        // {
        //     document.getElementById("edit").style.display="block";
        //     document.getElementById("edit2").style.display="block";
        //     document.getElementById("btnSimpan").style.display="block";
        //     document.getElementById("btnEdit").style.display="none";
        // }

    //     function toggleEditHeader() {

    //     var editHeader = document.getElementById("edit");
    //     var edit2 = document.getElementById("edit2");

    //     if (editHeader.style.display === "none") {
    //         editHeader.style.display = "table-cell";
    //         edit2.style.display = "table-cell";
    //     } else {
    //         editHeader.style.display = "none";
    //         edit2.style.display = "none";

    //     }
    // }

    function toggleEditHeader() {
        var editHeader = document.getElementById("edit");
        var edit2Elements = document.querySelectorAll('[id^="edit2"]');

        if (editHeader.style.display === "none") {
            editHeader.style.display = "table-cell";
            edit2Elements.forEach(function(element) {
                element.style.display = "table-cell";
            });
        } else {
            editHeader.style.display = "none";
            edit2Elements.forEach(function(element) {
                element.style.display = "none";
            });
        }
    }
    </script>

<script>
    function kirimBukti(id_keranjang, input) {
        var files = input.files;

        if (files.length > 4) {
            Swal.fire(
                    {
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Maaf, jumlah foto maksimal adalah 4. Silakan periksa kembali dan pastikan jumlah foto tidak melebihi ketentuan.'
                        }
                    )
            input.value = null;
            return; // Prevent further processing
        }

        var formData = new FormData();
        for (var i = 0; i < files.length; i++) {
            formData.append('foto_awal[' + id_keranjang + '][]', files[i]);
        }

        fetch('{{route('foto.awal')}}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response from the server if needed
            
        })
        .catch(error => {
            // Handle any error that occurred during the request
            Swal.fire(
                    {
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil menambah foto.'
                        }
                    )
           
        });
    }
</script>
    









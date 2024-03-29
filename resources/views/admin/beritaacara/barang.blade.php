<html>
<head>
    <title>Berita Acara Barang </title>
    <style type= "text/css">
    *{
            margin: 1;
        }
    body {font-family: 'Times New Roman', Times, serif; background-color : #fff }
    .rangkasurat {margin:auto ;background-color : #fff;padding: 10px}
   .header {border-bottom : 3px solid black; padding: 0px;margin-top:0em;line-height: 1.5}
    .tengah {text-align : center;font-size:16px;}
    .judul{
      text-align:center;line-height:5px;font-size:12px;margin-top:1em;}
     .isi{
      margin-left:2em;margin-top:1em;margin-right:2em;font-size:12px;
     }

     .list{
      margin-top:1em;
     }

     .list, .th, .td {
      border: 1px solid black;
      border-collapse: collapse;
      font-size:12pt;
      margin-top:1.5em;
      margin-left:0.4em;
      }

      .kegiatan{
            margin-top:1.5em;
      }
      .persyaratan{
            margin-top:1.5em;
            line-height:1;
      }

      h6{
            font-size:12pt;
            font-weight:400;
            line-height:1.5;
      }
      p{
            font-size:12pt;
      }

      .koordinator{
            margin-left:auto;
            margin-right:auto;
            line-height:1;
      }

      .staff{
            line-height:1;
      }
      


    
     </style >
</head>
<body>



<div class = "rangkasurat">
     <table class="header" width = "100%">
           <tr>
                 <td> <img src="{{public_path('template')}}/dist/assets/images/logoPolsub.png" width="120px"> </td>
                 <td style="width:99%" class = "tengah">
                  <br>
                       <h2 style="line-height:1px;font-weight:50">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,</h2>
                       <h2 style="line-height:25px;font-weight:50">RISET DAN TEKNOLOGI</h2>
                       <h2 style="margin-top:0.2em;margin-bottom:1em">POLITEKNIK NEGERI SUBANG</h2>
                       <h4 style="font-weight:1;line-height:1px;">Jl. Brigjen Katamso No.37(Belakang RSUD), Dangdeur, Subang, Jawa Barat 41211</h4>
                       <h4 style="font-weight:1;line-height:20px;">Telp. (0260) 417658 Laman: <span style="color:blue">https://www.polsub.ac.id</span></h4>
                 </td>
            </tr>
      </table>
     <div class="judul">
      <h4 style="font-weight:bold; font-size:14px;" >BERITA ACARA PEMINJAMAN BARANG INVENTARIS</h4>
      <h4 style="line-height:20px; font-size:14px;">POLITEKNIK NEGERI SUBANG</h4>
      </div>

      <div class="isi" style="font-size:14px">
      <table width="100%" class="mt-2">
            <tr align="justify">
                  <td colspan="3"><p>
                        Pada Hari Ini, Rabu Tanggal {{$tanggal}} Bulan {{$bulan}} Tahun {{$tahun}} ({{$now}}) telah memberikan izin kepada:</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Nama</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>{{$peminjaman->nama_pj}}</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Unit/Jurusan</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>{{$peminjaman->dari}}</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>No Identitas</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>{{$peminjaman->no_identitas}}</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>No HP</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>{{$peminjaman->no_hp}}</p></td>
            </tr>
            <tr>
                  <td colspan="3"><p>Untuk melakukan peminjaman barang/alat dengan rincian sebagai berikut:</p></td>
            </tr>
      </table>

      <table width="90%" class="list">
      <tr>
            <th class="th"><p>No</p></th>
            <th class="th"><p>Nama Barang/Alat</p></th>
            <th class="th"><p>Lokasi</p></th>
            <th class="th"><p>Jumlah</p></th>
            <th class="th"><p>Kondisi/Asal Barang</p></th>
      </tr>
      @php
      $i = 0;
      @endphp
      @foreach($keranjang as $data)
      @php
      $i = $i+1;
      @endphp
      <tr>
            <td style="text-align:center;width:5%" class="td"><p>{{$i}}</p></td>
            <td class="td" style="width:40%"><p>{{$data->nama_item}}</p></td>
            <td class="td" style="text-align:center;width:15%"><p>{{$data->lokasi_item}}</p></td>
            <td class="td" style="text-align:center;width:15%"><p>{{$data->jumlah}} Unit</p></td>
            <td class="td" style="text-align:center;width:25%">
                  <p>
                        @if($data->kondisi_item == "Ready")
                        Baik
                        @elseif($data->kondisi_item == "Rusak")
                        Rusak
                        @endif
                  </p>
            </td>
      </tr>
      @endforeach
      </table>

      <table width="100%" class="kegiatan">
            <tr>
                  <td colspan="3"><p>Dalam Rangka Kegiatan:</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Uraian Kegiatan</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>{{$peminjaman->nama_kegiatan}}</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Tanggal Peminjaman</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%">
                        <p>
                              @if($from == $to)
                              {{$from}}
                              @else
                              {{$from}} s/d {{$to}}
                              @endif
                         </p>
                  </td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Lama Peminjaman</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>{{$selisih}} Hari</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Pukul</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>{{$jam_mulai}} - {{$jam_selesai}}</p></td>
            </tr>
      </table>

      <table width="100%" class="persyaratan">
            <tr style="vertical-align: top" align="justify">
                  <td colspan="2"><p>Dengan persyaratan sebagai berikut :</p></td>
            </tr>
            <tr>
                  <td style="width:3%"><p>1.</p></td>
                  <td><p> Menyerahkan Kartu Tanda Mahasiswa/Kartu Identitas pada saat melakukan peminjaman.</p></td>
            </tr>
            <tr style="vertical-align: top" align="justify">
                  <td style="width:3%"><p>2.</p></td>
                  <td>
                   <p>Apabila terjadi kerusakan atau kehilangan barang karena kesalahan/kelalaian penggunaan maka pengguna/penerima barangharus memperbaiki atau mengganti barang tersebut dengan type/spesifikasi yang sama atau lebih tinggi.</p>           
                  </td>
            </tr>
            <tr style="vertical-align: top" align="justify">
                  <td style="width:3%"><p>3.</p></td>
                  <td>
                   <p>Barang/alat tidak boleh dipinjamkan atau digunakan orang lain atau keluarga penerima.</p>           
                  </td>
            </tr>
            <tr style="vertical-align: top" align="justify">
                  <td style="width:3%"><p>4.</p></td>
                  <td>
                   <p>Petugas UPB berhak untuk mengambil kembali barang/alat yang sudah diserahkan untuk keperluan yang lebih penting dan mendesak.</p>           
                  </td>
            </tr>
            <tr style="vertical-align: top" align="justify">
                  <td style="width:3%"><p>5.</p></td>
                  <td>
                   <p>Pengguna/penerima barang wajib mematuhi persyaratan diatas, apabila melanggar persyaratan tersebut akan dikenai sanksi atau denda sesuai dengan peraturan yang berlaku</p>           
                  </td>
            </tr>
            <tr style="line-height:3">
                  <td colspan="2"><p>Demikian Pernyataan ini untuk dilaksanakan sebagaimana mestinya</p></td>
            </tr>
           
      </table>

      <div class="ttd">
                        <table class="koordinator">
                              <tr>
                                    <td><p>Menyetujui,</p></td>
                              </tr>
                              <tr>
                                    <td><p>Koordinator Ketatausahaan</p></td>
                              </tr>
                              <tr>
                                    <td style="height:50px">
                                          @if($approval->kepala_bagian == "Disetujui")
                                          <img src="{{public_path('foto/ttd/'. $kabag->ttd_kabag)}}" width="50px" alt="">
                                          @endif
                                    </td>
                              </tr>
                              <tr>
                                    <td><p>{{$kabag->name}}</p></td>
                              </tr>
                              <tr>
                                    <td><p>{{$kabag->jenis_identitas}} {{$kabag->no_identitas}}</p></td>
                              </tr>
                        </table>

                        <table class="staff" width="100%">
                              <tr>
                                    <td><p>Yang Menyerahkan Barang</p></td>
                                    <td style="width:50%"></td>
                                    <td><p>Penerima Barang</p></td>
                              </tr>
                              <tr>
                                    <td><p>Staff Umum,</p></td>
                              </tr>
                              <tr>
                                    <td style="height:30px" colspan="3"><img src="{{public_path('foto/ttd/'. $umum->ttd_bagian_umum)}}" width="50px" alt=""></td>
                              </tr>
                              <tr>
                                    <td><p>{{$umum->name}}</p></td>
                                    <td style="width:50%"></td>
                                    <td><p>{{$peminjaman->nama_pj}}</p></td>
                              </tr>
                              <tr>
                                    <td><p>{{$umum->jenis_identitas}} {{$umum->no_identitas}}</p></td>
                                    <td style="width:50%"></td>
                                    <td><p>{{$peminjaman->jenis_identitas}} {{$peminjaman->no_identitas}}</p></td>
                              </tr>
                        </table>
      </div>
    
      

      </div>
</div>
</body>
</html>
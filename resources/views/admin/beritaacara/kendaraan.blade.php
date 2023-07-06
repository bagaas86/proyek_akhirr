<html>
<head>
    <title>Berita Acara Barang Kendaraan </title>
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
      <h4 style="font-weight:bold; font-size:14px;" >BERITA ACARA SERAH TERIMA BARANG</h4>
      <h4 style="line-height:20px; font-size:14px;">Nomor Surat</h4>
      </div>

      <div class="isi" style="font-size:14px">
      <table width="100%" class="mt-2">
            <tr align="justify">
                  <td colspan="3"><p style="line-height:1.5">
                        Pada Hari Ini, Rabu Tanggal {{$tanggal}} Bulan {{$bulan}} Tahun {{$tahun}} ({{$now}}). Kami yang bertanda tangan dibawah ini:</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Nama</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>Zaenal Abidin, S.Pd.I., M.Si.</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>NIP</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>196704221996011001</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Unit</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>Koordinator Ketatausahaan</p></td>
            </tr>
            <tr>
                  <td colspan="3"><p>Selanjutnya disebut PIHAK PERTAMA</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Nama</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>{{$peminjaman->nama_pj}}</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>NIP</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>{{$peminjaman->no_identitas}}</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Unit</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>{{$peminjaman->sebagai}}</p></td>
            </tr>
            <tr>
                  <td style="height:40px" colspan="3"><p>Selanjutnya disebut PIHAK KEDUA</p></td>
            </tr>
            <tr align="justify">
                  <td colspan="3"><p style="line-height:1.5">PIHAK PERTAMA menyerahkan barang kepada PIHAK KEDUA, dan PIHAK KEDUA menyatakan telah menerima barang dari PIHAK PERTAMA berupa barang dengan daftar terlampir</p></td>
            </tr>
      </table>

      <table width="100%" class="list">
      <tr>
            <th class="th"><p>No</p></th>
            <th class="th"><p>Nama Barang</p></th>
            <th class="th"><p>Merk/Type</p></th>
            <th class="th"><p>Jumlah</p></th>
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
            <td class="td" style="width:20%"><p>{{$data->tipe_kendaraan}}</p></td>
            <td class="td" style="width:60%">
            <p>
                  <ul>
                        <li>Plat Nomor :{{$data->plat_kendaraan}}</li>
                        <li>Merk :{{$data->merk_kendaraan}}</li>
                        <li>Warna :{{$data->warna_kendaraan}}</li>
                        <li>{{$data->deskripsi_item}}</li>
                      </ul>      
            </p>
            </td>
            <td class="td" style="text-align:center;width:20%"><p>1</p></td>
      </tr>
      @endforeach
      </table>

      <table width="100%" class="kegiatan">
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
      </table>

      <table width="100%" class="persyaratan">
            <tr style="line-height:1.5">
                  <td colspan="2"><p>Sejak penandatanganan berita acara ini, maka barang tersebut, menjadi tanggung jawab PIHAK KEDUA untuk digunakan dalam rangka kegiatan {{$peminjaman->nama_kegiatan}}. Demikian berita acara serah terima barang ini dibuat, adapun barang barang tersebut dalam keadaan baik dan cukup.</p></td>
            </tr>
           
      </table>

      <div class="ttd" style="margin-top:1.5em">
                        <table class="staff" width="100%">
                              <tr>
                                    <td><p>Yang Menyerahkan</p></td>
                                    <td style="width:35%"></td>
                                    <td><p>Yang Menerima</p></td>
                              </tr>
                              <tr>
                                    <td><p>Koordinator Ketatausahaan,</p></td>
                                    <td style="width:35%"></td>
                                    <td><p>{{$peminjaman->sebagai}}</p></td>
                              </tr>
                              <tr>
                                    <td style="height:75px" colspan="3"></td>
                              </tr>
                              <tr>
                                    <td><p>Zaenal Abidin, S.Pd.I., M.Si.</p></td>
                                    <td style="width:35%"></td>
                                    <td><p>{{$peminjaman->nama_pj}}</p></td>
                              </tr>
                              <tr>
                                    <td><p>NIP. 196704221996011001</p></td>
                                    <td style="width:35%"></td>
                                    <td><p>NIP. {{$peminjaman->no_identitas}}</p></td>
                              </tr>
                        </table>
      </div>
    
      

      </div>
</div>



</body>
</html>
<html>
<head>
    <title> Surat Tugas </title>
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
      <h4 style="font-weight:bold; font-size:18px;text-decoration:underline;" >SURAT PERINTAH TUGAS</h4>
      <h4 style="line-height:1.5; font-size:14px;font-weight:100;">Nomor : {{$nomor_surat}}</h4>
      </div>

      <div class="isi" style="font-size:14px">
      <table width="100%" class="mt-2">
            <tr>
                  <td colspan="3"><p align="justify">
                      Yang bertanda tangan dibawah ini Pengelola Supir Politeknik Negeri Subang, dengan ini menugaskan kepada :</p></td> 
            </tr>
            <tr>
                  <td style="width:20%"><p>Nama</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>{{$aktivitas->nama_supir}}</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Jabatan</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>Driver Politeknik Negeri Subang</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Untuk Melaksanakan</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%">
                        <p>{{$aktivitas->nama_aktivitas}}</p>
                  </td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Tanggal</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%">
                        @php
                        $mulai_aktivitas = date('d M Y H:i', strtotime($aktivitas->mulai_aktivitas));
                        $selesai_aktivitas = date('d M Y H:i', strtotime($aktivitas->selesai_aktivitas));
                        @endphp
                        <p>
                              @if($mulai_aktivitas == $selesai_aktivitas)
                              {{$mulai_aktivitas}}
                              @else
                              {{$mulai_aktivitas}} s/d {{$selesai_aktivitas}}
                              @endif
                         </p>
                  </td>
            </tr>
      </table>

      <div class="ttd" style="float:right;margin-top:1.5;">
            <table class="staff" width="100%">
                  <tr>
                        <td><p>Ditetapkan Di : Subang</p></td>
                  </tr>
                  <tr>
                        <td><p>Pada Tanggal: {{$now}}</p></td>
                  </tr>
                  <tr>
                        <td><p>{{Auth::user()->sebagai}}</p></td>
                  </tr>
                  <tr>
                        <td style="height:50px"></td>
                  </tr>
                  <tr>
                        <td><p>{{Auth::user()->name}}</p></td>
                  </tr>
                  <tr>
                        <td>{{Auth::user()->jenis_identitas}} {{Auth::user()->no_identitas}}</td>
                  </tr>
            </table>
</div>
    
      

      </div>
</div>



</body>
</html>
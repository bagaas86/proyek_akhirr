<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <title>Kwitansi </title>
    <style type= "text/css">
    *{
            margin: 0;
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
                 <td> <img src="{{asset('template')}}/dist/assets/images/logoPolsub.png" width="120px"> </td>
                 <td style="width:99%" class = "tengah">
                  <br>
                       <h2 style="line-height:1px;font-weight:50">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,</h2>
                       <h2 style="line-height:50px;font-weight:50">RISET DAN TEKNOLOGI</h2>
                       <h2 style="margin-top:0.2em;margin-bottom:1em">POLITEKNIK NEGERI SUBANG</h2>
                       <h4 style="font-weight:1;line-height:1px;">Jl. Brigjen Katamso No.37(Belakang RSUD), Dangdeur, Subang, Jawa Barat 41211</h4>
                       <h4 style="font-weight:1;line-height:30px;">Telp. (0260) 417658 Laman: <span style="color:blue">https://www.polsub.ac.id</span></h4>
                 </td>
            </tr>
      </table>
     <div class="judul">
      <h4 style="font-weight:bold; font-size:16px;text-decoration:underline;" >K W I T A N S I</h4>
      <h4 style="line-height:30px; font-size:12px;">KWI-24-12-2023</h4>
      </div>

      <div class="isi" style="font-size:14px">
      <table width="100%" class="mt-2">
            <tr>
                  <td style="width:20%"><p>Penerima</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>Jacob</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Jumlah Uang</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>Rp. 10.000.000</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Untuk Pembayaran</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>Dinas Palembang</p></td>
            </tr>
      </table>




      <div style="float:right" class="ttd">
                        <table class="staff" width="100%">
                              <tr>
                                    <td><p>Subang, 24 Mei 2023</p></td>
                              </tr>
                              <tr>
                                    <td>Bendahara</td>
                              </tr>
                              <tr>
                                    <td style="height:50px"></td>
                              </tr>
                              <tr>
                                    <td>Nama Bendahara</td>
                              </tr>
                              <tr>
                                    <td>NIP 32127137173173</td>
                              </tr>
                        </table>
      </div>
    
      

      </div>
</div>



</body>

<script>
    $(document).ready(function() {
            window.print()
        });
</script>
</html>
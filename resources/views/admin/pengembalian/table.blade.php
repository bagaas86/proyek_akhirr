<style>
    div.dataTables_wrapper {
        width: auto;
        margin: 0 auto;
    }
</style>
<input type="text" id="status" name="status" value="{{Auth::user()->sebagai}}" hidden>
<table width="100%" id="pengembalian" class="display">
    <thead>
        <tr style="font-size: 14px">
            <th>No</th>
            <th>Nama Penanggung Jawab</th>
            <th>Sebagai</th>
            <th>Waktu Pelaporan</th>
            <th>Waktu Peminjaman</th>
            <th>Jenis Peminjaman</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengembalian as $data)
        @php
        $jenis_peminjaman = explode("," , $data->jenis_peminjaman);
        date_default_timezone_set("Asia/Jakarta");
        $waktu_pengembalian = date('d M Y h:i', strtotime($data->waktu_pengembalian));
        $waktu_awal = date('d M Y ', strtotime($data->waktu_awal));
        $waktu_akhir = date('d M Y ', strtotime($data->waktu_akhir));
        @endphp
        <tr style="font-size: 12px">
            <td></td>
            <td style="width:15%">{{$data->nama_pj}}</td>
            <td style="width:10%">{{$data->sebagai}}</td>
            <td>
                @if($waktu_pengembalian <> "01 Jan 1970 07:00")
                {{$waktu_pengembalian}}
                @else 
                -
                @endif
            </td>
            <td>{{$waktu_awal}} s/d {{$waktu_akhir}}</td>
            <td> @foreach($jenis_peminjaman as $badge)
                <span class="badge badge-secondary">{{ $badge }}</span>
                @endforeach
            </td>
            <td>
              @if($data->status_pengembalian == "Belum Dikembalikan")
              <span class="badge badge-warning">Belum Dikembalikan</span>
              @elseif($data->status_pengembalian == "Proses Pengembalian")
              <span class="badge badge-primary">Pelaporan</span>
              @elseif($data->status_pengembalian == "Pengembalian Ditolak")
              <span class="badge badge-danger">Pengembalian Ditolak</span>
              @else
              <span class="badge badge-success">Pengembalian Disetujui</span>
              @endif
            </td>
            <td style="width:20%">
                @if($data->status_pengembalian == "Proses Pengembalian")
                <a href="#" onclick="modalDetail({{$data->id_peminjaman}})" class="btn btn-primary btn-sm mt-2">Konfirmasi Pelaporan Pengembalian</a>
                @elseif($data->status_pengembalian == "Pengembalian Ditolak")
                <a href="#" onclick="modalDetail2({{$data->id_peminjaman}})" class="btn btn-primary btn-sm mt-2">Lihat</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
     var t = $('#pengembalian').DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        stateSave: true,
        columnDefs: [
             {
                 searchable: false,
                 orderable: false,
                 targets: 0,
             },
         ],
         order: [[1, 'asc']],

    });

    t.on('order.dt search.dt', function () {
         let i = 1;
  
         t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
             this.data(i++);
         });
     }).draw();
     
 
     
 });

    function modalDetail(id_peminjaman)
    {
        $.get("{{ url('detailpengembalianadmin') }}/" + id_peminjaman, {}, function(data, status){
            $("#exampleModalCenterTitle2").html(`Detail Pengembalian`)
            $("#page2").html(data);
            $("#modalFooter2").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>
            <a style="color:white" onclick="modalKonfirmasi(`+id_peminjaman+`)"  class="btn  btn-primary" data-dismiss="modal">Konfirmasi Pelaporan</a>`)
            $("#exampleModalCenter2").modal('show');
        })
       
    }

    function modalDetail2(id_peminjaman)
    {
        $.get("{{ url('detailpengembalianadmin') }}/" + id_peminjaman, {}, function(data, status){
            $("#exampleModalCenterTitle2").html(`Detail Pengembalian`)
            $("#page2").html(data);
            $("#modalFooter2").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>
           `)
            $("#exampleModalCenter2").modal('show');
        })
       
    }
 
    function modalKonfirmasi(id_peminjaman)
    {
            $("#exampleModalCenterTitle2").html(`Detail Pengembalian`)
            $("#page2").html('Apakah Anda Yakin Untuk Konfirmasi Pelaporan Pengembalian?');
            $("#modalFooter2").html(`
            <a style="color:white"  onclick="modalDetail(`+id_peminjaman+`)" class="btn  btn-secondary">Tutup</a>
            <a style="color:white" href="#" id="statusterima`+id_peminjaman+`" onclick="konfirmasi(`+id_peminjaman+`)" data-custom-value="Pengembalian Diterima"  class="btn  btn-primary">Konfirmasi Pelaporan</a>
            <a style="color:white" href="#" id="statustolak`+id_peminjaman+`" onclick="tolak(`+id_peminjaman+`)" data-custom-value="Pengembalian Ditolak"  class="btn  btn-danger">Tolak Pelaporan</a>`)
            $("#exampleModalCenter2").modal('show');
       
    }

    function konfirmasi(id_peminjaman) { 
        var status = $("#statusterima"+id_peminjaman).data("custom-value");
            $.ajax({
                type: "get",
                url: "{{ url('konfirmasipengembalian') }}/" + id_peminjaman,
                data :{
                    'status' : status,
                },
                success: function(data) {
                    modalClose()
                    tampil()
                    modalDetail2(id_peminjaman)


                }
            });
        }

        function tolak(id_peminjaman) { 
        var status = $("#statustolak"+id_peminjaman).data("custom-value");
        console.log(status)
            $.ajax({
                type: "get",
                url: "{{ url('konfirmasipengembalian') }}/" + id_peminjaman,
                data :{
                    'status' : status,
                },
                success: function(data) {
                    modalClose()
                    tampil()
                    modalDetail2(id_peminjaman)


                }
            });
        }
 

    function modalClose()
    {
        $(".close").click();
    }

    // function ubahStatus(id_peminjaman) { 
    //     var status = $("#status").val();
    //         $.ajax({
    //             type: "get",
    //             url: "{{ url('ubahstatus') }}/" + id_peminjaman,
    //             data :{
    //                 'status' : status,
    //             },
    //             success: function(data) {
    //                 tampil(),
    //                 modalClose()

    //             }
    //         });
    //     }

    //     function ubahStatusTolak(id_peminjaman) { 
    //     var status = $("#status").val();
    //         $.ajax({
    //             type: "get",
    //             url: "{{ url('ubahstatustolak') }}/" + id_peminjaman,
    //             data :{
    //                 'status' : status,
    //             },
    //             success: function(data) {
    //                 tampil(),
    //                 modalClose()

    //             }
    //         });
    //     }  
   
    function modalStatus(id_peminjaman) 
    {
            $("#exampleModalCenterTitle").html(`Konfirmasi Peminjaman?`)
            $("#page").html('Apakah Anda yakin Ingin Menyetujui Peminjaman?');
            $("#modalFooter").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>
            <a style="color:white" href="#" onclick="ubahStatus(`+id_peminjaman+`)" class="btn  btn-success">Setuju</a>)`)
            $("#exampleModalCenter").modal('show');
    }

    function modalStatusTolak(id_peminjaman) 
    {
            $("#exampleModalCenterTitle").html(`Konfirmasi Peminjaman?`)
            $("#page").html('Apakah Anda yakin Ingin Menolak Peminjaman?');
            $("#modalFooter").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>
            <a style="color:white" href="#" onclick="ubahStatusTolak(`+id_peminjaman+`)" class="btn  btn-success">Tolak</a>)`)
            $("#exampleModalCenter").modal('show');
    }

    function modalFinish() 
    {
            $("#exampleModalCenterTitle").html(`Berhasil`)
            $("#page").html('Berhasil');
            $("#modalFooter").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>)`)
            $("#exampleModalCenter").modal('show');
    }

 </script>



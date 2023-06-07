<style>
    div.dataTables_wrapper {
        width: auto;
        margin: 0 auto;
    }
</style>
<input type="text" id="status" name="status" value="{{Auth::user()->sebagai}}" hidden>
<table width="100%" id="peminjaman" class="display">
    <thead>
        <tr style="font-size: 14px">
            <th>No</th>
            <th>Nama Penanggung Jawab</th>
            <th>Sebagai</th>
            <th>Waktu Pengajuan</th>
            <th>Waktu Peminjaman</th>
            <th>Jenis Peminjaman</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjaman as $data)
        @php
        $jenis_peminjaman = explode("+" , $data->jenis_peminjaman);
        date_default_timezone_set("Asia/Jakarta");
        $waktu_pengajuan = date('d M Y h:i', strtotime($data->waktu_pengajuan));
        $waktu_awal = date('d M Y ', strtotime($data->waktu_awal));
        $waktu_akhir = date('d M Y ', strtotime($data->waktu_akhir));
        @endphp
        <tr style="font-size: 12px">
            <td></td>
            <td style="width:15%">{{$data->nama_pj}}</td>
            <td style="width:10%">{{$data->sebagai}}</td>
            <td>{{$waktu_pengajuan}}</td>
            <td>{{$waktu_awal}} s/d {{$waktu_akhir}}</td>
            <td> @foreach($jenis_peminjaman as $badge)
                <span class="badge badge-secondary">{{ $badge }}</span>
                @endforeach
            </td>
            <td>
                @if(Auth::user()->sebagai == "Staff Umum")
                @if($data->staff_umum == "Proses")
                <span class="badge bg-warning">Menunggu Persetujuan Anda</span>
                @elseif($data->staff_umum == "Disetujui")
                <span class="badge bg-success">Disetujui Oleh Anda</span>
                @elseif($data->staff_umum == "Ditolak")
                <span class="badge bg-danger">Ditolak</span>
                @endif
                @endif

                @if(Auth::user()->sebagai == "Kepala Bagian")
                @if($data->kepala_bagian == "Proses")
                <span class="badge bg-warning">Menunggu Persetujuan Anda</span>
                @elseif($data->kepala_bagian == "Disetujui")
                <span class="badge bg-success">Disetujui</span>
                @elseif($data->kepala_bagian == "Ditolak")
                <span class="badge bg-danger">Ditolak</span>
                @endif
                @endif

                @if(Auth::user()->sebagai == "Wakil Direktur 1")
                @if($data->wakil_direktur_1 == "Proses")
                <span class="badge bg-warning">Menunggu Persetujuan Anda</span>
                @elseif($data->wakil_direktur_1 == "Disetujui")
                <span class="badge bg-success">Disetujui</span>
                @elseif($data->wakil_direktur_1 == "Ditolak")
                <span class="badge bg-danger">Ditolak</span>
                @endif
                @endif

                @if(Auth::user()->sebagai == "Wakil Direktur 2")
                @if($data->wakil_direktur_2 == "Proses")
                <span class="badge bg-warning">Menunggu Persetujuan Anda</span>
                @elseif($data->wakil_direktur_2 == "Disetujui")
                <span class="badge bg-success">Disetujui</span>
                @elseif($data->wakil_direktur_2 == "Ditolak")
                <span class="badge bg-danger">Ditolak</span>
                @endif
                @endif
            </td>
            <td style="width:20%">
                <a href="#" onclick="modalApproval({{$data->id_peminjaman}})" class="btn btn-primary btn-sm mt-2">Lihat Persetujuan</a>
                <a href="#" onclick="modalDetail({{$data->id_peminjaman}})" class="btn btn-primary btn-sm mt-2">Lihat</a>
                @if(Auth::user()->sebagai == "Kepala Bagian")
                @if($data->kepala_bagian == "Proses")
                <a href="#" onclick="modalStatus({{$data->id_peminjaman}})" class="btn btn-success btn-sm mt-2"><i class="bi bi-check"></i></a>
                <a href="#" onclick="modalStatusTolak({{$data->id_peminjaman}})"  class="btn btn-danger btn-sm mt-2"><i class="bi bi-x"></i></a>
                @endif
                @endif

                @if(Auth::user()->sebagai == "Wakil Direktur 1")
                @if($data->wakil_direktur_1 == "Proses")
                <a href="#" onclick="modalStatus({{$data->id_peminjaman}})" class="btn btn-success btn-sm mt-2"><i class="bi bi-check"></i></a>
                <a href="#" onclick="modalStatusTolak({{$data->id_peminjaman}})"  class="btn btn-danger btn-sm mt-2"><i class="bi bi-x"></i></a>
                @endif
                @endif

                @if(Auth::user()->sebagai == "Wakil Direktur 2")
                @if($data->wakil_direktur_2 == "Proses")
                <a href="#" onclick="modalStatus({{$data->id_peminjaman}})" class="btn btn-success btn-sm mt-2"><i class="bi bi-check"></i></a>
                <a href="#" onclick="modalStatusTolak({{$data->id_peminjaman}})"  class="btn btn-danger btn-sm mt-2"><i class="bi bi-x"></i></a>
                @endif
                @endif

                @if(Auth::user()->sebagai == "Staff Umum")
                @if($data->staff_umum == "Proses")
                <a href="#" onclick="modalStatus({{$data->id_peminjaman}})" class="btn btn-success btn-sm mt-2"><i class="bi bi-check"></i></a>
                <a href="#" onclick="modalStatusTolak({{$data->id_peminjaman}})"  class="btn btn-danger btn-sm mt-2"><i class="bi bi-x"></i></a>
                @endif
                @if($data->staff_umum == "Disetujui")
                <a href="#" onclick="modalCetak({{$data->id_peminjaman}})" class="btn btn-primary btn-sm mt-2">Berita Acara</a>
                @endif
                @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
     var t = $('#peminjaman').DataTable({
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

 function modalApproval(id_peminjaman)
    {
        $.get("{{ url('modalapproval') }}/" + id_peminjaman, {}, function(data, status){
            $("#exampleModalCenterTitle2").html(`Lihat Persetujuan`)
            $("#page2").html(data);
            $("#modalFooter2").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>)`)
            $("#exampleModalCenter2").modal('show');
        })
       
    }

    function modalClose()
    {
        $(".close").click();
    }

    function ubahStatus(id_peminjaman) { 
        var status = $("#status").val();
            $.ajax({
                type: "get",
                url: "{{ url('ubahstatus') }}/" + id_peminjaman,
                data :{
                    'status' : status,
                },
                success: function(data) {
                    tampil(),
                    modalClose()

                }
            });
        }

        function ubahStatusTolak(id_peminjaman) { 
        var status = $("#status").val();
            $.ajax({
                type: "get",
                url: "{{ url('ubahstatustolak') }}/" + id_peminjaman,
                data :{
                    'status' : status,
                },
                success: function(data) {
                    tampil(),
                    modalClose()

                }
            });
        }

    function cetakBarang(id_peminjaman)
    {
        var cek = $('#barangs').attr("data-custom-value");
        $("#download").html(`Sedang Membuat Berita Acara, Harap Tunggu...`)
        $.ajax({
                type: "get",
                url: "{{ url('peminjaman/pengajuan/cetak/') }}/" + id_peminjaman,
                data: {
                "cek": cek
                 },
                 xhrFields: {
                responseType: 'blob',
                },
                success: function(response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');

                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Berita Acara Barang.pdf";
                    link.click()
                    $("#download").html(`Berita Acara Selesai...`)
                },
                error: function(blob){
                console.log(blob);
            }
            });
    }

    function cetakRuangan(id_peminjaman)
    {
        var cek = $('#ruangans').attr("data-custom-value");
        $("#download").html(`Sedang Membuat Berita Acara, Harap Tunggu...`)
        $.ajax({
                type: "get",
                url: "{{ url('peminjaman/pengajuan/cetak/') }}/" + id_peminjaman,
                data: {
                "cek": cek
                 },
                 xhrFields: {
                responseType: 'blob',
                },
                success: function(response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Berita Acara Ruangan.pdf";
                    link.click()
                    $("#download").html(`Berita Acara Selesai...`)
                },
                error: function(blob){
                console.log(blob);
            }
            });
    }
  
   
    
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

    function modalCetak(id_peminjaman) 
    {
        $.get("{{ url('modalcetak') }}/" + id_peminjaman, {}, function(data, status){
            $("#exampleModalCenterTitle2").html(`Detail Peminjaman`)
            $("#page2").html(data);
            $("#modalFooter2").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>)`)
            $("#exampleModalCenter2").modal('show');
        })
    }

    function modalFinish() 
    {
            $("#exampleModalCenterTitle").html(`Berhasil`)
            $("#page").html('Berhasil');
            $("#modalFooter").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>)`)
            $("#exampleModalCenter").modal('show');
    }



    function modalDetail(id_peminjaman)
    {
        $.get("{{ url('detailpeminjaman') }}/" + id_peminjaman, {}, function(data, status){
            $("#exampleModalCenterTitle2").html(`Detail Peminjaman`)
            $("#page2").html(data);
            $("#modalFooter2").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>)`)
            $("#exampleModalCenter2").modal('show');
        })
       
    }
 </script>



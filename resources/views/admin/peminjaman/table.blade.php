<style>
    div.dataTables_wrapper {
        width: auto;
        margin: 0 auto;
    }
</style>
<input type="text" id="status" name="status" value="{{Auth::user()->level}}" hidden>
<table width="100%" id="myTable" class="display">
    <thead>
        <tr style="font-size: 14px">
            <th>No</th>
            <th>Nama Penanggung Jawab</th>
            <th>Jurusan/Organisasi</th>
            <th>Waktu Pengajuan</th>
            <th>Waktu Peminjaman</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjaman as $data)
        @php
        date_default_timezone_set("Asia/Jakarta");
        $waktu_pengajuan = date('d M Y h:i', strtotime($data->waktu_pengajuan));
        $waktu_awal = date('d M Y ', strtotime($data->waktu_awal));
        $waktu_akhir = date('d M Y ', strtotime($data->waktu_akhir));
        @endphp
        <tr style="font-size: 12px">
            <td></td>
            <td style="width:15%">{{$data->nama_pj}}</td>
            <td style="width:25%">{{$data->name}}</td>
            <td>{{$waktu_pengajuan}}</td>
            <td>{{$waktu_awal}} s/d {{$waktu_akhir}}</td>
            <td>
                @if(Auth::user()->level == "Bagian Umum")
                @if($data->staff_umum == "Proses")
                <span class="badge bg-warning">Menunggu Persetujuan Anda</span>
                @elseif($data->staff_umum == "Disetujui")
                <span class="badge bg-success">Disetujui</span>
                @endif
                @endif

                @if(Auth::user()->level == "Kabag")
                @if($data->kepala_bagian == "Proses")
                <span class="badge bg-warning">Menunggu Persetujuan Anda</span>
                @elseif($data->kepala_bagian == "Disetujui")
                <span class="badge bg-success">Disetujui</span>
                @endif
                @endif
            </td>
            <td style="width:20%">
                <a href="#" onclick="modalApproval({{$data->id_peminjaman}})" class="btn btn-primary btn-sm mt-2">Lihat Persetujuan</a>
                <a href="#" onclick="modalDetail({{$data->id_peminjaman}})" class="btn btn-primary btn-sm mt-2">Lihat</a>
                @if(Auth::user()->level == "Kabag")
                @if($data->kepala_bagian == "Proses")
                <a href="#" onclick="modalStatus({{$data->id_peminjaman}})" class="btn btn-success btn-sm mt-2">Setuju</a>
                <a href="#" class="btn btn-danger btn-sm mt-2">Tolak</a>
                @endif
                @endif

                @if(Auth::user()->level == "Bagian Umum")
                @if($data->staff_umum == "Proses")
                <a href="#" onclick="modalStatus({{$data->id_peminjaman}})" class="btn btn-success btn-sm mt-2">Setuju</a>
                <a href="#" class="btn btn-danger btn-sm mt-2">Tolak</a>
                @endif
                @endif

                @if($data->staff_umum == "Disetujui")
                <a href="#" onclick="modalCetak({{$data->id_peminjaman}})" class="btn btn-primary btn-sm mt-2">Berita Acara</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Modal --}}
<div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="mb-0" id="page"></p>
            </div>
            <div id="modalFooter" class="modal-footer">
             
            </div>
        </div>
    </div>
</div>
{{-- endModal --}}

{{-- Modal --}}
<div id="exampleModalCenter2" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle2">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="mb-0" id="page2"></p>
            </div>
            <div id="modalFooter2" class="modal-footer">
             
            </div>
        </div>
    </div>
</div>
{{-- endModal --}}


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
     var t = $('#myTable').DataTable({
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
                    modalFinish()
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



<table id="myTable" class="display">
    <thead>
        <tr style="font-size:14px">
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
        $waktu_awal = date('d M Y h:i', strtotime($data->waktu_awal));
        $waktu_akhir = date('d M Y h:i', strtotime($data->waktu_akhir));
        @endphp
        <tr style="font-size:12px">
            <td></td>
            <td style="width:15%">{{$data->nama_pj}}</td>
            <td style="width:25%">{{$data->name}}</td>
            <td>{{$waktu_pengajuan}}</td>
            <td>{{$waktu_awal}} s/d {{$waktu_akhir}}</td>
            <td>
                @if($data->status_peminjaman == "Proses")
                <span class="badge bg-warning">Menunggu</span>
                @elseif($data->status_peminjaman == "Disetujui")
                <span class="badge bg-success">Disetujui</span>
                @endif
            </td>
            <td style="width:30%">
                <a href="#" onclick="modalApproval({{$data->id_peminjaman}})" class="btn btn-primary btn-sm">Lihat Persetujuan</a>
                <a href="#" class="btn btn-success btn-sm">Setuju</a>
                <a href="#" class="btn btn-danger btn-sm">Tolak</a>
              
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

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
 </script>


<style>
    div.dataTables_wrapper {
        width: auto;
        margin: 0 auto;
    }
</style>
<table width="100%" id="pengembalian" class="display">
    <thead>
        <tr style="font-size: 14px">
            <th>No</th>
            <th>Nama Penanggung Jawab</th>
            <th>Aktivitas</th>
            <th>Unit/Jabatan</th>
            <th>Waktu Pengajuan</th>
            <th>Waktu Peminjaman</th>
            <th>Jenis Peminjaman</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjaman as $data)
        @php
        $jenis_peminjaman = explode("," , $data->jenis_peminjaman);
        date_default_timezone_set("Asia/Jakarta");
        $waktu_pengajuan = date('d M Y H:i', strtotime($data->waktu_pengajuan));
        $waktu_awal = date('d M Y ', strtotime($data->waktu_awal));
        $waktu_akhir = date('d M Y ', strtotime($data->waktu_akhir));
        @endphp
        <tr style="font-size: 12px">
            <td></td>
            <td style="width:15%">{{$data->nama_pj}}</td>
            <td style="width:15%">{{$data->nama_kegiatan}}</td>
            <td style="width:10%">{{$data->dari}}</td>
            <td>{{$waktu_pengajuan}} <span style="color:white" class="badge @if($data->status_peminjaman == "Proses") bg-primary @else bg-success @endif">{{$data->status_peminjaman}}</span></td>
            <td>{{$waktu_awal}} s/d {{$waktu_akhir}}</td>
            <td> @foreach($jenis_peminjaman as $badge)
                <span class="badge badge-secondary">{{ $badge }}</span>
                @endforeach
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


 </script>



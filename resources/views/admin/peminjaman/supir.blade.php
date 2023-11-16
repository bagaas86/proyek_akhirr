<div class="xformdm">
    <center>
        <h5>Informasi Peminjaman Supir {{$identitas->nama_supir}}</h5>
    </center>
    <div class="form mt-4">
       <div class="row">
            <div class="col col-md-12 col-12">
                <table id="supirs" class="display" style="width:100%;font-size:14px;">
                    <thead>
                        <tr style="vertical-align:top">
                            <th></th>
                            <th style="width:25%">Nama Supir</th>
                            <th style="width:30%">Nama Aktivitas</th>
                            <th>Awal Peminjaman</th>
                            <th>Selesai Peminjaman</th>
                          </tr>
                    </thead>
                  <tbody>
                    @foreach($supir as $item)
                    @php
                       $waktu_awal = date('d M Y H:i ', strtotime($item->mulai_aktivitas));
                        $waktu_akhir = date('d M Y H:i', strtotime($item->selesai_aktivitas));
                    @endphp
                    <tr>
                        <td></td>
                        <td style="width:30%">{{$item->nama_supir}}</td>
                        <td style="width:30%">{{$item->nama_aktivitas}}</td>
                        <td style="width:15%">{{$waktu_awal}} WIB</td>
                        <td  style="width:15%">{{$waktu_akhir}} WIB</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
       </div>
    </div>
  
</div>


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
     var t = $('#supirs').DataTable({
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
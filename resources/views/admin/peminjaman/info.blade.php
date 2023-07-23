<div class="xformdm">
    <center>
        <h5>Informasi Peminjaman {{$identitas->nama_item}}</h5>
    </center>
    <div class="form mt-4">
       <div class="row">
            <div class="col col-md-12 col-12">
                <table id="info" class="display" style="width:100%;font-size:14px;">
                    <thead>
                        <tr style="vertical-align:top">
                            <th></th>
                            <th style="width:25%">Nama Barang</th>
                            <th style="width:30%">Nama Kegiatan</th>
                            <th>Jumlah</th>
                            <th>Awal Peminjaman</th>
                            <th>Selesai Peminjaman</th>
                          </tr>
                    </thead>
                  <tbody>
                    @foreach($keranjang as $item)
                    @php
                       $waktu_awal = date('d M Y H:i ', strtotime($item->waktu_awal));
                        $waktu_akhir = date('d M Y H:i', strtotime($item->waktu_akhir));
                    @endphp
                    <tr>
                        <td></td>
                        <td style="width:30%">{{$item->nama_item}}</td>
                        <td style="width:30%">{{$item->nama_kegiatan}}</td>
                        <td style="width:10%">{{$item->jumlah}}</td>
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

<script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
     var t = $('#info').DataTable({
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
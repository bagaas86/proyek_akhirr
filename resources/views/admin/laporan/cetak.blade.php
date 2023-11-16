<style>
     .list, .th, .td {
      border: 1px solid black;
      border-collapse: collapse;
      font-size:12pt;
      margin-top:1.5em;
      margin-left:0.4em;
      }
</style>

<table width="100%" id="pengembalian" class="list">
    <thead>
        <tr style="font-size: 14px">
            <th class="th">No</th>
            <th class="th">Nama Penanggung Jawab</th>
            <th class="th">Aktivitas</th>
            <th class="th">Unit/Jabatan</th>
            <th class="th">Waktu Pengajuan</th>
            <th class="th">Waktu Peminjaman</th>
            <th class="th">Jenis Peminjaman</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 0;
        @endphp
        @foreach($peminjaman as $data)
        @php
        $i = $i+1;
        @endphp
        @php
        $jenis_peminjaman = explode("," , $data->jenis_peminjaman);
        date_default_timezone_set("Asia/Jakarta");
        $waktu_pengajuan = date('d M Y H:i', strtotime($data->waktu_pengajuan));
        $waktu_awal = date('d M Y ', strtotime($data->waktu_awal));
        $waktu_akhir = date('d M Y ', strtotime($data->waktu_akhir));
        @endphp
        <tr style="font-size: 12px">
            <td class="td" style="width:5%">{{$i}}</td>
            <td class="td" style="width:15%">{{$data->nama_pj}}</td>
            <td class="td" style="width:15%">{{$data->nama_kegiatan}}</td>
            <td class="td" style="width:10%">{{$data->dari}}</td>
            <td class="td">{{$waktu_pengajuan}}</td>
            <td class="td">{{$waktu_awal}} s/d {{$waktu_akhir}}</td>
            <td class="td"> @foreach($jenis_peminjaman as $badge)
                <span class="badge badge-secondary">{{ $badge }}</span>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
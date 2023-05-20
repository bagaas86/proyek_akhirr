<center>
    <table width="80%">
        <tr>
            <td style="width:50%">Nama BMN</td>
            <td style="width:2%">:</td>
            <td style="width:50%">{{$item->nama_item}}</td>
        </tr>
        <tr>
            <td style="width:50%">Jumlah BMN</td>
            <td style="width:2%">:</td>
            <td style="width:50%">{{$item->jumlah_item}}</td>
        </tr>
        <tr>
            <td style="width:50%">Lokasi BMN</td>
            <td style="width:2%">:</td>
            <td style="width:50%">{{$item->lokasi_item}}</td>
        </tr>
        @if($item->kategori_item == "Kendaraan")
        <tr>
            <td>Tipe Kendaraan</td>
            <td>:</td>
            <td>{{$kendaraan->tipe_kendaraan}}</td>
        </tr>
        <tr>
            <td>Plat Nomor</td>
            <td>:</td>
            <td>{{$kendaraan->plat_kendaraan}}</td>
        </tr>
        <tr>
            <td>Warna Kendaraan</td>
            <td>:</td>
            <td>{{$kendaraan->warna_kendaraan}}</td>
        </tr>
        @endif
    </table>
</center>

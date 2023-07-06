<center>
    <div id="download">
    </div>
    <div class="row">
        @if($checkbarang <> 0)
        <div class="col col-md-4">
            <a style="color:white" onclick="cetakBarang({{$id_peminjaman}})" id="barangs" data-custom-value="Barang" class="btn  btn-primary">Download Berita Acara Barang</a>
        </div>
        @endif  
        @if($checkruangan <> 0)
        <div  class="col col-md-4">
            <a style="color:white" onclick="cetakRuangan({{$id_peminjaman}})" id="ruangans" data-custom-value="Ruangan" class="btn  btn-primary">Download Berita Acara Ruangan</a>
        </div>  
        @endif
        @if($checkkendaraan <> 0)
        <div class="col col-md-4">
            <a style="color:white" onclick="cetakKendaraan({{$id_peminjaman}})" id="kendaraans" data-custom-value="Kendaraan" class="btn  btn-primary">Download Berita Acara Kendaraan</a>
        </div>  
        @endif
    </div>
</center>
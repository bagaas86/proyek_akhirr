

<div class="awal">
    <div class="header" style="text-align: center">
        <h4>Bukti Awal Peminjaman</h4>
    </div>
    <div class="row">
        @foreach ($awal as $item)
            <div class="col col-3 col-md-3">
                <h6>Diupload pada {{$item->tanggal_upload}}</h6>
                @if($item->foto_bukti <> null)
                <img src="{{asset('foto/peminjaman/foto/'. $item->foto_bukti)}}" alt="" style="width:250px;height:150px">
                @else
                <img src="{{asset('foto/peminjaman/foto/npengambilan.png')}}" alt="" style="width:250px;height:150px">
                @endif
            </div>
        @endforeach
    </div>
</div>

<div class="mt-4">
    <div class="header" style="text-align: center">
        <h4>Bukti Pengembalian</h4>
    </div>
    <div class="row">
    @foreach ($foto as $item)
        <div class="col col-3 col-md-3">
            <h6>Diupload pada {{$item->tanggal_upload}}</h6>
            @if($item->foto_bukti <> null)
            <img src="{{asset('foto/pengembalian/foto/'. $item->foto_bukti)}}" alt="" style="width:250px;height:150px">
            @else
            <img src="{{asset('foto/pengembalian/foto/npengembalian.png')}}" alt="" style="width:250px;height:150px">
            @endif
        </div>
    @endforeach
    </div>
</div>


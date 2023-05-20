<div class="row mt-2">
    <div class="col col-md-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="header" style="text-align: center">
                    <h4>Barang</h4>
                </div>
                <div class="1">
                    <table>
                        <tr style="border-bottom:1pt solid rgb(205, 205, 205);">
                            <th style="width:60%">Nama Barang</th>
                            <th style="width:30%">Jumlah</th> 
                            <th style="width:10%;padding-left:30px;">Aksi</th>   
                        </tr>
                        @foreach($keranjang as $data)
                        <tr style="height:50px;color:black">
                            <td style="width:60%">{{$data->nama_item}}</td>
                            <td style="width:30%"> <input class="form-control" type="number" value="{{old('jumlah',$data->jumlah)}}" id="jumlah{{$data->id_keranjang}}" name="jumlah" onchange="ubahJumlah({{$data->id_keranjang}})"></td>
                            <td style="width:10%;padding-left:30px;"><a href="#" class="btn btn-danger btn-sm" id="delete{{$data->id_keranjang}}" onclick="hapusBarang({{$data->id_keranjang}})"> <i class="bi bi-trash"></i> </a></td>
                        </tr>
                        @endforeach
                    </table> 
                </div>  
            </div>
        </div>
        
        
        <div class="card mt-2">
            <div class="card-body">
                <div class="header" style="text-align: center">
                    <h4>Ruangan</h4>
                </div>
                <div class="2">
                    <table>
                        <tr style="border-bottom:1pt solid rgb(205, 205, 205);">
                            <th style="width:85%">Nama Ruangan</th> 
                            <th style="width:10%;padding-left:30px;">Aksi</th>   
                        </tr>
                        @foreach($ruangan as $datas)
                        <tr style="height:50px">
                            <td style="width:85%">{{$datas->nama_item}}</td>
                            <td style="width:10%;padding-left:30px;"><a href="#" class="btn btn-danger btn-sm" id="delete{{$datas->id_keranjang}}" onclick="hapusBarang({{$datas->id_keranjang}})"> <i class="bi bi-trash"></i> </a></td>
                        </tr>
                        @endforeach
                    </table> 
                </div>
                  
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <div class="header" style="text-align: center">
                    <h4>Kendaraan</h4>
                </div>
                <div class="2">
                    <table>
                        <tr style="border-bottom:1pt solid rgb(205, 205, 205);">
                            <th style="width:40%">Merk Kendaraan</th> 
                            <th style="width:40%">Plat Kendaraan</th> 
                            <th style="width:10%;padding-left:30px;">Aksi</th>   
                        </tr>
                        @foreach($kendaraan as $datas)
                        <tr style="height:50px">
                            <td style="width:40%">{{$datas->nama_item}}</td>
                            <td style="width:40%">{{$datas->plat_kendaraan}}</td>
                            <td style="width:10%;padding-left:30px;"><a href="#" class="btn btn-danger btn-sm" id="delete{{$datas->id_keranjang}}" onclick="hapusBarang({{$datas->id_keranjang}})"> <i class="bi bi-trash"></i> </a></td>
                        </tr>
                        @endforeach
                    </table> 
                </div>
                  
            </div>
        </div>
        
    </div>
</div>



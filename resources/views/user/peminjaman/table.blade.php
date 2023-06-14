<input type="text" class="form-control" id="id_user" value="{{ Auth::user()->id }}" hidden>
<br>

<div class="text-center title">
    {{-- <div id="form1">
        <a href="#" class="btn btn-primary" onclick="submit()">Pinjam Sekarang</a>
    </div> --}}
  
</div>
   


<div class="row">
    @foreach($item as $data)
    <div class="col col-6 col-md-3" style="margin-top:1em;">
        <div class="card h-100" style="border:1px solid grey">
            <div type="button" onclick="tambahitem({{ $data->id_item }})"  class="card-header h-50">
                <div style="text-align: center">
                    @if($data->kategori_item == "Barang")
                    <img class="img-rounded" src="{{asset('foto/dm/barang/'. $data->foto_item)}}" width="50%" height="50%"  alt="">    
                    @elseif($data->kategori_item == "Ruangan")
                    <img class="img-rounded" src="{{asset('foto/dm/ruangan/'. $data->foto_item)}}" width="50%" height="50%" alt="">    
                    @elseif($data->kategori_item == "Kendaraan")
                    <img class="img-rounded" src="{{asset('foto/dm/kendaraan/'. $data->foto_item)}}" width="50%" height="50%" alt="">    
                    @endif
                </div>
               
                
            </div>
            <div class="card-body h-20">
                <div style="text-align: center">
                    <h6>{{$data->nama_item}}</h6>
                  
                </div>
                <div style="text-align:center">
                    <a class="btn btn-primary btn-sm" onclick="modalDetail({{$data->id_item}})" href="#"><i class="bi bi-eye"></i></a>
                </div>
            </div>
           
        </div>
    </div>
    @endforeach
</div>

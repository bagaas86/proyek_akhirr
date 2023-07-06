<div class="card">
    @foreach($ulasan as $data)
    <div class="card-body">
        <div class="row">
            <div class="col col-md-2">
                <center>
                    <img src="{{asset('foto/dm/pengguna/default.png')}}" class="img-rounded" style="width:20%">
                </center>
            </div>
            <div class="col col-md-8">
                {{$data->ulasan}}
            </div>
            <div class="col col-md-2">
                {{$data->waktu_ulasan}}
            </div>
        </div>
    </div>
    @endforeach
</div>
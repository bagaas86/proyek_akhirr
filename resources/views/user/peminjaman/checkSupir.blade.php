    @foreach($supir as $data)
    <div style="border: 1px solid grey;height:50px" class="card justify-content-center mt-2">
        <div class="row">
            <div style="float:left;" class="col col-md-10 col-8">
                <h6>{{$data->nama_supir}}</h6>
            </div>
            <div class="col col-md-2 col-3">
                <a href="#" onclick="tambahsupir({{$data->id_supir}})" class="btn btn-sm btn-primary">Pilih</a>
            </div>
        </div>
    
    </div>
    @endforeach
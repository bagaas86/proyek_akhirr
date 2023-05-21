<div class="text-center title">
    <h3>History Peminjaman Saya</h3>
  </div>
  <div class="col col-12 col-md-6 mx-auto">
     @foreach($history as $data)
          <div class="card">
              <div class="row">
                  @if(Auth::user()->level == "Ormawa")
                  <div class="card-body col col-2 col-md-2">
                      <div class="status">
                          @if($data->staff_umum == "Proses")
                      <i class="badge bg-warning">Menunggu...</i>
                      @else
                      <i class="badge bg-success">Disetujui</i>
                      </div>
                      @endif
                  </div>
                  @endif
                  @if(Auth::user()->level == "Dosen")
                  <div class="card-body col col-2 col-md-2">
                      <div class="status">
                          @if($data->staff_umum =="Proses" OR $data->wakil_direktur_1 == "Proses" OR $data->wakil_direktur_2 == "Proses")
                          <i class="badge bg-warning">Menunggu</i>
                          @else
                          <i class="badge bg-warning">Disetujui</i>
                          @endif
                      </div>
                  </div>
                  @endif
                  <div class="card-body col col-10 col-md-10">
                  <h6>{{$data->nama_kegiatan}}</h6>
                  <div class="row">
                      <div class="col col-8 col-md-8">
                          <small style="font-size:10px">Penanggung Jawab :{{$data->nama_pj}}</small>
                      </div>
                      <div class="col col-4 col-md-4" style="text-align: right">
                          <small style="font-size:10px">{{$data->waktu_pengajuan}}</small>
                      </div> 
                  </div>
                 
                  </div>
              </div>
              <a href="#" onclick="detail({{$data->id_peminjaman}})" class="stretched-link"></a>
          </div>
      @endforeach
  </div>
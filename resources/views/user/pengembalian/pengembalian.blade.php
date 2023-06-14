  <div class="text-center title">
    <h3>Pengembalian Peminjaman</h3>
  </div>
  <div class="col col-12 col-md-6 mx-auto">
     @foreach($pengembalian as $data)
          <div class="card">
              <div class="row">
                  <div class="card-body col col-10 col-md-10">
                  <h6>{{$data->nama_kegiatan}}                        
                    @if($data->status_peminjaman =="Pengajuan Diterima")
                    <span class="badge bg-warning">Belum Dikembalikan</span>
                    @elseif($data->status_peminjaman == "Proses Pengembalian")
                    <span class="badge bg-primary text-white">Menunggu Persetujuan Pengembalian</span>
                    @elseif($data->status_peminjaman == "Pengembalian Ditolak")
                    <span class="badge bg-danger">Pengembalian Ditolak</span>
                    @else
                    <span class="badge bg-success">Pengembalian Disetujui</span>
                    @endif</h6>
                  <div class="row">
                      <div class="col col-8 col-md-8">
                          <small style="font-size:10px">Penanggung Jawab :{{$data->nama_pj}}</small>
                      </div>
                      <div class="col col-4 col-md-4" style="text-align: right">
                          <small style="font-size:10px">{{$data->waktu_pengajuan}} </small>
                      </div> 
                  </div>
                 
                  </div>
              </div>
              <a href="#" onclick="detail({{$data->id_peminjaman}})" class="stretched-link"></a>
          </div>
      @endforeach
  </div>
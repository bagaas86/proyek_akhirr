
<div class="text-center title">
    <h3><b>HISTORY PEMINJAMAN SAYA</b></h3>
  </div>
  <div class="col col-12 col-md-6 mx-auto">
     @foreach($history as $data)
          <div class="card">
              <div class="row">
                <div class="card-body col col-4 col-md-4">
                    <div class="status">
                        @php
                        $jenis_peminjaman = explode("," , $data->jenis_peminjaman);
                        @endphp
                        @foreach($jenis_peminjaman as $badge)
                        <span class="badge badge-secondary">{{ $badge }}</span>
                        @endforeach
                    </div>

                </div>
                  {{-- @if($data->jenis_peminjaman == "Kendaraan" OR $data->jenis_peminjaman == "Barang,Kendaraan" OR $data->jenis_peminjaman == "Ruangan,Kendaraan" OR $data->jenis_peminjaman == "Barang,Ruangan,Kendaraan")
                  <div class="card-body col col-4 col-md-4">
                        <div class="status">
                            @if($data->staff_umum == "Proses" OR $data->wakil_direktur_1 == "Proses" OR $data->wakil_direktur_2 == "Proses" OR $data->kepala_bagian == "Proses")
                            <span class="text-white badge bg-warning">Menunggu...</span>
                            @elseif($data->staff_umum <> "Proses" AND $data->staff_umum <> "Disetujui" OR $data->wakil_direktur_1 <> "Proses" AND $data->wakil_direktur_1 <> "Disetujui" OR $data->wakil_direktur_2 <> "Proses" AND $data->wakil_direktur_2 <> "Disetujui" OR $data->kepala_bagian <> "Proses" AND $data->kepala_bagian <> "Disetujui")
                            <span class="text-white badge bg-danger">Ditolak...</span>
                            @else
                            <span class="text-white badge bg-success">Disetujui</span>
                            @endif
                        </div>
                  </div>
                  @elseif($data->jenis_peminjaman == "Kendaraan,Supir" OR $data->jenis_peminjaman == "Barang,Kendaraan,Supir" OR $data->jenis_peminjaman == "Ruangan,Kendaraan,Supir" OR $data->jenis_peminjaman == "Barang,Ruangan,Kendaraan,Supir")
                  <div class="card-body col col-4 col-md-4">
                    <div class="status">
                        @if($data->staff_umum =="Proses" OR $data->wakil_direktur_1 == "Proses" OR $data->wakil_direktur_2 == "Proses" OR $data->kepala_bagian == "Proses" OR $data->pengelola_supir == "Proses")
                        <span class="text-white badge bg-warning">Menunggu...</span>
                        @elseif($data->staff_umum <> "Proses" AND $data->staff_umum <> "Disetujui" OR $data->wakil_direktur_1 <> "Proses" AND $data->wakil_direktur_1 <> "Disetujui" OR $data->wakil_direktur_2 <> "Proses" AND $data->wakil_direktur_2 <> "Disetujui" OR $data->kepala_bagian <> "Proses" AND $data->kepala_bagian <> "Disetujui" OR $data->pengelola_supir <> "Proses" AND $data->pengelola_supir <> "Disetujui")
                        <span class="text-white badge bg-danger">Ditolak...</span>
                        @else
                        <span class="text-white badge bg-success">Disetujui</span>
                        @endif
                    </div>
                 </div>
                  @else
                  <div class="card-body col col-4 col-md-4">
                      <div class="status">
                          @if($data->staff_umum =="Proses" OR $data->kepala_bagian == "Proses")
                          <span class="text-white badge bg-warning">Menunggu</span>
                          @elseif($data->staff_umum <> "Proses" AND $data->staff_umum <> "Disetujui" OR $data->kepala_bagian <> "Proses" AND $data->kepala_bagian <> "Disetujui")
                          <span class="text-white badge bg-danger">Ditolak...</span>
                          @else
                          <span class="text-white badge bg-success">Disetujui</span>
                          @endif
                      </div>
                  </div>
                  @endif --}}
                  <div class="card-body col col-8 col-md-8">
                  <h6 style="font-size:12px">{{$data->nama_kegiatan}}</h6>
                  <div class="row">
                      <div class="col col-12 col-md-12" style="text-align: right">
                          <small style="font-size:10px;text-align: right">{{$data->waktu_pengajuan}}</small>
                      </div> 
                  </div>
                 
                  </div>
              </div>
              <a href="#" onclick="detail({{$data->id_peminjaman}})" class="stretched-link"></a>
          </div>
      @endforeach
  </div>

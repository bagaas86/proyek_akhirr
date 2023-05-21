<center>
    <div class="col col-md-4 col-12 mt-2" id="pilihKategori">
        <select class="form-select form-select" aria-label=".form-select-sm example" id="kategori" onchange="submit()">
            <option value="All" selected disabled>-- Pilih Kategori --</option>
            {{-- <option value="All">Semua Kategori</option> --}}
            <option value="Barang">Barang</option>
            <option value="Ruangan">Ruangan</option>
            <option value="Kendaraan">Kendaraan</option>
        </select>
    </div>
 
</center>
  

<div class="text-center title mt-4">
    <div class="text-center title">
        <div id="kembali"  style="display:none">
            <a href="#" class="btn btn-warning" onclick="back()">Kembali</a>
        </div>
        <div id="selanjutnya">
            <a href="#" class="btn btn-warning" onclick="list()">Selanjutnya</a>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col col-md-12 col-12">
        <div class="tableItem" id="tableItem">

        </div>
    </div>
    <div class="col col-md-6 col-12">
        <div class="list" id="list">

        </div>
    </div>
    <div class="col col-md-6 col-12 mt-2" style="color:black">
        <div class="pengajuan" id="pengajuan" style="display:none">
            <div class="col col-md-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header" style="text-align: center">
                            <h4>Form Pengajuan</h4>
                        </div>
                        <div class="form">
                            <form action="{{route('kirimpengajuan')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for=""><b>Tanggal Peminjaman</b><small style="color:red">*</small></label>
                                <div class="row">
                                    <div class="col col-6 col-md-6">
                                        <label for="">Dari<small style="color:red">*</small></label>
                                        <input id="fromdate" type="datetime-local" class="form-control" placeholder="Masukkan" name="fromdate" value="{{old('fromdate')}}" required>
                                    </div>
                                    <div class="col col-6 col-md-6">
                                        <label for="">Sampai<small style="color:red">*</small></label>
                                        <input id="todate" type="datetime-local" class="form-control" placeholder="Masukkan" name="todate" required>
                                    </div>
                                    <div class="col col-12 col-md-12 mt-2">
                                        <label for=""><b>Nama Penanggung Jawab</b><small style="color:red">*</small></label>
                                        <input type="text" class="form-control" placeholder="Nama Penanggung Jawab" id="nama_pj" name="nama_pj" required>
                                    </div>
                                    <div class="col col-12 col-md-12 mt-2">
                                        <label for=""><b>Nomor Identitas</b><small style="color:red">*</small></label>
                                        <input type="number" class="form-control" placeholder="Nomor Identitas" id="no_identitas" name="no_identitas" required>
                                    </div>
                                    <div class="col col-12 col-md-12 mt-2">
                                        <label for=""><b>Nomor HP</b><small style="color:red">*</small></label>
                                        <input type="number" class="form-control" placeholder="Nomor HP" id="no_hp" name="no_hp" required>
                                    </div>
                                    <div class="col col-12 col-md-12 mt-2">
                                        <label for=""><b>Nama Kegiatan</b><small style="color:red">*</small></label>
                                        <input type="text" class="form-control" placeholder="Nama Kegiatan" id="nama_kegiatan" name="nama_kegiatan" required>
                                    </div>
                                    <div class="col col-12 col-md-12 mt-2">
                                        <label for=""><b>Upload Surat Pengajuan</b><small>(opsional)</small></label>
                                        <input type="file" class="form-control" placeholder="Nama Kegiatan" id="bukti" name="surat_pengajuan">
                                    </div>
                                    <div class="col col-12 col-md-12 mt-2">
                                        <label for=""><b>Upload Kartu Identitas</b><small style="color:red">*</small></label>
                                        <input type="file" class="form-control" placeholder="Nama Kegiatan" id="tanda_pengenal" name="foto_identitas" required>
                                    </div>
                                </div>
                                <div style="text-align: center">
                                    <button class="btn btn-block btn-primary mt-4">Kirim Pengajuan</button>
                                </div>
                            </form>
                            
            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div id="tableItem"></div> --}}
{{-- Modal --}}
<div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal Title</h5>
            </div>
            <div class="modal-body">
                <p class="mb-0" id="page"></p>
            </div>
            <div id="modalFooter" class="modal-footer">
             
            </div>
        </div>
    </div>
</div>
{{-- endModal --}}

<script>
     function submit(){
        var kategori = $("#kategori").val();
      $.ajax({
             type: "get",
             url: "{{ url('loaditem') }}",
             data: {
                "kategori": kategori,
             },
         success: function(data, status) {
             $("#tableItem").html(data),
             console.log(data),
             document.getElementById("pilihKategori").style.display="block";
             document.getElementById("pengajuan").style.display="none";
             document.getElementById("tableItem").style.display="block";
             document.getElementById("selanjutnya").style.display="block";
             document.getElementById("kembali").style.display="none";
             document.getElementById("list").style.display="none";
             }
         });
     }

     function back(){ 
      $.ajax({
             type: "get",
             url: "{{ url('loaditem') }}",
         success: function(data, status) {
             $("#tableItem").html(data),
             submit();
             }
         });
     }
     function tambahitem(id_item){
      var id_user = $("#id_user").val();
      $.ajax({
              type: "get",
              url: "{{ url('tambahitem') }}",
              data: {
              "id_item": id_item,
              "id_user": id_user,
              },
              success: function(data, status) {
              if(data == 1){
                Swal.fire(
                    {
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Item Berhasil Ditambahkan!'
                        }
                    )
              }if(data == 2){
                Swal.fire(
                    {
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Item Sudah Ada!'
                        }
                    )
              }
             
              }
             
          });
     }
     function list()
     {
        $.get("{{ url('listbarang') }}", {}, function(data, status) {
               $("#list").html(data);
               document.getElementById("tableItem").style.display="none";
               document.getElementById("pilihKategori").style.display="none";
               document.getElementById("list").style.display="block";
               document.getElementById("pengajuan").style.display="block";
               document.getElementById("selanjutnya").style.display="none";
               document.getElementById("kembali").style.display="block";
           });
     }

     function ubahJumlah(id_keranjang){
        var jumlah = $("#jumlah"+id_keranjang).val();
      $.ajax({
              type: "get",
              url: "{{ url('ubahjumlah') }}",
              data: {
              "id_keranjang": id_keranjang,
              "jumlah": jumlah,
              },
              success: function(data, status) {
                list()
              }
             
          });
     }
     function hapusBarang(id_keranjang) {
            $.ajax({
                type: "get",
                url: "{{ url('hapusbarang') }}/" + id_keranjang,
                success: function(data) {
                    list()
                }
            });
        }
    
    function modalDetail(id_item) {
        $.get("{{ url('detailbmn') }}/" + id_item, {}, function(data, status) {
            $("#exampleModalCenterTitle").html(`Detail BMN`)
            $("#page").html(data);
            $("#exampleModalCenter").modal('show');
           })  
    }

</script>



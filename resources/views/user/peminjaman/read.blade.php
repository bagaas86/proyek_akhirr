<center>
    <div id="tanggal">
        <div class="row" style="margin-left: 4em;margin-right:4em">
            <div class="col col-6 col-md-6">
                <label for="">Dari</label>
                <input id="fromdate" type="datetime-local" class="form-control" placeholder="Masukkan"  name="fromdate" value="{{old('fromdate')}}" onchange="submit()"  required>
            </div>
            <div class="col col-6 col-md-6">
                <label for="">Sampai</label>
                <input id="todate" type="datetime-local" class="form-control" placeholder="Masukkan" name="todate" value="{{old('todate')}}" onchange="submit()"  required>
            </div>
        </div>
    </div>
   

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
    <div class="col col-md-12 col-12">
        <div class="list" id="list">

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
        var fromdate = $("#fromdate").val();
        var todate = $("#todate").val();
      $.ajax({
             type: "get",
             url: "{{ url('loaditem') }}",
             data: {
                "kategori": kategori,
                "fromdate": fromdate,
                "todate": todate,
             },
         success: function(data, status) {
             $("#tableItem").html(data),
             document.getElementById("pilihKategori").style.display="block";
             document.getElementById("pengajuan").style.display="none";
             document.getElementById("tableItem").style.display="block";
             document.getElementById("selanjutnya").style.display="block";
             document.getElementById("kembali").style.display="none";
             document.getElementById("list").style.display="none";
             document.getElementById("tanggal").style.display="block";
        
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
             resetKeranjang();
             }
         });
     }

     function resetKeranjang(){ 
      $.ajax({
             type: "get",
             url: "{{ url('resetkeranjang') }}",
         success: function(data, status) {
            console.log('success')
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
        var fromdate = $("#fromdate").val();
        var todate = $("#todate").val();
        $.get("{{ url('listbarang') }}", {}, function(data, status) {
               $("#list").html(data);
               document.getElementById("tableItem").style.display="none";
               document.getElementById("pilihKategori").style.display="none";
               document.getElementById("list").style.display="block";
               document.getElementById("pengajuan").style.display="block";
               document.getElementById("selanjutnya").style.display="none";
               document.getElementById("kembali").style.display="block";
               document.getElementById("tanggal").style.display="none";
               $('#fromdate1').val(fromdate);
             $('#todate1').val(todate);
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



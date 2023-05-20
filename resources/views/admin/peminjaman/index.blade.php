@extends('layouts.template')
@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">List Pengajuan Peminjaman</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Pengajuan Peminjaman</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session()->get('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
@endif
<div class="card">
    <div class="xtabledm">
        <a href="#" class="btn btn-primary mb-2"><i class="fa fa-plus"></i>Tambah Peminjaman</a>
        <div class="form-group col-md-4">
            <label for="">Sumber Pengajuan</label>
            <select class="form-control" name="table" id="filter" onchange="filterPengajuan()">
            <option value="" disabled selected>-- Pilih Sumber Pengajuan --</option>
            <option value="Ormawa">Ormawa</option>
            <option value="Dosen">Dosen/Staff</option>
            </select>
        </div>
        @php
        date_default_timezone_set("Asia/Jakarta");
        $d = date("Y-m");
        @endphp
        <input type="month" id="cekws" class="form-control col-md-3"  value="{{ $d }}" hidden>
      
        <div id="table">
            
        </div>
       
    </div>
</div>

{{-- Modal --}}
<div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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

{{-- Modal --}}
<div id="exampleModalCenter2" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle2">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="mb-0" id="page2"></p>
            </div>
            <div id="modalFooter2" class="modal-footer">
             
            </div>
        </div>
    </div>
</div>
{{-- endModal --}}

<script>
        function filterPengajuan()
    {
        var filter = $("#filter").val();
        if (filter == "Ormawa")
        {
            tableormawa()
        }
        if (filter == "Dosen")
        {
            tabledosen()
        }
    }
     function tableormawa()
     {
        $.get("{{ url('tableormawa') }}", {}, function(data, status) {
               $("#table").html(data);
           });
     }
     function tabledosen()
     {
        $.get("{{ url('tabledosen') }}", {}, function(data, status) {
               $("#table").html(data);
           });
     }
     

     function ubahStatus(id_peminjaman) {
            $.ajax({
                type: "get",
                url: "{{ url('ubahstatus') }}/" + id_peminjaman,
                success: function(data) {
                    filterPengajuan(),
                    modalFinish()
                }
            });
        }

    function cetakBarang(id_peminjaman)
    {
        var cek = $('#barangs').attr("data-custom-value");
        $("#download").html(`Sedang Membuat Berita Acara, Harap Tunggu...`)
        $.ajax({
                type: "get",
                url: "{{ url('peminjaman/pengajuan/cetak/') }}/" + id_peminjaman,
                data: {
                "cek": cek
                 },
                 xhrFields: {
                responseType: 'blob',
                },
                success: function(response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');

                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Berita Acara Barang.pdf";
                    link.click()
                    $("#download").html(`Berita Acara Selesai...`)
                },
                error: function(blob){
                console.log(blob);
            }
            });
    }

    function cetakRuangan(id_peminjaman)
    {
        var cek = $('#ruangans').attr("data-custom-value");
        $("#download").html(`Sedang Membuat Berita Acara, Harap Tunggu...`)
        $.ajax({
                type: "get",
                url: "{{ url('peminjaman/pengajuan/cetak/') }}/" + id_peminjaman,
                data: {
                "cek": cek
                 },
                 xhrFields: {
                responseType: 'blob',
                },
                success: function(response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Berita Acara Ruangan.pdf";
                    link.click()
                    $("#download").html(`Berita Acara Selesai...`)
                },
                error: function(blob){
                console.log(blob);
            }
            });
    }
  
   
    
    function modalStatus(id_peminjaman) 
    {
            $("#exampleModalCenterTitle").html(`Konfirmasi Peminjaman?`)
            $("#page").html('Apakah Anda yakin Ingin Menyetujui Peminjaman?');
            $("#modalFooter").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>
            <a style="color:white" href="#" onclick="ubahStatus(`+id_peminjaman+`)" class="btn  btn-success">Setuju</a>)`)
            $("#exampleModalCenter").modal('show');
    }

    function modalCetak(id_peminjaman) 
    {
        $.get("{{ url('modalcetak') }}/" + id_peminjaman, {}, function(data, status){
            $("#exampleModalCenterTitle2").html(`Detail Peminjaman`)
            $("#page2").html(data);
            $("#modalFooter2").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>)`)
            $("#exampleModalCenter2").modal('show');
        })
    }

    function modalFinish() 
    {
            $("#exampleModalCenterTitle").html(`Berhasil`)
            $("#page").html('Berhasil');
            $("#modalFooter").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>)`)
            $("#exampleModalCenter").modal('show');
    }



    function modalDetail(id_peminjaman)
    {
        $.get("{{ url('detailpeminjaman') }}/" + id_peminjaman, {}, function(data, status){
            $("#exampleModalCenterTitle2").html(`Detail Peminjaman`)
            $("#page2").html(data);
            $("#modalFooter2").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>)`)
            $("#exampleModalCenter2").modal('show');
        })
       
    }

    function modalApproval(id_peminjaman)
    {
        $.get("{{ url('modalapproval') }}/" + id_peminjaman, {}, function(data, status){
            $("#exampleModalCenterTitle2").html(`Lihat Persetujuan`)
            $("#page2").html(data);
            $("#modalFooter2").html(`
            <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>)`)
            $("#exampleModalCenter2").modal('show');
        })
       
    }


</script>
  
@endsection

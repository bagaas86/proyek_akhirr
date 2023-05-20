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
        $("#download").html(`Sedang Mendownload, Harap Tunggu...`)
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
                    $("#download").html(`Download Selesai...`)
                },
                error: function(blob){
                console.log(blob);
            }
            });
    }

    function cetakRuangan(id_peminjaman)
    {
        var cek = $('#ruangans').attr("data-custom-value");
        $("#download").html(`Sedang Mendownload, Harap Tunggu...`)
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
                    $("#download").html(`Download Selesai...`)
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


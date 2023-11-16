<form enctype="multipart/form-data" action="{{ route('dm.unit.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col col-md-7 col-12">
            <div class="form-group">
                <label for="nama_barang">Nama Unit</label>
                <input type="text" class="form-control @error('nama_unit') is-invalid @enderror" id="nama_unit"
                    name="nama_unit" placeholder="Masukkan Nama Unit" value="">
                <span id="alert1" class="invalid-feedback" style="display: none">
                    <strong>Bidang ini harus diisi</strong>
                </span>
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>
        <div class="col col-md-7 col-12">
            <div class="form-group">
                <label for="nama_barang">Jenis</label>
                <select id="jenis_unit" type="text" name="jenis"
                    class="form-control @error('jenis') is-invalid @enderror">
                    <option value="Tidak Didefinisikan" selected>-- Pilih Jenis --</option>
                    <option value="Unit">Unit</option>
                    <option value="Jabatan">Jabatan</option>
                </select>
                <span id="alertjenis" class="invalid-feedback" style="display: none">
                    <strong>Bidang ini harus diisi</strong>
                </span>
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>


        <div style="margin-left:28em">
            <a href="#" onclick="kirim()" class="btn btn-primary">Submit</a>
            <button id="send" type="submit" class="btn btn-primary" hidden>Submit</button>
        </div>
</form>

<script>
    function kirim() {
        var jenis = $("#jenis_unit").val();
        var nama = $("#nama_unit").val();

        if (jenis == "Tidak Didefinisikan") {
            document.getElementById("alertjenis").style.display = "block";
        } else if (nama == "") {
            document.getElementById("alert1").style.display = "block";
        } else {
            document.getElementById("send").click();
        }
    }
</script>

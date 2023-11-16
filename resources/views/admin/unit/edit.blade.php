<form enctype="multipart/form-data" action="{{route('dm.unit.update', $unit->id_unit)}}" method="POST" >
    @csrf
    <div class="row">
        <div class="col col-md-7 col-12">
            <div class="form-group">
                <label for="nama_barang">Nama Unit/Jabatan</label>
                <input type="text" class="form-control @error('nama_unit') is-invalid @enderror" id="name" name="nama_unit" placeholder="Masukkan Nama Unit" value="{{$unit->nama_unit}}">
                @error('nama_unit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>
        <div class="col col-md-7 col-12">
            <div class="form-group">
                <label for="nama_barang">Jenis</label>
                <select type="text" name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                    <option value="" disabled>-- Pilih Jenis --</option>
                    <option value="Unit" @if($unit->jenis == "Unit") selected @endif>Unit</option>
                    <option value="Jabatan" @if($unit->jenis == "Jabatan") selected @endif>Jabatan</option>
                @error('jenis')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </select>
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>
    </div>
    <div style="margin-left:28em">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
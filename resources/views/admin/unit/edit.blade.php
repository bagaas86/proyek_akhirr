<form enctype="multipart/form-data" action="{{route('dm.unit.update', $unit->id_unit)}}" method="POST" >
    @csrf
    <div class="row">
        <div class="col col-md-7 col-12">
            <div class="form-group">
                <label for="nama_barang">Nama Unit</label>
                <input type="text" class="form-control @error('nama_unit') is-invalid @enderror" id="name" name="nama_unit" placeholder="Masukkan Nama Unit" value="{{$unit->nama_unit}}">
                @error('nama_unit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>
        <div class="col col-md-5 col-12">
            <div class="form-group">
                <label for="jenis_unit">Jenis Unit</label>
                <select name="jenis_unit" class="form-control @error('jenis_unit') is-invalid @enderror">
                    <option value="" selected disabled>-- Pilih Jenis Unit --</option>
                    <option value="Ormawa" @if($unit->jenis_unit == "Ormawa") selected @endif>Ormawa</option>
                    <option value="Jurusan" @if($unit->jenis_unit  == "Jurusan") selected @endif>Jurusan</option>
                    <option value="Normal" @if($unit->jenis_unit == "Normal") selected @endif>Normal</option>   
                </select>
                @error('jenis_unit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

    <div style="margin-left:28em">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
</form>
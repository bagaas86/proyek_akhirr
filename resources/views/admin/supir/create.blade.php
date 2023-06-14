<form enctype="multipart/form-data" action="{{route('supir.kelola.store')}}" method="POST" >
    @csrf
    <div class="row">
        <div class="col col-md-7 col-12">
            <div class="form-group">
                <label for="nama_barang">Nama Supir</label>
                <input type="text" class="form-control @error('nama_supir') is-invalid @enderror" id="name" name="nama_supir" placeholder="Masukkan Nama Supir" value="{{old('nama_supir')}}">
                @error('nama_supir')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>
        <div class="col col-md-5 col-12">
            <div class="form-group">
                <label for="nama_barang">Umur Supir</label>
                <input type="number" class="form-control @error('nama_supir') is-invalid @enderror" id="name" name="umur_supir" placeholder="Masukkan Umur Supir" value="{{old('umur_supir')}}">
                @error('umur_supir')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>
     

    <div style="margin-left:28em">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
</form>  
<form enctype="multipart/form-data" action="{{route('supir.aktivitas.store')}}" method="POST" >
    @csrf
    <div class="row">
        <div class="col col-md-12 col-6">
            <label for=""><b>Tanggal Aktivitas</b><small style="color:red">*</small></label>
            <div class="row">
                <div class="col col-6 col-md-6">
                    <label for="">Mulai<small style="color:red">*</small></label>
                    <input id="mulai_aktivitas" type="datetime-local" class="form-control" placeholder="Masukkan" name="mulai_aktivitas" value="{{old('mulai_aktivitas')}}">
                </div>
                <div class="col col-6 col-md-6">
                    <label for="">Selesai<small style="color:red">*</small></label>
                    <input id="selesai_aktivitas" type="datetime-local" class="form-control" placeholder="Masukkan" name="selesai_aktivitas" value="{{old('selesai_aktivitas')}}">
            </div>
            </div>
        </div>
        <div class="col col-md-6 col-12 mt-2">
            <div class="form-group">
                <label for="nama_supir">Nama Supir</label>
                <select name="id_supir" class="form-control @error('id_supir') is-invalid @enderror">
                    <option value="" selected disabled>-- Pilih Supir --</option>
                    @foreach($supir as $data)
                    <option value="{{$data->id_supir}}" @if(old('id_supir')== $data->id_supir) selected @endif>{{$data->nama_supir}}</option>
                    @endforeach
                </select>
                @error('id_supir')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>   
                @enderror 
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>
        <div class="col col-md-6 col-12 mt-2">
            <div class="form-group">
                <label for="nama_aktivitas">Nama Aktivitas</label>
                <input type="text" class="form-control @error('nama_aktivitas') is-invalid @enderror" name="nama_aktivitas" placeholder="Masukkan Aktivitas Supir" value="{{old('nama_aktivitas')}}">
                @error('nama_aktivitas')
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
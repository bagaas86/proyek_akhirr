{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
                <form  action="{{route('tambah.tugas.update', $pengguna->id)}}" method="POST" >
                    @csrf
                        <div class="col col-md-12 col-12">
                            <div class="form-group">
                                <label for="level">Unit/Jabatan Tambahan</label>
                                <select style="width:600px" name="sebagai" class="select4" >
                                    @foreach($tambahan as $data)
                                    <option value="{{$data->nama_unit}}" @if($data->nama_unit == $pengguna->sebagai) selected @endif>{{$data->nama_unit}} - {{$data->jenis}}</option>
                                    @endforeach
                                    <option value="{{$pengguna->keterangan}}" @if($pengguna->keterangan == $pengguna->sebagai) selected @endif>Tidak ada</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </form>

                   
                    <script>
                        $(document).ready(function() {
                            $('.select4').select2({
                             dropdownParent: $('#exampleModalCenter2')
                    });
                    });
                      
                    </script>
                   
                    
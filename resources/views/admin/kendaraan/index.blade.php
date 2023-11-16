@extends('layouts.template')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">List Data Master Kendaraan</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Data Master Kendaraan</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
    @endif
    <div class="card">
        <div class="xtabledm">
            <a href="{{ route('dm.kendaraan.create') }}" class="btn btn-primary btn-sm mb-2"><i
                    class="fa fa-plus"></i>Tambah Kendaraan</a>
            <table id="myTable2" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Merk Kendaraan</th>
                        <th>Foto</th>
                        <th>Plat Kendaraan</th>
                        <th>Warna Kendaraan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item as $data)
                        <tr>
                            <td></td>
                            <td style="width:25%">{{ $data->nama_item }}</td>
                            <td style="width:10%"><img src="{{ asset('foto/dm/kendaraan/' . $data->foto_item) }}"
                                    class="img-rounded" style="width:50%" alt=""></td>
                            <td>{{ $data->plat_kendaraan }}</td>
                            <td>{{ $data->warna_kendaraan }}</td>
                            <td style="width:20%">
                                {{-- <a href="{{route('dm.kendaraan.detail', $data->id_item)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a> --}}
                                <a href="{{ route('dm.kendaraan.edit', $data->id_item) }}" class="btn btn-warning btn-sm"><i
                                        class="fa fa-edit"></i></a>
                                <a href="#" data-toggle="modal" data-target="#delete{{ $data->id_item }}"
                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Modal Delete --}}
    @foreach ($item as $data)
        <div id="delete{{ $data->id_item }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Kendaraan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <img src="{{ asset('foto/dm/kendaraan/' . $data->foto_item) }}" style="width:25%"
                                alt="">
                        </center>
                        <hr>
                        <p class="mb-0" id="page">Apakah Anda Yakin Menghapus Kendaraan
                            <b>{{ $data->nama_item }}</b>?</p>
                    </div>
                    <div id="modalFooter" class="modal-footer">
                        <a style="color:white" class="btn  btn-secondary" data-dismiss="modal">Tutup</a>
                        <a style="color:white" href="{{ route('dm.kendaraan.destroy', $data->id_item) }}"
                            class="btn  btn-primary">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- endModal Delete --}}
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var t = $('#myTable2').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                stateSave: true,
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0,
                }, ],
                order: [
                    [1, 'asc']
                ],

            });

            t.on('order.dt search.dt', function() {
                let i = 1;

                t.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                }).every(function(cell) {
                    this.data(i++);
                });
            }).draw();
        });
    </script>
@endsection

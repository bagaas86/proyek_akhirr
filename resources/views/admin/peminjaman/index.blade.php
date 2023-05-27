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
        @php
        date_default_timezone_set("Asia/Jakarta");
        $d = date("Y-m");
        @endphp
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Sumber Pengajuan</label>
                {{-- <select class="form-control" name="table" id="filter" onchange="filterPengajuan()"> --}}
                <select class="form-control" name="table" id="filter" onchange="tampil()">
                {{-- <option value="" disabled>-- Pilih Sumber Pengajuan --</option> --}}
                <option value="Semua" selected>Semua Pengajuan</option>
                <option value="Ormawa">Ormawa</option>
                <option value="Dosen">Dosen/Staff</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="">Periode Peminjaman</label>
                    <input type="month" id="bulan" class="form-control"  value="{{ $d }}" onchange="jh()">
                   <div class="input-group">
                     <input type="date" id="dari" class="form-control" onchange="tampil()">
                     <div style="width:20%">
                       <input style="text-align:center" type="text" class="form-control" value="-" readonly>
                     </div>
                     <input type="date" id="sampai" class="form-control" onchange="tampil()">
                   </div>
               </div>  
        </div>
        
      
    
        @php
        date_default_timezone_set("Asia/Jakarta");
        $d = date("Y-m");
        @endphp
      
        <div id="table">
            
        </div>
       
    </div>
    </div>
</div>


<script>

$(document).ready(function() {
            jh()
        });
function tampil() {
            var filter = $("#filter").val();
            var dari = $("#dari").val();
            var sampai = $("#sampai").val();
            $.ajax({
                type: "get",
                url: "{{ url('tampilpeminjaman') }}",
                data:{
                    "filter": filter,
                    "dari": dari,
                    "sampai": sampai,
                },
                success: function(data) {
                    $("#table").html(data);
                }
            });
        }

function jh()
    {
        var bulan =  $("#bulan").val();
        $.get("{{ url('hari') }}/"+bulan, {}, function(data, status) {
        $("#dari").val(bulan+"-01");
        $("#sampai").val(bulan+"-"+data);
        tampil()
        });    
    }



</script>
  
@endsection

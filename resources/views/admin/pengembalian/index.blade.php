@extends('layouts.template')
@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">List Pelaporan Pengembalian</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Pelaporan Pengembalian</a></li>
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

<div id="show" style="display: none">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Sukses Memberikan Ulasan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>   
</div>
<div class="card">
    <div class="xtabledm">
        @php
        date_default_timezone_set("Asia/Jakarta");
        $d = date("Y-m");
        $finaldate = date('Y-m', strtotime($d.'+1 month'));
        @endphp
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Jenis Peminjaman</label>
                {{-- <select class="form-control" name="table" id="filter" onchange="filterPengajuan()"> --}}
                <select class="form-control" name="table" id="filter" onchange="tampil()">
                {{-- <option value="" disabled>-- Pilih Sumber Pengajuan --</option> --}}
                <option value="Semua" selected>Semua Peminjaman</option>
                <option value="Barang">Barang</option>
                <option value="Ruangan">Ruangan</option>
                <option value="Kendaraan">Kendaraan</option>
                <option value="Supir">Supir</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="">Periode Peminjaman</label>
                    <div class="input-group">
                        <input type="month" id="bulan" class="form-control"  value="{{ $d }}" onchange="jh()">
                        <div style="width:20%">
                            <input style="text-align:center" type="text" class="form-control" value="-" readonly>
                          </div>
                        <input type="month" id="bulan2" class="form-control"  value="{{ $finaldate }}" onchange="jh()">
                    </div>
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

$(document).ready(function() {
            jh()
        });
function tampil() {
            var filter = $("#filter").val();
            var dari = $("#dari").val();
            var sampai = $("#sampai").val();
            $.ajax({
                type: "get",
                url: "{{ url('tampilpengembalian') }}",
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
        var bulan2 =  $("#bulan2").val();
            $.ajax({
                type: "get",
                url: "{{ url('hari') }}",
                data:{
                    "bulan": bulan,
                    "bulan2": bulan2,
                },
                success: function(data) {
                    $("#dari").val(bulan+"-01");
                    $("#sampai").val(bulan2+"-"+data);
                    tampil()
                }
            });
     
        };    
    



</script>
  
@endsection

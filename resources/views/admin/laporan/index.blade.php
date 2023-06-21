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
                     <input type="date" id="dari" class="form-control">
                     <div style="width:20%">
                       <input style="text-align:center" type="text" class="form-control" value="-" readonly>
                     </div>
                     <input type="date" id="sampai" class="form-control">
                   </div>
               </div>  
        </div>
        
      
    
        @php
        date_default_timezone_set("Asia/Jakarta");
        $d = date("Y-m");
        @endphp
      
        <div id="table">
            <div class="col col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>BMN Tersedia</h5>
                    </div>
                    <div class="card-body">
                        <div id="bar"></div>
                    </div>
                </div>
            </div>
           
        </div>
       
    </div>
    </div>

<script>

$(document).ready(function() {
            jh(),
            bar()
        });
// function tampil() {
//             var filter = $("#filter").val();
//             var dari = $("#dari").val();
//             var sampai = $("#sampai").val();
//             $.ajax({
//                 type: "get",
//                 url: "{{ url('tampilpeminjaman') }}",
//                 data:{
//                     "filter": filter,
//                     "dari": dari,
//                     "sampai": sampai,
//                 },
//                 success: function(data) {
//                     $("#table").html(data);
//                 }
//             });
//         }

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
                    // tampil()
                }
            });
     
        };    
    
    function bar() {
          $.get("{{ url('profil/chartlahan') }}/", {}, function(data, status){
            var h = data.h;
            var v = data.v
            var options = {
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                colors: ["#0e9e4a", "#4680ff", "#ff5252"],
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: [{
                    name: 'Net Profit',
                    data: v,
                }],
                xaxis: {
                    categories: h,
                },
             
                fill: {
                    opacity: 1

                },
            }
            var chart = new ApexCharts(
                document.querySelector("#bar"),
                options
            );
            chart.render();
        })};
    

</script>
  
@endsection

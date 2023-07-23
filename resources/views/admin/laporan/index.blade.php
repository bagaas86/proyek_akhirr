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
        @php
        date_default_timezone_set("Asia/Jakarta");
        $d = date("Y-m");
        @endphp
      
    <div class="card">
        <div class="xtabledm">
            <div id="table">
                <div class="col col-md-12">
                     <div id="bar"></div>
                </div>
            </div>
               
        </div>
    </div>
       
        <div class="card">
            <div class="xtabledm">
                @php
                date_default_timezone_set("Asia/Jakarta");
                $d = date("Y-m");
                $finaldate = date('Y-m', strtotime($d.'+1 month'));
                @endphp
                <div class="row mt-4">
                    <div class="form-group col-md-4">
                        <label for="">Periode Peminjaman</label>
                        <a href="#" onclick="downloadbar2()" id="downloadButton">Download</a>
                            <div class="input-group">
                                <input type="month" id="bulan" class="form-control"  value="{{ $d }}" onchange="jh()">
                                <div style="width:20%">
                                    <input style="text-align:center" type="text" class="form-control" value="-" readonly>
                                  </div>
                                <input type="month" id="bulan2" class="form-control"  value="{{ $finaldate }}" onchange="jh()">
                            </div>
                           <div class="input-group">
                             <input type="date" id="dari" class="form-control" onchange="bar2()">
                             <div style="width:20%">
                               <input style="text-align:center" type="text" class="form-control" value="-" readonly>
                             </div>
                             <input type="date" id="sampai" class="form-control" onchange="bar2()">
                           </div>
                       </div>  
                       
                </div>
                       
                <div id="barpeminjaman">
                </div>
                
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>

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
                    bar2()
                }
            });
     
        };    
    
    function bar() {
          $.get("{{ url('profil/chartlahan') }}/", {}, function(data, status){
            var h = data.h;
            var v = data.v;
            var options = {
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%'
                       
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
                    name: 'Jumlah BMN',
                    data: v,
                }],
                xaxis: {
                    categories: h,
                },
             
                fill: {
                    opacity: 1

                },
                title:{
                    text:"Jumlah Barang Milik Negara",
                    align:"center",
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#bar"),
                options
            );
            chart.render();
        })};

        function bar2() {
            $("#barpeminjaman").html(`<canvas id="barChart" style="max-height: 400px;"></canvas>`);
            var dari = $("#dari").val();
            var sampai = $("#sampai").val();
            $.ajax({
                type: "get",
                url: "{{ url('profil/chartpeminjaman') }}",
                data:{
                    "dari": dari,
                    "sampai": sampai,
                },
                success: function(data) {
                var h = data.h;
                var v = data.v;
                var barc = document.getElementById("barChart").getContext('2d');
                new Chart( barc, {
                type: 'bar',
                data: {
                    labels: h,
                    datasets: [{
                    label: 'Jumlah Peminjam',
                    data: v,
                    backgroundColor: [
                        'rgba(255, 99, 0)',

                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                    
                    ],
                    borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                    y: {
                         min: 0, // Nilai minimum pada sumbu Y
                         max: 16 // Nilai maksimum pada sumbu Y
                       }
                    },
                    plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Peminjaman',
                        font: {
                            size: 24
                        }
                    }
                }
                }
                }); 
                
               
                }
        })};

        function downloadbar2()
        {
            var downloadButton = document.getElementById('downloadButton');
            downloadButton.addEventListener('click', function() {
            var canvas = document.getElementById('barChart');
            var base64Image = canvas.toDataURL('image/png');
            var downloadLink = document.createElement('a');
            downloadLink.href = base64Image;
            downloadLink.download = 'chart.png';
            downloadLink.click();
        });
        }
         
          

        // function barpeminjaman() {
        //   $.get("{{ url('profil/chartpeminjaman') }}/", {}, function(data, status){
        //     var h = data.h;
        //     var v = data.v
        //     var options = {
        //         chart: {
        //             height: 350,
        //             type: 'bar',
        //         },
        //         plotOptions: {
        //             bar: {
        //                 horizontal: false,
        //                 columnWidth: '55%'
                       
        //             },
        //         },
        //         dataLabels: {
        //             enabled: false
        //         },
        //         colors: ["#0e9e4a", "#4680ff", "#ff5252"],
        //         stroke: {
        //             show: true,
        //             width: 2,
        //             colors: ['transparent']
        //         },
        //         series: [{
        //             name: 'Jumlah Jenis Peminjaman',
        //             data: v,
        //         }],
        //         xaxis: {
        //             categories: h,
        //         },
             
        //         fill: {
        //             opacity: 1

        //         },
        //         title:{
        //             text:"Jumlah Jenis Peminjaman",
        //             align:"center",
        //         }
        //     }
        //     var chart = new ApexCharts(
        //         document.querySelector("#barpeminjaman"),
        //         options
        //     );
        //     chart.render();
        // })};
    

</script>
  
@endsection

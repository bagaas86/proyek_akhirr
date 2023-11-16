<!DOCTYPE html>
<html lang="en">

<head>
    <title>SIP2 BMN</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <link rel="icon" href="{{asset('template')}}/dist/assets/images/logoPolsub.png">
    {{-- css pribadi --}}
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/css/mycss.css">
    
    <!-- Favicon icon -->
    {{-- <link rel="icon" href="{{asset('template')}}/dist/assets/images/favicon.ico" type="image/x-icon"> --}}

    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/css/style.css">

    {{-- fontawesome --}}
    <link rel="stylesheet" href="{{asset('template')}}/fontawesome/css/all.min.css">

    {{-- datatable --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" /> --}}

  {{-- bootstrap icons --}}
  <link href="{{asset('template')}}/dist/assets/js/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    {{-- Datatable --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" />

    
{{-- select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



</head>
<body class="">
	<!-- [ Pre-loader ] start -->
	{{-- <div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div> --}}
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menu-light">
	@include('layouts.nav')
	</nav>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
		
                
				<div class="m-header">
					<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
					<a href="#!" class="b-brand">
						<!-- ========   change your logo hear   ============ -->
                        <h5 style="color:white">{{Auth::user()->sebagai}}</h5>
					</a>
					<a href="#!" class="mob-toggler">
						<i class="feather icon-more-vertical"></i>
					</a>
				</div>
				
			
	</header>
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        @yield('content')
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        {{-- <div class="row">

        <!-- [ Main Content ] end -->
        </div> --}}
        {{-- <div class="fixed-button active"><a href="/" class="btn btn-md btn-warning"><i class="fa fa-home" aria-hidden="true"></i> Kembali keee Home</a> </div> --}}
</div>


    <!-- Required Js -->
    <script src="{{asset('template')}}/dist/assets/js/vendor-all.min.js"></script>
    <script src="{{asset('template')}}/dist/assets/js/plugins/bootstrap.min.js"></script>
    <script src="{{asset('template')}}/dist/assets/js/ripple.js"></script>
    <script src="{{asset('template')}}/dist/assets/js/pcoded.min.js"></script>

<!-- Apex Chart -->
<script src="{{asset('template')}}/dist/assets/js/plugins/apexcharts.min.js"></script>
{{-- <script src="{{asset('template')}}/dist/assets/js/pages/chart-apex.js"></script> --}}


<!-- custom-chart js -->
<script src="{{asset('template')}}/dist/assets/js/pages/dashboard-main.js"></script>

{{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script> --}}
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.3.3/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@yield('script')
</body>

</html>

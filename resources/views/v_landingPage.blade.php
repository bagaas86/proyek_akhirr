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

    <!-- prism css -->
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/css/plugins/prism-coy.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/css/style.css">
    
    

</head>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar theme-horizontal menu-light brand-blue">
        <div class="navbar-wrapper container">
            <div class="navbar-content sidenav-horizontal" id="layout-sidenav">
                <ul class="nav pcoded-inner-navbar sidenav-inner">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Haii</label>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('auth')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-log-in"></i></span><span class="pcoded-mtext">LOGIN</span></a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
        <div class="container">
            <div class="m-header">
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
                <a href="#!" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="{{asset('template')}}/dist/assets/images/logoBMNPOLSUB.png" style="width:200px" alt="" class="logo">
                    <img src="{{asset('template')}}/dist/assets/images/logo-icon.png" alt="" class="logo-thumb">
                </a>
                <a href="#!" class="mob-toggler">
                    <i class="feather icon-more-vertical"></i>
                </a>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container" style="background-color: white">
        <div class="pcoded-wrapper container text-center">    
				<h2>SISTEM INFORMASI PEMINJAMAN DAN PENGEMBALIAN</h2>
                <h2>BARANG MILIK NEGARA</h2>
				<img src="{{asset('template')}}/dist/assets/images/logoPolsub.png" style="width:40%" alt="" class="logo">
        </div>


        <div class="pcoded-wrapper container text-center mt-4">    
            <h2>BMN TERSEDIA</h2> 
        </div>
        <div class="row" style="margin-left:2em;margin-right:2em;">
                @foreach($item as $data)
                <div class="col col-6 col-md-3" style="margin-top:1em;">
                    <div class="card h-100" style="border:1px solid grey">
                        <div type="button" onclick="tambahitem({{ $data->id_item }})"  class="card-header h-75">
                            <div style="text-align: center">
                                @if($data->kategori_item == "Barang")
                                <img class="img-rounded" src="{{asset('foto/dm/barang/'. $data->foto_item)}}" width="50%" height="50%"  alt="">    
                                @elseif($data->kategori_item == "Ruangan")
                                <img class="img-rounded" src="{{asset('foto/dm/ruangan/'. $data->foto_item)}}" width="50%" height="50%" alt="">    
                                @elseif($data->kategori_item == "Kendaraan")
                                <img class="img-rounded" src="{{asset('foto/dm/kendaraan/'. $data->foto_item)}}" width="50%" height="50%" alt="">    
                                @endif
                            </div>                     
                        </div>
                        <div class="card-body h-20">
                            <div style="text-align: center">
                                <h6>{{$data->nama_item}}</h6>
                              
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
        <br>
    </div>
    <!-- [ Main Content ] end -->

        <!-- Warning Section start -->
        <!-- Older IE warning message -->
        <!--[if lt IE 11]>
            <div class="ie-warning">
                <h1>Warning!!</h1>
                <p>You are using an outdated version of Internet Explorer, please upgrade
                   <br/>to any of the following web browsers to access this website.
                </p>
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="{{asset('template')}}/dist/assets/images/browser/chrome.png" alt="Chrome">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="{{asset('template')}}/dist/assets/images/browser/firefox.png" alt="Firefox">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="{{asset('template')}}/dist/assets/images/browser/opera.png" alt="Opera">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="{{asset('template')}}/dist/assets/images/browser/safari.png" alt="Safari">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="{{asset('template')}}/dist/assets/images/browser/ie.png" alt="">
                                <div>IE (11 & above)</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <p>Sorry for the inconvenience!</p>
            </div>
        <![endif]-->
        <!-- Warning Section Ends -->

        <!-- Required Js -->
        <script src="{{asset('template')}}/dist/assets/js/vendor-all.min.js"></script>
        <script src="{{asset('template')}}/dist/assets/js/plugins/bootstrap.min.js"></script>
        <script src="{{asset('template')}}/dist/assets/js/ripple.js"></script>
        <script src="{{asset('template')}}/dist/assets/js/pcoded.min.js"></script>


    <!-- prism Js -->
    <script src="{{asset('template')}}/dist/assets/js/plugins/prism.js"></script>

    



    <script src="{{asset('template')}}/dist/assets/js/horizontal-menu.js"></script>
    <script>
        (function() {
            if ($('#layout-sidenav').hasClass('sidenav-horizontal') || window.layoutHelpers.isSmallScreen()) {
                return;
            }
            try {
                window.layoutHelpers._getSetting("Rtl")
                window.layoutHelpers.setCollapsed(
                    localStorage.getItem('layoutCollapsed') === 'true',
                    false
                );
            } catch (e) {}
        })();
        $(function() {
            $('#layout-sidenav').each(function() {
                new SideNav(this, {
                    orientation: $(this).hasClass('sidenav-horizontal') ? 'horizontal' : 'vertical'
                });
            });
            $('body').on('click', '.layout-sidenav-toggle', function(e) {
                e.preventDefault();
                window.layoutHelpers.toggleCollapsed();
                if (!window.layoutHelpers.isSmallScreen()) {
                    try {
                        localStorage.setItem('layoutCollapsed', String(window.layoutHelpers.isCollapsed()));
                    } catch (e) {}
                }
            });
        });
        $(document).ready(function() {
            $("#pcoded").pcodedmenu({
                themelayout: 'horizontal',
                MenuTrigger: 'hover',
                SubMenuTrigger: 'hover',
            });
        });
    </script>

    <script src="{{asset('template')}}/dist/assets/js/analytics.js"></script>

</body>

</html>

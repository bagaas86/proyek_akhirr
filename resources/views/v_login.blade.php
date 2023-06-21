<!DOCTYPE html>
<html lang="en">

<head>

	<title>SIP3</title>
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
	<!-- Favicon icon -->
	<link rel="icon" href="{{asset('template')}}/dist/assets/images/favicon.ico" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="{{asset('template')}}/dist/assets/css/style.css">
	
	


</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content">
		<div class="card">
			@if (session()->has('error'))
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
    		{{session()->get('error')}}
    		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			@endif
			<div class="row align-items-center text-center">
				<div class="col-md-12">
					<div class="card-body">
						<img src="{{asset('template')}}/dist/assets/images/logoPolsub.png" alt="" style="width:60px" class="img-fluid mb-4">
                  <h6>Sistem Informasi Barang Milik Negara</h6>
                  <h6>Politeknik Negeri Subang</h6>
                  <br>
						<h4 class="mb-3 f-w-400">Masuk</h4>
                  <form class="form" action="{{route('login.check')}}" method="POST" >
                     @csrf
						<div class="form-group mb-3">
							<label class="floating-label" for="Email">Username</label>
							<input type="text" class="form-control  @error('username') is-invalid @enderror" id="Email" placeholder="" name="username">
							@error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
						</div>
						<div class="form-group mb-4">
							<label class="floating-label" for="Password">Password</label>
							<input type="password" class="form-control  @error('password') is-invalid @enderror" id="Password" placeholder="" name="password">
							@error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
						</div>
						<button class="btn btn-block btn-primary mb-4">Masuk</button>
                  <form>
						<p class="mb-2 text-muted">Lupa Password? <a href="auth-reset-password.html" class="f-w-400">Atur ulang</a></p>
						{{-- <p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup.html" class="f-w-400">Signup</a></p> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="fixed-button active"><a href="/" class="btn btn-md btn-warning"><i class="fa fa-home" aria-hidden="true"></i> Kembali ke Home</a> </div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="{{asset('template')}}/dist/assets/js/vendor-all.min.js"></script>
<script src="{{asset('template')}}/dist/assets/js/plugins/bootstrap.min.js"></script>
<script src="{{asset('template')}}/dist/assets/js/ripple.js"></script>
<script src="{{asset('template')}}/dist/assets/js/pcoded.min.js"></script>



</body>

</html>

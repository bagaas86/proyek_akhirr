@extends('layouts.templateBaru')
@section('content')
<div class="container">
	
	@if (session()->has('success'))
    <div onload="alert()"></div>
	@endif
	
	<div class="container d-flex flex-column align-items-center justify-content-center" data-aos="fade-up">
		<h1>Sistem Informasi Peminjaman Barang Milik Negara</h1>
		<h2>Politeknik Negeri Subang</h2>
		<a href="{{url('auth')}}" class="btn-get-started scrollto">Mulai</a>
		<img src="{{asset('templateBaru')}}/assets/img/hero-img.png" class="img-fluid hero-img" alt="" data-aos="zoom-in" data-aos-delay="150">
	  </div>
  
</div>
@endsection

@section('clients')
<div class="row">

	<div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
	  <img src="{{asset('templateBaru')}}/assets/img/clients/client-1.png" class="img-fluid" alt="">
	</div>

	<div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
	  <img src="{{asset('templateBaru')}}/assets/img/clients/client-2.png" class="img-fluid" alt="">
	</div>

	<div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
	  <img src="{{asset('templateBaru')}}/assets/img/clients/client-3.png" class="img-fluid" alt="">
	</div>

	<div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
	  <img src="{{asset('templateBaru')}}/assets/img/clients/client-4.png" class="img-fluid" alt="">
	</div>

	<div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
	  <img src="{{asset('templateBaru')}}/assets/img/clients/client-5.png" class="img-fluid" alt="">
	</div>

	<div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
	  <img src="{{asset('templateBaru')}}/assets/img/clients/client-6.png" class="img-fluid" alt="">
	</div>

  </div>
@endsection

@section('services')
<div class="section-title">
	<h2>Services</h2>
	<p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
  </div>

  <div class="row">
	<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
	  <div class="icon-box">
		<div class="icon"><i class="bx bxl-dribbble"></i></div>
		<h4 class="title"><a href="">Lorem Ipsum</a></h4>
		<p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
	  </div>
	</div>

	<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
	  <div class="icon-box">
		<div class="icon"><i class="bx bx-file"></i></div>
		<h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
		<p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
	  </div>
	</div>

	<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="300">
	  <div class="icon-box">
		<div class="icon"><i class="bx bx-tachometer"></i></div>
		<h4 class="title"><a href="">Magni Dolores</a></h4>
		<p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
	  </div>
	</div>

	<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="400">
	  <div class="icon-box">
		<div class="icon"><i class="bx bx-layer"></i></div>
		<h4 class="title"><a href="">Nemo Enim</a></h4>
		<p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
	  </div>
	</div>

  </div>
@endsection

@section('contact')
<div class="section-title">
	<h2>Contact</h2>
	<p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
  </div>

  <div class="row">

	<div class="col-lg-6">

	  <div class="row">
		<div class="col-md-12">
		  <div class="info-box">
			<i class="bx bx-map"></i>
			<h3>Our Address</h3>
			<p>A108 Adam Street, New York, NY 535022</p>
		  </div>
		</div>
		<div class="col-md-6">
		  <div class="info-box mt-4">
			<i class="bx bx-envelope"></i>
			<h3>Email Us</h3>
			<p>info@example.com<br>contact@example.com</p>
		  </div>
		</div>
		<div class="col-md-6">
		  <div class="info-box mt-4">
			<i class="bx bx-phone-call"></i>
			<h3>Call Us</h3>
			<p>+1 5589 55488 55<br>+1 6678 254445 41</p>
		  </div>
		</div>
	  </div>

	</div>

	<div class="col-lg-6 mt-4 mt-md-0">
	  <form action="forms/contact.php" method="post" role="form" class="php-email-form">
		<div class="row">
		  <div class="col-md-6 form-group">
			<input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
		  </div>
		  <div class="col-md-6 form-group mt-3 mt-md-0">
			<input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
		  </div>
		</div>
		<div class="form-group mt-3">
		  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
		</div>
		<div class="form-group mt-3">
		  <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
		</div>
		<div class="my-3">
		  <div class="loading">Loading</div>
		  <div class="error-message"></div>
		  <div class="sent-message">Your message has been sent. Thank you!</div>
		</div>
		<div class="text-center"><button type="submit">Send Message</button></div>
	  </form>
	</div>

  </div>
@endsection



<script>
	function alert(){
		Swal.fire(
                    {
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Item Berhasil Ditambahkan!'
                        }
                    )
	}
</script>
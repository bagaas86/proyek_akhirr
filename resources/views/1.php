@extends('layouts/template')
@section('header')
 <div class="container-fluid iq-container">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="flex-wrap d-flex justify-content-between align-items-center">
                              <div>
                                  <h1>Selamat Datang {{Auth::user()->name}}</h1>
                                  <p>Sistem Informasi Aset dan Barang Milik Negara Politeknik Negeri Subang</p>
                              </div>
                          </div>
                      </div>
                  </div>
@endsection
@section('content')
<div class="overflow-hidden d-slider1 ">
    <ul  class="p-0 m-0 mb-2 swiper-wrapper list-inline">
       <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
          <div class="card-body">
             <div class="progress-widget">
                <div id="circle-progress-01" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="1000" data-value="500" data-type="percent">
                   <svg class="card-slie-arrow icon-24" width="24"  viewBox="0 0 24 24">
                      <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                   </svg>
                </div>
                <div class="progress-detail">
                   <p  class="mb-2">Barang</p>
                   <h4 class="counter">500</h4>
                </div>
             </div>
          </div>
       </li>
       <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
          <div class="card-body">
             <div class="progress-widget">
                <div id="circle-progress-02" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="50" data-value="60" data-type="percent">
                   <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                   </svg>
                </div>
                <div class="progress-detail">
                   <p  class="mb-2">Ruangan</p>
                   <h4 class="counter">60</h4>
                </div>
             </div>
          </div>
       </li>
       <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
          <div class="card-body">
             <div class="progress-widget">
                <div id="circle-progress-03" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="10" data-type="percent">
                   <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                   </svg>
                </div>
                <div class="progress-detail">
                   <p  class="mb-2">Kendaraan</p>
                   <h4 class="counter">10</h4>
                </div>
             </div>
          </div>
       </li>
       <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
          <div class="card-body">
             <div class="progress-widget">
                <div id="circle-progress-04" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="25" data-type="percent">
                   <svg class="card-slie-arrow icon-24" width="24px"  viewBox="0 0 24 24">
                      <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                   </svg>
                </div>
                <div class="progress-detail">
                   <p  class="mb-2">Supir</p>
                   <h4 class="counter">25</h4>
                </div>
             </div>
          </div>
       </li>
       <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
          <div class="card-body">
             <div class="progress-widget">
                <div id="circle-progress-07" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="500" data-value="50" data-type="percent">
                   <svg class="card-slie-arrow icon-24 " width="24" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                   </svg>
                </div>
                <div class="progress-detail">
                   <p  class="mb-2">Pengguna</p>
                   <h4 class="counter">500</h4>
                </div>
             </div>
          </div>
       </li>
    </ul>
    <div class="swiper-button swiper-button-next"></div>
    <div class="swiper-button swiper-button-prev"></div>
 </div>



@endsection

@extends('layouts.default')





@section('main')
     <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 flex-column justify-content-center text-center text-lg-start">
          <h2>Rádio Desopila<span>
            @if (Auth::check())
              {{Auth::user()->name}}
            @endif
          </span></h2>
          <p>A plataforma da Rádio Desopila é fonte de comunicação e entretenimento dentro da escola e por isso se tornou um ponto de convergência para a diversidade de vozes e interesses, através de programas culturais, revista, pedidos de música, etc., a rádio se esforça para oferecer conteúdo que informe, inspire e, claro, divirta.
          </p>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <img src="assets/img/hero-img.svg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
        </div>
      </div>
    </div>
  </div>
  </section>
  <!-- End Hero Section -->

@endsection
 
  <!-- ======= Footer ======= -->
  @section('footer')
    @include('layouts.footer')
    
  @endsection
  <div id="preloader"></div>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 

 




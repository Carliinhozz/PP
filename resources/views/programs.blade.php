@extends('layouts.default')
@section('title')
    Quadros
@endsection
@section('main')
        <!-- ======= Our Services Section ======= -->
        <section id="services" class="services sections-bg">
            <div class="container" >
      
              <div class="section-header" data-aos="fade-up">
                <h2>Projetos</h2>
                <p>Confira nossos trabalhos</p>
              </div>
      
              <div class="row gy-4"  data-aos="fade-up" data-aos="delay-100">
      
                <div class="col-lg-4 col-md-6">
                  <div class="service-item  position-relative">
                    <div class="icon">
                      <i class="bi bi-briefcase"></i>
                    </div>
                    <h3>Carreiras</h3>
                    <p>Quadro onde você conhece a trajetória de diversos profissionais que compartilham suas experiências desde os primeiros passos na carreira até os desafios enfrentados durante a sua formação e sua rotina naquela profissão. </p>
                    <a href="#" class="readmore stretched-link">Saiba mais</a>
                  </div>
                </div><!-- End Service Item -->
      
              
      
                <div class="col-lg-4 col-md-6">
                  <div class="service-item position-relative">
                    <div class="icon">
                    <i class="bi bi-mic"></i>
                    </div>
                    <h3>IFCast</h3>
                    <p>Podcast com temas voltados para o mistério e curiosidades mundiais, fatos inusitados do cotidiano</p>
                    <a href="#" class="readmore stretched-link">Saiba mais</a>
                  </div>
                </div><!-- End Service Item -->
      
                <div class="col-lg-4 col-md-6">
                  <div class="service-item position-relative">
                    <div class="icon">
                    <i class="bi bi-chat"></i>
                    </div>
                    <h3>Papo de Almoço</h3>
                    <p>Diversas entrevistas sobre variados temas.</p>
                    <a href="#" class="readmore stretched-link">Saiba mais</a>
                  </div>
                </div><!-- End Service Item -->
      
                <div class="col-lg-6 col-md-6">
                  <div class="service-item position-relative">
                    <div class="icon">
                    <i class="bi bi-newspaper"></i>
                    </div>
                    <h3>Desopila News</h3>
                    <p>Aqui, você permanece informado sobre as últimas notícias envolvendo o IFRN.</p>
                    <a href="#" class="readmore stretched-link">Saiba mais</a>
                  </div>
                </div><!-- End Service Item -->
      
                <div class="col-lg-6 col-md-6">
                  <div class="service-item position-relative">
                    <div class="icon">
                    <i class="bi bi-book"></i>
                    </div>
                    <h3>Revista Impúrpura</h3>
                    <p>Revista da Rádio Desopila.</p>
                    <a href="#" class="readmore stretched-link">Saiba mais</a>
                  </div>
                </div><!-- End Service Item -->
      
              </div>
      
            </div>
          </section><!-- End Our Services Section -->
@endsection
@section('footer')
    @include('layouts.footer')
@endsection
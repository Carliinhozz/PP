@extends('layouts.default')
@section('title')
    Sobre nós
@endsection
@section('main')
      <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Sobre a Rádio</h2>
          <p>Você sabe como tudo começou?</p>
        </div>

          <div class="container gy-4">
            <div class="row">
              <div class="col-lg-6"><img src="assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt=""></div>
              <div class="col-lg-6">
                <p>A Rádio Escolar foi criada no ano de 2019 como um projeto de extensão, que tinha como objetivo contribuir para o desenvolvimento educacional, social e cultural dos alunos do IFRN - Campus Caicó, a partir da divulgação das atividades culturais que ocorrem no ambiente escolar. Tais atividades Agregado a este projeto, houve a criação de uma página na web, com o intuito de registrar e ampliar as atividades artísticas e culturais desenvolvidas no Campus Caicó, dessa forma transformando o ambiente da rádio escolar numa experiência digital aberta ao público.</p>
                <p>Embora se tenha tido um bom proveito da Web Rádio e ela tenha funcionado muito bem para as funções que ela visava, não havia funcionalidades voltadas para a otimização do trabalho dos bolsistas no site. A nossa proposta é ir além da exposição e explorar a interação com o público, facilitando a comunicação entre quem oferece os recursos e quem procura por ele.</p>
              </div>
            </div>
            </div>
          </div>

      </div>
    </section><!-- End About Us Section -->
@endsection
@section('footer')
    @include('layouts.footer')
@endsection

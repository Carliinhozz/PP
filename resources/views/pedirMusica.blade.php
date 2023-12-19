@extends('layouts.default')

@section('main')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 flex-column justify-content-center text-center text-lg-start">
          <h2>Pedir Música</h2>
          <p>Pedir música é uma forma de participar e interagir com a Rádio Desopila. Deixe sua sugestão e faça parte da nossa programação!</p>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <!-- Adicione uma imagem representativa, se desejar -->
          <!-- <img src="caminho-para-sua-imagem.jpg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100"> -->
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Adicione o Contêiner de Formulário para Pedir Música -->
  @if (Auth::check())
    <section id="pedido-musica" class="pedido-musica">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="purple-box rounded-3 p-4">
              <form action="{{ route('pedirmusica') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="musica" class="form-label text-white">Nome da Música:</label>
                    <input type="text" class="form-control" name="musica" required>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="artista" class="form-label text-white">Artista:</label>
                    <input type="text" class="form-control" name="artista" required>
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="turno" class="form-label text-white">Turno:</label>
                    <select class="form-select" name="turno">
                      <option value="manha">Manhã</option>
                      <option value="tarde">Tarde</option>
                      <option value="noite">Noite</option>
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-yellow">Enviar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif
@endsection

<style>
  .purple-box {
    background-color: #534881;
  }
</style>

@section('footer')
  <!-- Sem footer nesta página -->
@endsection

<div id="preloader"></div>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
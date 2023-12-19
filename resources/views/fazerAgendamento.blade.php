@extends('layouts.default')

@section('main')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 flex-column justify-content-center text-center text-lg-start">
          <h2>Fazer Agendamento</h2>
          <p>Agende um horário para tocar na Rádio Desopila. Preencha as informações abaixo e reserve seu horário!</p>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <!-- Adicione uma imagem representativa, se desejar -->
          <!-- <img src="caminho-para-sua-imagem.jpg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100"> -->
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Adicione o Contêiner de Formulário para Fazer Agendamento -->
  @if (Auth::check())
    <section id="fazer-agendamento" class="fazer-agendamento">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="purple-box rounded-3 p-4">
              <form action="{{ route('fazeragendamento') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="estudante" class="form-label text-white">Estudante:</label>
                    <input type="text" class="form-control" name="estudante" value="{{ Auth::user()->name }}" readonly>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="matricula" class="form-label text-white">Matrícula:</label>
                    <input type="text" class="form-control" name="matricula" value="{{ Auth::user()->registration }}" readonly>
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="data" class="form-label text-white">Data:</label>
                    <input type="date" class="form-control" name="data" required>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="instrumento" class="form-label text-white">Instrumento:</label>
                    <input type="text" class="form-control" name="instrumento" required>
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="horario" class="form-label text-white">Horário:</label>
                    <input type="time" class="form-control" name="horario" required>
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

  .btn-yellow {
    background-color: #f4d65d;
    color: #000000;
  }
</style>

@section('footer')
  <!-- Sem footer nesta página -->
@endsection

<div id="preloader"></div>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
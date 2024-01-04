@extends('layouts.default')

@section('main')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 flex-column justify-content-center text-center text-lg-start">
          <h2>Fazer Agendamento</h2>
          <p>Preencha as informações abaixo e reserve seu horário na sala de música!</p>
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
        <div class="row justify-content-center" data-aos="fade-in">
          <div class="col-lg-12">
            <div class="purple-box rounded-3 p-4">
              <form action="{{ route('borrow.index') }}" method="POST">
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
                    <select class="form-select" name="horario" required>
                        <!-- Manhã -->
                        <optgroup label="Manhã">
                            <option value="7h - 8h">7h - 8h</option>
                            <option value="9h - 10h">9h - 10h</option>
                            <option value="10h - 11h">10h - 11h</option>
                            <option value="11h - 12h">11h - 12h</option>
                        </optgroup>

                        <!-- Tarde -->
                        <optgroup label="Tarde">
                            <option value="13h - 14h">13h - 14h</option>
                            <option value="15h - 16h">15h - 16h</option>
                            <option value="16h - 17h">16h - 17h</option>
                            <option value="17h - 18h">17h - 18h</option>
                        </optgroup>

                        <!-- Noite -->
                        <optgroup label="Noite">
                            <option value="19h - 20h">19h - 20h</option>
                            <option value="20h - 21h">20h - 21h</option>
                        </optgroup>
                    </select>
                </div>
                </div>
                <button type="submit" class="btn-env">Enviar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif
@endsection

<script>
    document.addEventListener('DOMContentLoaded', async function () {
        var dataInput = document.querySelector('input[name="data"]');

        // Função para verificar se a data é um feriado ou final de semana
        async function isHolidayOrWeekend(date) {
            var formattedDate = date.toISOString().split('T')[0];
            var apiKey = '5930|Dm6va8HOVnVmCTQiNI4KcdZUEvSs3KmP';
            var state = 'RN';

            var url = `https://api.invertexto.com/v1/holidays/${date.getFullYear()}?token=${apiKey}&state=${state}`;

            try {
                var response = await fetch(url);
                var data = await response.json();

                // Verifica se a data é um feriado ou final de semana
                return data.some(feriado => feriado.date === formattedDate) || date.getDay() === 0 || date.getDay() === 6;
            } catch (error) {
                console.error('Erro ao verificar feriado:', error);
                return false;
            }
        }

        // Função para validar a data ao selecioná-la
        async function validarDataSelecionada() {
            var dataSelecionada = new Date(dataInput.value);

            if (await isHolidayOrWeekend(dataSelecionada)) {
                alert('Selecione uma data válida. Finais de semana e feriados não são permitidos.');
                dataInput.value = ''; // Limpar o campo se for inválido
            }
        }

        // Adicione um ouvinte de eventos ao campo de data
        dataInput.addEventListener('change', validarDataSelecionada);
    });
</script>




@section('footer')
  <!-- Sem footer nesta página -->
@endsection

<div id="preloader"></div>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
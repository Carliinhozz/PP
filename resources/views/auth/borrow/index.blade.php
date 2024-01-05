@extends('layouts.default')

@section('main')

<section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 flex-column justify-content-center text-center text-lg-start">
          <h2>Fazer Agendamento</h2>
          <p>Preencha as informações abaixo e reserve seu horário na sala de música!</p>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
        </div>
      </div>
    </div>
  </section>

    <section id="fazer-agendamento" class="fazer-agendamento">
      <div class="container">
        <div class="row justify-content-center" data-aos="fade-in">
          <div class="col-lg-12">
            <div class="purple-box rounded-3 p-4">
              <form action="{{ route('borrow.create') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="date" class="form-label text-white">Data:</label>
                    <input type="date" class="form-control" name="date" required>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="horario" class="form-label text-white">Horário:</label>
                    <select class="form-select" name="horario" required>
                        <!-- Manhã -->
                        <optgroup label="Manhã">
                            <option value="7">7h - 8h</option>
                            <option value="9">9h - 10h</option>
                            <option value="10">10h - 11h</option>
                        </optgroup>

                        <!-- Tarde -->
                        <optgroup label="Tarde">
                            <option value="13">13h - 14h</option>
                            <option value="15">15h - 16h</option>
                            <option value="16">16h - 17h</option>
                            <option value="17">17h - 18h</option>
                        </optgroup>

                        <!-- Noite -->
                        <optgroup label="Noite">
                            <option value="19">19h - 20h</option>
                            <option value="20">20h - 21h</option>
                        </optgroup>
                    </select>
                </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label for="instrument" class="form-label text-white">Instrumento:</label>
                    <select class="form-select" name="instrument" required>
                      @foreach ($instruments as $instrument)
                        <option value="{{ $instrument->id }}">
                          {{ $instrument->name }} - {{ $instrument->description }}
                        </option>
                      @endforeach
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
@endsection

<script>
    document.addEventListener('DOMContentLoaded', async function () {
        var dataInput = document.querySelector('input[name="data"]');

        async function isHolidayOrWeekend(date) {
            var formattedDate = date.toISOString().split('T')[0];
            var apiKey = '5930|Dm6va8HOVnVmCTQiNI4KcdZUEvSs3KmP';
            var state = 'RN';

            var url = `https://api.invertexto.com/v1/holidays/${date.getFullYear()}?token=${apiKey}&state=${state}`;

            try {
                var response = await fetch(url);
                var data = await response.json();

                return data.some(feriado => feriado.date === formattedDate) || date.getDay() === 0 || date.getDay() === 6;
            } catch (error) {
                console.error('Erro ao verificar feriado:', error);
                return false;
            }
        }

        async function validarDataSelecionada() {
            var dataSelecionada = new Date(dataInput.value);

            if (await isHolidayOrWeekend(dataSelecionada)) {
                alert('Selecione uma data válida. Finais de semana e feriados não são permitidos.');
                dataInput.value = ''; 
            }
        }

        dataInput.addEventListener('change', validarDataSelecionada);
    });
</script>

<div id="preloader"></div>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@extends('layouts.default')

@section('main')

<section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 flex-column justify-content-center text-center text-lg-start">
          <h2>Fazer Agendamento</h2>
          <p>Preencha as informações abaixo e reserve seu horário na sala de música!</p>
          @if(session('alert') && session('message'))
              <div class="alert alert-{{ session('alert') }}">
                  {{ session('message') }}
              </div>
          @endif
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function isWeekend(date) {
        const day = date.getDay();
        return day === 5 || day === 6;
    }

    function isHoliday(date, holidays) {
        return holidays.some(holiday => holiday.date === date);
    }

    $(document).ready(function () {
        const currentYear = new Date().getFullYear();

        const holidaysUrl = `https://api.invertexto.com/v1/holidays/${currentYear}?token=6029|NzXSNB9YQnuGlg6gQ10KsgyZL11VN584&state=RN`;

        $.getJSON(holidaysUrl, function (data) {
            const holidays = data;

            $('input[name="date"]').change(function () {
                const selectedDate = $(this).val();
                
                if (!selectedDate) {
                    return;
                }

                const selectedDateObj = new Date(selectedDate);
                const yesterday = new Date();
                yesterday.setDate(yesterday.getDate() - 1);

                if (selectedDateObj.getFullYear() > currentYear) {
                    alert(`Selecione uma data válida para o ano de ${currentYear}.`);
                    $(this).val('');
                    return;
                }

                if (selectedDateObj < yesterday) {
                    alert('Selecione uma data igual ou posterior a hoje.');
                    $(this).val('');
                    return;
                }

                if (isWeekend(selectedDateObj) || isHoliday(selectedDate, holidays)) {
                    alert('Selecione uma data que não seja feriado ou fim de semana.');
                    $(this).val('');
                }
            });
        });
    });
</script>

<div id="preloader"></div>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
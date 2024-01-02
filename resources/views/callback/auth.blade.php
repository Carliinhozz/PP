<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@700&display=swap">
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa; /* Cor de fundo */
        }
        #overlay {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }
        #loading-text {
            font-size: 100px; /* Tamanho da fonte */
            color: #534881; /* Cor roxa desejada */
            font-family: 'League Spartan', sans-serif; /* Fonte League Spartan */
            animation: jump 0.5s infinite alternate; /* Modificada a animação */
            text-align: center;
        }
        @keyframes jump {
            0% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(-40px); /* Aumentada a altura do pulo */
            }
        }
    </style>
</head>

<body>

    <div id="overlay">
        <div id="loading-text">Carregando...</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/js.cookie.js"></script>
    <script src="js/client.js"></script>
    <script>
        $(document).ready(function () {
          $("#overlay").show();
            var suap = new SuapClient(
                "{{ config('suap.uri') }}",
                "{{ config('suap.client_id') }}",
                "{{ config('suap.redirect_uri') }}",
                "{{ config('suap.scope') }}"
            );
            suap.init();
            if (suap.isAuthenticated()) {
                const suapToken = suap.getToken().getValue();
                const csrfToken = document.getElementsByName('_token')[0].value;
                $.ajax({
                    url: '/authorization-callback',
                    data: {
                        '_token': csrfToken,
                        'suap_token': suapToken,
                    },
                    type: 'POST',
                    success: function (response) {
                        window.location = '/'
                    },
                    error: function (response) {
                        alert('Falha na comunicação com o servidor');
                        console.log(response);
                    },
                    complete: function () {
                        $("#overlay").hide();
                    }
                });
            } else {
                alert('A autenticação via SUAP falhou.');
                window.location = "/";
            }
        });
    </script>
    @csrf
</body>
</html>
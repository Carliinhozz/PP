<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Rádio Desopila')</title>
</head>
<body>
    @yield('header')
    {{--Define o header da página, quando o usuário é administrador vai aparecer novas funções no header, como cadastrar instrumento ou cadastrar adiministrador  --}}
    @yield('main')
    {{-- Conteúdo principal da aplicação --}}
    @yield('footer')
    {{-- Aqui é definido o footer da aplicação, caso não tenha, pelo modelo eu não consegui identificar, apaga o yield --}}

    {{-- Caso aparça necessidades de mais yields pode colocar --}}
</body>
</html>
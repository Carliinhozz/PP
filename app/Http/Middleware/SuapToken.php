<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuapToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->cookie('suapToken'))
            # TODO: Verificar se o token é válido no SUAP?
            # TODO: Vertificar se o token passado é o mesmo da Session atual
            return $next($request);
            

        /* Se a requisição for GET, redireciona para a página inicial.
           Senão, apenas diz que é proibido.
           TODO: Adicionar mensagem ou página inteira indicando para o usuário
           que ele precisa fazer login. */
        if(Auth::check()){
            Auth::logout();
        } 
        return $request->method() == 'GET' ? redirect(route('home')) : abort(403);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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
        if ($request->cookie('suapToken') && Cookie::has('suapTokenExpirationTime')){
            # TODO: Verificar se o token é válido no SUAP?
            # TODO: Vertificar se o token passado é o mesmo da Session atual
            return $next($request);
        }
  
        Cookie::queue(Cookie::forget('suapToken'));
        Cookie::queue(Cookie::forget('suapTokenExpirationTime'));
        Cookie::queue(Cookie::forget('suapScope'));
        if(Auth::check()){
            Auth::logout();
            
            $request->session()->invalidate();
         
            $request->session()->regenerateToken();
        } 
        return $request->method() == 'GET' ? redirect(route('home')) : abort(403);
    }
}

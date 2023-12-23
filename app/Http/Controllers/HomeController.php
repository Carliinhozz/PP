<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Cookie::has('suapTokenExpirationTime') && Cookie::has('suapToken') && Auth::check()){
            return view('auth.index');
        }
        Auth::logout();
            
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
        return view('index');
    }
}

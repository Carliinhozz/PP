<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\SuapToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/testes', function () {
    return view('auth.music.show');
});
Route::name('home')->get('/', function () {
    if(Auth::check()){
        return view('auth.index');
    }
    return view('index');
  
});
Route::get('/quadros', function () {
    return view('programs');
});
Route::get('/sobre', function ()  {
    return view('about');
});

Route::get('/perfil', function () {    
    return view('user.perfil');
})->middleware (SuapToken::class);


Route::middleware(SuapToken::class)->name('music.')->group(function () {
        Route::get('musicas', [MusicController::class,'index'])->name('index');
        Route::post('musicas', [MusicController::class,'search'])->name('search');
        Route::post('musicas/{id}', [MusicController::class,'store'])->name('store');
    }

);

Route::name('login.')
    ->group(function () {
        Route::get('/auth', [LoginController::class, 'index']);
        Route::get('/login', [LoginController::class, 'pre_login']);
        Route::post('/authorization-callback',[LoginController::class,'callback']);        
    }
);

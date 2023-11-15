<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\LoginController;
use App\Models\User;
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

Route::get('/api', function () {
    return view('welcome');
});
Route::name('home')->get('/', function () {
    return view('index');
});
Route::get('/quadros', function () {
    return view('programs');
});
Route::get('/sobre', function () {
    return view('about');
});
Route::resource("musicas",MusicController::class);

Route::name('login.')
    ->group(function () {
        Route::get('/auth', [LoginController::class, 'index']);
        
        Route::post('/authorization-callback',[LoginController::class,'callback']);        
    }
);



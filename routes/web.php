<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('index');
});
Route::get('/quadros', function () {
    return view('programs');
});
Route::get('/sobre', function () {
    return view('about');
});
Route::resource("musicas",MusicController::class);
Route::resource("login",LoginController::class);




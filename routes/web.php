<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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
Route::get("login", function (){
    $response_type = 'token';
    $grant_type = 'implict';
    $scope = 'identificacao email documentos_pessoais';
    $suap_uri = 'https://suap.ifrn.edu.br';

    # Parâmetros que dependem do ambiente de execução
    $client_id = env('SUAP_CLIENT_ID');
    
    $uri_login= $suap_uri . '/o/authorize/?' . http_build_query([
        'response_type' => $response_type,
        'grant_type' => $grant_type,
        'client_id' => $client_id,
        'scope' => $scope,
        'redirect_uri' => 'http://localhost:8000/api',
    ]);
    $response= Http::get($uri_login);
    

});




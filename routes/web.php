<?php

use App\Http\Controllers\BorrowController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\SuapToken;
use App\Http\Middleware\SuperAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



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
Route::name('home')->get('/',[HomeController::class, 'index']);

Route::get('/quadros', function () {
    return view('programs');
});
Route::get('/sobre', function ()  {
    return view('about');
});

Route::get('/perfil', [UserController::class,'perfil'])->middleware (SuapToken::class);


Route::middleware(SuapToken::class)->name('borrow.')->group(function () {
    Route::get('agendamentos',[BorrowController::class,'index'])->name('index');
    Route::post('agendamentos', [BorrowController::class, 'create'])->name('create');
    Route::delete('/borrows/{id}', [BorrowController::class, 'destroy'])->name('delete')->middleware('auth');


    
});

Route::middleware(SuapToken::class)->name('music.')->group(function () {
        Route::get('musicas', [MusicController::class,'index'])->name('index');
        Route::post('musicas', [MusicController::class,'search'])->name('search');
        Route::post('musicas/{id}', [MusicController::class,'store'])->name('store');
        Route::post('musicas/{id}/delete/{music_id}', [MusicController::class,'destroy'])->name('delete');
    }

);

Route::middleware(SuapToken::class)->name('playlist.')->group(function () {
    Route::get('playlist', [PlaylistController::class,'index'])->name('index');
    Route::post('playlist/{id}', [PlaylistController::class,'edit'])->name('edit');
    Route::post('playlist/{id}/delete/{music_id}', [PlaylistController::class,'delete'])->name('delete');
    Route::get('playlist/{id}/adicionar', [PlaylistController::class,'add_index'])->name('add_index');
    Route::post('playlist/{id}/adicionar{music_id}', [PlaylistController::class,'add_store'])->name('add_store');
    Route::post('playlist/{id}/store', [PlaylistController::class,'store'])->name('store');
});
Route::middleware(SuapToken::class)->name('instruments.')->group(function (){
    Route::get('instrumentos',[InstrumentController::class, 'index'])->name('index');
    Route::post('instrumentos',[InstrumentController::class, 'store'])->name('store');
    Route::get('instrumentos/{id}',[InstrumentController::class, 'show'])->name('show');
    Route::post('instrumentos/{id}/editar',[InstrumentController::class, 'update'])->name('update');
    Route::post('instrumentos/{id}/deletar',[InstrumentController::class, 'destroy'])->name('delete');
});
Route::name('suap.')
    ->group(function () {
        Route::get('/auth', [LoginController::class, 'index']);
        Route::get('/login', [LoginController::class, 'pre_login']);
        Route::post('/authorization-callback',[LoginController::class,'callback']);        
    }
);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
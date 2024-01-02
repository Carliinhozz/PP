<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlaylistController;
use App\Http\Middleware\SuapToken;
use App\Models\Music;
use App\Models\Playlist;
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

Route::get('/perfil', function () {    
    return view('auth.user.perfil');
})->middleware (SuapToken::class);


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
    Route::get('playlist/{id}', [PlaylistController::class,'show'])->name('show');
    Route::post('playlist/{id}/delete/{music_id}', [PlaylistController::class,'delete'])->name('delete');
    Route::get('playlist/{id}/adicionar', [PlaylistController::class,'add_index'])->name('add_index');
    Route::post('playlist/{id}/adicionar{music_id}', [PlaylistController::class,'add_store'])->name('add_store');
    Route::post('playlist/{id}/store', [PlaylistController::class,'store'])->name('store');

}

);

Route::name('suap.')
    ->group(function () {
        Route::get('/auth', [LoginController::class, 'index']);
        Route::get('/login', [LoginController::class, 'pre_login']);
        Route::post('/authorization-callback',[LoginController::class,'callback']);        
    }
);


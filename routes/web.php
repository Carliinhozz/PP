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

Route::get('/perfil', [UserController::class,'perfil'])->middleware (SuapToken::class)->name('perfil');


Route::middleware(SuapToken::class)->name('borrow.')->group(function () {
    Route::get('agendamentos',[BorrowController::class,'index'])->name('index');
    Route::post('agendamentos', [BorrowController::class, 'create'])->name('create');
    Route::delete('/borrow/{id}', [BorrowController::class, 'destroy'])->name('delete');
    Route::get('/borrow/{id}/editar', [BorrowController::class, 'edit'])->name('edit')->middleware(Admin::class);
    Route::post('/borrow/{id}/editar', [BorrowController::class, 'update'])->name('update')->middleware(Admin::class);
    
});


Route::middleware(SuapToken::class)->name('music.')->group(function () {
        Route::get('musicas', [MusicController::class,'index'])->name('index');
        Route::post('musicas', [MusicController::class,'search'])->name('search');
        Route::post('musicas/{id}', [MusicController::class,'store'])->name('store');
        Route::post('musicas/{id}/delete/{music_id}', [MusicController::class,'destroy'])->name('delete')->middleware(Admin::class);
        
 });

Route::middleware(SuapToken::class)->name('playlist.')->group(function () {
    Route::get('playlist', [PlaylistController::class,'index'])->name('index')->middleware(Admin::class);
    Route::post('playlist/{id}/delete/{music_id}', [PlaylistController::class,'delete'])->name('delete')->middleware(Admin::class);
    Route::get('playlist/{id}/adicionar', [PlaylistController::class,'add_index'])->name('add_index')->middleware(Admin::class);
    Route::post('playlist/{id}/adicionar{music_id}', [PlaylistController::class,'add_store'])->name('add_store')->middleware(Admin::class);
    Route::post('playlist/{id}/store', [PlaylistController::class,'store'])->name('store')->middleware(Admin::class);
});//bolsista

Route::middleware(SuapToken::class)->name('instruments.')->group(function (){
    Route::get('instrumentos',[InstrumentController::class, 'index'])->name('index')->middleware(SuperAdmin::class);
    Route::post('instrumentos',[InstrumentController::class, 'store'])->name('store')->middleware(SuperAdmin::class);
    Route::get('instrumentos/{id}',[InstrumentController::class, 'show'])->name('show')->middleware(SuperAdmin::class);
    Route::post('instrumentos/{id}/editar',[InstrumentController::class, 'update'])->name('update')->middleware(SuperAdmin::class);
    Route::post('instrumentos/{id}/deletar',[InstrumentController::class, 'destroy'])->name('delete')->middleware(SuperAdmin::class);
    Route::post('instrumentos/{id}/edit', [InstrumentController::class, 'edit'])->name('edit')->middleware(Admin::class);
    Route::post('instrumentos/get-details/{instrumentId}', [InstrumentController::class, 'getDetails'])->name('get')->middleware(Admin::class);
});//professor

Route::middleware(SuapToken::class)->name('admin.')->group(function () {
    Route::get('bolsista',[UserController::class,'index'])->name('index')->middleware(SuperAdmin::class);
    Route::post('bolsista',[UserController::class,'search'])->name('search')->middleware(SuperAdmin::class);
    Route::post('bolsista/{id}/delete',[UserController::class,'destroy'])->name('delete')->middleware(SuperAdmin::class);
    Route::post('bolsista/{id}/promote',[UserController::class,'promote'])->name('promote')->middleware(SuperAdmin::class);
});//professor

Route::name('suap.')
    ->group(function () {
        Route::get('/auth', [LoginController::class, 'index']);
        Route::get('/login', [LoginController::class, 'pre_login']);
        Route::post('/authorization-callback',[LoginController::class,'callback']);        
    }
);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
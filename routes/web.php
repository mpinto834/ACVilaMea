<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ProfileController; 
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PlantelController; 
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ArtigoController;

// Página inicial
Route::get('/', [HomeController::class, 'index'])->name('home');

// Páginas públicas (não requerem autenticação)
Route::get('/plantel', [PlantelController::class, 'show'])->name('plantel.show');
Route::view('/noticias', 'noticias');
Route::view('/loja', 'loja');
Route::get('/galeria', action: [GaleriaController::class, 'show'])->name('galeria.show');
Route::get('/calendario', [GameController::class, 'calendario'])->name('calendario');


// Páginas de autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Páginas de registro
Route::get('/register', function() {
    return view('register');
});
Route::post('/register', [RegisterController::class, 'store'])->name('register');

// Rotas do dashboard e perfil (requere login)
Route::middleware('auth')->group(function () {
    // Rota para o dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rota para atualizar o perfil
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Rota para atualizar a senha
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    // Rota para atualizar a foto do perfil
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
});

// Rota para as notícias
Route::get('/noticias', [NewsController::class, 'index'])->name('news.index');
Route::get('/noticias/{slug}', [NewsController::class, 'show'])->name('noticias.show');

// Rotas protegidas para administradores
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/gerir-noticias', [NewsController::class, 'index'])->name('noticias.index');
    Route::post('/noticias', [NewsController::class, 'store'])->name('noticias.store');
    Route::put('/noticias/{noticia}', [NewsController::class, 'update'])->name('noticias.update');
    Route::delete('/noticias/{noticia}', [NewsController::class, 'destroy'])->name('noticias.destroy');
});

// Novas rotas para gerenciamento do plantel
Route::middleware(['auth', 'isAdmin'])->group(function () {
Route::get('/gerir-plantel', [PlantelController::class, 'index'])->name('plantel.index');
Route::post('/plantel', [PlantelController::class, 'store'])->name('plantel.store');
Route::put('/plantel/{jogador}', [PlantelController::class, 'update'])->name('plantel.update');
Route::delete('/plantel/{jogador}', [PlantelController::class, 'destroy'])->name('plantel.destroy');
});


// Rotas protegidas para administrar a galeria
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/gerir-galeria', [GaleriaController::class, 'index'])->name('galeria.index');
    Route::post('/galeria', [GaleriaController::class, 'store'])->name('galeria.store');
    Route::put('/galeria/{foto}', [GaleriaController::class, 'update'])->name('galeria.update');
    Route::delete('/galeria/{foto}', [GaleriaController::class, 'destroy'])->name('galeria.destroy');
});

//Rotas protegidas para administrar os utilizadores
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/gerir-utilizadores', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.update.role');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

//rotas para administrar os jogos
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/gerir-jogos', [GameController::class, 'index'])->name('games.index');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');
    Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update');
});

// Rotas para gerenciamento de artigos (protegidas por autenticação e middleware admin)
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Lista todos os artigos (view de gerenciamento)
    Route::get('/gerir-artigos', [ArtigoController::class, 'index'])->name('artigos.index');
    
    // Criar novo artigo
    Route::post('/artigos', [ArtigoController::class, 'store'])->name('artigos.store');
    
    // Atualizar artigo existente
    Route::put('/artigos/{artigo}', [ArtigoController::class, 'update'])->name('artigos.update');
    
    // Excluir artigo
    Route::delete('/artigos/{artigo}', [ArtigoController::class, 'destroy'])->name('artigos.destroy');
});

// Rota pública para visualizar a loja
Route::get('/loja', [ArtigoController::class, 'loja'])->name('loja');




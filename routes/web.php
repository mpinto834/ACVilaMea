<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\NewsController;

// Página inicial
Route::get('/', function () {
    return view('home');
});

// Páginas públicas (não requerem autenticação)
Route::view('/plantel', 'plantel');
Route::view('/news', 'news');
Route::view('/store', 'loja');
Route::view('/galery', 'galeria');
Route::view('/calendar', 'calendario');

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
Route::get('/news', [NewsController::class, 'index']);

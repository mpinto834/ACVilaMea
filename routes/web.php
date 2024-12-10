<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/plantel',function(){
    return view('plantel');
});

Route::get('/news',function(){
    return view('noticias');
});

Route::get('/login',function(){
    return view('login');
});

Route::get('/register',function(){
    return view('register');
});

Route::get('/dashboard',function(){
    return view('dashboard');
});

Route::get('/loja',function(){
    return view('loja');
});

Route::get('/galeria',function(){
    return view('galeria');
});

Route::get('/calendario',function(){
    return view('calendario');
});


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\NewsController;


Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Rota par exibir o dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rota para atualizar o perfil
    Route::put('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Rota para atualizar a senha
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('password.update');

    // Rota para atualizar a foto do perfil
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');

    Route::get('/news', [NewsController::class, 'index']);
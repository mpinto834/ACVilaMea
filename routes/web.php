<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/plantel',function(){
    return view('plantel');
});

Route::get('/noticias',function(){
    return view('noticias');
});

Route::get('/login',function(){
    return view('login');
});

Route::get('/register',function(){
    return view('register');
});


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home');  // Exemplo de página protegida
    });
});


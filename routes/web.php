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
Route::get('/register',function(){
    return view('register');
});







